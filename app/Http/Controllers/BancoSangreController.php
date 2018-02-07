<?php

namespace App\Http\Controllers;

use App\BancoSangre;
use App\Bitacora;
use Redirect;
use DB;
use Response;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BancoSangreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $estado = $request->get('estado');
      $nombre = $request->get('tipoSangre');
      $donaciones = BancoSangre::buscar($nombre,$estado);
      $activos = BancoSangre::where('estado',true)->count();
      $inactivos = BancoSangre::where('estado',false)->count();
      return view('BancoSangre.index',compact('donaciones','estado','nombre','activos','inactivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('BancoSangre.create');
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
        $donacion = BancoSangre::create($request->All());
        if($request->hasfile('pruebaCruzada')){
          $donacion->pruebaCruzada = $request->file('pruebaCruzada')->store('public/pruebaCruzada');
        }
        $donacion->save();
        DB::commit();
      }catch(Exception $e){
        DB::rollback();
        return redirect('/bancosangre')->with('mensaje', '¡Algo salio mal!');
      }
      Bitacora::bitacora('store','banco_sangres','bancosangre',$donacion->id);
      return redirect('/bancosangre')->with('mensaje', '¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BancoSangre  $bancoSangre
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donacion=BancoSangre::find($id);
        //return \PDF::loadView('BancoSangre.pruebaCruzada',compact('donacion'))->stream('Prueba_Cruzada_'.$donacion->id.'.pdf');
        return view('BancoSangre.show',compact('donacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BancoSangre  $bancoSangre
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $donacion = BancoSangre::find($id);
      return view('BancoSangre.edit',compact('donacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BancoSangre  $bancoSangre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $donacionAnterior = BancoSangre::find($id);
      $donacion = BancoSangre::find($id);
      $donacion->fill($request->all());
      if($request->hasfile('pruebaCruzada')){
        $donacion->pruebaCruzada = $request->file('pruebaCruzada')->store('public/pruebaCruzada');
      }else {
        $donacion->pruebaCruzada=$donacionAnterior->pruebaCruzada;
      }
      $donacion->save();
      if($donacion->estado)
      {
        return redirect('/bancosangre')->with('mensaje', '¡Editado!');
      }
      else{
        return redirect('/bancosangre?estado=0')->with('mensaje', '¡Editado!');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BancoSangre  $bancoSangre
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $donacion = BancoSangre::findOrFail($id);
      $donacion->delete();
      return redirect('/bancosangre?estado=0');
    }

    public function desactivate($id){
      $donacion = BancoSangre::find($id);
      $donacion->estado = false;
      $donacion->save();
      return Redirect::to('/bancosangre');
    }

    public function activate($id){
      $donacion = BancoSangre::find($id);
      $donacion->estado = true;
      $donacion->save();
      return Redirect::to('/bancosangre?estado=0');
    }
}