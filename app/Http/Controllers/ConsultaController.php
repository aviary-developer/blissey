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

    //Consulta medica
    public function consulta(Request $request){
        $consulta = Consulta::find($request->id);
        setlocale(LC_ALL,'es');
        $fecha = $consulta->created_at->formatLocalized('%d de %B de %Y a las %H:%M');
        $medico = (($consulta->medico->sexo)?'Dr. ':'Dra. ').$consulta->medico->nombre.' '.$consulta->medico->apellido;
        return (compact('consulta','medico','fecha'));
    }

    public function ingresos(Request $request){
        $consultas = Consulta::where('f_ingreso',$request->id)->orderBy('created_at','desc')->get();
        setlocale(LC_ALL,'es');
        $fechas = [];
        $medicos = [];
        foreach($consultas as $k => $consulta){
            $fechas[$k] = $consulta->created_at->formatLocalized('%d de %B de %Y a las %H:%M');
            $medicos[$k] = (($consulta->medico->sexo)?'Dr. ':'Dra. ').$consulta->medico->nombre.' '.$consulta->medico->apellido;
        }
        return (compact('consultas','medicos','fechas'));
    }
}
