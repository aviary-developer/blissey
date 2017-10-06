<?php

namespace App\Http\Controllers;
use App\Dependiente;
use Illuminate\Http\Request;

class DependienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $id_proveedor=$request->id;
      $estado=$request->estado;
      $nombre=$request->nombre;
      $visitadores=Dependiente::buscar($id_proveedor,$estado,$nombre);
      $activos = Dependiente::where('f_proveedor','=',$id_proveedor)->where('estado',true)->count();
      $inactivos = Dependiente::where('f_proveedor','=',$id_proveedor)->where('estado',false)->count();
      return view('Visitadores.index',compact('id_proveedor','estado','nombre','visitadores','activos','inactivos'));

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
        //
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
        //
    }
    public function desactivate($id){
      $dependiente= Dependiente::find($id);
      $dependiente->estado = false;
      $dependiente->save();
      return Redirect::to('/visistadores');
    }

    public function activate($id){
      $dependiente = Dependiente::find($id);
      $dependiente->estado = true;
      $dependiente->save();
      return Redirect::to('/proveedores?estado=0');
    }
}
