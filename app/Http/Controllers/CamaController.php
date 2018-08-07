<?php

namespace App\Http\Controllers;

use App\Cama;
use App\Servicio;
use App\CategoriaServicio;
use Illuminate\Http\Request;
use DB;

class CamaController extends Controller
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
     * @param  \App\Cama  $cama
     * @return \Illuminate\Http\Response
     */
    public function show(Cama $cama)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cama  $cama
     * @return \Illuminate\Http\Response
     */
    public function edit(Cama $cama)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cama  $cama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cama $cama)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cama  $cama
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cama $cama)
    {
        //
    }

    public function desactivate(Request $request){
        $id = $request->id;
        $cama = Cama::find($id);
        $servicio = Servicio::find($cama->servicio->id);
        DB::beginTransaction();
        try{
            $cama->estado = true;
            $cama->save();
            
            $servicio->estado = false;
            $servicio->save();

            DB::commit();
            return 1;
        }catch(Exception $e)
        {
            DB::rollback();
            return 0;
        }
    }

    public function activate(Request $request){
        $id = $request->id;
        $cama = Cama::find($id);
        $servicio = Servicio::find($cama->servicio->id);
        DB::beginTransaction();
        try{
            $cama->estado = false;
            $cama->save();
            
            $servicio->estado = true;
            $servicio->save();

            DB::commit();
            return 1;
        }catch(Exception $e)
        {
            DB::rollback();
            return 0;
        }
    }

     public function editar_precio(Request $request){
        $id = $request->id;
        $precio = $request->precio;
        $cama = Cama::find($id);
        $servicio = Servicio::find($cama->servicio->id);
        DB::beginTransaction();
        try{
            $cama->precio = $precio;
            $cama->save();
            
            $servicio->precio = $precio;
            $servicio->save();

            DB::commit();
            return 1;
        }catch(Exception $e)
        {
            DB::rollback();
            return 0;
        }
    }

    
    public function nueva_cama(Request $request){
        DB::beginTransaction();

        try {
            $categoria_existe = CategoriaServicio::where('nombre','Cama')->first();

            if($categoria_existe == null){
            $categoria_existe = new CategoriaServicio;
            $categoria_existe->nombre = "Cama";
            $categoria_existe->save();
            }

            $cama_ = new Cama;
            $cama_->numero = $request->numero;
            $cama_->precio = $request->precio;
            $cama_->f_habitacion = $request->id;
            $cama_->save();

            $servicio = new Servicio;
            if($request->tipo == 0){
            $servicio->nombre = 'Cama O'.$cama_->numero;
            }else if($request->tipo == 1){
            $servicio->nombre = 'Cama I'.$cama_->numero;
            }else{
            $servicio->nombre = 'Cama M'.$cama_->numero;
            }
            $servicio->precio = $cama_->precio;
            $servicio->f_categoria = $categoria_existe->id;
            $servicio->f_cama = $cama_->id;
            $servicio->save();

        } catch (Exception $e) {
            DB::rollback();
            return 0;
        }
        DB::commit();
        return 1;
    }
}
