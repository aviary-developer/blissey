<?php

namespace App\Http\Controllers;

use App\Bitacora;
use Redirect;
use DB;
use Response;
use App\CategoriaServicio;
use App\Servicio;
use App\ultrasonografia;
use Illuminate\Http\Request;
use App\Http\Requests\UltrasonografiaRequest;

class UltrasonografiaController extends Controller
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
      $ultrasonografias = ultrasonografia::buscar($nombre,$estado);
      $activos = ultrasonografia::where('estado',true)->count();
      $inactivos = ultrasonografia::where('estado',false)->count();
      return view('Ultrasonografias.index',compact(
        'ultrasonografias',
        'estado',
        'nombre',
        'activos',
        'inactivos'
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
     public function store(UltrasonografiaRequest $request)
     {
       DB::beginTransaction();
       try{
         $ultraNueva = new ultrasonografia;
         $ultraNueva->nombre=$request->nombre;
         $ultraNueva->save();
         //Crear una categoria de servicio asociada a los examen
         $categoria_existe = CategoriaServicio::where('nombre','Ultrasonografía')->first();

         if($categoria_existe==null){
           $categoria_existe = new CategoriaServicio;
           $categoria_existe->nombre = "Ultrasonografía";
           $categoria_existe->save();
         }

         $servicio = new Servicio;
         $servicio->nombre = $request->nombre;
         $servicio->f_categoria = $categoria_existe->id;
         $servicio->precio = $request->precio;
         $servicio->f_ultrasonografia = $ultraNueva->id;
         $servicio->save();
       }catch(\Exception $e){
         DB::rollback();
         return $e;
         return redirect('/ultrasonografias')->with('mensaje', $e);
       }
       DB::commit();
       Bitacora::bitacora('store','ultrasonografias','ultrasonografias',$ultraNueva->id);
       return redirect('/ultrasonografias')->with('mensaje', '¡Guardado!');
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\ultrasonografia  $ultrasonografia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $ultrasonografia = ultrasonografia::find($id);
      $servicio = Servicio::where('f_ultrasonografia',$id)->first();
      return view('Ultrasonografias.show',compact('ultrasonografia','servicio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ultrasonografia  $ultrasonografia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $servicio =Servicio::where('f_ultrasonografia',$id)->first();
      $precio=$servicio->precio;
      $ultrasonografia = ultrasonografia::find($id);
      return view('Ultrasonografias.edit',compact('ultrasonografia','precio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ultrasonografia  $ultrasonografia
     * @return \Illuminate\Http\Response
     */
    public function update(UltrasonografiaRequest $request, $id)
    {
      $servicio =Servicio::where('f_ultrasonografia',$id)->first();
      $servicio->precio=$request->precio;
      $servicio->save();
      $ultrasonografias = ultrasonografia::find($id);
      $ultrasonografias->fill($request->all());
      $ultrasonografias->save();
      Bitacora::bitacora('update','ultrasonografias','ultrasonografias',$id);
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
     * @param  \App\ultrasonografia  $ultrasonografia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      DB::beginTransaction();
      try{
      $servicio =Servicio::where('f_ultrasonografia',$id)->first();
      $servicio->delete();
      $ultrasonografia = ultrasonografia::findOrFail($id);
      $ultrasonografia->delete();
      }catch(\Exception $e){
        DB::rollback();
        return redirect('/ultrasonografias?estado=0')->with('error', " ");
      }
      Bitacora::bitacora('destroy','ultrasonografias','ultrasonografias',$id);
      DB::commit();
      return redirect('/ultrasonografias?estado=0')->with('mensaje',' ');
    }

    public function desactivate($id){
      $ultrasonografias = ultrasonografia::find($id);
      $ultrasonografias->estado = false;
      $ultrasonografias->save();
      $servicio =Servicio::where('f_ultrasonografia',$id)->first();
      $servicio->estado=0;
      $servicio->save();
      Bitacora::bitacora('desactivate','ultrasonografias','ultrasonografias',$id);
      return Redirect::to('/ultrasonografias');
    }

    public function activate($id){
      $ultrasonografias = ultrasonografia::find($id);
      $ultrasonografias->estado = true;
      $ultrasonografias->save();
      $servicio =Servicio::where('f_ultrasonografia',$id)->first();
      $servicio->estado=1;
      $servicio->save();
      Bitacora::bitacora('activate','ultrasonografias','ultrasonografias',$id);
      return Redirect::to('/ultrasonografias?estado=0');
    }

   public function llenarUltrasonografiasExamenes(){
     $ultrasonografias=ultrasonografia::where('estado',true)->orderBy('nombre')->get();
     return Response::json($ultrasonografias);
   }
   public function ingresoMuestra(MuestraRequest $request){
     ultrasonografia::create($request->All());
     return Response::json('success');
   }
   public function actualizarPrecioUltra(Request $request){
     $servicio = Servicio::find($request->idServicio);
     $servicio->precio=$request->precio;
     $servicio->save();
     return Response::json('sucess');
   }
}
