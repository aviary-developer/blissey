<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Examen;
use App\Unidad;
use App\Reactivo;
use App\Bitacora;
use App\CategoriaServicio;
use App\Servicio;
use App\MuestraExamen;
use App\Parametro;
use App\Seccion;
use App\ExamenSeccionParametro;
use Redirect;
use Response;
use DB;
use App;
use Carbon\Carbon;

class ExamenController extends Controller
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
    $nombre = $request->get('nombre');
    $examenes = Examen::buscar($nombre,$estado);
    $activos = Examen::where('estado',true)->count();
    $inactivos = Examen::where('estado',false)->count();
    return view('Examenes.index',compact(
      'examenes',
      'estado',
      'nombre',
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
    $muestras=MuestraExamen::where('estado',true)->orderBy('nombre','asc')->get();
    $secciones = Seccion::where('estado',true)->orderBy('nombre')->get();
    $parametros= Parametro::where('estado',true)->orderBy('nombreParametro','asc')->get();
    $reactivos = Reactivo::where('estado',true)->orderBy('nombre')->get();
    $unidades = Unidad::where('estado',true)->orderBy('nombre')->get();

    return view('Examenes.create2', compact(
      'muestras',
      'secciones',
      'parametros',
      'reactivos',
      'unidades'
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

    try{
      $examenNuevo = new Examen;
      $examenNuevo->nombreExamen=$request->nombreExamen;
      $examenNuevo->tipoMuestra=$request->tipoMuestra;
      $examenNuevo->area=$request->area;
      if($request->checkImagenExamen){
        $examenNuevo->imagen=true;
      }
      $examenNuevo->save();
      //Crear una categoria de servicio asociada a los examen
      $categoria_existe = CategoriaServicio::where('nombre','Laboratorio Clínico')->first();

      if($categoria_existe==null){
        $categoria_existe = new CategoriaServicio;
        $categoria_existe->nombre = "Laboratorio Clínico";
        $categoria_existe->save();
      }

      $servicio = new Servicio;
      $servicio->nombre = $request->nombreExamen;
      $servicio->f_categoria = $categoria_existe->id;
      $servicio->precio = $request->precio;
      $servicio->f_examen = $examenNuevo->id;
      $servicio->save();

      if(isset($request->f_parametro)){
        foreach($request->f_parametro as $k => $parametro){
          $Seccion_examen = new ExamenSeccionParametro;
          $Seccion_examen->f_seccion = $request->f_seccion[$k];
          $Seccion_examen->f_examen = $examenNuevo->id;
          $Seccion_examen->f_parametro = $parametro;
          $Seccion_examen->f_reactivo = $request->f_reactivo[$k];
          $Seccion_examen->save();
        }
      }
    }catch(\Exception $e){
      DB::rollback();
      return $e;
      return redirect('/examenes')->with('mensaje', $e);
    }
    DB::commit();
    Bitacora::bitacora('store','examens','examenes',$examenNuevo->id);
    return redirect('/examenes')->with('mensaje', '¡Guardado!');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $examen = Examen::find($id);
    $servicio = Servicio::where('f_examen',$id)->first();
    $e_s_p = ExamenSeccionParametro::where('f_examen',$id)->where('estado',TRUE)->get();
    //echo $e_s_p;
    $contador=0;
    $contadorSecciones=0;
    if($e_s_p!=null){
      foreach ($e_s_p as $esp) {
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
    }else {
      $secciones=null;
    }
    return view('Examenes.show',compact('examen','e_s_p','secciones','servicio'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    // $examenes = Examen::find($id);
    // $unidades=Unidad::where('estado',true)->orderBy('nombre','asc')->get();
    // $muestras=MuestraExamen::where('estado',true)->orderBy('nombre','asc')->get();
    // $seccionesTabla=Seccion::where('estado',true)->orderBy('nombre','asc')->get();
    // $parametros=Parametro::where('estado',true)->orderBy('nombreParametro','asc')->get();
    // $areaSeleccionada=$examenes->area;
    // $muestraSeleccionada=$examenes->tipoMuestra;
    // $unidades=Unidad::where('estado',true)->orderBy('nombre','asc')->get();
    // $e_s_p = ExamenSeccionParametro::where('f_examen',$id)->where('estado',TRUE)->get();
    // $contador=0;
    // $contadorSecciones=0;
    // if(count($e_s_p)>0){
    //   foreach ($e_s_p as $esp) {
    //     if($contador==0){
    //       $secciones[$contadorSecciones]=$esp->f_seccion;
    //     }else{
    //       if($secciones[$contadorSecciones]==$esp->f_seccion)
    //       {
    //       }else {
    //         $contadorSecciones++;
    //         $secciones[$contadorSecciones]=$esp->f_seccion;
    //       }
    //     }
    //     $contador++;
    //   }
    // }
    // return view('Examenes.edit',compact('muestras','examenes','areaSeleccionada','muestraSeleccionada','unidades','e_s_p','secciones','seccionesTabla','parametros'));
    return redirect('/examenes');
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    DB::beginTransaction();
    try{
      $examenes = Examen::find($id);
      $examenes->fill($request->all());
      $examenes->save();
      $totalSecciones=($request->contadorEnEdit)+1;//Porque inicia en 0
      $datosADesactivar=ExamenSeccionParametro::where('f_examen', $id)->get();
      if (!empty($datosADesactivar)){
          foreach ($datosADesactivar as $desactive) {
            $desactive->delete();
            /*$desactive->estado=false;
            $desactive->save();*/
          }
          }
      //if(isset($request->{"parametrosEnTabla".$totalSecciones})){//Concatenanado nombre de variable
        for($seccion=0;$seccion<=$totalSecciones;$seccion++) {
          $parametrosEnTablaActual=$request->{"parametrosEnTabla".$seccion};
          echo('<pre>');
          echo $seccion;
          echo('</pre>');
          for($parametros=0;$parametros<count($parametrosEnTablaActual);$parametros++){
            $e_s_p = new ExamenSeccionParametro;
            $e_s_p->f_examen = $examenes->id;
            $e_s_p->f_seccion = $request->{"selectSeccion".$seccion};
            $e_s_p->f_parametro = $parametrosEnTablaActual[$parametros];
            $e_s_p->save();
          }
        }
      //}
    }catch(\Exception $e){
      DB::rollback();
      return redirect('/examenes')->with('mensaje', 'Algo salio mal');
    }
    DB::commit();
    Bitacora::bitacora('update','examens','examenes',$examenes->id);

    if($examenes->estado)
    {
      return redirect('/examenes')->with('mensaje', '¡Editado!');
    }
    else{
      return redirect('/examenes?estado=0')->with('mensaje', '¡Editado!');
    }
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    DB::beginTransaction();
      try{
        $espr =ExamenSeccionParametro::where('f_examen',$id)->get();
        foreach ($espr as $key => $value) {
          $value->delete();
        }
        $servicio =Servicio::where('f_examen',$id)->first();
        $servicio->delete();
        $examen = Examen::findOrFail($id);
        $examen->delete();
      }catch(\Exception $e){
        DB::rollback();
        return redirect('/examenes?estado=0')->with('error', " ");
      }
      DB::commit();
      return redirect('/examenes?estado=0')->with('mensaje',' ');
  }

  public function desactivate($id){
    $examenes = Examen::find($id);
    $examenes->estado = false;
    $examenes->save();
    $servicio =Servicio::where('f_examen',$id)->first();
    $servicio->estado=0;
    $servicio->save();
    Bitacora::bitacora('desactivate','examens','examenes',$id);
    return Redirect::to('/examenes');
  }

  public function activate($id){
    $examenes = Examen::find($id);
    $examenes->estado = true;
    $examenes->save();
    $servicio =Servicio::where('f_examen',$id)->first();
    $servicio->estado=1;
    $servicio->save();
    Bitacora::bitacora('activate','examens','examenes',$id);
    return Redirect::to('/examenes?estado=0');
  }
  public function actualizarPrecioExamen(Request $request){
    $servicio = Servicio::find($request->idServicio);
    $servicio->precio=$request->precio;
    $servicio->save();
    return Response::json('sucess');
  }
  public function actualizarNombreExamen(Request $request){
    $examen = Examen::find($request->idExamen);
    $examen->nombreExamen=$request->nombreExamen;
    $examen->save();
    return Response::json('sucess');
  }
}
