<?php

namespace App\Http\Controllers;

use App\Bitacora;
use Redirect;
use DB;
use Response;
use App\Http\Requests\RayoxRequest;
use App\CategoriaServicio;
use App\Servicio;
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
      DB::beginTransaction();
      try{
        $rayoIngresado=Rayosx::where('nombre','=',$request->nombre)->count();
        if($rayoIngresado>0){
          return redirect('/rayosx')->with('error',"ERROR");
        }else{
        $rayoxNuevo = Rayosx::create([
          "nombre"=>$request->nombre
        ]);
        //Crear una categoria de servicio asociada a los examen
        $categoria_existe = CategoriaServicio::where('nombre','Rayos X')->first();

        if($categoria_existe==null){
          $categoria_existe = new CategoriaServicio;
          $categoria_existe->nombre = "Rayos X";
          $categoria_existe->save();
        }

        $servicio = new Servicio;
        $servicio->nombre = $request->nombre;
        $servicio->f_categoria = $categoria_existe->id;
        $servicio->precio = $request->precio;
        $servicio->f_rayox = $rayoxNuevo->id;
        $servicio->save();
      }
      }catch(\Exception $e){
        DB::rollback();
        return $e;
        return redirect('/rayosx')->with('mensaje', $e);
      }
      DB::commit();
      Bitacora::bitacora('store','rayosxes','rayosx',$rayoxNuevo->id);
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
      $servicio = Servicio::where('f_rayox',$id)->first();
      return view('RayosX.show',compact('rayox','servicio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rayosx  $rayosx
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $servicio =Servicio::where('f_rayox',$id)->first();
      $precio=$servicio->precio;
      $rayox = Rayosx::find($id);
      return view('RayosX.edit',compact('rayox','precio'));
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
      $servicio =Servicio::where('f_rayox',$id)->first();
      $servicio->precio=$request->precio;
      $servicio->save();
      $rayosx = Rayosx::find($id);
      $rayosx->fill($request->all());
      $rayosx->save();
      Bitacora::bitacora('update','rayosxes','rayosx',$id);
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
      DB::beginTransaction();
      try{
      $servicio =Servicio::where('f_rayox',$id)->first();
      $servicio->delete();
      $rayosx = Rayosx::findOrFail($id);
      $rayosx->delete();
      }catch(\Exception $e){
        DB::rollback();
        return redirect('/rayosx?estado=0')->with('error', " ");
      }
      Bitacora::bitacora('destroy','rayosxes','rayosx',$id);
      DB::commit();
      return redirect('/rayosx?estado=0')->with('mensaje',' ');
    }
    public function desactivate($id){
      $rayosx = Rayosx::find($id);
      $rayosx->estado = false;
      $rayosx->save();
      $servicio =Servicio::where('f_rayox',$id)->first();
      $servicio->estado=0;
      $servicio->save();
      Bitacora::bitacora('desactivate','rayosxes','rayosx',$id);
      return Redirect::to('/rayosx')->with('mensaje','¡Desactivado!');
    }

    public function activate($id){
      $rayosx = Rayosx::find($id);
      $rayosx->estado = true;
      $rayosx->save();
      $servicio =Servicio::where('f_rayox',$id)->first();
      $servicio->estado=1;
      $servicio->save();
      Bitacora::bitacora('activate','rayosxes','rayosx',$id);
      return Redirect::to('/rayosx?estado=0')->with('mensaje','¡Restaurado!');
    }
    public function actualizarPrecioRayox(Request $request){
      $servicio = Servicio::find($request->idServicio);
      $servicio->precio=$request->precio;
      $servicio->save();
      Bitacora::bitacora('store','rayosxes','rayosx',$request->idServicio);
      return Response::json('sucess');
    }
}
