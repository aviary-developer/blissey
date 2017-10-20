<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;
use App\CategoriaServicio;
use App\Bitacora;
use Redirect;

class ServicioController extends Controller
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
      $servicios = Servicio::buscar($nombre,$estado);
      $activos = Servicio::where('estado',true)->count();
      $inactivos = Servicio::where('estado',false)->count();
      return view('Servicios.index',compact('servicios','estado','nombre','activos','inactivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categorias = CategoriaServicio::where('estado',true)->orderBy('nombre','asc')->get();
      return view('Servicios.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $servicios = Servicio::create($request->All());
      Bitacora::bitacora('store','servicios','servicios',$servicios->id);
      return redirect('/servicios')->with('mensaje', '¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $servicio = Servicio::find($id);
      return view('Servicios.show',compact('servicio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $servicios = Servicio::find($id);
      $categorias = CategoriaServicio::where('estado',true)->orderBy('nombre','asc')->get();
      return view('Servicios.edit',compact('servicios','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $servicios = Servicio::find($id);
      $servicios->fill($request->all());
      $servicios->save();
      Bitacora::bitacora('update','servicios','servicios',$id);
      if($servicios->estado)
      {
        return redirect('/servicios')->with('mensaje', '¡Editado!');
      }
      else{
        return redirect('/servicios?estado=0')->with('mensaje', '¡Editado!');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $servicios = Servicio::findOrFail($id);
      $servicios->delete();
      Bitacora::bitacora('destroy','servicios','servicios',$id);
      return redirect('/servicios?estado=0');
    }

    public function desactivate($id){
      $servicios = Servicio::find($id);
      $servicios->estado = false;
      $servicios->save();
      Bitacora::bitacora('desactivate','servicios','servicios',$id);
      return Redirect::to('/servicios');
    }

    public function activate($id){
      $servicios = Servicio::find($id);
      $servicios->estado = true;
      $servicios->save();
      Bitacora::bitacora('activate','servicios','servicios',$id);
      return Redirect::to('/servicios?estado=0');
    }
}