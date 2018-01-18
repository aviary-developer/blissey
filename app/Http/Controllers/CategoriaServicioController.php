<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoriaServicio;
use App\Bitacora;
use Redirect;
use App\Http\Requests\CategoriaServicioRequest;

class CategoriaServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pagina = ($request->get('page')!=null)?$request->get('page'):1;
        $pagina--;
        $pagina *= 10;
        $estado = $request->get('estado');
        $nombre = $request->get('nombre');
        $categoria_servicios = CategoriaServicio::buscar($nombre,$estado);
        $activos = CategoriaServicio::where('estado',true)->count();
        $inactivos = CategoriaServicio::where('estado',false)->count();
        return view('CategoriaServicios.index',compact(
          'categoria_servicios',
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
        return view('CategoriaServicios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaServicioRequest $request)
    {
      $categoria_servicios = CategoriaServicio::create($request->All());
      Bitacora::bitacora('store','categoria_servicios','categoria_servicios',$categoria_servicios->id);
      return redirect('/categoria_servicios')->with('mensaje', '¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $categoria_servicio = CategoriaServicio::find($id);
      return view('CategoriaServicios.show',compact('categoria_servicio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $categoria_servicios = CategoriaServicio::find($id);
      return view('CategoriaServicios.edit',compact('categoria_servicios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaServicioRequest $request, $id)
    {
      $categoria_servicios = CategoriaServicio::find($id);
      $categoria_servicios->fill($request->all());
      $categoria_servicios->save();
      Bitacora::bitacora('update','categoria_servicios','categoria_servicios',$id);
      if($categoria_servicios->estado)
      {
        return redirect('/categoria_servicios')->with('mensaje', '¡Editado!');
      }
      else{
        return redirect('/categoria_servicios?estado=0')->with('mensaje', '¡Editado!');
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
        $categoria_servicios = CategoriaServicio::findOrFail($id);
        $categoria_servicios->delete();
        Bitacora::bitacora('destroy','categoria_servicios','categoria_servicios',$id);
        return redirect('/categoria_servicios?estado=0');
    }

    public function desactivate($id){
      $categoria_servicios = CategoriaServicio::find($id);
      $categoria_servicios->estado = false;
      $categoria_servicios->save();
      Bitacora::bitacora('desactivate','categoria_servicios','categoria_servicios',$id);
      return Redirect::to('/categoria_servicios');
    }

    public function activate($id){
      $categoria_servicios = CategoriaServicio::find($id);
      $categoria_servicios->estado = true;
      $categoria_servicios->save();
      Bitacora::bitacora('activate','categoria_servicios','categoria_servicios',$id);
      return Redirect::to('/categoria_servicios?estado=0');
    }
}
