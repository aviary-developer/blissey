<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReactivoRequest;
use App\Http\Controllers\Controller;
use App\Reactivo;
use App\DescripcionReactivo;
use Redirect;
use Response;
use App\Bitacora;

class ReactivoController extends Controller
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
    $reactivos = Reactivo::buscar($nombre,$estado);
    $activos = Reactivo::where('estado',true)->count();
    $inactivos = Reactivo::where('estado',false)->count();
    return view('Reactivos.index',compact('reactivos','estado','nombre','activos','inactivos'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('Reactivos.create');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(ReactivoRequest $request)
  {
    $r=Reactivo::create($request->All());
    Bitacora::bitacora('store','reactivos','reactivos',$r->id);
    return redirect('/reactivos')->with('mensaje', '¡Guardado!');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $reactivo = Reactivo::find($id);
    $movimientos=DescripcionReactivo::where('f_reactivo',$id)->orderBy('created_at','desc')->get();
    return view('Reactivos.show',compact('reactivo','movimientos'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $reactivos = Reactivo::find($id);
    return view('Reactivos.edit',compact('reactivos'));
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
    $reactivos = Reactivo::find($id);
    $reactivos->fill($request->all());
    $reactivos->save();
    Bitacora::bitacora('update','reactivos','reactivos',$id);
    if($reactivos->estado)
    {
      return redirect('/reactivos')->with('mensaje', '¡Editado!');
    }
    else{
      return redirect('/reactivos?estado=0')->with('mensaje', '¡Editado!');
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
    $reactivos = Reactivo::findOrFail($id);
    $reactivos->delete();
    Bitacora::bitacora('destroy','reactivos','reactivos',$id);
    return redirect('/reactivos?estado=0');
  }
  public function desactivate($id){
    $reactivos = Reactivo::find($id);
    $reactivos->estado = false;
    $reactivos->save();
    Bitacora::bitacora('desactivate','reactivos','reactivos',$id);
    return Redirect::to('/reactivos');
  }

  public function activate($id){
    $reactivos = Reactivo::find($id);
    $reactivos->estado = true;
    $reactivos->save();
    Bitacora::bitacora('activate','reactivos','reactivos',$id);
    return Redirect::to('/reactivos?estado=0');
  }
  public function llenarReactivosExamenes(){
    $reactivos=Reactivo::where('estado',true)->orderBy('nombre')->get();
    return Response::json($reactivos);
  }
  public function ingresoReactivo(ReactivoRequest $request){
    $r=Reactivo::create($request->All());
    Bitacora::bitacora('store','reactivos','reactivos',$r->id);
    return Response::json('success');
  }
  public function actualizarExistenciaReactivos(Request $request){
    $reactivos = Reactivo::find($request->id);
    $descripcion=new DescripcionReactivo;
    $descripcion->descripcionExistencias=$request->descripcionExistencias;
    $descripcion->anterior = $reactivos->contenidoPorEnvase;
    $descripcion->posterior = $request->contenidoPorEnvase;
    $descripcion->movimiento = $request->movimiento;
    $descripcion->f_reactivo=$request->id;
    $reactivos->contenidoPorEnvase = $request->contenidoPorEnvase;
    $reactivos->save();
    $descripcion->save();
    return Response::json('sucess');
  }
}
