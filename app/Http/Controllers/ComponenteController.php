<?php

namespace App\Http\Controllers;

use App\Componente;
use Illuminate\Http\Request;
use App\Http\Requests\ComponenteRequest;

class ComponenteController extends Controller
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
      $componentes = Componente::buscar($nombre,$estado);
      $activos = Componente::where('estado',true)->count();
      $inactivos = Componente::where('estado',false)->count();
      return view('Componentes.index',compact('componentes','estado','codigo','nombre','inactivos'));
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
      $componente=new Componente;
      $componente->fill($request->all());
      $componente->save();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Componente  $componente
     * @return \Illuminate\Http\Response
     */
    public function edit(Componente $componente)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Componente  $componente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Componente $componente)
    {
        //
    }
}
