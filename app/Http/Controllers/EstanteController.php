<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estante;
use App\Nivel;
use Redirect;
use App\Http\Requests\EstanteRequest;

class EstanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $estado = $request->get('estado');
      $codigo = $request->get('codigo');
      $estantes = Estante::buscar($codigo,$estado);
      $activos = Estante::where('estado',true)->count();
      $inactivos = Estante::where('estado',false)->count();
      return view('Estantes.index',compact('estantes','estado','codigo','activos','inactivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Estantes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstanteRequest $request)
    {
        Estante::create([
          'codigo'=>$request->codigo,
          'cantidad'=>$request->cantidad,
        ]);
        $id_estante=Estante::codigoId($request->codigo);
        for ($i=0; $i < $request->cantidad ; $i++) {
          Nivel::create([
            'f_estante'=>$id_estante,
            'numero'=>$i+1,
          ]);
        }
        return redirect('/estantes')->with('mensaje','¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $estante = Estante::find($id);
      return view('Estantes.show',compact('estante'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $estante= Estante::find($id);
      return view('Estantes.edit',compact('estante'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $estantes = Unidad::findOrFail($id);
      $estantes->delete();
      return redirect('/unidades?estado=0');
    }

    public function desactivate($id){
      $estantes = Estante::find($id);
      $estantes->estado = false;
      $estantes->save();
      return Redirect::to('/estantes');
    }
    public function activate($id){
      $estantes = Estante::find($id);
      $estantes->estado = true;
      $estantes->save();
      return Redirect::to('/estantes?estado=0');
    }
}
