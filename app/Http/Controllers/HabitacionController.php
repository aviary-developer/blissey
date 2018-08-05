<?php

namespace App\Http\Controllers;

use App\Habitacion;
use App\Bitacora;
use App\Ingreso;
use App\Cama;
use App\CategoriaServicio;
use App\Servicio;
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
      $tipo = $request->get('tipo');
      $habitaciones = Habitacion::buscar($tipo,$estado);
      $activos = Habitacion::where('estado',true)->count();
      $inactivos = Habitacion::where('estado',false)->count();
      return view('Habitaciones.index',compact(
        'habitaciones',
        'estado',
        'tipo',
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
      $count_hi = $count_ho = $count_hm = 1;
      $count_hi += Habitacion::where('tipo',1)->count();
      $count_ho += Habitacion::where('tipo',0)->count();
      $count_hm += Habitacion::where('tipo',2)->count();

      $count_ci = $count_co = $count_cm = 1;
      $camas = Cama::get();
      foreach($camas as $cama){
        if($cama->habitacion->tipo == 1){
          $count_ci++;
        }else if($cama->habitacion->tipo == 0){
          $count_co++;
        }else{
          $count_cm++;
        }
      }

      return view('habitaciones.create',compact(
        'count_hi',
        'count_ho',
        'count_hm',
        'count_ci',
        'count_co',
        'count_cm'
      ));
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

      try {
        $categoria_existe = CategoriaServicio::where('nombre','Cama')->first();

        if($categoria_existe == null){
          $categoria_existe = new CategoriaServicio;
          $categoria_existe->nombre = "Cama";
          $categoria_existe->save();
        }

        $habitaciones = new Habitacion;
        $habitaciones->numero = $request->numero;
        $habitaciones->precio = 0;
        $habitaciones->tipo = $request->tipo;
        $habitaciones->save();

        if(isset($request->cama)){
          foreach($request->cama as $k => $cama){
            $cama_ = new Cama;
            $cama_->numero = $cama;
            $cama_->precio = $request->c_precio[$k];
            $cama_->f_habitacion = $habitaciones->id;
            $cama_->save();

            $servicio = new Servicio;
            if($request->tipo == 0){
              $servicio->nombre = 'Cama O'.$cama_->numero;
            }else if($request->tipo == 1){
              $servicio->nombre = 'Cama I'.$cama_->numero;
            }else{
              $servicio->nombre = 'Cama M'.$cama_->numero;
            }
            $servicio->precio = $cama_->precio;
            $servicio->f_categoria = $categoria_existe->id;
            $servicio->f_cama = $cama_->id;
            $servicio->save();
          }
        }

      } catch (Exception $e) {
        DB::rollback();
        return redirect('/habitaciones')->with('mensaje', 'Algo salio mal');
      }
      DB::commit();
      Bitacora::bitacora('store','habitacions','habitaciones',$habitaciones->id);
      Bitacora::bitacora('store','camas','habitaciones',$habitaciones->id);
      Bitacora::bitacora('store','servicios','servicios',$servicio->id);
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

        $servicio = Servicio::where('f_habitacion',$id)->first();
        $servicio->nombre = 'Habitación '.$request->numero;
        $servicio->precio = $request->precio;
        $servicio->save();

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
      Bitacora::bitacora('update','servicios','servicios',$servicio->id);
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
