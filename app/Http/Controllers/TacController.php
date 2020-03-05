<?php

namespace App\Http\Controllers;

use App\Bitacora;
use Redirect;
use DB;
use Response;
use App\CategoriaServicio;
use App\Servicio;
use App\Tac;
use Illuminate\Http\Request;

class TacController extends Controller
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
      $tacs = Tac::buscar($nombre,$estado);
      $activos = Tac::where('estado',true)->count();
      $inactivos = Tac::where('estado',false)->count();
      return view('Tac.index',compact(
        'tacs',
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
        return view('Tac.create');
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
        $tacNuevo = new Tac;
        $tacNuevo->nombre=$request->nombre;
        $tacNuevo->save();
        //Crear una categoria de servicio asociada a los examen
        $categoria_existe = CategoriaServicio::where('nombre','TAC')->first();

        if($categoria_existe==null){
          $categoria_existe = new CategoriaServicio;
          $categoria_existe->nombre = "TAC";
          $categoria_existe->save();
        }

        $servicio = new Servicio;
        $servicio->nombre = $request->nombre;
        $servicio->f_categoria = $categoria_existe->id;
        $servicio->precio = $request->precio;
        $servicio->f_tac = $tacNuevo->id;
        $servicio->save();
      }catch(\Exception $e){
        DB::rollback();
        return $e;
        return redirect('/tacs')->with('mensaje', $e);
      }
      DB::commit();
      Bitacora::bitacora('store','tacs','tacs',$tacNuevo->id);
      return redirect('/tacs')->with('mensaje', '¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $tac = Tac::find($id);
      $servicio = Servicio::where('f_tac',$id)->first();
      return view('Tac.show',compact('tac','servicio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $servicio =Servicio::where('f_tac',$id)->first();
      $precio=$servicio->precio;
      $tac = Tac::find($id);
      return view('Tac.edit',compact('tac','precio'));
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
      $servicio =Servicio::where('f_tac',$id)->first();
      $servicio->precio=$request->precio;
      $servicio->save();
      $tac = Tac::find($id);
      $tac->fill($request->all());
      $tac->save();
      Bitacora::bitacora('update','tacs','tacs',$id);

      if($tac->estado)
      {
        return redirect('/tacs')->with('mensaje', '¡Editado!');
      }
      else{
        return redirect('/tacs?estado=0')->with('mensaje', '¡Editado!');
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
      DB::beginTransaction();
      try{
      $servicio =Servicio::where('f_tac',$id)->first();
      $servicio->delete();
      $tac = Tac::findOrFail($id);
      $tac->delete();
      }catch(\Exception $e){
        DB::rollback();
        return redirect('/tacs?estado=0')->with('error', " ");
      }
      Bitacora::bitacora('destroy','tacs','tacs',$id);
      DB::commit();
      return redirect('/tacs?estado=0')->with('mensaje',' ');
    }
    public function desactivate($id){
      $tac = Tac::find($id);
      $tac->estado = false;
      $tac->save();
      $servicio =Servicio::where('f_tac',$id)->first();
      $servicio->estado=0;
      $servicio->save();
      Bitacora::bitacora('desactivate','tacs','tacs',$id);
      return Redirect::to('/tacs');
    }

    public function activate($id){
      $tac = Tac::find($id);
      $tac->estado = true;
      $tac->save();
      $servicio =Servicio::where('f_tac',$id)->first();
      $servicio->estado=1;
      $servicio->save();
      Bitacora::bitacora('activate','tacs','tacs',$id);
      return Redirect::to('/tacs?estado=0');
    }
    public function actualizarPrecioTac(Request $request){
      $servicio = Servicio::find($request->idServicio);
      $servicio->precio=$request->precio;
      $servicio->save();
      return Response::json('sucess');
    }
}
