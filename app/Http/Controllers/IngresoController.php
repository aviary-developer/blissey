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
use App\Receta;
use App\Cama;
use App\Tac;
use App\ultrasonografia;
use App\SolicitudExamen;
use App\Abono;
use App\Hospitalizacion;
use App\Seguimiento;
use App\Especialidad;
use Illuminate\Http\Request;
use App\Transacion;
use App\DetalleTransacion;
use App\CategoriaServicio;
use DB;
use Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Inventario;
use App\CambioProducto;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      // $pagina = ($request->get('page')!=null)?$request->get('page'):1;
      // $pagina--;
      // $pagina *= 10;
      // $estado = $request->get('estado');
			// $usuario = null;
			
      // $ingresos = Hospitalizacion::buscar($estado, $usuario);
      // $activos = Ingreso::where('estado','<>',2)->where('tipo', 1)->count();
			
			//Petición de todos los médicos para la calculadora
			$medicos = User::where('tipoUsuario','Médico')->where('estado',true)->orderBy('apellido')->get();
			//Petición de todos los exámenes médicos para la calculadora
			$examenes = Examen::where('estado', true)->orderBy('area')->orderBy('nombreExamen')->get();
			$rayosx = Rayosx::where('estado', true)->orderBy('nombre')->get();
			$ultras = ultrasonografia::where('estado', true)->orderBy('nombre')->get();
			$tacs = Tac::where('estado', true)->orderBy('nombre')->get();

      $habitaciones_ingreso = Habitacion::where('tipo',1)->where('estado',true)->orderBy('numero','asc')->get();
      $habitaciones_observacion = Habitacion::where('tipo',0)->where('estado',true)->orderBy('numero','asc')->get();
      $habitaciones_mediingreso = Habitacion::where('tipo',2)->where('estado',true)->orderBy('numero','asc')->get();

      /**Listado de cola en consulta médica */
      $cola_consulta = Ingreso::where('estado','<>',2)->where('tipo',3)->orderBy('created_at','asc')->get();

      //Variables utiles en la vista
      // $estadoOpuesto = ($estado != 2 || $estado == null)?2:0;
      $index = true;
      $fecha = Carbon::now();
      return view('Ingresos.index.base',compact(
        // 'ingresos',
        //'estado',
        // 'activos',
        //'pagina',
        //'tipo',
        'index',
        // 'estadoOpuesto',
        'habitaciones_ingreso',
        'habitaciones_observacion',
        'habitaciones_mediingreso',
        'medicos',
        'fecha',
				'cola_consulta',
				'examenes',
				'ultras',
				'rayosx',
				'tacs'
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
					//Asignación del numero de expediente
					$ultimo_registro = Hospitalizacion::where('fecha_entrada','>=',date('Y').'-1-1')->where('fecha_entrada','<=',date('Y').'-12-31')->get()->last();
					if($ultimo_registro == null){
						$correlativo = 0;
					}else if($ultimo_registro->expediente == null){
						$correlativo = 0;
					}else{
						$correlativo = $ultimo_registro->expediente;
					}
					//Creando el registro en hospitalizacion
					$aux = explode('T',$request->fecha_ingreso);
					$fecha = $aux[0].' '.$aux[1];
					
					$hospitalizacion = new Hospitalizacion;
					$hospitalizacion->fecha_entrada = $fecha.':00';
          $hospitalizacion->f_paciente = $request->f_paciente;
          if($request->c_responsable == 1){
						$hospitalizacion->f_responsable = $request->f_responsable;
          }else{
						$hospitalizacion->f_responsable = $request->f_paciente;
          }
					$hospitalizacion->f_medico = $request->f_medico;
					$hospitalizacion->expediente = $correlativo+1;
					$hospitalizacion->save();
					
					//Creando el registro en ingresos
          $ingresos = new Ingreso;
          if($request->tipo == 2 || $request->tipo == 0 || $request->tipo == 1){
            $ingresos->f_cama = $request->f_cama;
          }
          $ingresos->fecha_ingreso  = $fecha.':00';
          $ingresos->f_recepcion = Auth::user()->id;
					$ingresos->tipo = $request->tipo;
					if($request->tipo == 2){
						$ingresos->estado = 1;
					}
					$ingresos->f_hospitalizacion = $hospitalizacion->id;
          $ingresos->save();

          if($request->tipo < 3){
            $cama = Cama::find($request->f_cama);
            $cama->estado = true;
            $cama->save();
					}
					if($request->tipo > 1){
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
       * 1 - Medio ingreso
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
      $paciente = $ingreso->hospitalizacion->paciente;
			$responsable = null;
			$lista_paquetes = [];
			$lista_honorarios = [];
      if($ingreso->f_responsable != $ingreso->f_paciente){
        $responsable = $ingreso->hospitalizacion->responsable;
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
				if($ingreso->tipo == 0){
					$horas = $ingreso->fecha_ingreso->diffInHours($hoy);
				}else{
					$horas = $ingreso->fecha_ingreso->diffInHours($ahora);
				}
        $horas_f = $hoy->diff($ingreso->fecha_ingreso)->format('%dd  %hh : %im');
				/**Generador automatico de transacciones por uso de la habitación */
				/**SEP16: El costo de estar ingresado es llevado por un 'Servicio' especial ya no por las habitaciones
				 * la lógica de la corrección es la siguiente: El servicio de 'Paquete hospitalario' será añadido diariamente
				 * la 'Cama' ya no determina el costo que debe pagar el paciente por el servicio, sin embargo si puede añadir un
				 * costo extra a la hospitalización, el servicio debe ser añadido a diario y puede ser modificado en cualquier 
				 * momento por un servicio diferente.
				 * 
				 * Se añade además un segmento donde muestra una notificación sobre los honorarios médicos pendientes. 
				 * Para ello busca en la transacción aquellos detalles en los que se haya aplicado el serivicio hospitalario
				 * brindado por el médico que probó su ingreso.
				 */
				$habitacion_dia_guardado_count = 0;
				/**SEP16: Contador de días en los que se ha agregado un servicio de tipo paquete hospitalario 
				 * Contador de días en los que se ha agregado el servicio por honorarios médicos
				*/
				$paquete_dia_guardado_count = 0;
				$honorario_dia_guardado_count = 0;
				/**SEP16: Buscar el total de días en los que se ha registrado el honorario del médico que ha aprobado el ingreso
				 * Se cambio el proceso de obtención de los contadores, en lugar de usar un foreach como en la versión anterior se
				 * usan consultas directas a la base de datos a través de JOINS
				 */
				$habitacion_dia_guardado_count = DetalleTransacion::join('servicios', 'detalle_transacions.f_servicio', 'servicios.id')->join('categoria_servicios', 'servicios.f_categoria', 'categoria_servicios.id')->where('categoria_servicios.nombre', 'Cama')->where('detalle_transacions.f_transaccion',$ingreso->transaccion->id)->count();
				$paquete_dia_guardado_count = DetalleTransacion::join('servicios','detalle_transacions.f_servicio','servicios.id')->join('categoria_servicios','servicios.f_categoria','categoria_servicios.id')->where('categoria_servicios.nombre','Paquetes hospitalarios')->where('detalle_transacions.f_transaccion',$ingreso->transaccion->id)->count();

				$honorario_dia_guardado_count = DetalleTransacion::where('f_servicio',$ingreso->hospitalizacion->medico->servicio->id)->where('f_transaccion',$ingreso->transaccion->id)->count();
        /**Diferencia entre los días guardados hasta el día de hoy */
				$habitacion_dia_no_guardado_count = $dias - $habitacion_dia_guardado_count;
				/**SEP16: Diferencia para determinar cuantos días hacen falta añadir el paquete hospitalario */
				$paquete_dia_no_guardado_count = $dias - $paquete_dia_guardado_count;
				$honorario_dia_no_guardado_count = $dias - $honorario_dia_guardado_count;
				/**Si la diferencia no es 0 recorrer en un for desde el dia de ingreso hasta la fecha de hoy para revisar  el día que no se ha registrado y crearlo*/
        if($habitacion_dia_no_guardado_count > 0){
					$fecha_aux = new Carbon($dia_ingreso->format('Y-m-d'));
          for($i=0; $i<$dias; $i++){
            /**Comprobar si existe el detalle este día */
            $exist_detalle = DetalleTransacion::where('f_transaccion',$ingreso->transaccion->id)->where('created_at',$fecha_aux)->count();
						/**Si no existe se crea la transaccion */
						/**Se va a detener la creación automática del registro de habitaciones */
            // if($exist_detalle == 0){
            //   DB::beginTransaction();
            //   try{
            //     $detalle_new = new DetalleTransacion;
            //     $detalle_new->f_servicio = $ingreso->habitacion->servicio->id;
            //     $detalle_new->f_transaccion = $ingreso->transaccion->id;
            //     $detalle_new->cantidad = 1;
            //     $detalle_new->precio = $ingreso->habitacion->servicio->precio;
            //     $detalle_new->created_at = $fecha_aux;
            //     $detalle_new->save();
            //     DB::commit();
            //   }catch(Exception $e){
            //     DB::rollbalk();
            //   }
            // }
          }
				}
			
				/**SEP16: Si el valor de la diferencia no es cero entonces que guarde en un arreglo las fechas para que el usuario se encargue de añadir el valor de forma manual al estado financiero del paciente */
				
				if($paquete_dia_no_guardado_count > 0){
					for($i=0,$ii=0;$i<$dias; $i++){
						$fecha_aux = new Carbon($dia_ingreso->format('Y-m-d'));
						$fecha_aux->addDays($i);
						/**Determinar si existe el detalle de la transacción correspondiente al paquete hospitalario */
						$existe_detalle_paquete = DetalleTransacion::join('servicios','detalle_transacions.f_servicio','servicios.id')->join('categoria_servicios','servicios.f_categoria','categoria_servicios.id')->where('categoria_servicios.nombre','Paquetes hospitalarios')->where('detalle_transacions.f_transaccion',$ingreso->transaccion->id)->whereDate('detalle_transacions.created_at',$fecha_aux)->count();
						/**Si nos devuelve cero significa que no se ha añadido el servicio correspondiente al paquete hospitalario en dicha fecha */
						if($existe_detalle_paquete == 0){
							$lista_paquetes[$ii]["fecha"] = $fecha_aux;
							$ii++;
						}
					}
				}
				
				if ($honorario_dia_no_guardado_count > 0) {
					for ($i = 0, $ii = 0; $i < $dias; $i++) {
						$fecha_aux = new Carbon($dia_ingreso->format('Y-m-d'));
						$fecha_aux->addDays($i);
						/**Determinar si existe el detalle de la transacción correspondiente al honorario médico */
						$existe_detalle_honorario = DetalleTransacion::where('f_servicio', $ingreso->hospitalizacion->medico->servicio->id)->where('f_transaccion', $ingreso->transaccion->id)->whereDate('created_at', $fecha_aux)->count();
						/**Si nos devuelve cero significa que no se ha añadido el servicio correspondiente al honorario médico en dicha fecha */
						if ($existe_detalle_honorario == 0) {
							$lista_honorarios[$ii]["fecha"] = $fecha_aux;
							$ii++;
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
        if($ingreso->hospitalizacion->paciente->solicitudes->count()>0){
          foreach($ingreso->hospitalizacion->paciente->solicitudes as $solicitud){
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
        if($ingreso->hospitalizacion->paciente->solicitudes->count()>0){
          foreach($ingreso->hospitalizacion->paciente->solicitudes as $solicitud){
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
        if($ingreso->hospitalizacion->paciente->solicitudes->count()>0){
          foreach($ingreso->hospitalizacion->paciente->solicitudes as $solicitud){
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
        if($ingreso->hospitalizacion->paciente->solicitudes->count()>0){
          foreach($ingreso->hospitalizacion->paciente->solicitudes as $solicitud){
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
				if($ingreso->iva){
					$iva = $total_gastos * 0.13;
					$iva = number_format($iva,2);
					$total_gastos += $iva;
				}
        /**Total abonado a la deuda */
        $total_abono = Ingreso::abonos($id);
        /**Total adeudado a la cuenta */
        $total_deuda = $total_gastos - $total_abono;
			}
			/**DIC06: Los exámenes que se puede realizar un usuario en sí no dependen del tipo */
      if($ingreso->tipo <= 3){
				$categoria = CategoriaServicio::where('nombre', 'Laboratorio Clínico')->first();
				if ($categoria == null) {
					return view('errors.001');
				}
				$servicios = Servicio::where('f_categoria', $categoria->id)->get();
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
				$historial = Hospitalizacion::where('f_paciente',$ingreso->hospitalizacion->f_paciente)->orderBy('created_at','desc')->get();
        $lista_medicamentos = Producto::orderBy('nombre','asc')->get();
			}
			/**Listado de paquetes hospitalarios para la parte de los paquetes */
			$paquetes_hospitalarios = Servicio::join('categoria_servicios','servicios.f_categoria','categoria_servicios.id')->where('categoria_servicios.nombre','Paquetes hospitalarios')->orderBy('servicios.nombre')->select('servicios.*')->get();
			/**ABR3.20 Crear un detalle con los honorarios Médicos para el cobro en caso de ser consulta */
			$detalle_hc = 0;
			if($ingreso->tipo == 3){
				$detalle_honorario_consulta = DetalleTransacion::where('f_transaccion',$ingreso->transaccion->id)->where('f_servicio',$ingreso->hospitalizacion->medico->servicio->id)->first();
				if($detalle_honorario_consulta == null){
					DB::beginTransaction();
					try{
						$transaccion_honorario = new DetalleTransacion;
						$transaccion_honorario->f_servicio = $ingreso->hospitalizacion->medico->servicio->id;
						$transaccion_honorario->precio = $ingreso->hospitalizacion->medico->servicio->precio;
						$transaccion_honorario->f_transaccion = $ingreso->transaccion->id;
						$transaccion_honorario->cantidad = 1;
						$transaccion_honorario->f_usuario = Auth::user()->id;
						$transaccion_honorario->save();
						DB::commit();
						$detalle_hc = $transaccion_honorario;
					}catch(Exception $e){
						DB::rollback();
					}
				}else{
					$detalle_hc = $detalle_honorario_consulta;
				}
			}
			/**Lectura de recetas para usuarios de tipo enfermería */
			$indicaciones = [];
			$seguimientos = [];
			if(Auth::user()->tipoUsuario == "Enfermería"){
				$indicaciones = Receta::join('consultas','recetas.f_consulta','consultas.id')->join('users','consultas.f_medico','users.id')->where('consultas.f_ingreso',$ingreso->id)->select('recetas.*','users.nombre','users.apellido','users.sexo')->orderBy('recetas.created_at','desc')->get();
				$seguimientos = Seguimiento::where('f_ingreso',$ingreso->id)->orderBy('fecha','desc')->get();
			}
      return view('Ingresos.dashboard.show',compact(
				'seguimientos',
				'indicaciones',
				'detalle_hc',
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
				'servicios',
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
				'lista_medicamentos',
				'lista_paquetes',
				'paquetes_hospitalarios',
				'lista_honorarios'
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
      if($pacientes!=null){
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
      return ($pdf->stream());
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
        $ingresos = Ingreso::count();
        if($ingresos > 0){
          $pacientes = DB::table('pacientes')
          ->whereNotExists(
            function ($query){
              $query->select(DB::raw(1))
              ->from('hospitalizacions')
              ->where('hospitalizacions.estado','<>',0)
              ->whereRaw('hospitalizacions.f_paciente = pacientes.id');
            }
            )->where(
              function ($query) use ($nombre){
                $query->where('nombre','like','%'.$nombre.'%')
                ->orWhere('apellido','like','%'.$nombre.'%');
              }
              )->where('estado',true)->orderBy('apellido')->take(7)->get();
        }else{
          $pacientes = DB::table('pacientes')
          ->where(
              function ($query) use ($nombre){
                $query->where('nombre','like','%'.$nombre.'%')
                ->orWhere('apellido','like','%'.$nombre.'%');
              }
            )->where('estado',true)->orderBy('apellido')->take(7)->get();
        }
      }else if($tipo == "solicitud"){
        $pacientes = Paciente::where('nombre','like','%'.$nombre.'%')->orWhere('apellido','like','%'.$nombre.'%')->where('estado',true)->orderBy('apellido')->take(7)->get();
      }else{
        $pacientes = Paciente::where('fechaNacimiento','<=',$fecha->format('Y-m-d'))->where('nombre','like','%'.$nombre.'%')->orWhere('apellido','like','%'.$nombre.'%')->where('estado',true)->orderBy('apellido')->take(7)->get();
      }
      if($pacientes!=null){
        return $pacientes;

      }else{
        return 0;
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
        $detalle->f_usuario=Auth::user()->id;
        if(Auth::user()->tipoUsuario == 'Enfermería'){
          $detalle->estado = false;
        }elseif(Auth::user()->tipoUsuario == 'Recepción' && $request->tipo_detalle == 1 ){
        $inve=Inventario::Actualizar($detalle->f_producto,Transacion::tipoUsuario(),2,$request->cantidad);          
        }
        $detalle->save();
        DB::commit();
        CambioProducto::actualizarCambio($detalle->f_producto);
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
					
					$hospitalizacion = Hospitalizacion::find($ingreso->f_hospitalizacion);
					$hospitalizacion->fecha_salida = Carbon::now();
					$hospitalizacion->estado = 0;
					$hospitalizacion->save();

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
			$fecha_hf = Carbon::parse($fecha_x);
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
			$ultima_honorario_24 = $fecha_hf;
      $ultima48 = Carbon::parse($fecha_x)->hour(7)->addDay();

      $fecha = $fecha->formatLocalized('%d de %B de %Y');
      $medico = (($ingreso->hospitalizacion->medico->sexo)?'Dr. ':'Dra. ').$ingreso->hospitalizacion->medico->nombre.' '.$ingreso->hospitalizacion->medico->apellido;

      //Total gastos
      $honorarios = 0;
      $total = Ingreso::servicio_gastos($id, $dia);
      $total += Ingreso::tratamiento_gastos($id, $dia);
      //Honorarios
      $total+= $honorarios = Ingreso::honorario_gastos($id, $dia);
      $medicos = [];
      if($ingreso->transaccion->detalleTransaccion->where('f_producto',null)!=null){
        $k = 0;
        foreach($ingreso->transaccion->detalleTransaccion->where('f_producto',null) as $detalle){
          if($detalle->servicio->categoria->nombre == "Honorarios" && ($detalle->created_at->between($ultima_honorario_24, $ultima48))){
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
      if($ingreso->transaccion->detalleTransaccion->where('f_producto',null)->where('estado',true)!=null){
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
      if($ingreso->transaccion->solicitud!=null){
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
      if($ingreso->transaccion->detalleTransaccion->where('estado',true)!=null){
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

			if($ingreso->iva){
				$iva = $total * 0.13;
				$iva = number_format($iva,2);
			}else{
				$iva = 0;
			}
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
          $detalle->f_usuario=Auth::user()->id;
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
		$precio = $request->precio;
    DB::beginTransaction();
    try{
			$detalle = DetalleTransacion::find($id);
			if($cantidad != null){
				$anterior=$detalle->cantidad;
				$detalle->cantidad = $cantidad;
				$detalle->save();
				if($detalle->estado){
					$movimiento = $anterior - $cantidad;
					if($movimiento > 0){
						Inventario::Actualizar($detalle->f_producto,Transacion::tipoUsuario(),14,abs($movimiento));            
					}else{
						Inventario::Actualizar($detalle->f_producto,Transacion::tipoUsuario(),15,abs($movimiento)); 
					}
				}
			}else{
				$detalle->precio = $precio;
				$detalle->save();
			}
      DB::commit();
      CambioProducto::actualizarCambio($detalle->f_producto);
      return 1;
    }catch(Exception $e){
      DB::rollback();
      return 0;
    }
	}

	public function editarx24(Request $request)
	{
		$id = $request->id;
		$precio = $request->precio;
		DB::beginTransaction();
		try {
			$detalle = DetalleTransacion::find($id);
			$detalle->precio = $precio;
			$detalle->save();
			DB::commit();
			return 1;
		} catch (Exception $e) {
			DB::rollback();
			return 0;
		}
	}

  public function eliminar24 (Request $request){
    $id = $request->id;
    DB::beginTransaction();
    try{
      $detalle = DetalleTransacion::find($id);
      Inventario::Actualizar($detalle->f_producto,Transacion::tipoUsuario(),14,$detalle->cantidad);   
      $detalle->delete();
      DB::commit();
      CambioProducto::actualizarCambio($detalle->f_producto);
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
			$detalle->f_usuario = Auth::user()->id;
      $detalle->save();
      Inventario::Actualizar($detalle->f_producto,Transacion::tipoUsuario(),2,$detalle->cantidad);          
      DB::commit();
      CambioProducto::actualizarCambio($detalle->f_producto);
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
    for($i=0,$l=0; $l<$dias+1; $i++){
      $monto[$i]=Ingreso::servicio_gastos($id,$i);
      $monto[$i]+=Ingreso::honorario_gastos($id,$i);
      $monto[$i]+=Ingreso::tratamiento_gastos($id,$i);
			$abonos[$i]=Ingreso::abonos($id,$i);
			if($ingreso->iva){
				$iva = $monto[$i]*0.13;
				$iva = number_format($iva,2);
				$monto[$i]+=$iva;
			}
			$fecha[$i]=$ingreso->fecha_ingreso->addDays($i)->format('m-d-Y');
			if($dias > 10 && $dias < 20){
				$l += 2;
			}else{
				$l += 7;
			}
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
		//$lista = DetalleTransacion::where('f_producto',null)->whereDate('created_at',$fecha->format('Y-m-d'))->get();
		$lista = DetalleTransacion::join('transacions', 'detalle_transacions.f_transaccion', 'transacions.id')->where('detalle_transacions.f_producto', null)->where('transacions.f_ingreso', $id)->whereDate('detalle_transacions.created_at', $fecha->format('Y-m-d'))->select('detalle_transacions.*')->get();
    $servicios = [];
		$indice = 0;
    foreach($lista as $detalle){
      if($detalle->servicio->categoria->nombre != "Honorarios" && $detalle->servicio->categoria->nombre != "Cama" && $detalle->servicio->categoria->nombre != "Rayos X" && $detalle->servicio->categoria->nombre != "Laboratorio Clínico" && $detalle->servicio->categoria->nombre != "Ultrasonografía" && $detalle->servicio->categoria->nombre != "TAC"){
        $servicios[$indice]['id'] = $detalle->id;
        $servicios[$indice]['hora'] = $detalle->created_at->format('H:i.s');
        $servicios[$indice]['cantidad'] = $detalle->cantidad;
				$servicios[$indice]['nombre'] = $detalle->servicio->nombre;
				$servicios[$indice]['precio'] = $detalle->precio;
				$servicios[$indice]['total'] = $detalle->precio * $detalle->cantidad;
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
		//$lista = DetalleTransacion::where('f_servicio', null)->whereDate('created_at', $fecha->format('Y-m-d'))->get();
		$lista = DetalleTransacion::join('transacions','detalle_transacions.f_transaccion','transacions.id')->where('detalle_transacions.f_servicio',null)->where('transacions.f_ingreso',$id)->whereDate('detalle_transacions.created_at', $fecha->format('Y-m-d'))->select('detalle_transacions.*')->get();
    $productos = [];
		$indice = 0;
    foreach($lista as $detalle){
      $productos[$indice]['id']=$detalle->id;
      $productos[$indice]['hora']=$detalle->created_at->format('h:i:s a');
      $productos[$indice]['cantidad'] = $detalle->cantidad;
      if($detalle->divisionProducto->unidad == null){
        $productos[$indice]['division'] = $detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->producto->presentacion->nombre;
      }else{
        $productos[$indice]['division'] = $detalle->divisionProducto->division->nombre." ".$detalle->divisionProducto->cantidad." ".$detalle->divisionProducto->unidad->nombre;
      }
			$productos[$indice]['nombre'] = $detalle->divisionProducto->producto->nombre;
			$productos[$indice]['precio'] = $detalle->precio;
			$productos[$indice]['total'] = $detalle->precio * $detalle->cantidad;
      // if($dias != -1 && $detalle->created_at->between($ultima24,$ultima48)){
      //   $productos[$indice]['estado'] = 1;
      // }else{
      //   $productos[$indice]['estado'] = 0;
			// }
			$productos[$indice]['estado'] = $detalle->estado;
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
      $lista = $ingreso->hospitalizacion->paciente->solicitudes->where('created_at','>',$fecha)->where('created_at','<',$fecha24)->where('f_examen','!=',null);
    }else{
      $lista = $ingreso->hospitalizacion->paciente->solicitudes->where('estado',0)->where('f_examen','!=',null);
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
			$laboratorio[$indice]['f_examen'] = $detalle->f_examen;
			$laboratorio[$indice]['actual'] = false;
			if($detalle->transaccion != null){
				if($detalle->transaccion->ingreso->id == $ingreso->id){
					$laboratorio[$indice]['actual'] = true;		
				}
			}
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
      $lista = $ingreso->hospitalizacion->paciente->solicitudes->where('created_at','>',$fecha)->where('created_at','<',$fecha24)->where('f_rayox','!=',null);
    }else{
      $lista = $ingreso->hospitalizacion->paciente->solicitudes->where('estado',0)->where('f_rayox','!=',null);
    }
    $rayox = [];
    $indice = 0;
    foreach($lista as $detalle){
      $rayox[$indice]['id'] = $detalle->id;
      $rayox[$indice]['hora'] = $detalle->created_at->format('h:i.s a');
      $rayox[$indice]['nombre'] = $detalle->rayox->nombre;
			$rayox[$indice]['estado'] = $detalle->estado;
			$rayox[$indice]['f_rayox'] = $detalle->f_rayox;
			$rayox[$indice]['actual'] = false;
			if ($detalle->transaccion != null) {
				if ($detalle->transaccion->ingreso->id == $ingreso->id) {
					$rayox[$indice]['actual'] = true;
				}
			}
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
      $lista = $ingreso->hospitalizacion->paciente->solicitudes->where('created_at','>',$fecha)->where('created_at','<',$fecha24)->where('f_ultrasonografia','!=',null);
    }else{
      $lista = $ingreso->hospitalizacion->paciente->solicitudes->where('estado',0)->where('f_ultrasonografia','!=',null);
    }
    $ultra = [];
    $indice = 0;
    foreach($lista as $detalle){
      $ultra[$indice]['id'] = $detalle->id;
      $ultra[$indice]['hora'] = $detalle->created_at->format('h:i.s a');
      $ultra[$indice]['nombre'] = $detalle->ultrasonografia->nombre;
			$ultra[$indice]['estado'] = $detalle->estado;
			$ultra[$indice]['f_ultrasonografia'] = $detalle->f_ultrasonografia;
			$ultra[$indice]['actual'] = false;
			if ($detalle->transaccion != null) {
				if ($detalle->transaccion->ingreso->id == $ingreso->id) {
					$ultra[$indice]['actual'] = true;
				}
			}
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
      $lista = $ingreso->hospitalizacion->paciente->solicitudes->where('created_at','>',$fecha)->where('created_at','<',$fecha24)->where('f_tac','!=',null);
    }else{
      $lista = $ingreso->hospitalizacion->paciente->solicitudes->where('estado',0)->where('f_tac','!=',null);
    }
    $tac = [];
    $indice = 0;
    foreach($lista as $detalle){
      $tac[$indice]['id'] = $detalle->id;
      $tac[$indice]['hora'] = $detalle->created_at->format('h:i.s a');
      $tac[$indice]['nombre'] = $detalle->tac->nombre;
			$tac[$indice]['estado'] = $detalle->estado;
			$tac[$indice]['f_tac'] = $detalle->f_tac;
			$tac[$indice]['actual'] = false;
			if ($detalle->transaccion != null) {
				if ($detalle->transaccion->ingreso->id == $ingreso->id) {
					$tac[$indice]['actual'] = true;
				}
			}
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
    $detalles = DetalleTransacion::where('f_transaccion',$ingreso->transaccion->id)->where('f_servicio',$id)->orderBy('created_at')->get();
    $consultas = [];
    foreach($detalles as $k => $detalle){
      $consultas[$k]['fecha'] = $detalle->created_at->format('d / m / Y');
			$consultas[$k]['hora'] = $detalle->created_at->format('h:i:s a');
			$consultas[$k]['precio'] = $detalle->precio;
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
	
	//Funciones de la calculadora
	public function c_habitacion (Request $request){
		if($request->tipo != 0){
			$tipo = 1;
		}else{
			$tipo = 0;
		}
		$habitacion = Habitacion::where('tipo',$tipo)->where('estado',true)->orderBy('numero')->get();
		return $habitacion;
	}

	public function c_cama (Request $request){
		$cama = Cama::where('f_habitacion',$request->id)->where('estado',false)->where('activo',true)->orderBy('numero')->get();
		if($request->tipo == 1){
			$servicio = Servicio::where('nombre','Ingreso')->first();
		}else if($request->tipo == 0){
			$servicio = Servicio::where('nombre', 'Observación')->first();
		}else{
			$servicio = Servicio::where('nombre', 'Medio Ingreso')->first();
		}
		foreach($cama as $c){
			$c->precio = $c->precio + $servicio->precio;
		}
		return $cama;
	}

	public function v_habitacion (Request $request){
		$cama = Servicio::where('f_cama',$request->id)->first();
		if ($request->tipo == 1) {
			$servicio = Servicio::where('nombre', 'Ingreso')->first();
		} else if ($request->tipo == 0) {
			$servicio = Servicio::where('nombre', 'Observación')->first();
		} else {
			$servicio = Servicio::where('nombre', 'Medio Ingreso')->first();
		}
		return $servicio->precio + $cama->precio;
	}

	//SEP16:Nuevas funciones para trabajar con ingresos
	public function guardar_paquete(Request $request){
		$id_servicio = $request->id_servicio;
		$id_transaccion = $request->id_transaccion;
		$precio = $request->precio;
		$fecha = $request->fecha;
		
		DB::beginTransaction();
		try{
			$detalle = new DetalleTransacion;
			$detalle->f_servicio = $id_servicio;
      $detalle->f_transaccion = $id_transaccion;
      $detalle->cantidad = 1;
      $detalle->precio = $precio;
      $detalle->created_at = $fecha;
      $detalle->f_usuario=Auth::user()->id;
      $detalle->save();
			DB::commit();
			return 1;
		}catch(Exception $e){
			DB::rollback();
			return 0;
		}
	}

	public function guardar_honorario(Request $request)
	{
		$id_servicio = $request->id_servicio;
		$id_transaccion = $request->id_transaccion;
		$precio = $request->precio;
		$fecha = $request->fecha;

		DB::beginTransaction();
		try {
			$detalle = new DetalleTransacion;
			$detalle->f_servicio = $id_servicio;
			$detalle->f_transaccion = $id_transaccion;
			$detalle->cantidad = 1;
			$detalle->precio = $precio;
			$detalle->created_at = $fecha;
			$detalle->save();
			DB::commit();
			return 1;
		} catch (Exception $e) {
			DB::rollback();
			return 0;
		}
	}

	public function eliminarDS (Request $request){
		$id = $request->id;
		DB::beginTransaction();
		try {
			$solicitud = SolicitudExamen::find($id);
			$detalle = DetalleTransacion::where('f_transaccion',$solicitud->f_transaccion)->where('created_at',$solicitud->created_at)->first();
			$solicitud->delete();
			$detalle->delete();
			DB::commit();
			return 1;
		} catch (Exception $e) {
			DB::rollback();
			return 0;
		}
	}

	//FEB15.20 Actualización del acta de consentimiento, solicita la información antes de generár el acta
	public function acta_datos(Request $request){
		$hospitalizacion = Hospitalizacion::find($request->id);
		$paciente = $hospitalizacion->paciente;
		$paciente->edad = $paciente->fechaNacimiento->age;
		$responsable = $hospitalizacion->responsable;
		$responsable->edad = $responsable->fechaNacimiento->age;
		return compact('paciente','responsable');
	}

	//ABR22.20 Estado de IVA
	public function estado_iva(Request $request){
		$ingreso = Ingreso::find($request->i_id);
		DB::beginTransaction();
		try{
			$ingreso->iva = !$ingreso->iva;
			$ingreso->save();
			DB::commit();
			return 1;
		}catch(Exception $e){
			DB::rollback();
			return 0;
		}
	}
}
