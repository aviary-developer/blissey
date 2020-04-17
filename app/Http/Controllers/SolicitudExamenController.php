<?php

namespace App\Http\Controllers;

use App\SolicitudExamen;
use App\Examen;
use App\DetalleUltrasonografia;
use App\DetalleRayox;
use App\DetalleTac;
use App\ultrasonografia;
use App\Rayosx;
use App\CategoriaServicio;
use App\Servicio;
use App\DetalleResultado;
use App\Resultado;
use App\Parametro;
use App\ExamenSeccionParametro;
use App\Bitacora;
use App\Reactivo;
use App\Tac;
use App\Transacion;
use App\DetalleTransacion;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;

class SolicitudExamenController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
		$pacientes = null;
		$examenes = null;
    if (Auth::user()->tipoUsuario == "TAC" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="tac")) {
      $vista = $request->get("vista");
      if($vista == "paciente"){
        $pacientes = SolicitudExamen::where('estado','<',2)->where('f_tac','!=',null)->distinct()->get(['f_paciente']);
        $solicitudes = SolicitudExamen::where('estado','<',2)->where('f_tac','!=',null)->orderBy('estado')->get();
      }else{
        $examenes = SolicitudExamen::where('estado','<',2)->where('f_tac','!=',null)->distinct()->get(['f_tac']);
        $solicitudes = SolicitudExamen::where('estado','<',2)->where('f_tac','!=',null)->orderBy('estado')->get();
      }
      return view('SolicitudTAC.index',compact('pacientes','solicitudes','examenes','vista'));
    }else if (Auth::user()->tipoUsuario == "Rayos X" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="rayosx")) {
      $vista = $request->get("vista");
      if($vista == "paciente"){
        $pacientes = SolicitudExamen::where('estado','<',2)->where('f_rayox','!=',null)->distinct()->get(['f_paciente']);
        $solicitudes = SolicitudExamen::where('estado','<',2)->where('f_rayox','!=',null)->orderBy('estado')->get();
      }else{
        $examenes = SolicitudExamen::where('estado','<',2)->where('f_rayox','!=',null)->distinct()->get(['f_rayox']);
        $solicitudes = SolicitudExamen::where('estado','<',2)->where('f_rayox','!=',null)->orderBy('estado')->get();
      }
      return view('SolicitudRayosx.index',compact('pacientes','solicitudes','examenes','vista'));
    }
    else if (Auth::user()->tipoUsuario == "Ultrasonografía" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="ultras")) {
      $vista = $request->get("vista");
      if($vista == "paciente"){
        $pacientes = SolicitudExamen::where('estado','<',2)->where('f_ultrasonografia','!=',null)->distinct()->get(['f_paciente']);
        $solicitudes = SolicitudExamen::where('estado','<',2)->where('f_ultrasonografia','!=',null)->orderBy('estado')->get();
      }else{
        $examenes = SolicitudExamen::where('estado','<',2)->where('f_ultrasonografia','!=',null)->distinct()->get(['f_ultrasonografia']);
        $solicitudes = SolicitudExamen::where('estado','<',2)->where('f_ultrasonografia','!=',null)->orderBy('estado')->get();
      }
      return view('SolicitudUltras.index',compact('pacientes','solicitudes','examenes','vista'));
    }else if(Auth::user()->tipoUsuario == "Laboaratorio" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="examenes")){
    $vista = $request->get("vista");
    if($vista == "paciente"){
      $pacientes = SolicitudExamen::where('estado','<',2)->where('f_examen','!=',null)->distinct()->get(['f_paciente']);
      $solicitudes = SolicitudExamen::where('estado','<',2)->where('f_examen','!=',null)->orderBy('estado')->orderBy('created_at','desc')->get();
    }else{
      $examenes = SolicitudExamen::where('estado','<',2)->where('f_examen','!=',null)->distinct()->get(['f_examen']);
      $solicitudes = SolicitudExamen::where('estado','<',2)->where('f_examen','!=',null)->orderBy('estado')->orderBy('created_at','desc')->get();
    }
    return view('SolicitudExamenes.index',compact('pacientes','solicitudes','examenes','vista'));
  }
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create(Request $request)
  {
    if (Auth::user()->tipoUsuario == "TAC" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="tac")) {
      $tacs = Tac::where('estado',true)->orderBy('nombre')->get();
      return view('SolicitudTAC.create',compact('tacs'));
    }else if (Auth::user()->tipoUsuario == "Rayos X" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="rayosx")) {
      $rayosx = Rayosx::where('estado',true)->orderBy('nombre')->get();
      return view('SolicitudRayosx.create',compact('rayosx'));
    }
    else if (Auth::user()->tipoUsuario == "Ultrasonografía" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="ultras")) {
      $ultras = ultrasonografia::where('estado',true)->orderBy('nombre')->get();
      return view('SolicitudUltras.create',compact('ultras'));
    } else if(Auth::user()->tipoUsuario == "Laboaratorio" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="examenes")){
			$categoria= CategoriaServicio::where('nombre','Laboratorio Clínico')->first();
			if($categoria == null){
				return view('errors.001');
			}
      $servicios=Servicio::where('f_categoria',$categoria->id)->get();
      $examenes = Examen::where('estado',true)->orderBy('area')->orderBy('nombreExamen')->get();
      return view('SolicitudExamenes.create',compact('examenes','servicios'));
    }
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    if (Auth::user()->tipoUsuario == "TAC"|| ((Auth::user()->tipoUsuario == "Recepción" || Auth::user()->tipoUsuario == "Médico" || Auth::user()->tipoUsuario == "Enfermería" ) && $request->tipo=="tac")) {
      DB::beginTransaction();
      try{
        $año = date('Y');
        if(isset($request->tac)){
          if($request->f_ingreso == null){
            $ultima_factura = Transacion::where('tipo',2)->latest()->first();

            if($ultima_factura == null){
              $factura = 1;
            }else{
              $factura = $ultima_factura->factura;
              $factura++;
            }

						// $transaccion = new Transacion;
						// $transaccion->fecha = Carbon::now();
						// $transaccion->f_cliente = $request->f_paciente;
						// $transaccion->f_ingreso = $request->f_ingreso;
						// $transaccion->tipo = 2;
						// $transaccion->factura = $factura;
						// $transaccion->f_usuario = Auth::user()->id;
						// $transaccion->localizacion = 1;
						// $transaccion->save();
						// $transaccion_id = $transaccion->id;
						$solicitud = new SolicitudExamen;
						$solicitud->f_paciente = $request->f_paciente;
						$solicitud->f_tac = $request->tac;
            $solicitud->estado = 1;
            $solicitud->cancelado=0;
						// $solicitud->f_transaccion = $transaccion_id;
						$solicitud->save();
          }else{
						$transaccion_id = $request->transaccion;
						$solicitud = new SolicitudExamen;
            $solicitud->f_paciente = $request->f_paciente;
            $solicitud->f_tac= $request->tac;
            $solicitud->estado = 1;
            $solicitud->f_transaccion = $transaccion_id;
            $solicitud->save();
          }
            // $solicitud = new SolicitudExamen;
            // $solicitud->f_paciente = $request->f_paciente;
            // $solicitud->f_tac= $request->tac;
            // $solicitud->estado = 1;
            // // $solicitud->f_transaccion = $transaccion_id;
            // $solicitud->save();

            //Detalle de transaccion
            if($request->f_ingreso != null){

            $detalle = new DetalleTransacion;
            $detalle->f_servicio = $solicitud->tac->servicio->id;
            $detalle->precio = $solicitud->tac->servicio->precio;
            $detalle->cantidad = 1;
            $detalle->f_transaccion = $transaccion_id;
            $detalle->f_usuario=Auth::user()->id;
            $detalle->save();
          }

            DB::commit();
            Bitacora::bitacora('store','solicitud_examens','solicitudex',$solicitud->id);
            if($request->f_ingreso != null){
            Bitacora::bitacora('store','transacions','transacciones',$transaccion_id);
            }

        }
      }catch(Exception $e){
        DB::rollback();
        return redirect('/solicitudex?tipo=tac')->with('mensaje','Algo salio mal');
      }
    }else if (Auth::user()->tipoUsuario == "Rayos X"|| ((Auth::user()->tipoUsuario == "Recepción" || Auth::user()->tipoUsuario == "Médico" || Auth::user()->tipoUsuario == "Enfermería" ) && $request->tipo=="rayosx")) {
      DB::beginTransaction();
      try{
        $año = date('Y');
        if(isset($request->rayox)){
          if($request->f_ingreso == null){
            $ultima_factura = Transacion::where('tipo',2)->latest()->first();

            if($ultima_factura == null){
              $factura = 1;
            }else{
              $factura = $ultima_factura->factura;
              $factura++;
            }

						// $transaccion = new Transacion;
						// $transaccion->fecha = Carbon::now();
						// $transaccion->f_cliente = $request->f_paciente;
						// $transaccion->f_ingreso = $request->f_ingreso;
						// $transaccion->tipo = 2;
						// $transaccion->factura = $factura;
						// $transaccion->f_usuario = Auth::user()->id;
						// $transaccion->localizacion = 1;
						// $transaccion->save();
						// $transaccion_id = $transaccion->id;
						$solicitud = new SolicitudExamen;
						$solicitud->f_paciente = $request->f_paciente;
						$solicitud->f_rayox = $request->rayox;
            $solicitud->estado = 1;
            $solicitud->cancelado=0;
						// $solicitud->f_transaccion = $transaccion_id;
						$solicitud->save();
          }else{
						$transaccion_id = $request->transaccion;
						$solicitud = new SolicitudExamen;
						$solicitud->f_paciente = $request->f_paciente;
						$solicitud->f_rayox = $request->rayox;
						$solicitud->estado = 1;
						$solicitud->f_transaccion = $transaccion_id;
						$solicitud->save();
          }
            

            //Detalle de transaccion
            if($request->f_ingreso != null){
            $detalle = new DetalleTransacion;
            $detalle->f_servicio = $solicitud->rayox->servicio->id;
            $detalle->precio = $solicitud->rayox->servicio->precio;
            $detalle->cantidad = 1;
            $detalle->f_transaccion = $transaccion_id;
            $detalle->f_usuario=Auth::user()->id;
            $detalle->save();
            }

            DB::commit();
            Bitacora::bitacora('store','solicitud_examens','solicitudex',$solicitud->id);
            if($request->f_ingreso != null){
            Bitacora::bitacora('store','transacions','transacciones',$transaccion_id);
            }

        }
      }catch(Exception $e){
        DB::rollback();
        return redirect('/solicitudex?tipo=rayosx')->with('mensaje','Algo salio mal');
      }
    }else if (Auth::user()->tipoUsuario == "Ultrasonografía"|| ((Auth::user()->tipoUsuario == "Recepción" || Auth::user()->tipoUsuario == "Médico" || Auth::user()->tipoUsuario == "Enfermería" ) && $request->tipo=="ultras")) {
      DB::beginTransaction();
      try{
        $año = date('Y');
        if(isset($request->ultrasonografia)){
          if($request->f_ingreso == null){
            $ultima_factura = Transacion::where('tipo',2)->latest()->first();

            if($ultima_factura == null){
              $factura = 1;
            }else{
              $factura = $ultima_factura->factura;
              $factura++;
            }

						// $transaccion = new Transacion;
						// $transaccion->fecha = Carbon::now();
						// $transaccion->f_cliente = $request->f_paciente;
						// $transaccion->f_ingreso = $request->f_ingreso;
						// $transaccion->tipo = 2;
						// $transaccion->factura = $factura;
						// $transaccion->f_usuario = Auth::user()->id;
						// $transaccion->localizacion = 1;
						// $transaccion->save();
						// $transaccion_id = $transaccion->id;
						$solicitud = new SolicitudExamen;
						$solicitud->f_paciente = $request->f_paciente;
						$solicitud->f_ultrasonografia = $request->ultrasonografia;
            $solicitud->estado = 1;
            $solicitud->cancelado=0;
						// $solicitud->f_transaccion = $transaccion_id;
						$solicitud->save();
          }else{
						$transaccion_id = $request->transaccion;
						$solicitud = new SolicitudExamen;
						$solicitud->f_paciente = $request->f_paciente;
						$solicitud->f_ultrasonografia = $request->ultrasonografia;
						$solicitud->estado = 1;
						$solicitud->f_transaccion = $transaccion_id;
						$solicitud->save();
          }

            //Detalle de transaccion
            if($request->f_ingreso != null){
            $detalle = new DetalleTransacion;
            $detalle->f_servicio = $solicitud->ultrasonografia->servicio->id;
            $detalle->precio = $solicitud->ultrasonografia->servicio->precio;
            $detalle->cantidad = 1;
            $detalle->f_transaccion = $transaccion_id;
            $detalle->f_usuario=Auth::user()->id;
            $detalle->save();
            }

            DB::commit();
            Bitacora::bitacora('store','solicitud_examens','ultrasonografias',$solicitud->id);
            if($request->f_ingreso != null){
            Bitacora::bitacora('store','transacions','transacciones',$transaccion_id);
            }

        }
      }catch(Exception $e){
        DB::rollback();
        return redirect('/solicitudex?tipo=ultras')->with('mensaje','Algo salio mal');
      }
    }else if(Auth::user()->tipoUsuario == "Laboaratorio" || ((Auth::user()->tipoUsuario == "Recepción" || Auth::user()->tipoUsuario == "Médico" || Auth::user()->tipoUsuario == "Enfermería" ) && $request->tipo=="examenes")){
    DB::beginTransaction();
    try{
      $año = date('Y');
      if(isset($request->examen)){
        if($request->f_ingreso == null){
          $ultima_factura = Transacion::where('tipo',2)->latest()->first();

          if($ultima_factura == null){
            $factura = 1;
          }else{
            $factura = $ultima_factura->factura;
            $factura++;
          }

          // $transaccion = new Transacion;
          // $transaccion->fecha = Carbon::now();
          // $transaccion->f_cliente = $request->f_paciente;
          // $transaccion->f_ingreso = $request->f_ingreso;
          // $transaccion->tipo = 2;
          // $transaccion->factura = $factura;
          // $transaccion->f_usuario = Auth::user()->id;
          // $transaccion->localizacion = 1;
          // $transaccion->save();
          // $transaccion_id = $transaccion->id;
        }else{
          $transaccion_id = $request->transaccion;
        }
        $banderaQS=false;
        foreach ($request->examen as $examen) {
          $area= Examen::find($examen);
          // Generar codigo de la muestra
          $hoy = Carbon::today()->startOfDay();
          $hoy2 = Carbon::today()->endOfDay();
          $cantidad_examenes = SolicitudExamen::where('created_at','>',$hoy)->where('created_at','<',$hoy2)->count();
          //$codigo_muestra = $examen.'-'.$cantidad_examenes.'-'.$año_corto;
          if($cantidad_examenes==0){
           $codigo_muestra=0; 
          }else{
            $ultimaSolicitudConMuestra = SolicitudExamen::where('created_at','>',$hoy)->where('created_at','<',$hoy2)->where('codigo_muestra','!=',null)->get();
            $muestraSeparada= explode(" ", $ultimaSolicitudConMuestra->last()->codigo_muestra." siQS");
            $codigo_muestra=(int) $muestraSeparada[0];
          }
          if($banderaQS==false){
            $codigo_muestra++;
            $muestraQuimicaSanguinea=$codigo_muestra;
            $banderaQS=true;
        }
          //Inicio
          $solicitud = new SolicitudExamen;
          $solicitud->f_paciente = $request->f_paciente;
          $solicitud->f_examen = $examen;
          if($request->f_ingreso == null){
            $solicitud->cancelado=0;
          }
          if($area->area=='QUIMICA SANGUINEA'){
            $solicitud->codigo_muestra = $muestraQuimicaSanguinea;  
          }else{
          $solicitud->codigo_muestra = $muestraQuimicaSanguinea." noQS";//LE PONGO LA MISMA DE QS
          }
					$solicitud->estado = 0;
					if($request->f_ingreso == null){
						// $solicitud->f_transaccion = $transaccion_id;
					}else{
						$solicitud->f_transaccion = $transaccion_id;
          }
          if($request->enviarClinica)
          {
            $solicitud->enviarClinica=1;
          }
          $solicitud->save();

          //Detalle de transaccion
          if($request->f_ingreso != null){
          $detalle = new DetalleTransacion;
          $detalle->f_servicio = $solicitud->examen->servicio->id;
          $detalle->precio = $solicitud->examen->servicio->precio;
          $detalle->cantidad = 1;
          $detalle->f_transaccion = $transaccion_id;
          $detalle->f_usuario=Auth::user()->id;
          $detalle->save();
          }

          DB::commit();
          Bitacora::bitacora('store','solicitud_examens','solicitudex',$solicitud->id);
          if($request->f_ingreso != null){
          Bitacora::bitacora('store','transacions','transacciones',$transaccion_id);
          }
        }
      }
    }catch(Exception $e){
      DB::rollback();
      return redirect('/solicitudex?tipo=examenes')->with('mensaje','Algo salio mal');
    }
    }
    if($request->f_ingreso == null){
      if(Auth::user()->tipoUsuario == "Laboaratorio" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="examenes")){
      return redirect('/solicitudex?tipo=examenes&vista=paciente')->with('mensaje', '¡Guardado!');
    }elseif (Auth::user()->tipoUsuario == "Rayos X" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="rayosx")) {
        return redirect('/solicitudex?tipo=rayosx')->with('mensaje', '¡Guardado!');
      } elseif (Auth::user()->tipoUsuario == "Ultrasonografía" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="ultras")) {
        return redirect('/solicitudex?tipo=ultras')->with('mensaje', '¡Guardado!');
      }elseif (Auth::user()->tipoUsuario == "TAC" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="tac")) {
        return redirect('/solicitudex?tipo=tac')->with('mensaje', '¡Guardado!');
      }
    }else{
      return "Guardado";
    }
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\SolicitudExamen  $solicitudExamen
  * @return \Illuminate\Http\Response
  */
  public function show(SolicitudExamen $solicitudExamen)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\SolicitudExamen  $solicitudExamen
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    if (Auth::user()->tipoUsuario == "TAC") {
      $solicitud = SolicitudExamen::find($id);
      $resultado = Resultado::where('f_solicitud','=',$id)->first();
      $detallesResultado = DetalleTac::where('f_resultado','=',$resultado->id)->first();
      return view('SolicitudTAC.edit',compact('solicitud','resultado','detallesResultado'));
    }else if (Auth::user()->tipoUsuario == "Rayos X") {
      $solicitud = SolicitudExamen::find($id);
      $resultado = Resultado::where('f_solicitud','=',$id)->first();
      $detallesResultado = DetalleRayox::where('f_resultado','=',$resultado->id)->first();
      return view('SolicitudRayosx.edit',compact('solicitud','resultado','detallesResultado'));
    }else{
    $solicitud = SolicitudExamen::find($id);
    $resultado = Resultado::where('f_solicitud','=',$id)->first();
    $detallesResultado = DetalleUltrasonografia::where('f_resultado','=',$resultado->id)->first();
    return view('SolicitudUltras.edit',compact('solicitud','resultado','detallesResultado'));
  }
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\SolicitudExamen  $solicitudExamen
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request,$id)
  {
    if (Auth::user()->tipoUsuario == "TAC") {
      $solicitudAnterior = SolicitudExamen::find($id);
      $resultadoAnterior = Resultado::where('f_solicitud','=',$id)->first();
      $detallesResultadoAnterior = DetalleTac::where('f_resultado','=',$resultadoAnterior->id)->first();
      $resultadoAnterior->observacion=$request->observacion;
      if($request->hasfile('tac')){
        $detallesResultadoAnterior->tac = $request->file('tac')->store('public/tac');
      }
      $resultadoAnterior->save();
      $detallesResultadoAnterior->save();
      Bitacora::bitacora('update','resultados','solicitudex',$resultadoAnterior->id);
      return redirect('/examenesEvaluados?vista=paciente')->with('mensaje', '¡Editado!');
    }else if (Auth::user()->tipoUsuario == "Rayos X") {
      $solicitudAnterior = SolicitudExamen::find($id);
      $resultadoAnterior = Resultado::where('f_solicitud','=',$id)->first();
      $detallesResultadoAnterior = DetalleRayox::where('f_resultado','=',$resultadoAnterior->id)->first();
      $resultadoAnterior->observacion=$request->observacion;
      if($request->hasfile('rayox')){
        $detallesResultadoAnterior->rayox = $request->file('rayox')->store('public/radiografia');
      }
      $resultadoAnterior->save();
      $detallesResultadoAnterior->save();
      Bitacora::bitacora('update','resultados','solicitudex',$resultadoAnterior->id);
      return redirect('/solicitudex')->with('mensaje', '¡Editado!');
    }else{
    $solicitudAnterior = SolicitudExamen::find($id);
    $resultadoAnterior = Resultado::where('f_solicitud','=',$id)->first();
    $detallesResultadoAnterior = DetalleUltrasonografia::where('f_resultado','=',$resultadoAnterior->id)->first();
    $resultadoAnterior->observacion=$request->observacion;
    if($request->hasfile('ultrasonografia')){
      $detallesResultadoAnterior->ultrasonografia = $request->file('ultrasonografia')->store('public/ultrasonografia');
    }
    $resultadoAnterior->save();
    $detallesResultadoAnterior->save();
    Bitacora::bitacora('update','resultados','solicitudex',$resultadoAnterior->id);
    return redirect('/solicitudex')->with('mensaje', '¡Editado!');
  }
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\SolicitudExamen  $solicitudExamen
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    if (Auth::user()->tipoUsuario == "TAC") {
      $solicitud = SolicitudExamen::findOrFail($id);
      $solicitud->delete();
      return redirect()->action('SolicitudExamenController@index');
  }else if (Auth::user()->tipoUsuario == "Rayos X") {
      $solicitud = SolicitudExamen::findOrFail($id);
      $solicitud->delete();
      return redirect()->action('SolicitudExamenController@index');
  }else if (Auth::user()->tipoUsuario == "Ultrasonografía") {
      $solicitud = SolicitudExamen::findOrFail($id);
      $solicitud->delete();
      return redirect()->action('SolicitudExamenController@index');
  }else{
    $solicitud = SolicitudExamen::findOrFail($id);
    $paciente = $solicitud->f_paciente;
    $solicitud->delete();
    $examenes = SolicitudExamen::where('f_paciente',$paciente)->where('estado','<',3)->count();
    return $examenes;
  }
  }

  public function aceptar($id){
    $solicitud = SolicitudExamen::find($id);
    $solicitud->estado = 1;
    $solicitud->save();
    return 1;
  }

  public function evaluarExamen($id,$idExamen){
    if (Auth::user()->tipoUsuario == "TAC") {
      $solicitud=SolicitudExamen::where('id','=',$id)->where('estado','=',1)->where('f_tac','=',$idExamen)->first();
      return view('SolicitudTAC.evaluarTAC',compact('solicitud'));
    }else if (Auth::user()->tipoUsuario == "Rayos X") {
      $solicitud=SolicitudExamen::where('id','=',$id)->where('estado','=',1)->where('f_rayox','=',$idExamen)->first();
      return view('SolicitudRayosx.evaluarRadiografia',compact('solicitud'));
    }else
    if (Auth::user()->tipoUsuario == "Ultrasonografía") {
      $solicitud=SolicitudExamen::where('id','=',$id)->where('estado','=',1)->where('f_ultrasonografia','=',$idExamen)->first();
      return view('SolicitudUltras.evaluarUltrasonografia',compact('solicitud'));
    }
    else {
      $solicitud=SolicitudExamen::where('id','=',$id)->where('estado','=',1)->where('f_examen','=',$idExamen)->first();
      $areaExamen=Examen::find($idExamen);
      if($areaExamen->area=='QUIMICA SANGUINEA'){
          $hoy = $solicitud->created_at->startOfDay();
          $hoy2 = $solicitud->created_at->endOfDay();
          $solicitud=SolicitudExamen::where('id','=',$id)->where('estado','=',1)->where('f_examen','=',$idExamen)->first();
          $solicitudes=SolicitudExamen::where('estado','=',1)->where('codigo_muestra','=',$solicitud->codigo_muestra)->where('created_at','>',$hoy)->where('created_at','<',$hoy2)->get();
          foreach ($solicitudes as $i => $soli) {
            $todasEspr=ExamenSeccionParametro::where('f_examen','=',$soli->f_examen)->where('estado','=',true)->get();
            foreach($todasEspr as $espr){
            $esprQuimicaSanguinea[]=$espr;
            }
          }
          return view('SolicitudExamenes.evaluarExamenQuimicaSanguinea',compact('solicitud','solicitudes','esprQuimicaSanguinea'));
      }
    $secciones=ExamenSeccionParametro::where('f_examen','=',$idExamen)->where('estado','=',true)->distinct()->get(['f_seccion']);;
    $espr=ExamenSeccionParametro::where('f_examen','=',$idExamen)->where('estado','=',true)->get();
    $contador=0;
    $contadorSecciones=0;
    $banderaValores=0;
    $banderaUnidad=0;
    if($espr!=null){
      foreach ($espr as $esp) {
        $para=Parametro::find($esp->f_parametro);
        if($para->valorMinimo!=null || $para->valorMaximo!=null || $para->valorMinimoFemenino!=null || $para->valorMaximoFemenino!=null){
          $banderaValores=1;
        }
        if(strlen($para->unidad)>0){
          $banderaUnidad=1;
        }
        if($contador==0){
          $secciones[$contadorSecciones]=$esp->f_seccion;
        }else{
          if($secciones[$contadorSecciones]==$esp->f_seccion)
          {
          }else {
            $contadorSecciones++;
            $secciones[$contadorSecciones]=$esp->f_seccion;
          }
        }
        $contador++;
      }
    }
    return view('SolicitudExamenes.evaluarExamen',compact('solicitud','espr','secciones','contadorSecciones','banderaValores','banderaUnidad'));
  }
}
  public function guardarResultadosExamen(Request $request)
  {
    if (Auth::user()->tipoUsuario == "TAC") {
      $idSolicitud=$request->solicitud;
      $observacion=$request->observacion;
      DB::beginTransaction();
      try{
        $resultado= new Resultado();
        $resultado->f_solicitud=$idSolicitud;
        $resultado->observacion=$observacion;
        $resultado->f_laboratorista=Auth::user()->id;
        $resultado->save();
        $resultados=Resultado::all();
        $idResultado=$resultados->last()->id;
        $detalleTac= new DetalleTac;
        $detalleTac->f_resultado=$idResultado;
        if($request->hasfile('tac')){
          $detalleTac->tac = $request->file('tac')->store('public/tac');
        }
        $detalleTac->save();
        $cambioEstadoSolicitud=SolicitudExamen::find($idSolicitud);
        $cambioEstadoSolicitud->estado=2;
        $cambioEstadoSolicitud->save();
      }catch(Exception $e){
        DB::rollback();
        return redirect('/solicitudex')->with('mensaje','Algo salio mal');
      }
      DB::commit();
      Bitacora::bitacora('store','resultados','solicitudex',$idResultado);
      return redirect('/solicitudex')->with('mensaje', '¡Guardado!');
    }else if (Auth::user()->tipoUsuario == "Rayos X") {
      $idSolicitud=$request->solicitud;
      $observacion=$request->observacion;
      DB::beginTransaction();
      try{
        $resultado= new Resultado();
        $resultado->f_solicitud=$idSolicitud;
        $resultado->observacion=$observacion;
        $resultado->f_laboratorista=Auth::user()->id;
        $resultado->save();
        $resultados=Resultado::all();
        $idResultado=$resultados->last()->id;
        $detalleRadiografia= new DetalleRayox;
        $detalleRadiografia->f_resultado=$idResultado;
        if($request->hasfile('rayox')){
          $detalleRadiografia->rayox = $request->file('rayox')->store('public/radiografia');
        }
        $detalleRadiografia->save();
        $cambioEstadoSolicitud=SolicitudExamen::find($idSolicitud);
        $cambioEstadoSolicitud->estado=2;
        $cambioEstadoSolicitud->save();
      }catch(Exception $e){
        DB::rollback();
        return redirect('/solicitudex')->with('mensaje','Algo salio mal');
      }
      DB::commit();
      Bitacora::bitacora('store','resultados','solicitudex',$idResultado);
      return redirect('/solicitudex')->with('mensaje', '¡Guardado!');
    }
    else if (Auth::user()->tipoUsuario == "Ultrasonografía") {
      $idSolicitud=$request->solicitud;
      $observacion=$request->observacion;
      DB::beginTransaction();
      try{
        $resultado= new Resultado();
        $resultado->f_solicitud=$idSolicitud;
        $resultado->observacion=$observacion;
        $resultado->f_laboratorista=Auth::user()->id;
        $resultado->save();
        $resultados=Resultado::all();
        $idResultado=$resultados->last()->id;
        $detalleUltrasonografia= new DetalleUltrasonografia;
        $detalleUltrasonografia->f_resultado=$idResultado;
        if($request->hasfile('ultrasonografia')){
          $detalleUltrasonografia->ultrasonografia = $request->file('ultrasonografia')->store('public/ultrasonografia');
        }
        $detalleUltrasonografia->save();
        $cambioEstadoSolicitud=SolicitudExamen::find($idSolicitud);
        $cambioEstadoSolicitud->estado=2;
        $cambioEstadoSolicitud->save();
      }catch(Exception $e){
        DB::rollback();
        return redirect('/solicitudex')->with('mensaje','Algo salio mal');
      }
      DB::commit();
      Bitacora::bitacora('store','resultados','solicitudex',$idResultado);
      return redirect('/solicitudex')->with('mensaje', '¡Guardado!');
    }
    else {
    if($request->evaluar){
      $resultadosGuardar=$request->resultados;
      $datosControlados=$request->datoControlado;
      if($datosControlados){
      $totalControlados= count($datosControlados);
    }
      $observacion=$request->observacion;
      if($request->quimica){//INICIO GUARDAR RESULTADOS DE QUIMICA SANGUINEA
            $idsSolicitudes=$request->solicitud;
            $contadorControlados=0;
            foreach ($idsSolicitudes as $key => $idSolicitud) {
          DB::beginTransaction();
          try{
            $resultado= new Resultado();
            $resultado->f_solicitud=$idSolicitud;
            $resultado->observacion=$observacion;
            $resultado->f_laboratorista=Auth::user()->id;
            if($request->hasfile('imagenExamen')){
            $resultado->imagen = $request->file('imagenExamen')->store('public/examenes');
            }
            $resultado->save();
            $resultados=Resultado::all();
            $idResultado=$resultados->last()->id;
            if($request->espr){
              foreach ($request->espr as $key =>$valor) {
              $detallesResultado= new DetalleResultado();
              $detallesResultado->f_resultado=$idResultado;
              $detallesResultado->f_espr=$request->espr[$key];
              $detallesResultado->resultado=$resultadosGuardar[$key];
              $espr_evaluar_controlado=ExamenSeccionParametro::find($valor);
              if($espr_evaluar_controlado->f_reactivo){
                if($datosControlados[$contadorControlados]!="noReactivo"){
                $detallesResultado->dato_controlado=$datosControlados[$contadorControlados];
                $reactivoUtilizado=Reactivo::where('id','=',$espr_evaluar_controlado->f_reactivo)->first();
                $cantidadReactivoRestante=$reactivoUtilizado->contenidoPorEnvase-($datosControlados[$contadorControlados]+1);
                if($contadorControlados<$totalControlados-1){
                $contadorControlados++;
                }
                $finalReactivo=Reactivo::find($reactivoUtilizado->id);
                $finalReactivo->contenidoPorEnvase=$cantidadReactivoRestante;
                $finalReactivo->save();
                }
              }
              $detallesResultado->save();
            }
          }
            $cambioEstadoSolicitud=SolicitudExamen::find($idSolicitud);
            $cambioEstadoSolicitud->estado=2;
            $cambioEstadoSolicitud->save();
            DB::commit();
          }catch(Exception $e){
            DB::rollback();
            return redirect('/solicitudex?tipo=examenes&vista=examenes')->with('mensaje','Algo salio mal');
          }
        }
      }else{//FIN GUARDAR RESULTADOS DE QUIMICA SANGUINEA
      $idSolicitud=$request->solicitud;
      DB::beginTransaction();
      try{
        $resultado= new Resultado();
        $resultado->f_solicitud=$idSolicitud;
        $resultado->observacion=$observacion;
        $resultado->f_laboratorista=Auth::user()->id;
        if($request->hasfile('imagenExamen')){
        $resultado->imagen = $request->file('imagenExamen')->store('public/examenes');
        }
        $resultado->save();
        $resultados=Resultado::all();
        $idResultado=$resultados->last()->id;
        $contadorControlados=0;
        if($request->espr){
        foreach ($request->espr as $key =>$valor) {
          $detallesResultado= new DetalleResultado();
          $detallesResultado->f_resultado=$idResultado;
          $detallesResultado->f_espr=$valor;
          $detallesResultado->resultado=$resultadosGuardar[$key];
          $espr_evaluar_controlado=ExamenSeccionParametro::find($valor);
          if($espr_evaluar_controlado->f_reactivo){
            $detallesResultado->dato_controlado=$datosControlados[$contadorControlados];
            $reactivoUtilizado=Reactivo::where('id','=',$espr_evaluar_controlado->f_reactivo)->first();
            $cantidadReactivoRestante=$reactivoUtilizado->contenidoPorEnvase-($datosControlados[$contadorControlados]+1);
            $contadorControlados++;
            $finalReactivo=Reactivo::find($reactivoUtilizado->id);
            $finalReactivo->contenidoPorEnvase=$cantidadReactivoRestante;
            $finalReactivo->save();
          }
          $detallesResultado->save();
        }
      }
        $cambioEstadoSolicitud=SolicitudExamen::find($idSolicitud);
        if($request->estaIncompleto==1){
        $cambioEstadoSolicitud->completo=false;
        }
        $cambioEstadoSolicitud->estado=2;
        $cambioEstadoSolicitud->save();
        DB::commit();
      }catch(Exception $e){
        DB::rollback();
        return redirect('/solicitudex')->with('mensaje','Algo salio mal');
      }
    }
      Bitacora::bitacora('store','resultados','solicitudex',$idResultado);
      return redirect('/solicitudex?tipo=examenes&vista=examenes')->with('mensaje', '¡Guardado!');
    }else {///EDICION DE RESULTADOS DE EXAMENES
      $idSolicitud=$request->solicitud;
      $resultadosGuardar=$request->resultados;
      $datosControlados=$request->datoControlado;
      $observacion=$request->observacion;
      DB::beginTransaction();
      try{
        $resultado=Resultado::where('f_solicitud','=',$idSolicitud)->first();
        $resultado->observacion=$observacion;
        $resultado->f_laboratorista=Auth::user()->id;
        if($request->hasfile('imagenExamen')){
        $resultado->imagen = $request->file('imagenExamen')->store('public/examenes');
        }
        $resultado->save();
        $idResultado=$resultado->id;
        $contadorControlados=0;
        $detallesResultado=DetalleResultado::where('f_resultado','=',$idResultado)->get();
        if($request->espr){
        foreach ($request->espr as $key =>$valor) {
          $detallesResultado[$key]->resultado=$resultadosGuardar[$key];
          $espr_evaluar_controlado=ExamenSeccionParametro::find($valor);
          if($espr_evaluar_controlado->f_reactivo){
            $reactivoUtilizado=Reactivo::where('id','=',$espr_evaluar_controlado->f_reactivo)->first();
            $finalReactivo=Reactivo::find($reactivoUtilizado->id);
            if($detallesResultado[$key]->dato_controlado<$datosControlados[$contadorControlados]){
              $diferencia=$datosControlados[$contadorControlados]-$detallesResultado[$key]->dato_controlado;
              $cantidadReactivoRestante=$reactivoUtilizado->contenidoPorEnvase-$diferencia;
              $finalReactivo->contenidoPorEnvase=$cantidadReactivoRestante;
            }elseif($detallesResultado[$key]->dato_controlado>$datosControlados[$contadorControlados]){
              $diferencia=$detallesResultado[$key]->dato_controlado-$datosControlados[$contadorControlados];
              $cantidadReactivoRestante=$reactivoUtilizado->contenidoPorEnvase+$diferencia;
              $finalReactivo->contenidoPorEnvase=$cantidadReactivoRestante;
            }
            $finalReactivo->save();
            $detallesResultado[$key]->dato_controlado=$datosControlados[$contadorControlados];
            $contadorControlados++;
          }
          $detallesResultado[$key]->save();
        }
      }
      $cambioCompletoSolicitud=SolicitudExamen::find($idSolicitud);
          if($request->estaIncompleto==1){
            $cambioCompletoSolicitud->completo=false;
          }else{
            $cambioCompletoSolicitud->completo=true;
          }
        $cambioCompletoSolicitud->save();
      }catch(Exception $e){
        DB::rollback();
        return redirect('/examenesEvaluados?tipo=examenes&vista=paciente')->with('mensaje','Algo salio mal');
      }
      DB::commit();
      Bitacora::bitacora('update','resultados','solicitudex',$idResultado);
      return redirect('/examenesEvaluados?tipo=examenes&vista=examenes')->with('mensaje', '¡Editado!');
    }
  }
  }
  public function entregarExamen($id,$idExamen,$tipo)
  {
    if (Auth::user()->tipoUsuario == "TAC" || (Auth::user()->tipoUsuario == "Recepción" && $tipo=="tac")) {
      $resultado=Resultado::where('f_solicitud','=',$id)->first();
      $detallesResultado=DetalleResultado::where('f_resultado','=', $resultado->id)->get();
      $solicitud=SolicitudExamen::where('id','=',$id)->where('f_tac','=',$idExamen)->first();
      $cambioEstadoSolicitud=SolicitudExamen::find($id);
      $cambioEstadoSolicitud->estado=3;
      $cambioEstadoSolicitud->save();
      $header = view('PDF.header.unidadImagenes');
      $footer = view('PDF.footer.numero_pagina');
      $main = view('SolicitudTAC.entregaExamen',compact('solicitud','resultado','detallesResultado'));
      $pdf = \PDF::loadHtml($main)->setOption('footer-html',$footer)->setOption('header-html',$header);
      return $pdf->stream('TAC_con_solicitud_'.$solicitud->id.'.pdf');
    }else if (Auth::user()->tipoUsuario == "Rayos X" || (Auth::user()->tipoUsuario == "Recepción" && $tipo=="rayosx")) {
      $resultado=Resultado::where('f_solicitud','=',$id)->first();
      $detallesResultado=DetalleResultado::where('f_resultado','=', $resultado->id)->get();
      $solicitud=SolicitudExamen::where('id','=',$id)->where('f_rayox','=',$idExamen)->first();
      $cambioEstadoSolicitud=SolicitudExamen::find($id);
      $cambioEstadoSolicitud->estado=3;
      $cambioEstadoSolicitud->save();
      $header = view('PDF.header.unidadImagenes');
      $footer = view('PDF.footer.numero_pagina');
      $main = view('SolicitudRayosx.entregaExamen',compact('solicitud','resultado','detallesResultado'));
      $pdf = \PDF::loadHtml($main)->setOption('footer-html',$footer)->setOption('header-html',$header);
      return $pdf->stream('Radiografia_con_solicitud_'.$solicitud->id.'.pdf');
    }elseif (Auth::user()->tipoUsuario == "Ultrasonografía" || (Auth::user()->tipoUsuario == "Recepción" && $tipo=="ultras")) {
      $resultado=Resultado::where('f_solicitud','=',$id)->first();
      $detallesResultado=DetalleResultado::where('f_resultado','=', $resultado->id)->get();
      $solicitud=SolicitudExamen::where('id','=',$id)->where('f_ultrasonografia','=',$idExamen)->first();
      $cambioEstadoSolicitud=SolicitudExamen::find($id);
      $cambioEstadoSolicitud->estado=3;
      $cambioEstadoSolicitud->save();
      $header = view('PDF.header.unidadImagenes');
      $footer = view('PDF.footer.numero_pagina');
      $main = view('SolicitudUltras.entregaExamen',compact('solicitud','resultado','detallesResultado'));
      $pdf = \PDF::loadHtml($main)->setOption('footer-html',$footer)->setOption('header-html',$header);
      return $pdf->stream('Ultrasonografia_con_solicitud_'.$solicitud->id.'.pdf');
    }
      elseif(Auth::user()->tipoUsuario == "Laboaratorio" || (Auth::user()->tipoUsuario == "Recepción" && $tipo=="examenes")){
        $solicitud=SolicitudExamen::where('id','=',$id)->where('f_examen','=',$idExamen)->first();
        $areaExamen=Examen::find($idExamen);        
        if($areaExamen->area=='QUIMICA SANGUINEA'){//INICIO ENTREGA Q.S.
          $hoy = $solicitud->created_at->startOfDay();
          $hoy2 = $solicitud->created_at->endOfDay();
          $solicitud=SolicitudExamen::where('id','=',$id)->where('f_examen','=',$idExamen)->first();
          $solicitudes=SolicitudExamen::where('codigo_muestra','=',$solicitud->codigo_muestra)->where('created_at','>',$hoy)->where('created_at','<',$hoy2)->get();
          foreach ($solicitudes as $i => $soli) {
            $todasEspr=ExamenSeccionParametro::where('f_examen','=',$soli->f_examen)->where('estado','=',true)->get();
            foreach ($todasEspr as $espr){
              $esprQuimicaSanguinea[]=$espr;
            }
            $todosResultado=Resultado::where('f_solicitud','=',$soli->id)->get();
            foreach ($todosResultado as $resultado){
            $resultadosQuimicaSanguinea[]=$resultado;
            }
            $todosDetallesResultado=DetalleResultado::where('f_resultado','=', $resultado->id)->get();
            foreach ($todosDetallesResultado as $detallesResultado){
              $detallesResultadosQuimicaSanguinea[]=$detallesResultado;
              if($detallesResultado->dato_controlado!=null){
                $tieneDatoControlado[]=1;
              }else{
                $tieneDatoControlado[]=0;
              }
            }
          $cambioEstadoSolicitud=SolicitudExamen::find($soli->id);
          $cambioEstadoSolicitud->estado=3;
          $cambioEstadoSolicitud->save();
        }
        //dd($detallesResultadosQuimicaSanguinea);
        $header = view('PDF.header.laboratorio');
        $footer = view('PDF.footer.numero_pagina');
        $main = view('SolicitudExamenes.entregaExamenQuimicaSanguinea',compact('solicitud','solicitudes','esprQuimicaSanguinea','resultadosQuimicaSanguinea','detallesResultadosQuimicaSanguinea','tieneDatoControlado'));
        $pdf = \PDF::loadHtml($main)->setOption('footer-html',$footer)->setOption('header-html',$header);
        return $pdf->stream('ExamenQuimicaSanguinea_'.$solicitud->id.'.pdf');
      }//FIN ENTREGA Q.S.
    $resultado=Resultado::where('f_solicitud','=',$id)->first();
    $detallesResultado=DetalleResultado::where('f_resultado','=', $resultado->id)->get();
    $solicitud=SolicitudExamen::where('id','=',$id)->where('f_examen','=',$idExamen)->first();
    $secciones=ExamenSeccionParametro::where('f_examen','=',$idExamen)->where('estado','=',1)->distinct()->get(['f_seccion']);;
    $espr=ExamenSeccionParametro::where('f_examen','=',$idExamen)->where('estado','=',1)->get();
    $contador=0;
    $contadorSecciones=0;
    $banderaValores=0;
    $banderaUnidad=0;
    if($espr!=null){
      foreach ($espr as $esp) {
        $para=Parametro::find($esp->f_parametro);
        if($para->valorMinimo!=null ||$para->valorMaximo!=null){
          $banderaValores=1;
        }
        if($para->unidad!=null){
          $banderaUnidad=1;
        }
        if($contador==0){
          $secciones[$contadorSecciones]=$esp->f_seccion;
        }else{
          if($secciones[$contadorSecciones]==$esp->f_seccion)
          {
          }else {
            $contadorSecciones++;
            $secciones[$contadorSecciones]=$esp->f_seccion;
          }
        }
        $contador++;
      }
    }
    $tieneDatoControlado=0;
    foreach ($detallesResultado as $det) {
      if($det->dato_controlado!=null){
        $tieneDatoControlado=1;
      }
    }
    $cambioEstadoSolicitud=SolicitudExamen::find($id);
    $cambioEstadoSolicitud->estado=3;
    $cambioEstadoSolicitud->save();
    $header = view('PDF.header.laboratorio');
    $footer = view('PDF.footer.numero_pagina');
		$main = view('SolicitudExamenes.entregaExamen',compact('solicitud','espr','secciones','contadorSecciones','resultado','detallesResultado','tieneDatoControlado','banderaValores','banderaUnidad'));
    //set_time_limit(300); // Extends to 5 minutes.
    //$pdf = \PDF::loadView('SolicitudExamenes.entregaExamen',compact('solicitud','espr','secciones','contadorSecciones','resultado','detallesResultado','tieneDatoControlado'));
    $pdf = \PDF::loadHtml($main)->setOption('footer-html',$footer)->setOption('header-html',$header);
    return $pdf->stream('Examen_con_solicitud_'.$solicitud->id.'.pdf');
  }
  }
  public function editarResultadosExamen($id,$idExamen)
  {
    $resultado=Resultado::where('f_solicitud','=',$id)->first();
    $detallesResultado=DetalleResultado::where('f_resultado','=', $resultado->id)->get();
    $solicitud=SolicitudExamen::where('id','=',$id)->first();
    $secciones=ExamenSeccionParametro::where('f_examen','=',$idExamen)->where('estado','=',1)->distinct()->get(['f_seccion']);;
    $espr=ExamenSeccionParametro::where('f_examen','=',$idExamen)->where('estado','=',1)->get();
    $contador=0;
    $contadorSecciones=0;
    if($espr!=null){
      foreach ($espr as $esp) {
        if($contador==0){
          $secciones[$contadorSecciones]=$esp->f_seccion;
        }else{
          if($secciones[$contadorSecciones]==$esp->f_seccion)
          {
          }else {
            $contadorSecciones++;
            $secciones[$contadorSecciones]=$esp->f_seccion;
          }
        }
        $contador++;
      }
    }
    return view('SolicitudExamenes.editarResultadosExamen',compact('solicitud','espr','secciones','contadorSecciones','resultado','detallesResultado'));
  }
  public function examenesEvaluados(Request $request)
  {
		$pacientes = null;
		$examenes = null;
    $vista = $request->get("vista");
    if (Auth::user()->tipoUsuario == "TAC" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="tac")) {
      if($vista == "paciente"){
        $pacientes = SolicitudExamen::where('estado','=',2)->where('f_tac','!=',null)->distinct()->get(['f_paciente']);
        $solicitudes = SolicitudExamen::where('estado','=',2)->where('f_tac','!=',null)->orderBy('estado')->get();
      }else{
        $examenes = SolicitudExamen::where('estado','=',2)->where('f_tac','!=',null)->distinct()->get(['f_tac']);
        $solicitudes = SolicitudExamen::where('estado','=',2)->where('f_tac','!=',null)->orderBy('estado')->get();
      }
      return view('SolicitudTAC.examenesEvaluados',compact('pacientes','solicitudes','examenes','vista'));
    }else if (Auth::user()->tipoUsuario == "Rayos X" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="rayosx")) {
      if($vista == "paciente"){
        $pacientes = SolicitudExamen::where('estado','=',2)->where('f_rayox','!=',null)->distinct()->get(['f_paciente']);
        $solicitudes = SolicitudExamen::where('estado','=',2)->where('f_rayox','!=',null)->orderBy('estado')->get();
      }else{
        $examenes = SolicitudExamen::where('estado','=',2)->where('f_rayox','!=',null)->distinct()->get(['f_rayox']);
        $solicitudes = SolicitudExamen::where('estado','=',2)->where('f_rayox','!=',null)->orderBy('estado')->get();
      }
      return view('SolicitudRayosx.examenesEvaluados',compact('pacientes','solicitudes','examenes','vista'));
    }
    elseif (Auth::user()->tipoUsuario == "Ultrasonografía" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="ultras")) {
      if($vista == "paciente"){
        $pacientes = SolicitudExamen::where('estado','=',2)->where('f_ultrasonografia','!=',null)->distinct()->get(['f_paciente']);
        $solicitudes = SolicitudExamen::where('estado','=',2)->where('f_ultrasonografia','!=',null)->orderBy('estado')->get();
      }else{
        $examenes = SolicitudExamen::where('estado','=',2)->where('f_ultrasonografia','!=',null)->distinct()->get(['f_ultrasonografia']);
        $solicitudes = SolicitudExamen::where('estado','=',2)->where('f_ultrasonografia','!=',null)->orderBy('estado')->get();
      }
      return view('SolicitudUltras.examenesEvaluados',compact('pacientes','solicitudes','examenes','vista'));
    }elseif (Auth::user()->tipoUsuario == "Laboaratorio" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="examenes")){
    if($vista == "paciente"){
      $pacientes = SolicitudExamen::where('estado','=',2)->where('f_examen','!=',null)->distinct()->get(['f_paciente']);
      $solicitudes = SolicitudExamen::where('estado','=',2)->where('f_examen','!=',null)->orderBy('estado')->get();
    }else{
      $examenes = SolicitudExamen::where('estado','=',2)->where('f_examen','!=',null)->distinct()->get(['f_examen']);
      $solicitudes = SolicitudExamen::where('estado','=',2)->where('f_examen','!=',null)->orderBy('estado')->get();
    }
    return view('SolicitudExamenes.examenesEvaluados',compact('pacientes','solicitudes','examenes','vista'));
  }
  }

  public function impresionExamenesPorPaciente($paciente,$bandera)
  {

    if($bandera==0){//EXAMENES ENTREGADOS
        $solicitudes = SolicitudExamen::where('estado','=',3)->where('f_paciente','=',$paciente)->where('codigo_muestra','!=',null)->orderBy('estado')->get();
    }else{
    $solicitudes = SolicitudExamen::where('estado','=',2)->where('f_paciente','=',$paciente)->where('codigo_muestra','!=',null)->orderBy('estado')->get();
  }
    if($bandera){
        foreach ($solicitudes as $solicitud) {
        $cambioEstadoSolicitud=SolicitudExamen::find($solicitud->id);
        $cambioEstadoSolicitud->estado=3;
        $cambioEstadoSolicitud->save();
      }
    }
    echo "Total solicitudes: ".count($solicitudes)."<br>";
    foreach ($solicitudes as $key => $solicitud) {

      $resultados[$key]=Resultado::where('f_solicitud','=',$solicitud->id)->first();
      $detallesResultado[$key]=DetalleResultado::where('f_resultado','=', $resultados[$key]->id)->get();
      $espr[$key]=ExamenSeccionParametro::where('f_examen','=',$solicitud->f_examen)->where('estado','=',1)->get();
      echo "Total de espr:".count($espr[$key])." # de solicitud".$key."<br>";
      $contador=0;
      $contadorSecciones=0;
      if($espr[$key]!=null){
        foreach ($espr[$key] as $esp) {
          if($contador==0){
            $secciones[$key][$contadorSecciones]=$esp->f_seccion;
          }else{
            if($secciones[$key][$contadorSecciones]==$esp->f_seccion)
            {
            }else {
              $contadorSecciones++;
              $secciones[$key][$contadorSecciones]=$esp->f_seccion;
            }
          }
          $contador++;
        }
      }
    }
    $header = view('PDF.header.laboratorio');
    $footer = view('PDF.footer.numero_pagina');
    $main = view('SolicitudExamenes.entregaTodosExamenes',compact('solicitudes','espr','secciones','contadorSecciones','resultados','detallesResultado'));
    $pdf = \PDF::loadHtml($main)->setOption('footer-html',$footer)->setOption('header-html',$header);
    return $pdf->stream('Examen.pdf');
  }
  public function verExamen($id,$idExamen)
  {
    $resultado=Resultado::where('f_solicitud','=',$id)->first();
    $detallesResultado=DetalleResultado::where('f_resultado','=', $resultado->id)->get();
    $solicitud=SolicitudExamen::where('id','=',$id)->where('f_examen','=',$idExamen)->first();
    $secciones=ExamenSeccionParametro::where('f_examen','=',$idExamen)->where('estado','=',1)->distinct()->get(['f_seccion']);;
    $espr=ExamenSeccionParametro::where('f_examen','=',$idExamen)->where('estado','=',1)->get();
    $contador=0;
    $contadorSecciones=0;
    if($espr!=null){
      foreach ($espr as $esp) {
        if($contador==0){
          $secciones[$contadorSecciones]=$esp->f_seccion;
        }else{
          if($secciones[$contadorSecciones]==$esp->f_seccion)
          {
          }else {
            $contadorSecciones++;
            $secciones[$contadorSecciones]=$esp->f_seccion;
          }
        }
        $contador++;
      }
    }
    return view('SolicitudExamenes.verExamen',compact(
      'solicitud',
      'espr',
      'secciones',
      'contadorSecciones',
      'resultado',
      'detallesResultado'
    ));
    /* return $request->tipo;
    if (Auth::user()->tipoUsuario == "Rayos X" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo="rayosx")) {
    $solicitud=SolicitudExamen::where('id',$id)->first();
    $resultado=Resultado::where('f_solicitud',$id)->first();
    $detalleResultadoRayox=DetalleRayox::where('f_resultado','=',$resultado->id)->first();
    return view('SolicitudRayosx.show',compact('solicitud','resultado','detalleResultadoRayox'));
  }if (Auth::user()->tipoUsuario == "Ultrasonografía") {
    $solicitud=SolicitudExamen::where('id',$id)->first();
    $resultado=Resultado::where('f_solicitud',$id)->first();
    $detalleResultadoUltrasonografia=DetalleUltrasonografia::where('f_resultado','=',$resultado->id)->first();
    return view('SolicitudUltras.show',compact('solicitud','resultado','detalleResultadoUltrasonografia'));
  }*/
  }
  public function examenesEntregados(Request $request){
		$examenes = null;
		$pacientes = null;
    $vista = $request->get("vista");
    if (Auth::user()->tipoUsuario == "TAC" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="tac")) {
      if($vista == "paciente"){
        $pacientes = SolicitudExamen::where('estado','=',3)->where('f_tac','!=',null)->distinct()->get(['f_paciente']);
        $solicitudes = SolicitudExamen::where('estado','=',3)->where('f_tac','!=',null)->orderBy('estado')->get();
      }else{
        $examenes = SolicitudExamen::where('estado','=',3)->where('f_tac','!=',null)->distinct()->get(['f_tac']);
        $solicitudes = SolicitudExamen::where('estado','=',3)->where('f_tac','!=',null)->orderBy('estado')->get();
      }
      return view('SolicitudTAC.examenesEntregados',compact('pacientes','solicitudes','examenes','vista'));
    }else if (Auth::user()->tipoUsuario == "Rayos X" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="rayosx")) {
      if($vista == "paciente"){
        $pacientes = SolicitudExamen::where('estado','=',3)->where('f_rayox','!=',null)->distinct()->get(['f_paciente']);
        $solicitudes = SolicitudExamen::where('estado','=',3)->where('f_rayox','!=',null)->orderBy('estado')->get();
      }else{
        $examenes = SolicitudExamen::where('estado','=',3)->where('f_rayox','!=',null)->distinct()->get(['f_rayox']);
        $solicitudes = SolicitudExamen::where('estado','=',3)->where('f_rayox','!=',null)->orderBy('estado')->get();
      }
      return view('SolicitudRayosx.examenesEntregados',compact('pacientes','solicitudes','examenes','vista'));
    }elseif (Auth::user()->tipoUsuario == "Ultrasonografía" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="ultras")) {
      if($vista == "paciente"){
        $pacientes = SolicitudExamen::where('estado','=',3)->where('f_ultrasonografia','!=',null)->distinct()->get(['f_paciente']);
        $solicitudes = SolicitudExamen::where('estado','=',3)->where('f_ultrasonografia','!=',null)->orderBy('estado')->get();
      }else{
        $examenes = SolicitudExamen::where('estado','=',3)->where('f_ultrasonografia','!=',null)->distinct()->get(['f_ultrasonografia']);
        $solicitudes = SolicitudExamen::where('estado','=',3)->where('f_ultrasonografia','!=',null)->orderBy('estado')->get();
      }
      return view('SolicitudUltras.examenesEntregados',compact('pacientes','solicitudes','examenes','vista'));
    }elseif (Auth::user()->tipoUsuario == "Laboaratorio" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="examenes")){
      if($vista == "paciente"){
        $pacientes = SolicitudExamen::where('estado','=',3)->where('f_examen','!=',null)->whereDate('created_at', Carbon::today())->distinct()->get(['f_paciente']);
        $solicitudes = SolicitudExamen::where('estado','=',3)->where('f_examen','!=',null)->whereDate('created_at', Carbon::today())->orderBy('estado')->get();
      }else{
        $examenes = SolicitudExamen::where('estado','=',3)->where('f_examen','!=',null)->whereDate('created_at', Carbon::today())->distinct()->get(['f_examen']);
        $solicitudes = SolicitudExamen::where('estado','=',3)->where('f_examen','!=',null)->whereDate('created_at', Carbon::today())->orderBy('estado')->get();
      }
      return view('SolicitudExamenes.examenesEntregados',compact('pacientes','solicitudes','examenes','vista'));
    }
  }

  public function graficar_examenes(){
    $solicitudes = SolicitudExamen::where('estado','>',1)->where('f_examen','!=',null)->get();

    $datos = [];
    $etiquetas = [];
    $colores = [];

    for($i=0; $i < 9; $i++){
      $datos[$i] = 0;
    }

    foreach($solicitudes as $k => $solicitud){
      for($i=0;$i < 9; $i++){
        if($k==0){
          $etiquetas[$i] = SolicitudExamen::areas($i);
          $colores[$i] = SolicitudExamen::colores($i);
        }
        if($solicitud->examen->area == SolicitudExamen::areas($i)){
          $datos[$i] = (++$datos[$i]);
        }
      }
    }

    return compact('datos','etiquetas','colores');
  }

  public function historialExamenes(Request $request){
		$examenes = null;
		$pacientes = null;
    $vista = $request->get("vista");
    if (Auth::user()->tipoUsuario == "TAC" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="tac")) {
      if($vista == "paciente"){
        $pacientes = SolicitudExamen::where('estado','=',3)->where('f_tac','!=',null)->distinct()->get(['f_paciente']);
        $solicitudes = SolicitudExamen::where('estado','=',3)->where('f_tac','!=',null)->orderBy('estado')->get();
      }else{
        $examenes = SolicitudExamen::where('estado','=',3)->where('f_tac','!=',null)->distinct()->get(['f_tac']);
        $solicitudes = SolicitudExamen::where('estado','=',3)->where('f_tac','!=',null)->orderBy('estado')->get();
      }
      return view('SolicitudTAC.historialExamenes',compact('pacientes','solicitudes','examenes','vista'));
    }else if (Auth::user()->tipoUsuario == "Rayos X" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="rayosx")) {
      if($vista == "paciente"){
        $pacientes = SolicitudExamen::where('estado','=',3)->where('f_rayox','!=',null)->distinct()->get(['f_paciente']);
        $solicitudes = SolicitudExamen::where('estado','=',3)->where('f_rayox','!=',null)->orderBy('estado')->get();
      }else{
        $examenes = SolicitudExamen::where('estado','=',3)->where('f_rayox','!=',null)->distinct()->get(['f_rayox']);
        $solicitudes = SolicitudExamen::where('estado','=',3)->where('f_rayox','!=',null)->orderBy('estado')->get();
      }
      return view('SolicitudRayosx.historialExamenes',compact('pacientes','solicitudes','examenes','vista'));
    }elseif (Auth::user()->tipoUsuario == "Ultrasonografía" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="ultras")) {
      if($vista == "paciente"){
        $pacientes = SolicitudExamen::where('estado','=',3)->where('f_ultrasonografia','!=',null)->distinct()->get(['f_paciente']);
        $solicitudes = SolicitudExamen::where('estado','=',3)->where('f_ultrasonografia','!=',null)->orderBy('estado')->get();
      }else{
        $examenes = SolicitudExamen::where('estado','=',3)->where('f_ultrasonografia','!=',null)->distinct()->get(['f_ultrasonografia']);
        $solicitudes = SolicitudExamen::where('estado','=',3)->where('f_ultrasonografia','!=',null)->orderBy('estado')->get();
      }
      return view('SolicitudUltras.historialExamenes',compact('pacientes','solicitudes','examenes','vista'));
    }elseif (Auth::user()->tipoUsuario == "Laboaratorio" || (Auth::user()->tipoUsuario == "Recepción" && $request->tipo=="examenes")){
      if($vista == "paciente"){
        $pacientes = SolicitudExamen::where('estado','=',3)->where('f_examen','!=',null)->distinct()->get(['f_paciente']);
        $solicitudes = SolicitudExamen::where('estado','=',3)->where('f_examen','!=',null)->orderBy('estado')->get();
      }else{
        $examenes = SolicitudExamen::where('estado','=',3)->where('f_examen','!=',null)->distinct()->get(['f_examen']);
        $solicitudes = SolicitudExamen::where('estado','=',3)->where('f_examen','!=',null)->orderBy('estado')->get();
      }
      return view('SolicitudExamenes.historialExamenes',compact('pacientes','solicitudes','examenes','vista'));
    }
  }
}