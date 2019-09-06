<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UnidadRequest;
use App\Http\Controllers\Controller;
use App\Unidad;
use App\Bitacora;
use Redirect;
use Response;
use DB;

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
    $unidades = Unidad::buscar($estado);
    $activos = Unidad::where('estado',true)->count();
    $inactivos = Unidad::where('estado',false)->count();
    return view('Unidades.index',compact(
      'unidades',
      'estado',
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
    $u=Unidad::create($request->All());
    Bitacora::bitacora('store','unidads','unidades',$u->id);
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
    $unidad = Unidad::find($id);
    return view('Unidades.edit',compact('unidad'));
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
    Bitacora::bitacora('update','unidads','unidades',$unidades->id);
    return redirect('/unidades?estado='.$unidades->estado)->with('mensaje', '¡Editado!');
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
    try {
      $unidades = Unidad::findOrFail($id);
      $unidades->delete();
      Bitacora::bitacora('destroy','unidades','unidads',$id);
      DB::commit();
      return redirect('/unidades?estado=0');
    } catch (\Exception $e) {
      DB::rollback();
      return redirect('/unidades?estado=0');
    }
  }

  public function desactivate($id){
    $unidades = Unidad::find($id);
    $unidades->estado = false;
    $unidades->save();
    Bitacora::bitacora('desactivate','unidads','unidades',$id);
    return Redirect::to('/unidades');
  }

  public function activate($id){
    $unidades = Unidad::find($id);
    $unidades->estado = true;
    $unidades->save();
    Bitacora::bitacora('activate','unidads','unidades',$id);
    return Redirect::to('/unidades?estado=0');
  }
  public static function ingresoUnidad(UnidadRequest $request){
    $u=Unidad::create($request->All());
    Bitacora::bitacora('store','unidads','unidades',$u->id);
    return Response::json('success');
  }
  public static function llenarUnidad(){
    $unidades=Unidad::where('estado',true)->orderBy('nombre')->get(['id','nombre']);
    return Response::json($unidades);
  }
}
