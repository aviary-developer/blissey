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
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\IngresoRequest;

class IngresoController extends Controller
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
      $ingresos = Ingreso::buscar($estado);
      $activos = Ingreso::where('estado','<>',2)->count();
      return view('Ingresos.index',compact(
        'ingresos',
        'estado',
        'activos',
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
    public function store(IngresoRequest $request)
    {
        DB::beginTransaction();
        try {
          $ultimo_registro = Ingreso::where('fecha_ingreso','>=','1-1-'.date('Y'))->where('fecha_ingreso','<=','31-12-'.date('Y'))->get()->last();
          if($ultimo_registro == null){
            $correlativo = 0;
          }else if($ultimo_registro->expediente == null){
            $correlativo = 0;
          }else{
            $correlativo = $ultimo_registro->expediente;
          }
          $ingresos = new Ingreso;
          $ingresos->f_paciente = $request->f_paciente;
          if($request->c_responsable == 'on'){
          $ingresos->f_responsable = $request->f_responsable;
          }else{
            $ingresos->f_responsable = $request->f_paciente;
          }
          $ingresos->f_habitacion = $request->f_habitacion;
          $ingresos->f_medico = $request->f_medico;
          $aux = explode('T',$request->fecha_ingreso);
          $fecha = $aux[0].' '.$aux[1];
          $ingresos->fecha_ingreso  = $fecha.':00';
          $ingresos->expediente = $correlativo+1;
          $ingresos->f_recepcion = Auth::user()->id;
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
    public function show($id)
    {
        $ingreso = Ingreso::find($id);
        return view('Ingresos.show',compact('ingreso'));
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

    public function activate($id){
      $ingreso = Ingreso::find($id);
      DB::beginTransaction();
      try{
        $ingreso->estado = 1;
        $ingreso->save();
        DB::commit();
      }catch(Exception $e){
        DB::rollback();
        return redirect('/ingresos')->with('mensaje', 'Algo salio mal');
      }
      Bitacora::bitacora('activate','ingresos','ingresos',$id);
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

    public function acta_pdf($id){
      $ingreso = Ingreso::find($id);
      $header = view('PDF.header.hospital');
      $footer = view('PDF.footer.numero_pagina');
      $main = view('Ingresos.PDF.acta',compact('ingreso'));
      $pdf = \PDF::loadHtml($main)->setOption('footer-html',$footer)->setOption('header-html',$header)->setPaper('Letter');
      return $pdf->stream('nombre.pdf');
    }

    public function buscarPersonas(Request $request)
    {
      $nombre = $request->nombre;
      $tipo = $request->tipo;
      $fecha = Carbon::now();
      $fecha = $fecha->subYears(18);
      if($tipo == "paciente"){
        $pacientes = DB::table('pacientes')
        ->whereNotExists(
          function ($query){
            $query->select(DB::raw(1))
            ->from('ingresos')
            ->whereRaw('ingresos.f_paciente = pacientes.id');
          }
        )->where('nombre','ilike','%'.$nombre.'%')->orWhere('apellido','ilike','%'.$nombre.'%')->where('estado',true)->orderBy('apellido')->take(7)->get();
      }else if($tipo == "solicitud"){
        $pacientes = Paciente::where('nombre','ilike','%'.$nombre.'%')->orWhere('apellido','ilike','%'.$nombre.'%')->where('estado',true)->orderBy('apellido')->take(7)->get();
      }else{
        $pacientes = Paciente::where('fechaNacimiento','<=',$fecha->format('Y-m-d'))->where('nombre','ilike','%'.$nombre.'%')->orWhere('apellido','ilike','%'.$nombre.'%')->where('estado',true)->orderBy('apellido')->take(7)->get();
      }
      if(count($pacientes)>0){
        return Response::json($pacientes);
        
      }else{
        return null;
      }
    }
}
