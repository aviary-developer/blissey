<?php

namespace App\Http\Controllers;

use App\Ingreso;
use App\Bitacora;
use App\User;
use App\Habitacion;
use App\Paciente;
use Illuminate\Http\Request;
use DB;
use Redirect;
use Response;
use Carbon\Carbon;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $estado = $request->get('estado');
      $ingresos = Ingreso::buscar($estado);
      $activos = Ingreso::where('estado','<>',2)->count();
      return view('Ingresos.index',compact('ingresos','estado','activos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $medicos = User::where('tipoUsuario','Médico')->where('estado',true)->orderBy('apellido')->get();
      $habitaciones = Habitacion::where('estado',true)->where('ocupado',false)->orderBy('numero')->get();
      return view('Ingresos.create',compact('medicos','habitaciones'));
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
          $ingresos = new Ingreso;
          $ingresos->f_paciente = $request->f_paciente;
          $ingresos->f_responsable = $request->f_responsable;
          $ingresos->f_habitacion = $request->f_habitacion;
          $ingresos->f_medico = $request->f_medico;
          $aux = explode('T',$request->fecha_ingreso);
          $fecha = $aux[0].' '.$aux[1];
          $ingresos->fecha_ingreso  = $fecha.':00';
          $ingresos->save();

          $habitacion = Habitacion::find($request->f_habitacion);
          $habitacion->ocupado = true;
          $habitacion->save();
        } catch (Exception $e) {
          DB::rollback();
          return redirect('/ingresos')->with('mensaje', 'Algo salio mal');
        }
        DB::commit();
        Bitacora::bitacora('store','ingresos','ingresos',$ingresos->id);
        return redirect('/ingresos')->with('mensaje', '¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function show(Ingreso $ingreso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingreso $ingreso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingreso $ingreso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingreso = Ingreso::findOrFail($id);
        $habitacion = Habitacion::find($ingreso->f_habitacion);
        $habitacion->ocupado = false;
        $habitacion->save();
        $ingreso->delete();
        Bitacora::bitacora('destroy','ingresos','ingresos',$id);
        return redirect('/ingresos');
    }

    public function buscarPaciente($nombre)
    {
      $pacientes = Paciente::where('nombre','ilike','%'.$nombre.'%')->orWhere('apellido','ilike','%'.$nombre.'%')->where('estado',true)->orderBy('apellido')->take(7)->get();
      if(count($pacientes)>0){
        return Response::json($pacientes);
      }else{
        return null;
      }
    }
}
