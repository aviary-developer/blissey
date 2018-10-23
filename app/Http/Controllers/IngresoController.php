<?php

namespace App\Http\Controllers;

use App\Ingreso;
use App\Bitacora;
use App\User;
use App\Habitacion;
use App\Examen;
use App\Paciente;
use App\Servicio;
use App\Producto;
use App\Rayosx;
use App\Cama;
use App\Tac;
use App\ultrasonografia;
use App\Abono;
use App\Especialidad;
use App\SolicitudExamen;
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
      $tipo = $request->get('tipo');
      $usuario = null;
      if(Auth::user()->tipoUsuario == "Médico" || Auth::user()->tipoUsuario == "Gerencía"){
        if($tipo == 3){
          $usuario = Auth::user()->id;
        }
      }
      $ingresos = Ingreso::buscar($estado, $tipo,$usuario);
      $activos = Ingreso::where('estado','<>',2)->where('tipo', $tipo)->count();

      $medicos = User::where('tipoUsuario','Médico')->where('estado',true)->orderBy('apellido')->get();

      $habitaciones_ingreso = Habitacion::where('tipo',1)->where('estado',true)->orderBy('numero','asc')->get();
      $habitaciones_observacion = Habitacion::where('tipo',0)->where('estado',true)->orderBy('numero','asc')->get();
      $habitaciones_mediingreso = Habitacion::where('tipo',2)->where('estado',true)->orderBy('numero','asc')->get();

      /**Listado de cola en consulta médica */
      $cola_consulta = Ingreso::where('estado','<>',2)->where('tipo',3)->orderBy('created_at','asc')->get();

      //Variables utiles en la vista
      $estadoOpuesto = ($estado != 2 || $estado == null)?2:0;
      $index = true;
      $fecha = Carbon::now();
      return view('Ingresos.index.base',compact(
        'ingresos',
        'estado',
        'activos',
        'pagina',
        'tipo',
        'index',
        'estadoOpuesto',
        'habitaciones_ingreso',
        'habitaciones_observacion',
        'habitaciones_mediingreso',
        'medicos',
        'fecha',
        'cola_consulta'
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
      $observaciones = Habitacion::where('estado',true)->where('ocupado',false)->where('tipo',0)->orderBy('numero')->get();
      return view('Ingresos.create',compact(
        'medicos',
        'habitaciones',
        'observaciones'
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
          $correlativo = 0;
          if($request->tipo != 3){
            $ultimo_registro = Ingreso::where('fecha_ingreso','>=',date('Y').'-1-1')->where('fecha_ingreso','<=',date('Y').'-12-31')->where('tipo','<>',3)->where('tipo','<>',4)->get()->last();
            if($ultimo_registro == null){
              $correlativo = 0;
            }else if($ultimo_registro->expediente == null){
              $correlativo = 0;
            }else{
              $correlativo = $ultimo_registro->expediente;
            }
          }
          $ingresos = new Ingreso;
          $ingresos->f_paciente = $request->f_paciente;
          if($request->c_responsable == 1){
            $ingresos->f_responsable = $request->f_responsable;
          }else{
            $ingresos->f_responsable = $request->f_paciente;
          }
          if($request->tipo == 2 || $request->tipo == 0 || $request->tipo == 1){
            $ingresos->f_cama = $request->f_cama;
          }
          $ingresos->f_medico = $request->f_medico;
          $aux = explode('T',$request->fecha_ingreso);
          $fecha = $aux[0].' '.$aux[1];
          $ingresos->fecha_ingreso  = $fecha.':00';
          $ingresos->expediente = $correlativo+1;
          $ingresos->f_recepcion = Auth::user()->id;
          $ingresos->tipo = $request->tipo;
          $ingresos->save();

          if($request->tipo < 3){
            $cama = Cama::find($request->f_cama);
            $cama->estado = true;
            $cama->save();
          }else{
            $ultima_factura = Transacion::where('tipo',2)->latest()->first();

            if($ultima_factura == null){
              $factura = 1;
            }else{
              $factura = $ultima_factura->factura;
              $factura++;
            }

            $transaccion = new Transacion;
            $transaccion->fecha = $ingresos->fecha_ingreso;
            $transaccion->f_cliente = $ingresos->f_paciente;
            $transaccion->f_ingreso = $ingresos->id;
            $transaccion->tipo = 2;
            $transaccion->factura = $factura;
            $transaccion->f_usuario = Auth::user()->id;
            $transaccion->localizacion = 1;
            $transaccion->save();
          }

        } catch (Exception $e) {
          DB::rollback();
          return 0;
        }
        DB::commit();
        Bitacora::bitacora('store','ingresos','ingresos',$ingresos->id);
        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      setlocale(LC_ALL,'es');
      $ingreso = Ingreso::find($id);
      
      /**Notas a tener en cuenta para la elaboración de esta pantalla
       * 
       * Tipos de ingreso:
       * 0 - Ingreso
       * 1 - Medi ingreso
       * 2 - Observación
       * 3 - Consulta médica
       * 4 - Cumplimiento
       * 
       * Estados del registro
       * 0 - Pendiente
       * 1 - Ingresado
       * 2 - Alta
       */
      /**Extracción de los datos del paciente */
      $paciente = $ingreso->paciente;
      $responsable = null;
      if($ingreso->f_responsable != $ingreso->f_paciente){
        $responsable = $ingreso->responsable;
      }
      /**Calculo de días que ha estado ingresado el paciente */
      $hoy = Carbon::today()->hour(7);
      $ahora = Carbon::now();
      if($ahora->lt($hoy)){
        $hoy = $hoy->subDays(1);
      }
      /**Inicialización de las variables a utilizar */
      $total_gastos = $total_abono = $total_deuda = $dias = $horas = 0;
      $examenes = $horas_f = null;
      $dia_ingreso = null;
      $dia_alta = null;
      $cambio = false;

      /**Obtener las habitaciones para realizar el cambio de habitacion */
      $habitaciones = Habitacion::where('estado',true)->where('ocupado',false)->where('tipo',1)->orderBy('numero')->get();
      $observaciones = Habitacion::where('estado',true)->where('ocupado',false)->where('tipo',0)->orderBy('numero')->get();
      $mediingresos = Habitacion::where('estado',true)->where('ocupado',false)->where('tipo',2)->orderBy('numero')->get();
      /**Examenes de ultrasonografía y de rayos x */
      $rayosx = Rayosx::where('estado',true)->orderBy('nombre')->get();
      $ultras = ultrasonografia::where('estado',true)->orderBy('nombre')->get();
      $tacs = Tac::where('estado',true)->orderBy('nombre')->get();
        /**Medicos para seleccionar */
      $especialidades = Especialidad::orderBy('nombre')->get();
      $medicos_general = DB::table('users')
      ->whereNotExists(
        function ($query){
          $query->select(DB::raw(1))
          ->from('especialidad_usuarios')
          ->whereRaw('especialidad_usuarios.f_usuario = users.id');
        }
      )->where(
        function($query){
          $query->where('tipoUsuario','Médico')
          ->orWhere('tipoUsuario','Gerencia');
        }
        )->where('estado',true)->orderBy('apellido')->get();
      $total_especialidad = $especialidades->count();
      /**Calculo de dia efectivo en que fue ingresado el paciente */
      $dia_ingreso = $ingreso->fecha_ingreso->hour(7)->minute(0);
      $dias_i = $ingreso->fecha_ingreso->hour(7)->minute(0);
      if($ingreso->fecha_ingreso->lt($dia_ingreso)){
        $dia_ingreso->subDay();
        $dias_i->subDay();
        $cambio = true;
      }
      if($ingreso->estado == 1){
        $dias = $dia_ingreso->diffInDays($hoy);
        /**Determinar cuales son las ultimas 24 horas */
        $ultima24 = Carbon::today()->hour(7);
        $ultima48 = Carbon::tomorrow()->hour(7);
        if($ahora->lt($ultima24)){
          $ultima24->subDay();
          $ultima48->subDay();
        }
        /**Determinar horas de ingreso */
        $horas = $ingreso->fecha_ingreso->diffInHours($hoy);
        $horas_f = $hoy->diff($ingreso->fecha_ingreso)->format('%dd  %hh : %im');
        /**Generador automatico de transacciones por uso de la habitación */
        $habitacion_dia_guardado_count = 0;
        /**Contar cuantos dias se ha guardado el gasto por habitación del paciente */
        foreach($ingreso->transaccion->detalleTransaccion->where('f_producto',null) as $detalle){
          if($detalle->servicio->categoria->nombre == "Cama"){
            $habitacion_dia_guardado_count++;
          }
        }
        /**Diferencia entre los días guardados hasta el día de hoy */
        $habitacion_dia_no_guardado_count = $dias - $habitacion_dia_guardado_count;
        /**Si la diferencia no es 0 recorrer en un for desde el dia de ingreso hasta la fecha de hoy para revisar  el día que no se ha registrado y crearlo*/
        if($habitacion_dia_no_guardado_count > 0){
          for($i=0; $i<$dias; $i++){
            $fecha_aux = $dia_ingreso->addDays($i);
            /**Comprobar si existe el detalle este día */
            $exist_detalle = DetalleTransacion::where('f_transaccion',$ingreso->transaccion->id)->where('created_at',$fecha_aux)->count();
            /**Si no existe se crea la transaccion */
            if($exist_detalle == 0){
              DB::beginTransaction();
              try{
                $detalle_new = new DetalleTransacion;
                $detalle_new->f_servicio = $ingreso->habitacion->servicio->id;
                $detalle_new->f_transaccion = $ingreso->transaccion->id;
                $detalle_new->cantidad = 1;
                $detalle_new->precio = $ingreso->habitacion->servicio->precio;
                $detalle_new->created_at = $fecha_aux;
                $detalle_new->save();
                DB::commit();
              }catch(Exception $e){
                DB::rollbalk();
              }
            }
          }
        }
      }else if($ingreso->estado == 2){
        $dia_alta = $ingreso->fecha_alta->hour(7)->minute(0);
        $dias_a = $ingreso->fecha_alta->hour(7)->minute(0);
        if($ingreso->fecha_alta->lt($dia_alta)){
          $dia_alta->subDay();
          $dias_a->subDay();
        }
        $dias = $dia_ingreso->diffInDays($dia_alta);
        /**Determinar cuales son las ultimas 24 horas */
        $ultima24 = $ingreso->fecha_ingreso->subDays(1);
        $ultima48 = $ingreso->fecha_alta->addDays(1);
        /**Determinar las horas que paso ingresado el paciente antes del alta medica */
        $horas = $ingreso->fecha_ingreso->diffInHours($ingreso->fecha_alta);
        $horas_f = $ingreso->fecha_alta->diff($ingreso->fecha_ingreso)->format('%dd  %hh : %im');
      }
      /**Ultima 24 para consultas */
      if($ingreso->tipo == 3){
        $ultima24 = $ingreso->fecha_ingreso->subDays(1);
        $ultima48 = $hoy->addDays(1);
      }
      /**Determinar si el estado del ingreso es mayor que 1, en ese caso sacaremos el listado de productos aplicados al paciente */
      if(($ingreso->estado > 0 && $ingreso->tipo < 3) || $ingreso->tipo == 3){
        $detalle_p = []; //Detalle producto
        $detalle_s = []; //Detalle servicio
        $detalle_l = []; //Detalle laboratorio clínico
        $detalle_r = []; //Detalle rayos X
        $detalle_u = []; //Detalle ultrasonografía
        $detalle_sv = []; //Detalle signos vitales
        $detalle_tac = [];
        $indice_detalle_p = 0;
        $indice_detalle_s = 0;
        $indice_detalle_l = 0;
        $indice_detalle_r = 0;
        $indice_detalle_u = 0;
        $indice_detalle_sv = 0;
        $indice_detalle_tac = 0;
        /**Contador de cuantos medicamentos han sido asignados en las ultimas 24 horas */
        $count_p24 = 0;
        if ($ingreso->transaccion->detalleTransaccion->where('f_servicio',null)->count() > 0){
          foreach($ingreso->transaccion->detalleTransaccion->where('f_servicio',null) as $detalle){
            $detalle_p[$indice_detalle_p] = $detalle;
            $indice_detalle_p++;
            if($detalle->created_at->between($ultima24,$ultima48)){
              $count_p24++;
            }
          }
          $detalle_p = array_reverse($detalle_p);
        }
        /**Contador de cuantos servicios han sido asignados en las últimas 24 horas */
        $count_s24 = 0;
        if($ingreso->transaccion->detalleTransaccion->where('f_producto',null)->count() > 0){
          foreach($ingreso->transaccion->detalleTransaccion->where('f_producto',null) as $detalle){
            if($detalle->servicio->categoria->nombre != "Honorarios" && $detalle->servicio->categoria->nombre != "Laboratorio Clínico" && $detalle->servicio->categoria->nombre != "Rayos X" && $detalle->servicio->categoria->nombre != "Cama" && $detalle->servicio->categoria->nombre != "Ultrasonografía" && $detalle->servicio->categoria->nombre != "TAC"){
              $detalle_s[$indice_detalle_s] = $detalle;
              $indice_detalle_s++;
              if($detalle->created_at->between($ultima24, $ultima48)){
                $count_s24++;
              }
            }
          }
        }
        /**Contador de cuantos examenes han sido asignados en las últimas 24 horas */
        $count_l24 = 0;
        if($ingreso->transaccion->solicitud->count()>0){
          foreach($ingreso->transaccion->solicitud as $solicitud){
            if($solicitud->examen != null){
              $detalle_l[$indice_detalle_l] = $solicitud;
              $indice_detalle_l++;
              if($solicitud->created_at->between($ultima24, $ultima48)){
                $count_l24++;
              }
            }
          }
        }
        $count_r24 = 0;
        if($ingreso->transaccion->solicitud->count()>0){
          foreach($ingreso->transaccion->solicitud as $solicitud){
            if($solicitud->rayox != null){
              $detalle_r[$indice_detalle_r] = $solicitud;
              $indice_detalle_r++;
              if($solicitud->created_at->between($ultima24, $ultima48)){
                $count_r24++;
              }
            }
          }
        }
        $count_tac24 = 0;
        if($ingreso->transaccion->solicitud->count()>0){
          foreach($ingreso->transaccion->solicitud as $solicitud){
            if($solicitud->f_tac != null){
              $detalle_tac[$indice_detalle_tac] = $solicitud;
              $indice_detalle_tac++;
              if($solicitud->created_at->between($ultima24, $ultima48)){
                $count_tac24++;
              }
            }
          }
        }
        $count_u24 = 0;
        if($ingreso->transaccion->solicitud->count()>0){
          foreach($ingreso->transaccion->solicitud as $solicitud){
            if($solicitud->ultrasonografia != null){
              $detalle_u[$indice_detalle_u] = $solicitud;
              $indice_detalle_u++;
              if($solicitud->created_at->between($ultima24, $ultima48)){
                $count_u24++;
              }
            }
          }
        }
        $count_sv24 = 0;
        if($ingreso->signos->count()>0){
          foreach($ingreso->signos as $solicitud){
            $detalle_sv[$indice_detalle_sv] = $solicitud;
            $indice_detalle_sv++;
            if($solicitud->created_at->between($ultima24, $ultima48)){
              $count_sv24++;
            }
          }
        }
        array_reverse($detalle_sv);
        /**Medicos que han atendido al paciente */
        $unicos = DetalleTransacion::distinct()->where('f_transaccion',$ingreso->transaccion->id)->where('f_producto',null)->get(['f_servicio']);
        $indice_u = 0;
        $medico_u = [];
        foreach($unicos as $unico){
          $service = Servicio::find($unico->f_servicio);
          if($service->categoria->nombre == "Honorarios"){
            $medico_u[$indice_u]['id'] = $service->id;
            $medico_u[$indice_u]['foto'] = $service->medico->foto;
            $medico_u[$indice_u]['nombre'] = (($service->medico->sexo)?'Dr. ':'Dra. ').$service->medico->nombre.' '.$service->medico->apellido;
            $medico_u[$indice_u]['frec'] = $ingreso->transaccion->detalleTransaccion->where('f_servicio',$service->id)->count();
            $indice_u++;
          }
        }
        $count_m = $indice_u;
      }

      if(($ingreso->tipo > 0 && $ingreso->tipo < 3) || ($ingreso->tipo == 0 && $ingreso->estado != 0)){
        /**Obtener el total de gastos del ingreso, pero solo si es un ingreso, mediingreso u observacion */
        $total_gastos = $this->total_gastos($id);
        $iva = $total_gastos * 0.13;
        $total_gastos += $iva;
        /**Total abonado a la deuda */
        $total_abono = Ingreso::abonos($id);
        /**Total adeudado a la cuenta */
        $total_deuda = $total_gastos - $total_abono;

        /**Examenes que se puede realizar el paciente */
        $examenes = Examen::where('estado',true)->orderBy('area')->orderBy('nombreExamen')->get();
      }
      if($ingreso->tipo == 3){
        /**Examenes que se puede realizar el paciente */
        $examenes = Examen::where('estado',true)->orderBy('area')->orderBy('nombreExamen')->get();
      }
      /**Determinar cual opcion de cambio de tipo de hospitalizacion estará activa */
      $obs = $med = $ing = false;
      $activo = 0;
      if($ingreso->tipo < 3 && $horas <= 2){
        $obs = true;
        $med = true;
        $ing = true;
        $activo = 2;
      }else{
        $obs = false;
        if($ingreso->tipo < 2 && $horas <= 6){
          $activo = ($ingreso->tipo == 2)?0:1;
          $med = true;
          $ing = true;
        }else{
          $activo = 0;
          $med = false;
          $ing = true;
        }
      }
      $dias_x = $ingreso->fecha_ingreso->hour(7)->minute(0)->addDays($dias);
      if($cambio){
        $dias_x->subDay();
      }
      /**Proceso para obtener el historial médico de un paciente, estos es exclusivo del usuario médico, pero para evitar problemas en cualquier otro tipo de usuario returnara null */
      $historial = null;
      $lista_medicamentos = null;
      if(Auth::user()->tipoUsuario == "Médico"){
        $historial = $ingreso->paciente->ingreso;
        $lista_medicamentos = Producto::orderBy('nombre','asc')->get();
      }
      return view('Ingresos.dashboard.show',compact(
        'ingreso',
        'paciente',
        'responsable',
        'dias',
        'total_gastos',
        'total_abono',
        'total_deuda',
        'detalle_p',
        'detalle_s',
        'detalle_l',
        'detalle_r',
        'detalle_u',
        'detalle_sv',
        'detalle_tac',
        'medico_u',
        'ultima24',
        'ultima48',
        'count_p24',
        'count_s24',
        'count_l24',
        'count_r24',
        'count_u24',
        'count_sv24',
        'count_tac24',
        'count_m',
        'hoy',
        'examenes',
        'habitaciones',
        'observaciones',
        'mediingresos',
        'horas',
        'horas_f',
        'obs',
        'med',
        'ing',
        'activo',
        'rayosx',
        'ultras',
        'tacs',
        'especialidades',
        'medicos_general',
        'total_especialidad',
        'dias_i',
        'dias_a',
        'dias_x',
        'historial',
        'lista_medicamentos'
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
        $cama = Cama::find($ingreso->f_cama);
        $cama->estado = false;
        $cama->save();
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
      $pacientes = Paciente::where('nombre','like','%'.$nombre.'%')->orWhere('apellido','like','%'.$nombre.'%')->where('estado',true)->orderBy('apellido')->take(7)->get();
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
      $hoy = Carbon::today()->hour(7);
      $ahora = Carbon::now();
      if($ahora->lt($hoy)){
        $hoy = $hoy->subDays(1);
      }
      $dia_ingreso = $ingreso->fecha_ingreso->hour(7)->minute(0);
      if($ingreso->fecha_ingreso->lt($dia_ingreso)){
        $dia_ingreso = $dia_ingreso->subDays(1);
      }
      if($ingreso->estado != 0){
        $dias = $dia_ingreso->diffInDays($hoy);
      }else{
        $dia_alta = $ingreso->fecha_alta->hour(7)->minute(0);
        if($ingreso->fecha_alta->lt($dia_alta)){
          $dia_alta = $dia_alta->subDays(1);
        }
        $dias = $dia_ingreso->diffInDays($dia_alta);
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
        )->where(
          function ($query) use ($nombre){
            $query->where('nombre','like','%'.$nombre.'%')
            ->orWhere('apellido','like','%'.$nombre.'%');
          }
        )->where('estado',true)->orderBy('apellido')->take(7)->get();
      }else if($tipo == "solicitud"){
        $pacientes = Paciente::where('nombre','like','%'.$nombre.'%')->orWhere('apellido','like','%'.$nombre.'%')->where('estado',true)->orderBy('apellido')->take(7)->get();
      }else{
        $pacientes = Paciente::where('fechaNacimiento','<=',$fecha->format('Y-m-d'))->where('nombre','like','%'.$nombre.'%')->orWhere('apellido','like','%'.$nombre.'%')->where('estado',true)->orderBy('apellido')->take(7)->get();
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
        if(Auth::user()->tipoUsuario == 'Enfermería'){
          $detalle->estado = false;
        }
        $detalle->save();       
        DB::commit();
        return $detalle->id;
      }catch(Exception $e){
        DB::rollback();
        return -1;
      }
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

          if($ingreso->f_cama != null){
            $cama = Cama::find($ingreso->f_cama);
            $cama->estado = false;
            $cama->save();
          }
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
      $fecha_x = $request->fecha;
      
      $fecha_xf = Carbon::parse($fecha_x)->hour(7);
      $ahora = Carbon::now();
      if($ahora->lt($fecha_xf)){
        $fecha_xf->subDay();
      }
      $ingreso = Ingreso::find($id);
      $dia_ingreso = $ingreso->fecha_ingreso->hour(7)->minute(0);
      if($ingreso->fecha_ingreso->lt($dia_ingreso)){
        $dia_ingreso->subDay();
      }
      $dia = $dia_ingreso->diffInDays($fecha_xf);

      $fecha = $dia_ingreso->addDays($dia);
      
      setlocale(LC_ALL,'es');
      $ultima24 = $fecha_xf;
      $ultima48 = Carbon::parse($fecha_x)->hour(7)->addDay();
      
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
          if($detalle->servicio->categoria->nombre == "Honorarios" && ($detalle->created_at->between($ultima24, $ultima48))){
            $medicos[$k]["nombre"] = $detalle->servicio->nombre;
            $medicos[$k]["precio"] = $detalle->precio;
            $k++;
          }
        }
      }

      //Total abono
      $abono = Ingreso::abonos($id,$dia);

      //Valor de la habitación
      $habitacion_count = DetalleTransacion::where('f_transaccion',$ingreso->transaccion->id)->where('created_at',$ultima24)->count();
      if($habitacion_count == 0){
        $habitacion = $ingreso->habitacion->precio;
        $habitacion_nombre = $ingreso->habitacion->servicio->nombre;
      }else{
        $habitacion = 0;
        $habitacion_nombre = "Habitación 0";
      }
      
      //Servicios
      $servicios = [];
      $total_servicios = 0;
      if(count($ingreso->transaccion->detalleTransaccion->where('f_producto',null)->where('estado',true))>0){
        $k = 0;
        foreach($ingreso->transaccion->detalleTransaccion->where('f_producto',null)->where('estado',true) as $detalle){
          if($detalle->servicio->categoria->nombre != "Honorarios" && $detalle->servicio->categoria->nombre != "Cama" && $detalle->servicio->categoria->nombre != "Laboratorio Clínico" && $detalle->servicio->categoria->nombre != "Rayos X" && $detalle->servicio->categoria->nombre != "Ultrasonografía" &&$detalle->servicio->categoria->nombre != "TAC" &&($detalle->created_at->between($ultima24, $ultima48))){
            $servicios[$k]["nombre"] = $detalle->servicio->nombre;
            $servicios[$k]["precio"] = $detalle->precio;
            $k++;
            $total_servicios++;
          }
          if($detalle->servicio->categoria->nombre == "Cama" && ($detalle->created_at == $ultima24)){
            $habitacion = $detalle->precio;
            $habitacion_nombre = $detalle->servicio->nombre;
          }
        }
      }
      
      //Valor de laboratorio
      $laboratorio = 0;
      $examenes = [];
      $ultrasonografia = 0;
      $ultras = [];
      $rayosx = 0;
      $rayos = [];
      $tacs = 0;
      $tac = [];
      if(count($ingreso->transaccion->solicitud)>0){
        $k = 0;
        $ku = 0;
        $kr = 0;
        $kt = 0;
        foreach($ingreso->transaccion->solicitud as$solicitud){
          if($solicitud->estado != 0 && ($solicitud->created_at->between($ultima24, $ultima48))){
            if($solicitud->f_examen != null){
              $laboratorio += $examenes[$k]["precio"] = $solicitud->examen->servicio->precio;
              $examenes[$k]['nombre'] = $solicitud->examen->nombreExamen;
              $k++;
            }else if($solicitud->f_ultrasonografia != null){
              $ultrasonografia += $ultras[$ku]["precio"] = $solicitud->ultrasonografia->servicio->precio;
              $ultras[$ku]["nombre"] = $solicitud->ultrasonografia->nombre;
              $ku++;
            }else if($solicitud->f_rayox != null){
              $rayosx += $rayos[$kr]["precio"] = $solicitud->rayox->servicio->precio;
              $rayos[$kr]["nombre"] = $solicitud->rayox->nombre;
              $kr++;
            }else{
              $tacs += $tac[$kt]["precio"] = $solicitud->tac->servicio->precio;
              $tac[$kt]["nombre"] = $solicitud->tac->nombre;
              $kt++;
            }
          }
        }
      }

      //Valor de tratamiento
      $tratamiento = 0;
      $medicina = [];
      if(count($ingreso->transaccion->detalleTransaccion->where('estado',true))>0){
        $k = 0;
        foreach($ingreso->transaccion->detalleTransaccion->where('estado',true) as $detalle){
          if($detalle->f_servicio == null && ($detalle->created_at->between($ultima24, $ultima48))){
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

      $iva = $total * 0.13;
      $total += $iva;

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
        'habitacion_nombre',
        'ultrasonografia',
        'ultras',
        'rayosx',
        'rayos',
        'tacs',
        'tac',
        'iva'
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
      $cama_actual = $ingreso->f_cama;
      $ingreso->f_cama = $request->f_cama;
      if($request->tipo != null){
        $ingreso->tipo = $request->tipo;
      }
      $ingreso->save();

      $cama_ = Cama::find($cama_actual);
      $cama_->estado = false;
      $cama_->save();

      $cama = Cama::find($request->f_cama);
      $cama->estado = true;
      $cama->save();
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

  public function cambiar_estado(Request $request){
    $id = $request->id;
    DB::beginTransaction();
    try{
      $detalle = DetalleTransacion::find($id);
      $detalle->estado = true;
      $detalle->save();
      DB::commit();
      return 1;
    }catch(Exception $e){
      DB::rollback();
      return 0;
    }
  }

  public function chart_financiero(Request $request){
    $id = $request->id;

    $ingreso = Ingreso::find($id);
    $hoy = Carbon::today()->hour(7);
    $ahora = Carbon::now();
    if($ahora->lt($hoy)){
      $hoy->subDay();
    }
    $dia_ingreso = $ingreso->fecha_ingreso->hour(7)->minute(0);
    if($ingreso->fecha_ingreso->lt($dia_ingreso)){
      $dia_ingreso->subDay();
    }
    if($ingreso->estado < 2){
      $dias = $dia_ingreso->diffInDays($hoy);
    }else{
      $dia_alta = $ingreso->fecha_alta->hour(7)->minute(0);
      if($ingreso->fecha_alta->lt($dia_alta)){
        $dia_alta->subDay();
      }
      $dias = $dia_ingreso->diffInDays($dia_alta);
    }

    /**Recorrer en un for todos los días desde el inicio hasta hoy, para ver todos los gastos hechos por día */
    $monto = [];
    $fecha = [];
    $abonos = [];
    for($i=0; $i<$dias+1; $i++){
      $monto[$i]=Ingreso::servicio_gastos($id,$i);
      $monto[$i]+=Ingreso::honorario_gastos($id,$i);
      $monto[$i]+=Ingreso::tratamiento_gastos($id,$i);
      $abonos[$i]=Ingreso::abonos($id,$i);
      $iva = $monto[$i]*0.13;
      $monto[$i]+=$iva;
      $fecha[$i]=$ingreso->fecha_ingreso->addDays($i)->format('m-d-Y');
    }

    return (compact('monto','fecha','dias','abonos'));
  }

  public function lista_servicio(Request $request){
    $id = $request->id;
    $fecha_sf = $request->fecha;
    $ingreso = Ingreso::find($id);
    $fecha = new Carbon($fecha_sf);
    $fecha24 = new Carbon($fecha_sf);
    $fecha->hour(7);
    $fecha24 = $fecha24->addDays(1);
    $fecha24->hour(7);
    $dias = -1;
    if($ingreso->estado != 2){
      $dias = 1;
      $ahora = Carbon::now();
      $ultima24 = Carbon::today()->hour(7);
      $ultima48 = Carbon::tomorrow()->hour(7);
      if($ahora->lt($ultima24)){
        $ultima24->subDay();
        $ultima48->subDay();
      }
    }
    $lista = $ingreso->transaccion->detalleTransaccion->where('f_producto',null)->where('created_at','>',$fecha)->where('created_at','<',$fecha24);
    $servicios = [];
    $indice = 0;
    foreach($lista as $detalle){
      if($detalle->servicio->categoria->nombre != "Honorarios" && $detalle->servicio->categoria->nombre != "Cama" && $detalle->servicio->categoria->nombre != "Rayos X" && $detalle->servicio->categoria->nombre != "Laboratorio Clínico" && $detalle->servicio->categoria->nombre != "Ultrasonografía" && $detalle->servicio->categoria->nombre != "TAC"){
        $servicios[$indice]['id'] = $detalle->id;
        $servicios[$indice]['hora'] = $detalle->created_at->format('H:i.s');
        $servicios[$indice]['cantidad'] = $detalle->cantidad;
        $servicios[$indice]['nombre'] = $detalle->servicio->nombre;
        if($dias != -1 && $detalle->created_at->between($ultima24,$ultima48)){
          $servicios[$indice]['estado'] = 1;
        }else{
          $servicios[$indice]['estado'] = 0;
        }
        $indice++;
      }
    }
    $servicios = array_reverse($servicios);
    setlocale(LC_ALL,'es');
    $fecha_f = $fecha->formatLocalized('%d de %B de %Y');
    return(compact('servicios','indice','fecha_f'));
  }

  public function lista_producto(Request $request){
    $id = $request->id;
    $fecha_sf = $request->fecha;
    $ingreso = Ingreso::find($id);
    $fecha = new Carbon($fecha_sf);
    $fecha24 = new Carbon($fecha_sf);
    $fecha->hour(7);
    $fecha24 = $fecha24->addDays(1);
    $fecha24->hour(7);
    $dias = -1;
    if($ingreso->estado != 2){
      $dias = 1;
      $ahora = Carbon::now();
      $ultima24 = Carbon::today()->hour(7);
      $ultima48 = Carbon::tomorrow()->hour(7);
      if($ahora->lt($ultima24)){
        $ultima24->subDay();
        $ultima48->subDay();
      }
    }
    $lista = $ingreso->transaccion->detalleTransaccion->where('f_servicio',null)->where('created_at','>',$fecha)->where('created_at','<',$fecha24);
    $productos = [];
    $indice = 0;
    foreach($lista as $detalle){
      $productos[$indice]['id']=$detalle->id;
      $productos[$indice]['hora']=$detalle->created_at->format('h:i.s a');
      $productos[$indice]['cantidad'] = $detalle->cantidad;
      if($detalle->divisionProducto->unidad == null){
        $productos[$indice]['division'] = $detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->producto->presentacion->nombre;
      }else{
        $productos[$indice]['division'] = $detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->unidad->nombre;
      }
      $productos[$indice]['nombre'] = $detalle->divisionProducto->producto->nombre;
      if($dias != -1 && $detalle->created_at->between($ultima24,$ultima48)){
        $productos[$indice]['estado'] = 1;
      }else{
        $productos[$indice]['estado'] = 0;
      }
      $indice++;
    }
    $productos = array_reverse($productos);
    setlocale(LC_ALL,'es');
    $fecha_f = $fecha->formatLocalized('%d de %B de %Y');
    return (compact('productos','indice','fecha_f'));
  }

  public function lista_laboratorio(Request $request){
    $id = $request->id;
    $fecha_sf = $request->fecha;
    $ingreso = Ingreso::find($id);
    $fecha = new Carbon($fecha_sf);
    $fecha24 = new Carbon($fecha_sf);
    $fecha->hour(7);
    $fecha24 = $fecha24->addDays(1);
    $fecha24->hour(7);
    $dias = -1;
    if($ingreso->estado != 2){
      $dias = 1;
      $ahora = Carbon::now();
      $ultima24 = Carbon::today()->hour(7);
      $ultima48 = Carbon::tomorrow()->hour(7);
      if($ahora->lt($ultima24)){
        $ultima24->subDay();
        $ultima48->subDay();
      }
    }
    if($request->pendiente == null){
      $lista = $ingreso->transaccion->solicitud->where('created_at','>',$fecha)->where('created_at','<',$fecha24)->where('f_examen','!=',null);
    }else{
      $lista = $ingreso->transaccion->solicitud->where('estado',0)->where('f_examen','!=',null);
    }
    $laboratorio = [];
    $indice = 0;
    foreach($lista as $detalle){
      $laboratorio[$indice]['id'] = $detalle->id;
      if($request->pendiente == null){
        $laboratorio[$indice]['hora'] = $detalle->created_at->format('h:i.s a');
      }else{
        $laboratorio[$indice]['hora'] = $detalle->created_at->format('d/m/Y');
      }
      $laboratorio[$indice]['muestra'] = $detalle->codigo_muestra;
      $laboratorio[$indice]['nombre'] = $detalle->examen->nombreExamen;
      $laboratorio[$indice]['estado'] = $detalle->estado;
      $indice++;
    }
    $laboratorio = array_reverse($laboratorio);
    setlocale(LC_ALL,'es');
    $fecha_f = $fecha->formatLocalized('%d de %B de %Y');
    return (compact('laboratorio','indice','fecha_f'));
  }

  public function lista_rayos(Request $request){
    $id = $request->id;
    $fecha_sf = $request->fecha;
    $ingreso = Ingreso::find($id);
    $fecha = new Carbon($fecha_sf);
    $fecha24 = new Carbon($fecha_sf);
    $fecha->hour(7);
    $fecha24 = $fecha24->addDays(1);
    $fecha24->hour(7);
    $dias = -1;
    if($ingreso->estado != 2){
      $dias = 1;
      $ahora = Carbon::now();
      $ultima24 = Carbon::today()->hour(7);
      $ultima48 = Carbon::tomorrow()->hour(7);
      if($ahora->lt($ultima24)){
        $ultima24->subDay();
        $ultima48->subDay();
      }
    }
    if($request->pendiente == null){
      $lista = $ingreso->transaccion->solicitud->where('created_at','>',$fecha)->where('created_at','<',$fecha24)->where('f_rayox','!=',null);
    }else{
      $lista = $ingreso->transaccion->solicitud->where('estado',0)->where('f_rayox','!=',null);
    }
    $rayox = [];
    $indice = 0;
    foreach($lista as $detalle){
      $rayox[$indice]['id'] = $detalle->id;
      $rayox[$indice]['hora'] = $detalle->created_at->format('h:i.s a');
      $rayox[$indice]['nombre'] = $detalle->rayox->nombre;
      $rayox[$indice]['estado'] = $detalle->estado;
      $indice++;
    }
    $rayox = array_reverse($rayox);
    setlocale(LC_ALL,'es');
    $fecha_f = $fecha->formatLocalized('%d de %B de %Y');
    return (compact('rayox','indice','fecha_f'));
  }

  public function lista_ultra(Request $request){
    $id = $request->id;
    $fecha_sf = $request->fecha;
    $ingreso = Ingreso::find($id);
    $fecha = new Carbon($fecha_sf);
    $fecha24 = new Carbon($fecha_sf);
    $fecha->hour(7);
    $fecha24 = $fecha24->addDays(1);
    $fecha24->hour(7);
    $dias = -1;
    if($ingreso->estado != 2){
      $dias = 1;
      $ahora = Carbon::now();
      $ultima24 = Carbon::today()->hour(7);
      $ultima48 = Carbon::tomorrow()->hour(7);
      if($ahora->lt($ultima24)){
        $ultima24->subDay();
        $ultima48->subDay();
      }
    }
    if($request->pendiente == null){
      $lista = $ingreso->transaccion->solicitud->where('created_at','>',$fecha)->where('created_at','<',$fecha24)->where('f_ultrasonografia','!=',null);
    }else{
      $lista = $ingreso->transaccion->solicitud->where('estado',0)->where('f_ultrasonografia','!=',null);
    }
    $ultra = [];
    $indice = 0;
    foreach($lista as $detalle){
      $ultra[$indice]['id'] = $detalle->id;
      $ultra[$indice]['hora'] = $detalle->created_at->format('h:i.s a');
      $ultra[$indice]['nombre'] = $detalle->ultrasonografia->nombre;
      $ultra[$indice]['estado'] = $detalle->estado;
      $indice++;
    }
    $ultra = array_reverse($ultra);
    setlocale(LC_ALL,'es');
    $fecha_f = $fecha->formatLocalized('%d de %B de %Y');
    return (compact('ultra','indice','fecha_f'));
  }

  public function lista_tac(Request $request){
    $id = $request->id;
    $fecha_sf = $request->fecha;
    $ingreso = Ingreso::find($id);
    $fecha = new Carbon($fecha_sf);
    $fecha24 = new Carbon($fecha_sf);
    $fecha->hour(7);
    $fecha24 = $fecha24->addDays(1);
    $fecha24->hour(7);
    $dias = -1;
    if($ingreso->estado != 2){
      $dias = 1;
      $ahora = Carbon::now();
      $ultima24 = Carbon::today()->hour(7);
      $ultima48 = Carbon::tomorrow()->hour(7);
      if($ahora->lt($ultima24)){
        $ultima24->subDay();
        $ultima48->subDay();
      }
    }
    if($request->pendiente == null){
      $lista = $ingreso->transaccion->solicitud->where('created_at','>',$fecha)->where('created_at','<',$fecha24)->where('f_tac','!=',null);
    }else{
      $lista = $ingreso->transaccion->solicitud->where('estado',0)->where('f_tac','!=',null);
    }
    $tac = [];
    $indice = 0;
    foreach($lista as $detalle){
      $tac[$indice]['id'] = $detalle->id;
      $tac[$indice]['hora'] = $detalle->created_at->format('h:i.s a');
      $tac[$indice]['nombre'] = $detalle->tac->nombre;
      $tac[$indice]['estado'] = $detalle->estado;
      $indice++;
    }
    $tac = array_reverse($tac);
    setlocale(LC_ALL,'es');
    $fecha_f = $fecha->formatLocalized('%d de %B de %Y');
    return (compact('tac','indice','fecha_f'));
  }

  public function lista_signos(Request $request){
    $id = $request->id;
    $fecha_sf = $request->fecha;
    $ingreso = Ingreso::find($id);
    $fecha = new Carbon($fecha_sf);
    $fecha24 = new Carbon($fecha_sf);
    $fecha24 = $fecha24->addDays(1);
    $fecha->hour(7);
    $fecha24 = $fecha24->addDays(1);
    $fecha24->hour(7);
    $dias = -1;
    if($ingreso->estado != 2){
      $dias = 1;
      $ahora = Carbon::now();
      $ultima24 = Carbon::today()->hour(7);
      $ultima48 = Carbon::tomorrow()->hour(7);
      if($ahora->lt($ultima24)){
        $ultima24->subDay();
        $ultima48->subDay();
      }
    }

    $lista = $ingreso->signos->where('created_at','>',$fecha)->where('created_at','<',$fecha24);

    $signos = [];
    $indice = 0;
    foreach($lista as $detalle){
      $signos[$indice]['id'] = $detalle->id;
      $signos[$indice]['hora'] = $detalle->created_at->format('h:i.s a');
      $indice++;
    }
    $signos = array_reverse($signos);
    setlocale(LC_ALL,'es');
    $fecha_f = $fecha->formatLocalized('%d de %B de %Y');
    return (compact('signos','indice','fecha_f'));
  }

  public function lista_medico(Request $request){
    $id = $request->id;
    $i_id = $request->i_id;
    $servicio = Servicio::find($id);
    $ingreso = Ingreso::find($i_id);
    $nombre = (($servicio->medico->sexo)?'Dr. ':'Dra. ').$servicio->medico->nombre.' '.$servicio->medico->apellido;
    //Mostrar la foto
    if($servicio->medico->foto == "noImgen.jpg"){
      $foto = '../../public/storage/noImgen.jpg';
    }else{
      $fotito = $servicio->medico->foto;
      $aux = explode('/',$fotito);
      $foto = '../../'.$aux[0].'/storage/'.$aux[1].'/'.$aux[2];
    }
    $especialidad = User::especialidad_principal($servicio->medico->id);
    $especialidad = ($especialidad == 0)?"Ninguna":DB::table('especialidads')->where('id',$especialidad)->first(['nombre']);
    $detalles = DetalleTransacion::where('f_transaccion',$ingreso->transaccion->id)->where('f_servicio',$id)->get();
    $consultas = [];
    foreach($detalles as $k => $detalle){
      $consultas[$k]['fecha'] = $detalle->created_at->format('d / m / Y');
      $consultas[$k]['hora'] = $detalle->created_at->format('h:i:s a');
      $consultas[$k]['id'] = $detalle->id;
      if($ingreso->estado == "1"){
        $ahora = Carbon::now();
        $hoy = Carbon::today()->addHours(7);
        $tmw = Carbon::tomorrow()->addHour(7);
        if($ahora->lt($hoy)){
          $hoy->subDay();
          $tmw->subDay();
        }
        if($detalle->created_at->between($hoy,$tmw)){
          $consultas[$k]['estado'] = true;
        }else{
          $consultas[$k]['estado'] = false;
        }
      }else{
        $consultas[$k]['estado'] = false;
      }
    }
    $consultas = array_reverse($consultas);
    return (compact(
      'nombre',
      'foto',
      'especialidad',
      'consultas'
    ));
  }

  public function dash ($id){
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
            if($detalle->servicio->categoria->nombre == "Cama"){
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
          if($ingreso->tipo < 3){
            $dias = $ingreso->fecha_ingreso->diffInDays($ingreso->fecha_alta);
            $utlima48 = $ultima24 = $ingreso->fecha_ingreso->subDays(1);
          }
        }
        if($ingreso->tipo < 3){
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
          $total_abono = $total_gastos = $total_abono = $total_deuda = 0;  
        }
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

      //Datos de las consultas
      $extraccion = $paciente->ingreso;
      $indx = $indx2 = 0;
      $consultas = [];
      $signos_vital = [];
      foreach($extraccion as $ingresos_){
        if($ingresos_->consulta != null){
          foreach($ingresos_->consulta as $consulta){
            $consultas[$indx] = $consulta;
            $indx++;
          }
        }
        if($ingresos_->signos != null){
          foreach($ingresos_->signos as $signo){
            $signos_vital[$indx2] = $signo;
            $indx2++;
          }
        }
      }
      //Lista de examenes del paciente
      $examenes_paciente = SolicitudExamen::where('f_paciente',$ingreso->f_paciente)->where('estado','>',1)->orderBy('created_at','desc')->get();
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
        'ultima48',
        'consultas',
        'signos_vital',
        'examenes_paciente'
      ));
  }
}
