<?php

namespace App\Http\Controllers;

use App\Consulta;
use App\Ingreso;
use App\Paciente;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function show(Consulta $consulta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function edit(Consulta $consulta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consulta $consulta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consulta $consulta)
    {
        //
    }

    //Historial del paciente
    public function historial_medico(Request $request){
        $id = $request->id;
        $paciente = Paciente::find($id);
        $count_consulta=0;
        if($paciente->ingreso->count() > 0){
            foreach($paciente->ingreso as $ingreso){
                if($ingreso->consulta != null){
                    if($ingreso->consulta->count() > 0){
                        foreach($ingreso->consulta as $consulta){
                            $count_consulta++;
                        }
                    }
                }
            }
        }

        return (compact(
            'count_consulta',
            'paciente'
        ));
    }
}
