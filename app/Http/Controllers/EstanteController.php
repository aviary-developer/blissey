<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estante;
use App\Nivel;
use Redirect;
use App\Bitacora;
use App\Http\Requests\EstanteRequest;
use DB;

class EstanteController extends Controller
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
      $estantes = Estante::buscar($estado);
      $activos = Estante::where('estado',true)->count();
      $inactivos = Estante::where('estado',false)->count();
      return view('Estantes.index',compact(
        'estantes',
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
        return view('Estantes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $estante=new Estante;
      $estante->fill($request->all());
      $estante->save();
        Bitacora::bitacora('store','estantes','estantes',$estante->id);
        return redirect('/estantes')->with('mensaje','¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $estante = Estante::find($id);
      return view('Estantes.show',compact('estante'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $estante= Estante::find($id);
      return view('Estantes.edit',compact('estante'));
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
        $estante=Estante::find($id);
        $nv=1; //No necesita validar = true
        if($estante->codigo!=$request->codigo){
          $nv=0;
          $validar['codigo']='required | min:1 | max:5';

          $mensaje['codigo.required']='El campo código identificador es obligatorio';
          $mensaje['codigo.min']='El campo código identificador necesita 1 caracteres mínimos';
          $mensaje['codigo.max']='El campo código identificador necesita 3 caracteres máximo';
        }
        if($estante->cantidad!=$request->cantidad){
          $nv=0;
          $validar['cantidad']='required';
          $mensaje['cantidad.required']='El campo n° de niveles es obligatorio';
        }
        if($estante->localizacion!=$request->localizacion){
          $nv=0;
          $validar['localizacion']='required';
          $mensaje['localizacion.required']='El campo localización es obligatorio';
        }
        if($nv==1){
          return redirect('/estantes?estado'.$estante->estado)->with('info', '¡No hay cambios!');
        }
        else{
          $this->validate($request,$validar,$mensaje);
          $estante->fill($request->all());
          $estante->save();
          Bitacora::bitacora('update','estantes','estantes',$estante->id);
          return redirect('/estantes')->with('mensaje','¡Editado!');
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
        $estantes = Estante::findOrFail($id);
        $estantes->delete();
        Bitacora::bitacora('destroy','estantes','estantes',$id);
        DB::commit();
        return redirect('/estantes?estado=0');
      } catch (\Exception $e) {
        DB::rollback();
        return redirect('/estantes?estado=0');
      }
    }

    public function desactivate($id){
      $estantes = Estante::find($id);
      $estantes->estado = false;
      $estantes->save();
      Bitacora::bitacora('desactivate','estantes','estantes',$id);
      return Redirect::to('/estantes');
    }
    public function activate($id){
      $estantes = Estante::find($id);
      $estantes->estado = true;
      $estantes->save();
      Bitacora::bitacora('activate','estantes','estantes',$id);
      return Redirect::to('/estantes?estado=0');
    }
}
