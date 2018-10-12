<?php

namespace App\Http\Controllers;

use App\Presentacion;
use Illuminate\Http\Request;
use App\Bitacora;
use Redirect;
use Response;
use App\Http\Requests\PresentacionRequest;
use DB;

class PresentacionController extends Controller
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
      $presentaciones = Presentacion::buscar($estado);
      $activos = Presentacion::where('estado',true)->count();
      $inactivos = Presentacion::where('estado',false)->count();
      return view('Presentaciones.index',compact(
        'presentaciones',
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
        return view('Presentaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(presentacionRequest $request)
    {
      DB::beginTransaction();
      try{
      $presentacion = Presentacion::create($request->All());
    }catch(Exception $e){
      DB::rollback();
      return redirect('/presentaciones')->with('mensaje', '¡Algo salio mal!');
    }
      DB::commit();
      Bitacora::bitacora('store','presentacions','presentaciones',$presentacion->id);
      return redirect('/presentaciones')->with('mensaje', '¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Presentacion  $presentacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $presentacion = Presentacion::find($id);
      return view('Presentaciones.show',compact('presentacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Presentacion  $presentacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $presentacion = Presentacion::find($id);
      return view('Presentaciones.edit',compact('presentacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Presentacion  $presentacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $presentaciones = Presentacion::find($id);
      $presentaciones->fill($request->all());
      $presentaciones->save();
      Bitacora::bitacora('update','presentacions','presentaciones',$id);
      if($presentaciones->estado)
      {
        return redirect('/presentaciones')->with('mensaje', '¡Editado!');
      }
      else{
        return redirect('/presentaciones?estado=0')->with('mensaje', '¡Editado!');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Presentacion  $presentacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      DB::beginTransaction();
      try {
        $presentaciones = Presentacion::findOrFail($id);
        $presentaciones->delete();
        Bitacora::bitacora('destroy','presentacions','presentaciones',$id);
        DB::commit();
        return redirect('/presentaciones?estado=0')->with('mensaje','¡Eliminado!');
      } catch (\Exception $e) {
        dB::rollback();
        return redirect('/presentaciones?estado=0')->with('error','¡No se puede eliminar!');
      }

    }

    public function desactivate($id){
      $presentaciones = Presentacion::find($id);
      $presentaciones->estado = false;
      $presentaciones->save();
      Bitacora::bitacora('desactivate','presentacions','presentaciones',$id);
      return Redirect::to('/presentaciones')->with('mensaje','¡Desactivado!');
    }

    public function activate($id){
      $presentaciones = Presentacion::find($id);
      $presentaciones->estado = true;
      $presentaciones->save();
      Bitacora::bitacora('activate','presentacions','presentaciones',$id);
      return Redirect::to('/presentaciones?estado=0')->with('mensaje','¡Restaurado!');
    }
    public function guardar($nombre)
    {
      $presentacion = Presentacion::create([
        'nombre'=>$nombre,
      ]);
      Bitacora::bitacora('store','presentacions','presentaciones',$presentacion->id);
      return redirect('/presentaciones')->with('mensaje', '¡Guardado!');
    }
    public function editar($id,$nombre){
      $pre=Presentacion::find($id);
      $pre->nombre=$nombre;
      $pre->save();
      Bitacora::bitacora('update','presentacions','presentaciones',$id);
      if($pre->estado)
      {
        return redirect('/presentaciones')->with('mensaje', '¡Editado!');
      }
      else{
        return redirect('/presentaciones?estado=0')->with('mensaje', '¡Editado!');
      }
    }
  public static function ingresoPresentacion(PresentacionRequest $request){
    $presentacion=Presentacion::create($request->All());
    Bitacora::bitacora('store','presentacions','presentaciones',$presentacion->id);
    return Response::json('success');
  }
  public static function llenarPresentacion(){
    $presentaciones=Presentacion::where('estado',true)->orderBy('nombre')->get(['id','nombre']);
    return Response::json($presentaciones);
  }
}
