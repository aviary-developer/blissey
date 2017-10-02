<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Reactivo;
use Redirect;
use Carbon\Carbon;

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
  public function store(Request $request)
  {
    Reactivo::create($request->All());
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
    return view('Reactivos.show',compact('reactivo'));
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
    return redirect('/reactivos?estado=0');
  }
  public function desactivate($id){
    $reactivos = Reactivo::find($id);
    $reactivos->estado = false;
    $reactivos->save();
    return Redirect::to('/reactivos');
  }

  public function activate($id){
    $reactivos = Reactivo::find($id);
    $reactivos->estado = true;
    $reactivos->save();
    return Redirect::to('/reactivos?estado=0');
  }
}
