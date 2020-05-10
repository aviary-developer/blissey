<?php

namespace App\Http\Controllers;

use App\SignoVital;
use Illuminate\Http\Request;
use App\Bitacora;
use DB;

class SignoVitalController extends Controller
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
        return view('Signos.create');
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
            $ultimo = SignoVital::where('f_ingreso',$request->f_ingreso)->first();
            $signos = SignoVital::create($request->All());
            if($ultimo !=null && $signos->altura == null){
                $signos->altura = $ultimo->altura;
                $signos->save();
            }
            Bitacora::bitacora('store','signo_vitals','signos',$signos->id);
            DB::commit();
            return 3;
        }catch(Exception $e){
            DB::rollback();
            return 0;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SignoVital  $signoVital
     * @return \Illuminate\Http\Response
     */
    public function show(SignoVital $signoVital)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SignoVital  $signoVital
     * @return \Illuminate\Http\Response
     */
    public function edit(SignoVital $signoVital)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SignoVital  $signoVital
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SignoVital $signoVital)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SignoVital  $signoVital
     * @return \Illuminate\Http\Response
     */
    public function destroy(SignoVital $signoVital)
    {
        //
    }

    public function listar(Request $request){
        $id = $request->id;
        $signos = SignoVital::where('f_ingreso',$id)->orderBy('created_at','asc')->get();
        return $signos;
    }

    public function ver_signo(Request $request){
        $id = $request->id;
        $signos = SignoVital::find($id);
        setlocale(LC_ALL,'es');
        $fecha = $signos->created_at->formatLocalized('%d de %B de %Y a las %H:%M');
        $sexo = $signos->ingreso->hospitalizacion->paciente->sexo;
        $edad = $signos->ingreso->hospitalizacion->paciente->fechaNacimiento->age;
        return (compact('signos','fecha','sexo','edad'));
    }
}
