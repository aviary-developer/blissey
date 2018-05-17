<?php

namespace App\Http\Controllers;

use App\Consulta;
use App\Ingreso;
use App\Paciente;
use App\Bitacora;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

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
        DB::beginTransaction();
        try{
            $consulta = Consulta::create($request->All());
            $consulta->f_medico = Auth::user()->id;
            $consulta->save();
            DB::commit();
            Bitacora::bitacora('store', 'consultas', 'consultas', $consulta->id);
        }catch(Exception $e){
            DB::rollback();
            return 0;
        }
        return 1;
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
        setlocale(LC_ALL,'es');
        $paciente = Paciente::find($id);
        $count_consulta=0;
        $consultar =[];
        if($paciente->ingreso->count() > 0){
            $i = 0;
            foreach($paciente->ingreso as $ingreso){
                if($ingreso->consulta != null){
                    if($ingreso->consulta->count() > 0){
                        foreach($ingreso->consulta as $consulta){
                            $count_consulta++;
                            $consultar[$i]['fecha'] = $consulta->created_at->formatLocalized('%d de %B de %Y a las %H:%M');
                            $consultar[$i]['motivo'] = $consulta->motivo;
                            $consultar[$i]['historia'] = $consulta->historia;
                            $consultar[$i]['ex_fisico'] = $consulta->examen_fisico;
                            $consultar[$i]['diagnostico'] = $consulta->diagnostico;
                            $i++;
                        }
                    }
                }
            }
        }
        $edad = $paciente->fechaNacimiento->age;
        return (compact(
            'count_consulta',
            'paciente',
            'edad',
            'consultar'
        ));
    }
}
