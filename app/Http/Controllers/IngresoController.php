<?php

namespace App\Http\Controllers;

use App\Ingreso;
use App\Bitacora;
use App\User;
use App\Habitacion;
use App\Examen;
use App\Paciente;
use App\Servicio;
use App\Abono;
use App\Especialidad;
use App\CategoriaServicio;
use Illuminate\Http\Request;
use App\Transacion;
use App\DetalleTransacion;
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

          // if($request->precio > -1){
          //   $categoria = new CategoriaServicio;
          //   $categoria->nombre = "Honorarios";
          //   $categoria->save();

          //   $servicio = new Servicio;
          //   $servicio->nombre = "Honorarios médicos por ingreso";
          //   $servicio->precio = $request->precio;
          //   $servicio->f_categoria = $categoria->id;
          //   $servicio->save();
          // }else{
          //   $servicio = Servicio::where('nombre','Honorarios médicos por ingreso')->first();
          // }

          // $detalle = new DetalleTransacion;
          // $detalle->f_servicio = $servicio->id;
          // $detalle->precio = $servicio->precio;
          // $detalle->cantidad = 1;
          // $detalle->f_transaccion = $transaccion->id;
          // $detalle->save();

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
        $especialidades = Especialidad::orderBy('nombre')->get();
        $hoy = Carbon::now();

        if($ingreso->estado != 0){
          $examenes = Examen::where('estado',true)->orderBy('area')->orderBy('nombreExamen')->get();
          $dias = $ingreso->fecha_ingreso->diffInDays($hoy);
  
          //Total de gastos
          $total_gastos = $this->total_gastos($id);
  
          //Total abonado a la deuda
          $total_abono = Ingreso::abonos($id);
  
          //Total adeudado
          $total_deuda = $total_gastos - $total_abono;
  
        }else{
          $examenes = null;
          $dias = 0;
          $total_abono = $total_abono = $total_deuda = 0;
        }
        $paciente = $ingreso->paciente;

        return view('Ingresos.show',compact(
          'ingreso',
          'examenes',
          'dias',
          'total_gastos',
          'total_abono',
          'total_deuda',
          'paciente',
          'especialidades'
        ));
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

        $ultima_factura = Transacion::where('tipo',2)->latest()->first();

        if($ultima_factura == null){
          $factura = 1;
        }else{
          $factura = $ultima_factura->factura;
          $factura++;
        }

        $transaccion = new Transacion;
        $transaccion->fecha = $ingreso->fecha_ingreso;
        $transaccion->f_cliente = $ingreso->f_paciente;
        $transaccion->f_ingreso = $ingreso->id;
        $transaccion->tipo = 2;
        $transaccion->factura = $factura;
        $transaccion->f_usuario = Auth::user()->id;
        $transaccion->localizacion = 1;
        $transaccion->save();

        $detalle = new DetalleTransacion;
        $detalle->f_servicio = $ingreso->habitacion->servicio->id;
        $detalle->precio = $ingreso->habitacion->servicio->precio;
        $detalle->cantidad = 1;
        $detalle->f_transaccion = $transaccion->id;
        $detalle->save();
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

    protected function total_gastos($id){
      $total = Ingreso::servicio_gastos($id);
      //Gastos por honorarios medicos
      $total += Ingreso::honorario_gastos($id);
      //Gastos por medicinas
      $total += Ingreso::tratamiento_gastos($id);
      //Retorno el total de gastos
      return $total;
    }

    public function tratamiento(Request $request){
      DB::beginTransaction();
      try{
        $detalle = new DetalleTransacion;
        if($request->tipo_detalle == 1){
          $detalle->f_producto = $request->f_producto;
        }else{
          $detalle->f_servicio = $request->f_producto;
        }
        $detalle->f_transaccion = $request->transaccion;
        $detalle->cantidad = $request->cantidad;
        $detalle->precio = $request->precio;
        $detalle->save();
      }catch(Exception $e){
        DB::rollback();
        return 0;
      }
      DB::commit();
      return 1;
    }

    public function abonar(Request $request){
      DB::beginTransaction();
      try{
        $abono = new Abono;
        $abono->f_transaccion = $request->transaccion;
        $abono->monto = $request->abono;
        $abono->save();
      }catch(Exception $e){
        DB::rollback();
        return 0;
      }
      DB::commit();
      return 1;
    }

    public function resumen(Request $request){
      $id = $request->id;
      $dia = $request->dia;
      $ingreso = Ingreso::find($id);
      setlocale(LC_ALL,'es');
      $fecha_carbon = $fecha = $ingreso->fecha_ingreso->addDays($dia);
      $fecha_mayor = $ingreso->fecha_ingreso->addDays(($dia+1));
      $fecha = $fecha->formatLocalized('%d de %B de %Y');
      $medico = (($ingreso->medico->sexo)?'Dr. ':'Dra. ').$ingreso->medico->nombre.' '.$ingreso->medico->apellido;

      //Total gastos
      $honorarios = 0;
      $total = Ingreso::servicio_gastos($id, $dia);
      $total += Ingreso::tratamiento_gastos($id, $dia);
      if($dia == 0){
        $total+= $honorarios = Ingreso::honorario_gastos($id, $dia);
      }

      //Total abono
      $abono = Ingreso::abonos($id,$dia);

      //Valor de la habitación
      $habitacion = $ingreso->habitacion->precio;
      
      //Servicios
      $servicios = [];
      $total_servicios = 0;
      if(count($ingreso->transaccion->detalleTransaccion->where('f_producto',null))>0){
        $k = 0;
        foreach($ingreso->transaccion->detalleTransaccion->where('f_producto',null) as $detalle){
          if($detalle->servicio->categoria->nombre != "Honorarios" && $detalle->servicio->categoria->nombre != "Habitación" && $detalle->servicio->categoria->nombre != "Laboratorio Clínico" && ($detalle->created_at->between($fecha_carbon, $fecha_mayor))){
            $servicios[$k]["nombre"] = $detalle->servicio->nombre;
            $servicios[$k]["precio"] = $detalle->precio;
            $k++;
            $total_servicios++;
          }
        }
      }
      
      //Valor de laboratorio
      $laboratorio = 0;
      $examenes = [];
      if(count($ingreso->transaccion->solicitud)>0){
        $k = 0;
        foreach($ingreso->transaccion->solicitud as$solicitud){
          if($solicitud->estado != 0 && ($solicitud->created_at->between($fecha_carbon, $fecha_mayor))){
            $laboratorio += $examenes[$k]["precio"] = $solicitud->examen->servicio->precio;
            $examenes[$k]['nombre'] = $solicitud->examen->nombreExamen;
            $k++;
          }
        }
      }

      //Valor de tratamiento
      $tratamiento = 0;
      $medicina = [];
      if(count($ingreso->transaccion->detalleTransaccion)>0){
        $k = 0;
        foreach($ingreso->transaccion->detalleTransaccion as $detalle){
          if($detalle->f_servicio == null && ($detalle->created_at->between($fecha_carbon, $fecha_mayor))){
            $tratamiento += $medicina[$k]["precio"] = $detalle->precio * $detalle->cantidad;
            if($detalle->divisionProducto->unidad == null){
              $medicina[$k]["presentacion"] = $detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->producto->presentacion->nombre;
            }else{
              $medicina[$k]["presentacion"] = $detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->unidad->nombre;
            }
            $medicina[$k]["nombre"] = $detalle->divisionProducto->producto->nombre;
            $medicina[$k]["cantidad"] = $detalle->cantidad;
            $k++;
          }
        }
      }

      return(compact(
        "dia",
        "id",
        "ingreso",
        'total',
        'abono',
        'fecha',
        'habitacion',
        'laboratorio',
        'examenes',
        'honorarios',
        'medico',
        'tratamiento',
        'medicina',
        'servicios',
        'total_servicios'
      ));
    }

}
