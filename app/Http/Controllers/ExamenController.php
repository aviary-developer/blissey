<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Examen;
use App\Unidad;
use App\Bitacora;
use App\Parametro;
use App\ExamenSeccionParametro;
use Redirect;
use DB;
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
      $estado = $request->get('estado');
      $nombre = $request->get('nombre');
      $examenes = Examen::buscar($nombre,$estado);
      $activos = Examen::where('estado',true)->count();
      $inactivos = Examen::where('estado',false)->count();
      return view('Examenes.index',compact('examenes','estado','nombre','activos','inactivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $unidades=Unidad::where('estado',true)->orderBy('nombre','asc')->get();
        return view('Examenes.create',compact('unidades'));
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
        $examenNuevo->save();
        $totalSecciones=($request->totalSecciones)-1;//Porque inicia en 0
        $ultimoExamen=Examen::all();
        $ultimoExamen=$ultimoExamen->last();
        if(isset($request->{"parametrosEnTabla".$totalSecciones})){//Concatenanado nombre de variable
          for($seccion=0;$seccion<=$totalSecciones;$seccion++) {
            $parametrosEnTablaActual=$request->{"parametrosEnTabla".$seccion};
            echo('<pre>');
            echo $seccion;
            echo('</pre>');
            for($parametros=0;$parametros<count($parametrosEnTablaActual);$parametros++){
            $e_s_p = new ExamenSeccionParametro;
            $e_s_p->f_examen = $ultimoExamen->id;
            $e_s_p->f_seccion = $request->{"selectSeccion".$seccion};
            $e_s_p->f_parametro = $parametrosEnTablaActual[$parametros];
            $e_s_p->save();
          }
        }
      }
      }catch(\Exception $e){
        DB::rollback();
        return redirect('/examenes')->with('mensaje', 'Algo salio mal');
      }
      DB::commit();
      Bitacora::bitacora('store','examens','examenes',$ultimoExamen->id);
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
      return view('Examenes.show',compact('examen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $examenes = Examen::find($id);
      return view('Examenes.edit',compact('examenes'));
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
      $examenes = Examen::find($id);
      $examenes->fill($request->all());
      $examenes->save();
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
      $examenes = Examen::findOrFail($id);
      $examenes->delete();
      return redirect('/examenes?estado=0');
    }

    public function desactivate($id){
      $examenes = Examen::find($id);
      $examenes->estado = false;
      $examenes->save();
      return Redirect::to('/examenes');
    }

    public function activate($id){
      $examenes = Examen::find($id);
      $examenes->estado = true;
      $examenes->save();
      return Redirect::to('/examenes?estado=0');
    }
}
