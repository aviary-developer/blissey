<?php

namespace App\Http\Controllers;

use App\Presentacion;
use Illuminate\Http\Request;
use App\Bitacora;
use Redirect;

class PresentacionController extends Controller
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
      $presentaciones = Presentacion::buscar($nombre,$estado);
      $activos = Presentacion::where('estado',true)->count();
      $inactivos = Presentacion::where('estado',false)->count();
      return view('Presentaciones.index',compact('presentaciones','estado','nombre','activos','inactivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Presentaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $presentaciones = Presentacion::create($request->All());
      Bitacora::bitacora('store','presentacions','presentaciones',$presentaciones->id);
      return redirect('/presentaciones')->with('mensaje', '¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Presentacion  $presentacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $presentacion = Presentacion::find($id);
      return view('Presentaciones.show',compact('presentacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Presentacion  $presentacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $presentaciones = Presentacion::find($id);
      return view('Presentaciones.edit',compact('presentaciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Presentacion  $presentacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $presentaciones = Presentacion::find($id);
      $presentaciones->fill($request->all());
      $presentaciones->save();
      Bitacora::bitacora('update','especialidads','presentaciones',$id);
      if($presentaciones->estado)
      {
        return redirect('/presentaciones')->with('mensaje', '¡Editado!');
      }
      else{
        return redirect('/presentaciones?estado=0')->with('mensaje', '¡Editado!');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Presentacion  $presentacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $presentaciones = Presentacion::findOrFail($id);
      $presentaciones->delete();
      Bitacora::bitacora('destroy','especialidads','presentaciones',$id);
      return redirect('/presentaciones?estado=0');
    }

    public function desactivate($id){
      $presentaciones = Presentacion::find($id);
      $presentaciones->estado = false;
      $presentaciones->save();
      Bitacora::bitacora('desactivate','especialidads','presentaciones',$id);
      return Redirect::to('/presentaciones');
    }

    public function activate($id){
      $presentaciones = Presentacion::find($id);
      $presentaciones->estado = true;
      $presentaciones->save();
      Bitacora::bitacora('activate','especialidads','presentaciones',$id);
      return Redirect::to('/presentaciones?estado=0');
    }
}
