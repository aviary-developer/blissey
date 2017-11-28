<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Response;
use App\Transacion;
use App\DetalleTransacion;
use App\DivisionProducto;
use App\Division;
use App\Presentacion;
use DB;
use Auth;

class TransaccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    $tipo= $request->tipo;
    if(Auth::check()){
      $transacciones=Transacion::buscar($tipo);
      return view('transacciones.index',compact('transacciones','tipo'));
    }else{
      return redirect('/');
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo=0;
        //$tipo=1;
        return view('Transacciones.create',compact('tipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if(count($request->f_producto)>0){
        DB::beginTransaction();
        try{
        $transaccion=Transacion::create([
          'fecha'=>$request->fecha,
          'f_proveedor'=>$request->f_proveedor,
          'tipo'=>$request->tipo,
          'f_usuario'=>Auth::user()->id,
          'localizacion'=>0,
        ]);
        $id_transaccion= $transaccion->id;

        $f_producto=$request->f_producto;
        $cantidad=$request->cantidad;
        for ($i=0; $i < count($f_producto); $i++) {
          DetalleTransacion::create([
            'f_transaccion'=>$id_transaccion,
            'f_producto'=>$request->f_producto[$i],
            'cantidad'=>$cantidad[$i],
            'condicion'=>0,
          ]);
        }
      }catch(\Exception $e){
        DB::rollback();
        return redirect('/')->with('error', '¡Algo salio mal!');
      }
      DB::commit();
      return redirect('/')->with('mensaje', '¡Guardado!');
    }else{
      DB::rollback();
      return redirect('/transacciones/create')->with('error', 'No agrego ningún detalle');
    }
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

        return view('Transacciones.show',compact('transaccion'));
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
        $transaccion = Transacion::findOrFail($id);
        $transaccion->fecha=$request->fecha;
        $transaccion->factura=$request->factura;
        $transaccion->descuento=$request->descuentog;
        $transaccion->save();

        $contador = count($request->estado);
        $cont_eliminados=count($request->eliminado);

        for($i=0;$i<$cont_eliminados;$i++){
          $bor=DetalleTransacion::findOrFail($request->eliminado[$i]);
          $bor->delete();
        }

        for($i=0;$i<$contador;$i++){
          if($request->estado[$i]!='nuevo'){
            $detalle=DetalleTransacion::findOrFail($request->estado[$i]);
          }else{
            $detalle= new DetalleTransacion;
          }
          $detalle->descuento = $request->descuento[$i];
          $detalle->cantidad = $request->cantidad[$i];
          $detalle->condicion = '1';
          $detalle->fecha_vencimiento = $request->fecha_vencimiento[$i];
          $detalle->f_transaccion=$transaccion->id;
          $detalle->precio = $request->precio[$i];
          $detalle->lote = $request->lote[$i];
          $detalle->f_producto=$request->f_producto[$i];
          $detalle->save();
        }
        Return redirect('/transacciones?tipo=0')->with('mensaje', '¡Pedido Confirmado!');
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
    public function buscarProductos($id,$texto){
      $productos=Producto::where('f_proveedor','=',$id)->where('nombre','ilike','%'.$texto.'%')->get();
      if(count($productos)>0){
        foreach($productos as $producto){
          $producto->presentacion;
        }
        return Response::json($productos);
      }else{
        return null;
      }
    }
    public function buscarDivisiones($id){
      $divisiones=DivisionProducto::where('f_producto','=',$id)->get();
      if(count($divisiones)>0){
        foreach($divisiones as $division){
            $division->division;
        }
        return Response::json($divisiones);
      }else{
        return null;
      }
    }

    public function nombreDivision($id){
      $nombre=Division::find($id);
      return $nombre->nombre;
    }

    public function nombrePresentacion($id,$tipo){
      if($tipo=="1"){
        $nombre=Presentacion::find($id);
        return $nombre->nombre;
      }else{
        $producto=Producto::find($id);
        $producto->presentacion;
        return $producto;
      }
    }

    public function confirmarPedido($id){
      $transaccion=Transacion::find($id);
      return view('Transacciones.confirmar',compact('transaccion'));
    }
    public function buscarDivision($codigo){
      $division=DivisionProducto::where('codigo','=',$codigo)->first();
      if(count($division)==1){
        return $division;
      }else{
        return 0;
      }
    }
}
