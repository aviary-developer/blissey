<?php

namespace App\Http\Controllers;

use App\Habitacion;
use App\Bitacora;
use App\Ingreso;
use Illuminate\Http\Request;
use DB;
use Redirect;
use App\Http\Requests\HabitacionRequest;

class HabitacionController extends Controller
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
      $estado = $request->get('estado');
      $numero = $request->get('numero');
      $habitaciones = Habitacion::buscar($numero,$estado);
      $activos = Habitacion::where('estado',true)->count();
      $inactivos = Habitacion::where('estado',false)->count();
      return view('Habitaciones.index',compact(
        'habitaciones',
        'estado',
        'numero',
        'activos',
        'inactivos',
        'pagina'
      ));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('habitaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HabitacionRequest $request)
    {
      DB::beginTransaction();

      try {
        $habitaciones = Habitacion::create($request->All());
      } catch (Exception $e) {
        DB::rollback();
        return redirect('/habitaciones')->with('mensaje', 'Algo salio mal');
      }
      DB::commit();
      Bitacora::bitacora('store','habitacions','habitaciones',$habitaciones->id);
      return redirect('/habitaciones')->with('mensaje', '¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $habitacion = Habitacion::find($id);
      $paciente = null;
      if($habitacion->ocupado){
        $paciente=Ingreso::where('f_habitacion',$habitacion->id)->where('estado','<',2)->first();
      }
      return view('Habitaciones.show',compact(
        'habitacion',
        'paciente'
      ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $habitaciones = Habitacion::find($id);
      return view('Habitaciones.edit',compact('habitaciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function update(HabitacionRequest $request, $id)
    {
      $habitaciones = Habitacion::find($id);
      DB::beginTransaction();
      try {
        $habitaciones->fill($request->all());
        $habitaciones->save();
      } catch (Exception $e) {
        DB::rollback();
        if($habitaciones->estado)
        {
          return redirect('/habitaciones')->with('mensaje', 'Algo salio mal');
        }
        else{
          return redirect('/habitaciones?estado=0')->with('mensaje', 'Algo salio mal');
        }
      }
      DB::commit();
      Bitacora::bitacora('update','habitacions','habitaciones',$id);
      if($habitaciones->estado)
      {
        return redirect('/habitaciones')->with('mensaje', '¡Editado!');
      }
      else{
        return redirect('/habitaciones?estado=0')->with('mensaje', '¡Editado!');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $habitaciones = Habitacion::findOrFail($id);
      $habitaciones->delete();
      Bitacora::bitacora('destroy','habitacions','habitaciones',$id);
      return redirect('/habitaciones?estado=0');
    }

    public function desactivate($id){
      $habitaciones = Habitacion::find($id);
      $habitaciones->estado = false;
      $habitaciones->save();
      Bitacora::bitacora('desactivate','habitacions','habitaciones',$id);
      return Redirect::to('/habitaciones');
    }

    public function activate($id){
      $habitaciones = Habitacion::find($id);
      $habitaciones->estado = true;
      $habitaciones->save();
      Bitacora::bitacora('activate','habitacions','habitaciones',$id);
      return Redirect::to('/habitaciones?estado=0');
    }
}
