<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Paciente;
use App\Bitacora;
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
        $activos = Paciente::where('estado',true)->count();
        $inactivos = Paciente::where('estado',false)->count();
        return view('Pacientes.index',compact('pacientes','estado','nombre','activos','inactivos'));
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
        $pacientes = Paciente::create($request->All());
        Bitacora::bitacora('store','pacientes','pacientes',$pacientes->id);
        return redirect('/pacientes')->with('mensaje', '¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paciente = Paciente::find($id);
        return view('Pacientes.show',compact('paciente'));
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
        Bitacora::bitacora('update','pacientes','pacientes',$id);
        if($pacientes->estado)
        {
          return redirect('/pacientes')->with('mensaje', '¡Editado!');
        }
        else{
          return redirect('/pacientes?estado=0')->with('mensaje', '¡Editado!');
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
        $pacientes = Paciente::findOrFail($id);
        $pacientes->delete();
        Bitacora::bitacora('destroy','pacientes','pacientes',$id);
        return redirect('/pacientes?estado=0');
    }

    public function desactivate($id){
      $pacientes = Paciente::find($id);
      $pacientes->estado = false;
      $pacientes->save();
      Bitacora::bitacora('desactivate','pacientes','pacientes',$id);
      return Redirect::to('/pacientes');
    }

    public function activate($id){
      $pacientes = Paciente::find($id);
      $pacientes->estado = true;
      $pacientes->save();
      Bitacora::bitacora('activate','pacientes','pacientes',$id);
      return Redirect::to('/pacientes?estado=0');
    }
}
