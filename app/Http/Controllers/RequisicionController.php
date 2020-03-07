<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\DivisionProducto;
use App\Transacion;
use Auth;
use App\DetalleTransacion;
use DB;
use App\DetalleDevolucion;
use App\CambioProducto;
use App\Bitacora;
use App\Inventario;

class RequisicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $tipo= $request->tipo;
      $buscar=$request->buscar;
        $transacciones=Transacion::buscar($buscar,$tipo);
        return view('Requisiciones.index',compact('transacciones','tipo','buscar'));//index recepción
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Requisiciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $f_producto=$request->f_producto;
      $cantidad=$request->cantidad;
      $t=$transaccion= Transacion::create([
        'fecha'=>$request->fecha,
        'f_usuario'=>Auth::user()->id,
        'localizacion'=>Transacion::tipoUsuario(),
        'tipo'=>4,
      ]);
      if($f_producto!=null){
        for ($i=0; $i <count($f_producto) ; $i++) {
          DetalleTransacion::create([
            'f_transaccion'=>$transaccion->id,
            'cantidad'=>$cantidad[$i],
            'f_producto'=>$f_producto[$i],
          ]);
          }
      }
      Bitacora::bitacora('store','transacions','requisiciones',$t->id);
       return redirect('requisiciones?tipo=4')->with('mensaje', '¡Requisición Enviada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $transaccion=Transacion::find($id);
      return view('Requisiciones.show',compact('transaccion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      DB::beginTransaction();
      try {
        $transaccionr=Transacion::find($id);//Cambio a transacción recibida
        $transaccionr->tipo=6;
        $transaccionr->save();

        $activo=false;
        $transaccion=new Transacion();//Transacción por envío a próximos a vencer
        $f = \Carbon\Carbon::now();
        $f = $f->format('Y-m-d');
        $transaccion->fecha=$f;
        $transaccion->f_usuario=Auth::user()->id;
        $transaccion->localizacion=DivisionProducto::busquedaTipo(1);
        $transaccion->tipo=7;

        if($request->detalle_id!=null){
          for ($i=0; $i <count($request->detalle_id) ; $i++) {
            $detalle=DetalleTransacion::find($request->detalle_id[$i]);
            $detalle->f_estante=$request->f_estante[$i];
            $detalle->nivel=$request->nivel[$i];
            $detalle->save();
            Inventario::Actualizar($detalle->f_producto,Transacion::tipoUsuario(),6,$detalle->cantidad);        
              //Si hay productos próximos
              $cantidad= CambioProducto::mover($detalle->f_producto,1);
              if($cantidad>0){
                if(!$activo){
                  $transaccion->save();
                  $activo=true;
                }
                if($cantidad>0){//Transacción de envío
                  $dtl=new DetalleTransacion();
                  $dtl->cantidad=$cantidad;
                  $dtl->f_transaccion=$transaccion->id;
                  $dtl->f_producto=$detalle->f_producto;
                  $dtl->save();
                }
              }
          }
        }
        Bitacora::bitacora('update','transacions','requisiciones',$id);
        DB::commit();
        return redirect('requisiciones?tipo=5')->with('mensaje', '¡Ubicaciones asignadas correctamente!');
      } catch (\Exception $e) {
        DB::rollback();
        return redirect('requisiciones?tipo=5')->with('error', '¡Algo salió mal!');
      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public static function buscar($texto){
      $productos=Producto::where('nombre','like','%'.$texto.'%')->where('estado',1)->take(3)->get(['id','nombre','f_presentacion']);
      foreach ($productos as $p) {
        $p->presentacion;
        $p->divisionProducto;
        foreach ($p->divisionProducto as $dp) {
          $dp->division;
          if($dp->contenido!=null){
            $dp->unidad;
          }
          if(Auth::user()->tipoUsuario=='Farmacia'){
            $contrario=3;
          }elseif(Auth::user()->tipoUsuario=='Recepción'){
            $contrario=2;
          }
          $dp->inventario=DivisionProducto::inventario($dp->id,$contrario);
        }
      }
      return $productos;
    }
    function verrequisiciones(Request $request){
      $tipo= $request->tipo;
      $buscar=$request->buscar;
        $transacciones=Transacion::pendientes($buscar,$tipo);
        return view('Requisiciones.indexf',compact('transacciones','tipo','buscar'));//index farmacia
    }

    function confirmar($id){
      $transaccion=Transacion::find($id);
      return view('Requisiciones.confirmar',compact('transaccion'));
    }

    function atenderPeticion($id){
      echo $id;
      DB::beginTransaction();
      try {
        $transaccion=Transacion::find($id);
        $transaccion->tipo=5;
        $transaccion->save();
        $detalles=$transaccion->detalleTransaccion;
        DetalleTransacion::where('f_transaccion',$id)->delete();
        foreach ($detalles as $detalle) {
          $inventario=DivisionProducto::inventario($detalle->f_producto,1);
            $compras=DivisionProducto::compras($detalle->f_producto,1);
            $cuenta=0;
            $i=0;
            $ultimos=[];
            foreach ($compras as $compra) {
              $devoluciones=DetalleDevolucion::total($compra->id);
              $retirados=CambioProducto::total($compra->id);
              $diferencia=$compra->cantidad-$devoluciones-$retirados;
              if ($diferencia!=0) {
                $cuenta=$cuenta+$diferencia;
                $compra->cantidad=$diferencia;
                $ultimos[$i]=$compra;
                if($cuenta>=$inventario)
                break;
                $i++;
              }
            }
            $diferencia=$cuenta-$inventario;
            if($diferencia!=0 && isset($ultimos[$i])){
              if($ultimos!=null){
                $fila=$ultimos[$i];
                $fila->cantidad=$fila->cantidad-$diferencia;
                $ultimos[$i]=$fila;
              }
            }
            $regresivo=$detalle->cantidad;
            for ($b=$i; $b>=0 ; $b--) {
              $fila=$ultimos[$b];
              $inv=DetalleTransacion::find($fila->id);
              if($fila->cantidad<$regresivo){
                DetalleTransacion::create([
                  'cantidad'=>$fila->cantidad,
                  'fecha_vencimiento'=>$inv->fecha_vencimiento,
                  'f_transaccion'=>$transaccion->id,
                  'lote'=>$fila->lote,
                  'f_producto'=>$detalle->f_producto,
                ]);
                Inventario::Actualizar($detalle->f_producto,Transacion::tipoUsuario(),5,$fila->cantidad);        
              $regresivo=$regresivo-$fila->cantidad;
            }elseif($regresivo!=0){
              DetalleTransacion::create([
                'cantidad'=>$regresivo,
                'fecha_vencimiento'=>$inv->fecha_vencimiento,
                'f_transaccion'=>$transaccion->id,
                'lote'=>$fila->lote,
                'f_producto'=>$detalle->f_producto,
              ]);
              Inventario::Actualizar($detalle->f_producto,Transacion::tipoUsuario(),5,$regresivo);        
              $regresivo=0;
            }
            }
        }
        Bitacora::bitacora('update','transacions','requisiciones',$id);

        DB::commit();
        foreach ($detalles as $detalle) {
          CambioProducto::actualizarCambio($detalle->f_producto);
        }
        return redirect('verrequisiciones?tipo=4')->with('mensaje', '¡Requisición atendida correctamente!');
      } catch (\Exception $e) {
        DB::rollback();
        return redirect('verrequisiciones?tipo=4')->with('error', '¡Algo salió mal!');
      }
    }
    function asignar($id){
      $transaccion=Transacion::find($id);
      return view('Requisiciones.asignar',compact('transaccion'));
    }
}
