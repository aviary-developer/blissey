<?php

namespace App\Http\Controllers;

use App\Componente;
use Illuminate\Http\Request;
use App\Http\Requests\ComponenteRequest;
use Redirect;
use Response;
use App\Bitacora;
use DB;

class ComponenteController extends Controller
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
      $componentes = Componente::buscar($estado);
      $activos = Componente::where('estado',true)->count();
      $inactivos = Componente::where('estado',false)->count();
      return view('Componentes.index',compact(
        'componentes',
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
        return view('Componentes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComponenteRequest $request)
    {
      $componente=new Componente();
      $componente->fill($request->all());
      $componente->save();
      Bitacora::bitacora('store','componentes','componentes',$componente->id);
      return redirect('/componentes')->with('mensaje','¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Componente  $componente
     * @return \Illuminate\Http\Response
     */
    public function show(Componente $componente)
    {
        return view('Componentes.show',compact('componente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Componente  $componente
     * @return \Illuminate\Http\Response
     */
    public function edit(Componente $componente)
    {
        return view('Componentes.edit',compact('componente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Componente  $componente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Componente $componente)
    {
        if($request->nombre==$componente->nombre){
          return redirect('/componentes?estado'.$componente->estado)->with('info', '¡No hay cambios!');
        }else{
          $validar['nombre']='required';
          $this->validate($request,$validar);
          $componente->fill($request->all());
          $componente->save();
          Bitacora::bitacora('update','componentes','componentes',$componente->id);
          return redirect('/componentes')->with('mensaje','¡Editado!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Componente  $componente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      DB::beginTransaction();
      try {
        $componente = Componente::findOrFail($id);
        $componente->delete();
        Bitacora::bitacora('destroy','componentes','componentes',$id);
        DB::commit();
        return redirect('/componentes?estado=0');
      } catch (\Exception $e) {
        DB::rollback();
        return redirect('/componentes?estado=0');
      }
    }

    public function desactivate($id){
      $componentes = Componente::find($id);
      $componentes->estado = false;
      $componentes->save();
      Bitacora::bitacora('desactivate','componentes','componentes',$id);
      return Redirect::to('/componentes');
    }
    public function activate($id){
      $componentes = Componente::find($id);
      $componentes->estado = true;
      $componentes->save();
      Bitacora::bitacora('activate','componentes','componentes',$id);
      return Redirect::to('/componentes?estado=0');
    }
    public static function ingresoComponente(ComponenteRequest $request){
      $c=Componente::create($request->All());
      Bitacora::bitacora('store','componentes','componentes',$c->id);
      return Response::json('success');
    }
}
