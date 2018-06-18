<?php

namespace App\Http\Controllers;

use App\SolicitudExamen;
use App\Examen;
use App\DetalleUltrasonografia;
use App\DetalleRayox;
use App\ultrasonografia;
use App\Rayosx;
use App\DetalleResultado;
use App\Resultado;
use App\ExamenSeccionParametro;
use App\Bitacora;
use App\Reactivo;
use App\Transacion;
use App\DetalleTransacion;
use Response;
use App\Paciente;
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
    if (Auth::user()->tipoUsuario == "Rayos X") {
      $vista = $request->get("vista");
      if($vista == "paciente"){
        $pacientes = SolicitudExamen::where('estado','<>',3)->where('f_rayox','!=',null)->distinct()->get(['f_paciente']);
        $solicitudes = SolicitudExamen::where('estado','<>',3)->where('f_rayox','!=',null)->orderBy('estado')->get();
      }else{
        $examenes = SolicitudExamen::where('estado','<>',3)->where('f_rayox','!=',null)->distinct()->get(['f_rayox']);
        $solicitudes = SolicitudExamen::where('estado','<>',3)->where('f_rayox','!=',null)->orderBy('estado')->get();
      }
      return view('SolicitudRayosx.index',compact('pacientes','solicitudes','examenes','vista'));
    }
    else if (Auth::user()->tipoUsuario == "Ultrasonografía") {
      $vista = $request->get("vista");
      if($vista == "paciente"){
        $pacientes = SolicitudExamen::where('estado','<>',3)->where('f_ultrasonografia','!=',null)->distinct()->get(['f_paciente']);
        $solicitudes = SolicitudExamen::where('estado','<>',3)->where('f_ultrasonografia','!=',null)->orderBy('estado')->get();
      }else{
        $examenes = SolicitudExamen::where('estado','<>',3)->where('f_ultrasonografia','!=',null)->distinct()->get(['f_ultrasonografia']);
        $solicitudes = SolicitudExamen::where('estado','<>',3)->where('f_ultrasonografia','!=',null)->orderBy('estado')->get();
      }
      return view('SolicitudUltras.index',compact('pacientes','solicitudes','examenes','vista'));
    }else{
    $vista = $request->get("vista");
    if($vista == "paciente"){
      $pacientes = SolicitudExamen::where('estado','<>',3)->where('f_examen','!=',null)->distinct()->get(['f_paciente']);
      $solicitudes = SolicitudExamen::where('estado','<>',3)->where('f_examen','!=',null)->orderBy('estado')->get();
    }else{
      $examenes = SolicitudExamen::where('estado','<>',3)->where('f_examen','!=',null)->distinct()->get(['f_examen']);
      $solicitudes = SolicitudExamen::where('estado','<>',3)->where('f_examen','!=',null)->orderBy('estado')->get();
    }
    return view('SolicitudExamenes.index',compact('pacientes','solicitudes','examenes','vista'));
  }
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    if (Auth::user()->tipoUsuario == "Rayos X") {
      $rayosx = Rayosx::where('estado',true)->orderBy('nombre')->get();
      return view('SolicitudRayosx.create',compact('rayosx'));
    }
    else if (Auth::user()->tipoUsuario == "Ultrasonografía") {
      $ultras = ultrasonografia::where('estado',true)->orderBy('nombre')->get();
      return view('SolicitudUltras.create',compact('ultras'));
    } else {
      $examenes = Examen::where('estado',true)->orderBy('area')->orderBy('nombreExamen')->get();
      return view('SolicitudExamenes.create',compact('examenes'));
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
    if (Auth::user()->tipoUsuario == "Rayos X") {
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

            $transaccion = new Transacion;
            $transaccion->fecha = Carbon::now();
            $transaccion->f_cliente = $request->f_paciente;
            $transaccion->f_ingreso = $request->f_ingreso;
            $transaccion->tipo = 2;
            $transaccion->factura = $factura;
            $transaccion->f_usuario = Auth::user()->id;
            $transaccion->localizacion = 1;
            $transaccion->save();
            $transaccion_id = $transaccion->id;
          }else{
            $transaccion_id = $request->transaccion;
          }
            $solicitud = new SolicitudExamen;
            $solicitud->f_paciente = $request->f_paciente;
            $solicitud->f_rayox = $request->rayox;
            $solicitud->estado = 1;
            $solicitud->f_transaccion = $transaccion_id;
            $solicitud->save();

            //Detalle de transaccion
            $detalle = new DetalleTransacion;
            $detalle->f_servicio = $solicitud->rayox->servicio->id;
            $detalle->precio = $solicitud->rayox->servicio->precio;
            $detalle->cantidad = 1;
            $detalle->f_transaccion = $transaccion_id;
            $detalle->save();

            DB::commit();
            Bitacora::bitacora('store','solicitud_examens','solicitudex',$solicitud->id);
            Bitacora::bitacora('store','transacions','transacciones',$transaccion_id);

        }
      }catch(Exception $e){
        DB::rollback();
        return redirect('/solicitudex')->with('mensaje','Algo salio mal');
      }
    }else if (Auth::user()->tipoUsuario == "Ultrasonografía") {
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

            $transaccion = new Transacion;
            $transaccion->fecha = Carbon::now();
            $transaccion->f_cliente = $request->f_paciente;
            $transaccion->f_ingreso = $request->f_ingreso;
            $transaccion->tipo = 2;
            $transaccion->factura = $factura;
            $transaccion->f_usuario = Auth::user()->id;
            $transaccion->localizacion = 1;
            $transaccion->save();
            $transaccion_id = $transaccion->id;
          }else{
            $transaccion_id = $request->transaccion;
          }
            $solicitud = new SolicitudExamen;
            $solicitud->f_paciente = $request->f_paciente;
            $solicitud->f_ultrasonografia = $request->ultrasonografia;
            $solicitud->estado = 1;
            $solicitud->f_transaccion = $transaccion_id;
            $solicitud->save();

            //Detalle de transaccion
            $detalle = new DetalleTransacion;
            $detalle->f_servicio = $solicitud->ultrasonografia->servicio->id;
            $detalle->precio = $solicitud->ultrasonografia->servicio->precio;
            $detalle->cantidad = 1;
            $detalle->f_transaccion = $transaccion_id;
            $detalle->save();

            DB::commit();
            Bitacora::bitacora('store','solicitud_examens','ultrasonografias',$solicitud->id);
            Bitacora::bitacora('store','transacions','transacciones',$transaccion_id);

        }
      }catch(Exception $e){
        DB::rollback();
        return redirect('/solicitudex')->with('mensaje','Algo salio mal');
      }
    }else {
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

          $transaccion = new Transacion;
          $transaccion->fecha = Carbon::now();
          $transaccion->f_cliente = $request->f_paciente;
          $transaccion->f_ingreso = $request->f_ingreso;
          $transaccion->tipo = 2;
          $transaccion->factura = $factura;
          $transaccion->f_usuario = Auth::user()->id;
          $transaccion->localizacion = 1;
          $transaccion->save();
          $transaccion_id = $transaccion->id;
        }else{
          $transaccion_id = $request->transaccion;
        }

        foreach ($request->examen as $examen) {
          // Generar codigo de la muestra
          $cantidad_examenes = SolicitudExamen::where('f_examen',$examen)->where('created_at','>',$año.'-01-01')->where('created_at','<=',$año.'-12-31')->count();
          $año_corto = date('y');
          $cantidad_examenes++;
          $codigo_muestra = $examen.'-'.$cantidad_examenes.'-'.$año_corto;
          //Inicio
          $solicitud = new SolicitudExamen;
          $solicitud->f_paciente = $request->f_paciente;
          $solicitud->f_examen = $examen;
          $solicitud->codigo_muestra = $codigo_muestra;
          $solicitud->estado = 0;
          $solicitud->f_transaccion = $transaccion_id;
          $solicitud->save();

          //Detalle de transaccion
          $detalle = new DetalleTransacion;
          $detalle->f_servicio = $solicitud->examen->servicio->id;
          $detalle->precio = $solicitud->examen->servicio->precio;
          $detalle->cantidad = 1;
          $detalle->f_transaccion = $transaccion_id;
          $detalle->save();

          DB::commit();
          Bitacora::bitacora('store','solicitud_examens','solicitudex',$solicitud->id);
          Bitacora::bitacora('store','transacions','transacciones',$transaccion_id);
        }
      }
    }catch(Exception $e){
      DB::rollback();
      return redirect('/solicitudex')->with('mensaje','Algo salio mal');
    }
    }
    if($request->f_ingreso == null){
      return redirect('/solicitudex')->with('mensaje', '¡Guardado!');
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
    if (Auth::user()->tipoUsuario == "Rayos X") {
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
    if (Auth::user()->tipoUsuario == "Rayos X") {
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
    if (Auth::user()->tipoUsuario == "Rayos X") {
      $solicitud = SolicitudExamen::findOrFail($id);
      $solicitud->delete();
      return redirect()->action('SolicitudExamenController@index');
  }else
  if (Auth::user()->tipoUsuario == "Ultrasonografía") {
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
    if (Auth::user()->tipoUsuario == "Rayos X") {
      $solicitud=SolicitudExamen::where('id','=',$id)->where('estado','=',1)->where('f_rayox','=',$idExamen)->first();
      return view('SolicitudRayosx.evaluarRadiografia',compact('solicitud'));
    }else
    if (Auth::user()->tipoUsuario == "Ultrasonografía") {
      $solicitud=SolicitudExamen::where('id','=',$id)->where('estado','=',1)->where('f_ultrasonografia','=',$idExamen)->first();
      return view('SolicitudUltras.evaluarUltrasonografia',compact('solicitud'));
    }
    else {
    $solicitud=SolicitudExamen::where('id','=',$id)->where('estado','=',1)->where('f_examen','=',$idExamen)->first();
    $secciones=ExamenSeccionParametro::where('f_examen','=',$idExamen)->where('estado','=',true)->distinct()->get(['f_seccion']);;
    $espr=ExamenSeccionParametro::where('f_examen','=',$idExamen)->where('estado','=',true)->get();
    $contador=0;
    $contadorSecciones=0;
    if(count($espr)>0){
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
    return view('SolicitudExamenes.evaluarExamen',compact('solicitud','espr','secciones','contadorSecciones'));
  }
}
  public function guardarResultadosExamen(Request $request)
  {
    if (Auth::user()->tipoUsuario == "Rayos X") {
      $idSolicitud=$request->solicitud;
      $observacion=$request->observacion;
      DB::beginTransaction();
      try{
        $resultado= new Resultado();
        $resultado->f_solicitud=$idSolicitud;
        $resultado->observacion=$observacion;
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
      $idSolicitud=$request->solicitud;
      $observacion=$request->observacion;
      DB::beginTransaction();
      try{
        $resultado= new Resultado();
        $resultado->f_solicitud=$idSolicitud;
        $resultado->observacion=$observacion;
        $resultado->save();
        $resultados=Resultado::all();
        $idResultado=$resultados->last()->id;
        $contadorControlados=0;
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
    }else {///EDICION DE RESULTADOS DE EXAMENES
      $idSolicitud=$request->solicitud;
      $resultadosGuardar=$request->resultados;
      $datosControlados=$request->datoControlado;
      $observacion=$request->observacion;
      DB::beginTransaction();
      try{
        $resultado=Resultado::where('f_solicitud','=',$idSolicitud)->first();
        $resultado->observacion=$observacion;
        $resultado->save();
        $idResultado=$resultado->id;
        $contadorControlados=0;
        $detallesResultado=DetalleResultado::where('f_resultado','=',$idResultado)->get();
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
      }catch(Exception $e){
        DB::rollback();
        return redirect('/solicitudex')->with('mensaje','Algo salio mal');
      }
      DB::commit();
      Bitacora::bitacora('update','resultados','solicitudex',$idResultado);
      return redirect('/solicitudex')->with('mensaje', '¡Editado!');
    }
  }
  }
  public function entregarExamen($id,$idExamen)
  {
    if (Auth::user()->tipoUsuario == "Rayos X") {
      $resultado=Resultado::where('f_solicitud','=',$id)->first();
      $detallesResultado=DetalleResultado::where('f_resultado','=', $resultado->id)->get();
      $solicitud=SolicitudExamen::where('id','=',$id)->where('estado','=',2)->where('f_rayox','=',$idExamen)->first();
      $header = view('PDF.header.laboratorio');
      $footer = view('PDF.footer.numero_pagina');
      $main = view('SolicitudRayosx.entregaExamen',compact('solicitud','resultado','detallesResultado'));
      $pdf = \PDF::loadHtml($main)->setOption('footer-html',$footer)->setOption('header-html',$header);
      return $pdf->stream('Radiografia_con_solicitud_'.$solicitud->id.'.pdf');
    }
      else{
    $resultado=Resultado::where('f_solicitud','=',$id)->first();
    $detallesResultado=DetalleResultado::where('f_resultado','=', $resultado->id)->get();
    $solicitud=SolicitudExamen::where('id','=',$id)->where('estado','=',2)->where('f_examen','=',$idExamen)->first();
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
    $header = view('PDF.header.laboratorio');
    $footer = view('PDF.footer.numero_pagina');
    $main = view('SolicitudExamenes.entregaExamen',compact('solicitud','espr','secciones','contadorSecciones','resultado','detallesResultado'));
    $pdf = \PDF::loadHtml($main)->setOption('footer-html',$footer)->setOption('header-html',$header);
    return $pdf->stream('Examen_con_solicitud_'.$solicitud->id.'.pdf');
  }
  }
  public function editarResultadosExamen($id,$idExamen)
  {
    $resultado=Resultado::where('f_solicitud','=',$id)->first();
    $detallesResultado=DetalleResultado::where('f_resultado','=', $resultado->id)->get();
    $solicitud=SolicitudExamen::where('id','=',$id)->where('estado','=',2)->where('f_examen','=',$idExamen)->first();
    $secciones=ExamenSeccionParametro::where('f_examen','=',$idExamen)->where('estado','=','true')->distinct()->get(['f_seccion']);;
    $espr=ExamenSeccionParametro::where('f_examen','=',$idExamen)->where('estado','=','true')->get();
    $contador=0;
    $contadorSecciones=0;
    if(count($espr)>0){
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
    $vista = $request->get("vista");
    if($vista == "paciente"){
      $pacientes = SolicitudExamen::where('estado','=',2)->where('f_examen','!=',null)->distinct()->get(['f_paciente']);
      $solicitudes = SolicitudExamen::where('estado','=',2)->where('f_examen','!=',null)->orderBy('estado')->get();
    }else{
      $examenes = SolicitudExamen::where('estado','=',2)->where('f_examen','!=',null)->distinct()->get(['f_examen']);
      $solicitudes = SolicitudExamen::where('estado','=',2)->where('f_examen','!=',null)->orderBy('estado')->get();
    }
    return view('SolicitudExamenes.examenesEvaluados',compact('pacientes','solicitudes','examenes','vista'));
  }

  public function impresionExamenesPorPaciente($paciente,$bandera)
  {
    $solicitudes = SolicitudExamen::where('estado','=',2)->where('f_paciente','=',$paciente)->orderBy('estado')->get();
    if($bandera){
        foreach ($solicitudes as $solicitud) {
        /*$cambioEstadoSolicitud=SolicitudExamen::find($solicitud->id);
        $cambioEstadoSolicitud->estado=3;
        $cambioEstadoSolicitud->save();*/
      }
    }
    foreach ($solicitudes as $key => $solicitud) {
      $resultados[$key]=Resultado::where('f_solicitud','=',$solicitud->id)->first();
      $detallesResultado[$key]=DetalleResultado::where('f_resultado','=', $resultados[$key]->id)->get();
      $espr[$key]=ExamenSeccionParametro::where('f_examen','=',$solicitud->f_examen)->where('estado','=',1)->get();
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
}
