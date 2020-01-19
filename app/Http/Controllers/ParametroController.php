<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ParametroRequest;
use App\Http\Controllers\Controller;
use App\Parametro;
use App\Unidad;
use Redirect;
use Response;
use DB;
use App\Bitacora;

class ParametroController extends Controller
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
    $parametros = Parametro::buscar($nombre,$estado);
    $unidades = Unidad::all();
    $activos = Parametro::where('estado',true)->count();
    $inactivos = Parametro::where('estado',false)->count();
    return view('Parametros.index',compact(
      'parametros',
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
    $unidades=Unidad::where('estado',true)->orderBy('nombre','asc')->get();
    return view('Parametros.create',compact('unidades'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(ParametroRequest $request)
  {
    $p=Parametro::create($request->All());
    Bitacora::bitacora('store','parametros','parametros',$p->id);
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
    $unidades = Unidad::where('estado',true)->orderBy('nombre','asc')->get();
    return view('Parametros.edit',compact('parametros','unidades'));
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
    Bitacora::bitacora('update','parametros','parametros',$id);
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
    DB::beginTransaction();
    try {
      $parametro = Parametro::findOrFail($id);
      $parametro->delete();
      Bitacora::bitacora('destroy','parametros','parametros',$id);
      DB::commit();
      return redirect('/parametros?estado=0');
    } catch (\Exception $e) {
      DB::rollback();
      return redirect('/parametros?estado=0');
    }
  }
  public function desactivate($id){
    $parametros = Parametro::find($id);
    $parametros->estado = false;
    $parametros->save();
    Bitacora::bitacora('desactivate','parametros','parametros',$id);
    return Redirect::to('/parametros');
  }

  public function activate($id){
    $parametros = Parametro::find($id);
    $parametros->estado = true;
    $parametros->save();
    Bitacora::bitacora('activate','parametros','parametros',$id);
    return Redirect::to('/parametros?estado=0');
  }

  public function llenarParametrosExamenes(){
    $parametros=Parametro::where('estado',true)->orderBy('nombreParametro','asc')->get();
    return Response::json($parametros);
  }
  public function ingresoParametro(ParametroRequest $request){
    $p=Parametro::create($request->All());
    Bitacora::bitacora('store','parametros','parametros',$p->id);
    return Response::json('success');
  }
}
