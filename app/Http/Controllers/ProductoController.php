<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;
use Bitacora;
use Rediret;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $estado = $request->get('estado');
      $nombre = $request->get('nombre');
      $productos = Producto::buscar($nombre,$estado);
      $activos = Producto::where('estado',true)->count();
      $inactivos = Producto::where('estado',false)->count();
      return view('Productos.index',compact('productos','estado','nombre','activos','inactivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Productos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $productos = Producto::create($request->All());
      Bitacora::bitacora('store','productos','productos',$productos->id);
      return redirect('/productos')->with('mensaje', '¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $producto = Producto::find($id);
      return view('Productos.show',compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $productos = Producto::find($id);
      return view('Productos.edit',compact('productos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $productos = Producto::find($id);
      $productos->fill($request->all());
      $productos->save();
      Bitacora::bitacora('update','productos','productos',$id);
      if($productos->estado)
      {
        return redirect('/productos')->with('mensaje', '¡Editado!');
      }
      else{
        return redirect('/productos?estado=0')->with('mensaje', '¡Editado!');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
      $productos = Producto::findOrFail($id);
      $productos->delete();
      Bitacora::bitacora('destroy','productos','productos',$id);
      return redirect('/productos?estado=0');
    }

    public function desactivate($id){
      $productos = Producto::find($id);
      $productos->estado = false;
      $productos->save();
      Bitacora::bitacora('desactivate','productos','productos',$id);
      return Redirect::to('/productos');
    }

    public function activate($id){
      $productos = Producto::find($id);
      $productos->estado = true;
      $productos->save();
      Bitacora::bitacora('activate','productos','productos',$id);
      return Redirect::to('/productos?estado=0');
    }
}
