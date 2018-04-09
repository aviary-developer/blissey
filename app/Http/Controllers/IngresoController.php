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
      $habitaciones = Habitacion::where('estado',true)->where('ocupado',false)->where('tipo',1)->orderBy('numero')->get();
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
      $especialidades = Especialidad::orderBy('nombre')->get();
      $ultima48 = $ultima24 = $hoy = Carbon::now();
      $medicos_general = DB::table('users')
      ->whereNotExists(
        function ($query){
          $query->select(DB::raw(1))
          ->from('especialidad_usuarios')
          ->whereRaw('especialidad_usuarios.f_usuario = users.id');
        }
      )->where('tipoUsuario','Médico')->orWhere('tipoUsuario','Gerencia')->where('estado',true)->orderBy('apellido')->get();

      if($ingreso->estado != 0){
        if($ingreso->estado == 1){
          $dias = $ingreso->fecha_ingreso->diffInDays($hoy);
          $ultima24 = $ingreso->fecha_ingreso->addDays($dias);
          $ultima48 = $ingreso->fecha_ingreso->addDays(($dias + 1));
          $habitacion_detalle_count = 0;
          foreach($ingreso->transaccion->detalleTransaccion->where('f_producto',null) as $detalle){
            if($detalle->servicio->categoria->nombre == "Habitación"){
              $habitacion_detalle_count++;
            }
          }
          $diff_dias_count = $dias - $habitacion_detalle_count;
          if($diff_dias_count > 0){
            for($i = 0; $i < $dias; $i++){
              $fecha_aux = $ingreso->fecha_ingreso->addDays($i);
              $is_detalle = DetalleTransacion::where('f_transaccion',$ingreso->transaccion->id)->where('created_at',$fecha_aux)->count();
              if($is_detalle == 0){
                DB::beginTransaction();
                try{
                  $detalle_n = new DetalleTransacion;
                  $detalle_n->f_servicio = $ingreso->habitacion->servicio->id;
                  $detalle_n->f_transaccion = $ingreso->transaccion->id;
                  $detalle_n->cantidad = 1;
                  $detalle_n->precio = $ingreso->habitacion->servicio->precio;
                  $detalle_n->created_at = $fecha_aux;
                  $detalle_n->save();
                  DB::commit();
                }catch(Exception $e){
                  DB::rollback();
                }
              }
            }
          }
        }else{
          $dias = $ingreso->fecha_ingreso->diffInDays($ingreso->fecha_alta);
          $utlima48 = $ultima24 = $ingreso->fecha_ingreso->subDays(1);
        }
        $examenes = Examen::where('estado',true)->orderBy('area')->orderBy('nombreExamen')->get();

        //Total de gastos
        $total_gastos = $this->total_gastos($id);
        $iva = $total_gastos * 0.13;
        $total_gastos += $iva;
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
      $responsable = $ingreso->responsable;
      $habitacion = $ingreso->habitacion;
      $habitaciones_h = Habitacion::where('estado',true)->where('ocupado',false)->where('tipo',1)->orderBy('numero')->get();
      $habitaciones_o = Habitacion::where('estado',true)->where('ocupado',false)->where('tipo',0)->orderBy('numero')->get();

      return view('Ingresos.show',compact(
        'ingreso',
        'examenes',
        'dias',
        'total_gastos',
        'total_abono',
        'total_deuda',
        'paciente',
        'especialidades',
        'medicos_general',
        'habitacion',
        'habitaciones_h',
        'habitaciones_o',
        'responsable',
        'ultima24',
        'ultima48'
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

        // $detalle = new DetalleTransacion;
        // $detalle->f_servicio = $ingreso->habitacion->servicio->id;
        // $detalle->precio = $ingreso->habitacion->servicio->precio;
        // $detalle->cantidad = 1;
        // $detalle->f_transaccion = $transaccion->id;
        // $detalle->save();
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

    public function informe_pdf($id){
      $ingreso = Ingreso::find($id);
      $hoy = Carbon::now();
      if($ingreso->estado != 0){
        $dias = $ingreso->fecha_ingreso->diffInDays($hoy);
      }else{
        $dias = $ingreso->fecha_ingreso->diffInDays($ingreso->fecha_alta);
      }
      $header = view('PDF.header.hospital');
      $footer = view('PDF.footer.numero_pagina');
      $main = view('Ingresos.PDF.informe',compact('ingreso','dias'));
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
            ->where('ingresos.estado','<>',2)
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
        if(isset($request->ingreso)){
          $ingreso = Ingreso::find($request->ingreso);
          $ingreso->fecha_alta = Carbon::now();
          $ingreso->estado = 2;
          $ingreso->save();

          $habitacion = Habitacion::find($ingreso->f_habitacion);
          $habitacion->ocupado = false;
          $habitacion->save();
        }
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
      //Honorarios
      $total+= $honorarios = Ingreso::honorario_gastos($id, $dia);
      $medicos = [];
      if(count($ingreso->transaccion->detalleTransaccion->where('f_producto',null))>0){
        $k = 0;
        foreach($ingreso->transaccion->detalleTransaccion->where('f_producto',null) as $detalle){
          if($detalle->servicio->categoria->nombre == "Honorarios" && ($detalle->created_at->between($fecha_carbon, $fecha_mayor))){
            $medicos[$k]["nombre"] = $detalle->servicio->nombre;
            $medicos[$k]["precio"] = $detalle->precio;
            $k++;
          }
        }
      }

      //Total abono
      $abono = Ingreso::abonos($id,$dia);

      //Valor de la habitación
      $habitacion_count = DetalleTransacion::where('f_transaccion',$ingreso->transaccion->id)->where('created_at',$fecha_carbon)->count();
      if($habitacion_count == 0){
        $habitacion = $ingreso->habitacion->precio;
        $habitacion_nombre = 'Habitación '.$ingreso->habitacion->numero;
      }else{
        $habitacion = 0;
        $habitacion_nombre = "Habitación 0";
      }
      
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
          if($detalle->servicio->categoria->nombre == "Habitación" && ($detalle->created_at == $fecha_carbon)){
            $habitacion = $detalle->precio;
            $habitacion_nombre = $detalle->servicio->nombre;
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
        'medicos',
        'tratamiento',
        'medicina',
        'servicios',
        'total_servicios',
        'habitacion_nombre'
      ));
    }
  
  public function servicio_medicos(Request $request){
    DB::beginTransaction();
    try{
      if(isset($request->f_medico)){
        foreach($request->f_medico as $medico){
          $servicio = Servicio::find($medico);
  
          $detalle = new DetalleTransacion;
          $detalle->cantidad = 1;
          $detalle->f_transaccion = $request->f_transaccion;
          $detalle->precio = $servicio->precio + $servicio->retencion;
          $detalle->f_servicio = $servicio->id;
          $detalle->save();
        }
        DB::commit();
        return 1;
      }else{
        return 0;
      }
    }catch(Exception $e){
      DB::rollback();
      return 0;
    }
  }

  public function cambio_ingreso(Request $request){
    DB::beginTransaction();
    try{
      $ingreso = Ingreso::find($request->ingreso);
      $habitacion_actual = $ingreso->f_habitacion;
      $ingreso->f_habitacion = $request->f_habitacion;
      $ingreso->tipo = $request->tipo;
      $ingreso->save();

      $habitacion_ = Habitacion::find($habitacion_actual);
      $habitacion_->ocupado = false;
      $habitacion_->save();

      $habitacion = Habitacion::find($request->f_habitacion);
      $habitacion->ocupado = true;
      $habitacion->save();
      DB::commit();
      return 1;
    }catch(Exception $e){
      DB::rollback();
      return 0;
    }
  }

  public function editar24 (Request $request){
    $id = $request->id;
    $cantidad = $request->cantidad;
    DB::beginTransaction();
    try{
      $detalle = DetalleTransacion::find($id);
      $detalle->cantidad = $cantidad;
      $detalle->save();
      DB::commit();
      return 1;
    }catch(Exception $e){
      DB::rollback();
      return 0;
    }
  }

  public function eliminar24 (Request $request){
    $id = $request->id;
    DB::beginTransaction();
    try{
      $detalle = DetalleTransacion::find($id);
      $detalle->delete();
      DB::commit();
      return 1;
    }catch(Exception $e){
      DB::rollback();
      return 0;
    }
  }
}
