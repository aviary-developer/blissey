<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Response;
use App\Transacion;
use App\DetalleTransacion;
use App\DivisionProducto;
use App\Division;
use DB;
use Auth;

class TransaccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        return redirect('/')->with('error', 'Algo salio mal');
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
        //
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
    public function buscarProductos($id,$texto){
      $productos=Producto::where('f_proveedor','=',$id)->where('nombre','ilike','%'.$texto.'%')->get();
      if(count($productos)>0){
        return Response::json($productos);
      }else{
        return null;
      }
    }
    public function buscarDivisiones($id){
      $divisiones=DivisionProducto::where('f_producto','=',$id)->get();
      if(count($divisiones)>0){
        return Response::json($divisiones);
      }else{
        return null;
      }
    }

    public function nombreDivision($id){
      $nombre=Division::find($id);
      return $nombre->nombre;
    }
}
