<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Parametro;
use App\Unidad;
use Redirect;
use Response;
use Carbon\Carbon;

class ParametroController extends Controller
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
    $parametros = Parametro::buscar($nombre,$estado);
    $unidades = Unidad::all();
    $activos = Parametro::where('estado',true)->count();
    $inactivos = Parametro::where('estado',false)->count();
    return view('Parametros.index',compact('parametros','estado','nombre','activos','inactivos'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $unidades=Unidad::where('estado',true)->orderBy('nombre','asc')->get();
    return view('Parametros.create',compact('unidades'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    Parametro::create($request->All());
    return redirect('/parametros')->with('mensaje', '¡Guardado!');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $parametro = Parametro::find($id);
    return view('Parametros.show',compact('parametro'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $parametros = Parametro::find($id);
    return view('Parametros.edit',compact('parametros'));
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
    $parametros = Parametro::find($id);
    $parametros->fill($request->all());
    $parametros->save();
    if($parametros->estado)
    {
      return redirect('/parametros')->with('mensaje', '¡Editado!');
    }
    else{
      return redirect('/parametros?estado=0')->with('mensaje', '¡Editado!');
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
    $parametros = Parametro::findOrFail($id);
    $parametros->delete();
    return redirect('/parametros?estado=0');
  }
  public function desactivate($id){
    $parametros = Parametro::find($id);
    $parametros->estado = false;
    $parametros->save();
    return Redirect::to('/parametros');
  }

  public function activate($id){
    $parametros = Parametro::find($id);
    $parametros->estado = true;
    $parametros->save();
    return Redirect::to('/parametros?estado=0');
  }

  public function llenarParametrosExamenes(){
    $parametros=Parametro::where('estado',true)->get();
    return Response::json($parametros);
  }
}
