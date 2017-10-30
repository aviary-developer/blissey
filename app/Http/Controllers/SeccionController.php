<?php

namespace App\Http\Controllers;

use App\Seccion;
use Illuminate\Http\Request;
use Redirect;
use Response;
use Carbon\Carbon;

class SeccionController extends Controller
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
      $secciones = Seccion::buscar($nombre,$estado);
      $activos = Seccion::where('estado',true)->count();
      $inactivos = Seccion::where('estado',false)->count();
      return view('Secciones.index',compact('secciones','estado','nombre','activos','inactivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Secciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Seccion::create($request->All());
      return redirect('/secciones')->with('mensaje', '¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seccion  $seccion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $seccion = Seccion::find($id);
      return view('Secciones.show',compact('seccion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seccion  $seccion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $secciones = Seccion::find($id);
      return view('Secciones.edit',compact('secciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seccion  $seccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
      $secciones = Seccion::find($id);
      $secciones->fill($request->all());
      $secciones->save();
      if($secciones->estado)
      {
        return redirect('/secciones')->with('mensaje', '¡Editado!');
      }
      else{
        return redirect('/secciones?estado=0')->with('mensaje', '¡Editado!');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seccion  $seccion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $secciones = Seccion::findOrFail($id);
      $secciones->delete();
      return redirect('/secciones?estado=0');
    }
    public function desactivate($id){
      $secciones = Seccion::find($id);
      $secciones->estado = false;
      $secciones->save();
      return Redirect::to('/secciones');
    }

    public function activate($id){
      $secciones = Seccion::find($id);
      $secciones->estado = true;
      $secciones->save();
      return Redirect::to('/secciones?estado=0');
    }
    public function llenarSeccionExamenes(){
      $secciones=Seccion::where('estado',true)->get();
      return Response::json($secciones);
    }
}