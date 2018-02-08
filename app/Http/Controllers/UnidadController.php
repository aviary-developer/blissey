<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UnidadRequest;
use App\Http\Controllers\Controller;
use App\Unidad;
use Redirect;
use Carbon\Carbon;

class UnidadController extends Controller
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
    $unidades = Unidad::buscar($nombre,$estado);
    $activos = Unidad::where('estado',true)->count();
    $inactivos = Unidad::where('estado',false)->count();
    return view('Unidades.index',compact(
      'unidades',
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
      return view('Unidades.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(UnidadRequest $request)
  {
    Unidad::create($request->All());
    return redirect('/unidades')->with('mensaje', '¡Guardado!');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $unidad = Unidad::find($id);
    return view('Unidades.show',compact('unidad'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $unidades = Unidad::find($id);
    return view('Unidades.edit',compact('unidades'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(UnidadRequest $request, $id)
  {
    $unidades = Unidad::find($id);
    $unidades->fill($request->all());
    $unidades->save();
    if($unidades->estado)
    {
      return redirect('/unidades')->with('mensaje', '¡Editado!');
    }
    else{
      return redirect('/unidades?estado=0')->with('mensaje', '¡Editado!');
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
    $unidades = Unidad::findOrFail($id);
    $unidades->delete();
    return redirect('/unidades?estado=0');
  }

  public function desactivate($id){
    $unidades = Unidad::find($id);
    $unidades->estado = false;
    $unidades->save();
    return Redirect::to('/unidades');
  }

  public function activate($id){
    $unidades = Unidad::find($id);
    $unidades->estado = true;
    $unidades->save();
    return Redirect::to('/unidades?estado=0');
  }
}
