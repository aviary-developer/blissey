<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;

class ProveedorController extends Controller
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
      $proveedores = Proveedor::buscar($nombre,$estado);
      $activos = Proveedor::where('estado',true)->count();
      $inactivos = Proveedor::where('estado',false)->count();
      return view('Proveedores.index',compact('proveedores','estado','nombre','activos','inactivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
      $proveedores = Proveedores::findOrFail($id);
      $proveedores->delete();
      return redirect('/proveedores?estado=0');
    }

    public function desactivate($id){
      $proveedores= Proveedor::find($id);
      $proveedores->estado = false;
      $proveedores->save();
      return Redirect::to('/proveedores');
    }

    public function activate($id){
      $proveedores = Proveedor::find($id);
      $proveedores->estado = true;
      $proveedores->save();
      return Redirect::to('/proveedores?estado=0');
    }
}
