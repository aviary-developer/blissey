<?php

namespace App\Http\Controllers;

use App\SolicitudExamen;
use App\Examen;
use App\DetalleResultado;
use App\Resultado;
use App\ExamenSeccionParametro;
use App\Bitacora;
use App\Paciente;
use Illuminate\Http\Request;
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
        $vista = $request->get("vista");
        if($vista == "paciente"){
            $pacientes = SolicitudExamen::where('estado','<>',3)->distinct()->get(['f_paciente']);
            $solicitudes = SolicitudExamen::where('estado','<>',3)->orderBy('estado')->get();
        }else{
            $examenes = SolicitudExamen::where('estado','<>',3)->distinct()->get(['f_examen']);
            $solicitudes = SolicitudExamen::where('estado','<>',3)->orderBy('estado')->get();
        }
        return view('SolicitudExamenes.index',compact('pacientes','solicitudes','examenes','vista'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $examenes = Examen::where('estado',true)->orderBy('area')->orderBy('nombreExamen')->get();
        return view('SolicitudExamenes.create',compact('examenes'));
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
        try{
            $año = date('Y');
            if(isset($request->examen)){
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

                    $solicitud->save();

                    DB::commit();
                    Bitacora::bitacora('store','solicitud_examens','solicitudex',$solicitud->id);
                }
            }
        }catch(Exception $e){
            DB::rollback();
            return redirect('/solicitudex')->with('mensaje','Algo salio mal');
        }
      return redirect('/solicitudex')->with('mensaje', '¡Guardado!');
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
    public function edit(SolicitudExamen $solicitudExamen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SolicitudExamen  $solicitudExamen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SolicitudExamen $solicitudExamen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SolicitudExamen  $solicitudExamen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $solicitud = SolicitudExamen::findOrFail($id);
        $paciente = $solicitud->f_paciente;
        $solicitud->delete();
        $examenes = SolicitudExamen::where('f_paciente',$paciente)->where('estado','<',3)->count();
        return $examenes;
    }

    public function aceptar($id){
        $solicitud = SolicitudExamen::find($id);
        $solicitud->estado = 1;
        $solicitud->save();
        return 1;
    }

    public function evaluarExamen($id,$idExamen){
      $solicitud=SolicitudExamen::where('id','=',$id)->where('estado','=',1)->where('f_examen','=',$idExamen)->first();
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
      return view('SolicitudExamenes.evaluarExamen',compact('solicitud','espr','secciones','contadorSecciones'));
    }
    public function guardarResultadosExamen(Request $request)
    {
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
      $contadorControlados++;
    }
      $detallesResultado->save();
      }
    }catch(Exception $e){
        DB::rollback();
        return redirect('/solicitudex')->with('mensaje','Algo salio mal');
    }
    DB::commit();
    Bitacora::bitacora('store','resultados','solicitudex',$idResultado);
    return redirect('/solicitudex')->with('mensaje', '¡Guardado!');
    }
}
