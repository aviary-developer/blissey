<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Http\Controllers;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = Empresa::orderBy('created_at','desc')->first();
        return view('Empresa.index',compact('empresa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $cantidad = Empresa::count();
        // if($cantidad < 1)
        // {
            return view('Empresa.create');
        // }
        // return redirect('/grupo_promesa');
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
        try {
            $empresa = Empresa::create($request->All());
            if ($request->hasfile('logo_hospital')) {
                $empresa->logo_hospital = $request->file('logo_hospital')->store('public/logo');
            }
            if ($request->hasfile('logo_clinica')) {
                $empresa->logo_clinica = $request->file('logo_clinica')->store('public/logo');
            }
            if ($request->hasfile('logo_laboratorio')) {
                $empresa->logo_laboratorio = $request->file('logo_laboratorio')->store('public/logo');
            }
            if ($request->hasfile('logo_farmacia')) {
                $empresa->logo_farmacia = $request->file('logo_farmacia')->store('public/logo');
            }
            $empresa->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return redirect('/grupo_promesa')->with('mensaje', 'Algo salio mal');
        }
        Bitacora::bitacora('store', 'empresas', 'grupo_promesa', $empresa->id);
        return redirect('/grupo_promesa')->with('mensaje', '¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit($valor)
    {
        $aux = explode('-',$valor);
        $id = $aux[0];
        $seccion = $aux[1];
        $empresa = Empresa::find($id);
        return view("Empresa.edit",compact("empresa","seccion"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try{
            $empresa = Empresa::find($id);
            $hospital = $empresa->logo_hospital;
            $laboratorio = $empresa->logo_laboratorio;
            $clinica = $empresa->logo_clinica;
            $farmacia = $empresa->logo_farmacia;
            $empresa->fill($request->all());
            if ($request->hasfile('logo_hospital')) {
                $empresa->logo_hospital = $request->file('logo_hospital')->store('public/logo');
                if($hospital != "noImgen.jpg"){
                    Storage::delete($hospital);
                }
            }
            if ($request->hasfile('logo_clinica')) {
                $empresa->logo_clinica = $request->file('logo_clinica')->store('public/logo');
                if($clinica != "noImgen.jpg"){
                    Storage::delete($clinica);
                }
            }
            if ($request->hasfile('logo_laboratorio')) {
                $empresa->logo_laboratorio = $request->file('logo_laboratorio')->store('public/logo');
                if($laboratorio != "noImgen.jpg"){
                    Storage::delete($laboratorio);
                }
            }
            
            if ($request->hasfile('logo_farmacia')) {
                $empresa->logo_farmacia = $request->file('logo_farmacia')->store('public/logo');
                if($farmacia != "noImgen.jpg"){
                    Storage::delete($farmacia);
                }
            }
            $empresa->save();
        }catch(Exception $e){
            DB::rollback();
            return redirect("/grupo_promesa")->with('mensaje','Algo salio mal');
        }
        DB::commit();
        Bitacora::bitacora('update','empresas','grupo_promesa',$id);
        return redirect("/grupo_promesa")->with('mensaje', "¡Editado!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}
