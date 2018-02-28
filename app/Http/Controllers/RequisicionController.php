<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\DivisionProducto;
use App\transacion;
use Auth;
use App\DetalleTransacion;

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
        //Transacion::llenar();
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
      $transaccion= Transacion::create([
        'fecha'=>$request->fecha,
        'f_usuario'=>Auth::user()->id,
        'localizacion'=>1,
        'tipo'=>4,
      ]);
      for ($i=0; $i <count($f_producto) ; $i++) {
        DetalleTransacion::create([
          'f_transaccion'=>$transaccion->id,
          'cantidad'=>$cantidad[$i],
          'f_producto'=>$f_producto[$i],
        ]);
        }
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

        } catch (\Exception $e) {
          $transaccion=Transacion::find($id);
          $detalles=$transaccion->detalleTransaccion;
          detalleTransaccion::where('f_transaccion',$id)->delete();
          foreach ($detalles as $detalle) {
            $inventario=App\DivisionProducto::inventario($detalle->f_producto,2);
              $compras=App\DivisionProducto::compras($detalle->f_producto);
              $cuenta=0;
              $i=0;
              $ultimos=[];
              foreach ($compras as $compra) {
                $cuenta=$cuenta+$compra->cantidad;
                $ultimos[$i]=$compra;
                if($cuenta>=$inventario)
                break;
                $i++;
              }
              $diferencia=$cuenta-$inventario;
              if($diferencia!=0){
                $fila=$ultimos[$i];
                $fila->cantidad=$fila->cantidad-$diferencia;
                $ultimos[$i]=$fila;
              }
              $regresivo=$detalle->cantidad;
              for ($b=$i; $b>=0 ; $b--) {
                $fila=$ultimos[$b];
                $inv=App\DetalleTransacion::find($fila->id);
                if($fila->cantidad<$regresivo){
                  DetalleTransacion::create([
                    'cantidad'=>,
                    'fecha_vencimiento'=>,
                    'f_transaccion'=>,
                    'lote'=>,
                    'f_producto'=>,
                  ]);
                $regresivo=$regresivo-$fila->cantidad;
              }elseif($regresivo!=0){
                $regresivo=0;
              }
              }
          }
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
      $productos=Producto::where('nombre','ILIKE','%'.$texto.'%')->where('estado',1)->get(['id','nombre','f_presentacion']);
      foreach ($productos as $p) {
        $p->presentacion;
        $p->divisionProducto;
        foreach ($p->divisionProducto as $dp) {
          $dp->division;
          if($dp->contenido!=null){
            $dp->unidad;
          }
          $dp->inventario=DivisionProducto::inventario($dp->id,2);
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
}
