<?php

namespace App\Http\Controllers;

use App\Bitacora;
use Redirect;
use DB;
use Response;
use Carbon\Carbon;
use App\Rayosx;
use Illuminate\Http\Request;

class RayosxController extends Controller
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
      $pagina = ($request->get('page')!=null)?$request->get('page'):1;
      $pagina--;
      $pagina *= 10;
      $rayosx = Rayosx::buscar($nombre,$estado);
      $activos = Rayosx::where('estado',true)->count();
      $inactivos = Rayosx::where('estado',false)->count();
      return view('RayosX.index',compact(
        'rayosx',
        'estado',
        'nombre',
        'activos',
        'inactivos',
        'pagina'
      ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('RayosX.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Rayosx::create($request->All());
      return redirect('/rayosx')->with('mensaje', '¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rayosx  $rayosx
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $rayox = Rayosx::find($id);
      return view('RayosX.show',compact('rayox'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rayosx  $rayosx
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $rayox = Rayosx::find($id);
      return view('RayosX.edit',compact('rayox'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rayosx  $rayosx
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $rayosx = Rayosx::find($id);
      $rayosx->fill($request->all());
      $rayosx->save();
      if($rayosx->estado)
      {
        return redirect('/rayosx')->with('mensaje', '¡Editado!');
      }
      else{
        return redirect('/rayosx?estado=0')->with('mensaje', '¡Editado!');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rayosx  $rayosx
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $rayosx = Rayosx::findOrFail($id);
      $rayosx->delete();
      return redirect('/rayosx?estado=0');
    }
    public function desactivate($id){
      $rayosx = Rayosx::find($id);
      $rayosx->estado = false;
      $rayosx->save();
      return Redirect::to('/rayosx');
    }

    public function activate($id){
      $rayosx = Rayosx::find($id);
      $rayosx->estado = true;
      $rayosx->save();
      return Redirect::to('/rayosx?estado=0');
    }
}
