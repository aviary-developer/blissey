<?php

namespace App\Http\Controllers;

use App\Bitacora;
use Redirect;
use DB;
use Response;
use Carbon\Carbon;
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
     public function store(UltrasonografiaRequest $request)
     {
       DB::beginTransaction();

       try{
         $ultraNueva = new ultrasonografia;
         $ultraNueva->nombre=$request->nombre;
         $ultraNueva->save();
         //Crear una categoria de servicio asociada a los examen
         $categoria_existe = CategoriaServicio::where('nombre','Ultrasonografía')->first();

         if(count($categoria_existe)<1){
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
      return view('Ultrasonografias.show',compact('ultrasonografia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ultrasonografia  $ultrasonografia
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
     * @param  \App\ultrasonografia  $ultrasonografia
     * @return \Illuminate\Http\Response
     */
    public function update(UltrasonografiaRequest $request, $id)
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
     * @param  \App\ultrasonografia  $ultrasonografia
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

   public function llenarUltrasonografiasExamenes(){
     $ultrasonografias=ultrasonografia::where('estado',true)->orderBy('nombre')->get();
     return Response::json($ultrasonografias);
   }
   public function ingresoMuestra(MuestraRequest $request){
     ultrasonografia::create($request->All());
     return Response::json('success');
   }
}
