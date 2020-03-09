<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\DivisionProducto;
use App\CambioProducto;
use App\Transacion;
use Auth;
use App\DetalleTransacion;
use DB;
use App\Bitacora;
use App\Inventario;

class CambioProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $pagina = ($request->get('page')!=null)?$request->get('page'):1;
      $pagina--;
      $pagina *= 10;
      $estado=$request->estado;
      $retirados=CambioProducto::buscar($estado);
      return view('CambioProductos.index',compact('retirados','estado','pagina'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('Entradas.entrada');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
      DB::beginTransaction();
      $transaccion= new Transacion();
      $transaccion->fecha=$request->fecha;
      $transaccion->f_proveedor=$request->f_proveedor;
      $transaccion->f_usuario=Auth::user()->id;
      $transaccion->localizacion=Transacion::tipoUsuario();
      $transaccion->tipo=10;
      $transaccion->comentario=$request->comentario;
      $transaccion->save();

      for($i=0;$i<count($request->f_producto);$i++){
        $detalle= new DetalleTransacion;
        $detalle->cantidad = $request->cantidad[$i];
        $detalle->fecha_vencimiento = $request->fecha_vencimiento[$i];
        $detalle->f_transaccion=$transaccion->id;
        $detalle->lote = $request->lote[$i];
        $detalle->f_producto=$request->f_producto[$i];
        $detalle->f_estante=$request->f_estante[$i];
        $detalle->nivel=$request->nivel[$i];
        $detalle->save();
        Inventario::Actualizar($request->f_producto[$i],Transacion::tipoUsuario(),10,$request->cantidad[$i]);          
      }
      Bitacora::bitacora('store','transacions','entradas',$transaccion->id);
      DB::commit();
      for($i=0;$i<count($request->f_producto);$i++){
        CambioProducto::actualizarCambio($request->f_producto[$i]);
      }
      Return redirect('/entradas')->with('mensaje', '¡Pedido Confirmado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $retirado=CambioProducto::find($id);
        return view('CambioProductos.show',compact('retirado'));
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
        //
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
    public static function lugar($tipo){//tipo 1=según el logueo 2=farmacia 3= recepción
      $productos=Producto::where('estado',1)->orderBy('nombre')->get();
      $activo=false;
      $transaccion=new Transacion();
      $f = \Carbon\Carbon::now();
      $f = $f->format('Y-m-d');
      $transaccion->fecha=$f;
      $transaccion->f_usuario=Auth::user()->id;
      $transaccion->localizacion=DivisionProducto::busquedaTipo($tipo);
      $transaccion->tipo=7;
      foreach ($productos as $producto) {
        $divisiones=$producto->divisionProducto;
        foreach ($divisiones as $division) {
          $cantidad= CambioProducto::mover($division->id,$tipo);
          if($cantidad>0){
            if(!$activo){
              $transaccion->save();
              $activo=true;
            }
            if($cantidad>0){
              $detalle=new DetalleTransacion();
              $detalle->cantidad=$cantidad;
              $detalle->f_transaccion=$transaccion->id;
              $detalle->f_producto=$division->id;
              $detalle->save();
            }
          }

        }
      }
    }
    public static function confirmarRetiro(){
      $cambios=CambioProducto::where('estado',0)->where('localizacion',Transacion::tipoUsuario())->get();
      $date = \Carbon\Carbon::now();
      $date = $date->format('Y-m-d');
      foreach($cambios as $cambio){
        if($cambio->transaccion->fecha_vencimiento<=$date){
          $cambio->estado=true;
          $cambio->save();
          Inventario::Actualizar($cambio->transaccion->f_producto,Transacion::tipoUsuario(),7,$cambio->cantidad);        
        }
      }
      Bitacora::bitacora('update','cambio_productos','cambio_productos',0);
      return redirect('cambio_productos')->with('mensaje','¡Todos los lotes fueron confirmado!');
    }
    public static function confirmarIndividual($id){
      $lote=CambioProducto::find($id);
      $lote->estado=1;
      $lote->save();
      Inventario::Actualizar($lote->transaccion->f_producto,Transacion::tipoUsuario(),7,$lote->cantidad);        
      Bitacora::bitacora('update','cambio_productos','cambio_productos',$lote->id);
      return redirect('cambio_productos')->with('mensaje','¡Confirmado!');
    }
    public static function entradas(Request $request){
      $tipo=10;
      $transacciones=Transacion::where('tipo',$tipo)->where('localizacion',Transacion::tipoUsuario())->orderBy('created_at','DESC')->get();
      return view('Entradas.index',compact('tipo','transacciones'));
    }
    public static function ver($id){
      $transaccion=Transacion::find($id);
      return view('Entradas.show',compact('transaccion'));
    }
    public static function vencimiento($tipo){
      if($tipo==1){
        $retirados=CambioProducto::where('estado',0)->orderBy('id','DESC')->where('localizacion',Transacion::tipoUsuario())->get();
        // return view('CambioProductos.PDF.vencimiento',compact('lotes'));

        if(Transacion::tipoUsuario()==1){
          $header = view('PDF.header.hospital');
        }else{
          $header = view('PDF.header.farmacia');
        }
        $footer = view('PDF.footer.numero_pagina');
        $main = view('CambioProductos.PDF.vencimiento',compact('retirados'));
        $pdf = \PDF::loadHtml($main)->setOption('footer-html',$footer)->setOption('header-html',$header)->setPaper('Letter');
        return $pdf->stream('lotes.pdf');
      }
    }
}
