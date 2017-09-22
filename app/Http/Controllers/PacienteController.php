<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Paciente;
use Redirect;
use Carbon\Carbon;

class PacienteController extends Controller
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
        $pacientes = Paciente::buscar($nombre,$estado);
        return view('Pacientes.index',compact('pacientes','estado','nombre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Paciente::create($request->All());
        return redirect('/pacientes')->with('mensaje', '¡Hecho!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pacientes = Paciente::find($id);
        return view('Pacientes.edit',compact('pacientes'));
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
        $pacientes = Paciente::find($id);
        $pacientes->fill($request->all());
        $pacientes->save();
        return redirect('/pacientes')->with('mensaje', '¡Hecho!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pacientes = Paciente::findOrFail($id);
        $pacientes->delete();
        return redirect('/pacientes');
    }

    public function desactivate($id){
      $pacientes = Paciente::find($id);
      $pacientes->estado = false;
      $pacientes->save();
      return Redirect::to('/pacientes');
    }

    public function activate($id){
      $pacientes = Paciente::find($id);
      $pacientes->estado = true;
      $pacientes->save();
      return Redirect::to('/pacientes');
    }
}
