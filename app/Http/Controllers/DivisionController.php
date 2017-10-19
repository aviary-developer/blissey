<?php

namespace App\Http\Controllers;

use App\Division;
use Illuminate\Http\Request;
use App\Http\Requests\DivisionRequest;

class DivisionController extends Controller
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
      $divisiones = Division::buscar($nombre,$estado);
      $activos = Division::where('estado',true)->count();
      $inactivos = Division::where('estado',false)->count();
      return view('Divisiones.index',compact('divisiones','estado','nombre','activos','inactivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Divisiones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DivisionRequest $request)
    {
      $division=new Division;
      $division->fill($request->all());
      $division->save();
        return redirect('/divisiones')->with('mensaje','¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function show(Division $division)
    {
          return view('Divisiones.show',compact('division'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function edit(Division $division)
    {
        return view('Divisiones.edit',compact('division'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Division $division)
    {
      if($request->nombre==$division->nombre){
        return redirect('/divisiones?estado'.$division->estado)->with('info', '¡No hay cambios!');
      }else{
        $validar['nombre']='required';
        $this->validate($request,$validar);
        $division->fill($request->all());
        $division->save();
        return redirect('/divisiones')->with('mensaje','¡Editado!');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $division = Division::findOrFail($id);
      $division->delete();
      return redirect('/divisiones?estado=0');
    }

    public function desactivate($id){
      $divisiones = Division::find($id);
      $divisiones->estado = false;
      $divisiones->save();
      return Redirect::to('/divisiones');
    }
    public function activate($id){
      $divisiones = Division::find($id);
      $divisiones->estado = true;
      $divisiones->save();
      return Redirect::to('/divisiones?estado=0');
    }
}
