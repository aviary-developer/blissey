<?php

namespace App\Http\Controllers;

use App\MuestraExamen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;
use Response;
use Carbon\Carbon;

class MuestraExamenController extends Controller
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
       $muestras = MuestraExamen::buscar($nombre,$estado);
       $activos = MuestraExamen::where('estado',true)->count();
       $inactivos = MuestraExamen::where('estado',false)->count();
       return view('Muestras.index',compact('muestras','estado','nombre','activos','inactivos'));
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         return view('Muestras.create');
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
       MuestraExamen::create($request->All());
       return redirect('/muestras')->with('mensaje', '¡Guardado!');
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
       $muestra = MuestraExamen::find($id);
       return view('Muestras.show',compact('muestra'));
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
       $muestras = MuestraExamen::find($id);
       return view('Muestras.edit',compact('muestras'));
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
       $muestras = MuestraExamen::find($id);
       $muestras->fill($request->all());
       $muestras->save();
       if($muestras->estado)
       {
         return redirect('/muestras')->with('mensaje', '¡Editado!');
       }
       else{
         return redirect('/muestras?estado=0')->with('mensaje', '¡Editado!');
       }
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
       $muestras = MuestraExamen::findOrFail($id);
       $muestras->delete();
       return redirect('/muestras?estado=0');
     }

     public function desactivate($id){
       $muestras = MuestraExamen::find($id);
       $muestras->estado = false;
       $muestras->save();
       return Redirect::to('/muestras');
     }

     public function activate($id){
       $muestras = MuestraExamen::find($id);
       $muestras->estado = true;
       $muestras->save();
       return Redirect::to('/muestras?estado=0');
     }

    public function llenarMuestrasExamenes(){
      $muestras=MuestraExamen::where('estado',true)->orderBy('nombre')->get();
      return Response::json($muestras);
    }
    public function ingresoMuestra(Request $request){
      MuestraExamen::create($request->All());
      return Response::json('success');
    }
}
