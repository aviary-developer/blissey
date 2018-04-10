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
      $ultrasonografias = ultrasonografia::buscar($nombre,$estado);
      $activos = ultrasonografia::where('estado',true)->count();
      $inactivos = ultrasonografia::where('estado',false)->count();
      return view('Ultrasonografias.index',compact(
        'ultrasonografias',
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
        return view('Ultrasonografias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      ultrasonografia::create($request->All());
      return redirect('/ultrasonografias')->with('mensaje', '¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rayosx  $rayosx
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $ultrasonografia = ultrasonografia::find($id);
      return view('Ultrasonografias.show',compact('ultrasonografia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rayosx  $rayosx
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $ultrasonografia = ultrasonografia::find($id);
      return view('Ultrasonografias.edit',compact('ultrasonografia'));
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
      $ultrasonografias = ultrasonografia::find($id);
      $ultrasonografias->fill($request->all());
      $ultrasonografias->save();
      if($ultrasonografias->estado)
      {
        return redirect('/ultrasonografias')->with('mensaje', '¡Editado!');
      }
      else{
        return redirect('/ultrasonografias?estado=0')->with('mensaje', '¡Editado!');
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
      $ultrasonografias = ultrasonografia::findOrFail($id);
      $ultrasonografias->delete();
      return redirect('/ultrasonografias?estado=0');
    }
    public function desactivate($id){
      $ultrasonografias = ultrasonografia::find($id);
      $ultrasonografias->estado = false;
      $ultrasonografias->save();
      return Redirect::to('/ultrasonografias');
    }

    public function activate($id){
      $ultrasonografias = ultrasonografia::find($id);
      $ultrasonografias->estado = true;
      $ultrasonografias->save();
      return Redirect::to('/ultrasonografias?estado=0');
    }
}
