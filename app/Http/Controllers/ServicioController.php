<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;
use App\CategoriaServicio;
use App\Bitacora;
use Redirect;
use App\Promocion;
use App\DivisionProducto;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $contador=CategoriaServicio::where('nombre','Promociones')->count();
      if($contador==0){
        $cate=new CategoriaServicio();
        $cate->nombre="Promociones";
        $cate->save();
      }
			$estado = $request->get('estado');
			$tipo = $request->get('tipo');
			
      $servicios = Servicio::buscar($estado, $tipo);
      if(auth()->user()->tipoUsuario != 'Farmacia'){
        $activos = Servicio::where('estado',true)->count();
        $inactivos = Servicio::where('estado',false)->count();
      }
      else{
      $activos =Servicio::join('categoria_servicios','categoria_servicios.id','servicios.f_categoria')->estado(true)->where(
				function($query){
				$query->where('categoria_servicios.nombre','Promociones');
			})->count();
      $inactivos = Servicio::join('categoria_servicios','categoria_servicios.id','servicios.f_categoria')->estado(false)->where(
				function($query){
				$query->where('categoria_servicios.nombre','Promociones');
			})->count();
      }
      return view('Servicios.index',compact(
        'servicios',
        'estado',
        'nombre',
        'activos',
				'inactivos',
				'tipo'
      ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if(auth()->user()->tipoUsuario != 'Farmacia'){
      $categorias = CategoriaServicio::where('estado',true)->orderBy('nombre','asc')->get();
      }else{
        $categorias = CategoriaServicio::where('estado',true)->where('nombre','Promociones')->orderBy('nombre','asc')->get();
      }
      return view('Servicios.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $servicios = Servicio::create($request->All());
      $contador = count($request->tipo);
      $tipo=$request->tipo;
      $idp=$request->idp;
      $cantidad=$request->cantidad;

      for($i=0; $i<$contador; $i++){
        $promocion=new Promocion();
        $promocion->f_servicio=$servicios->id;
        if($tipo[$i]==1){
          $promocion->f_divisionproducto=$idp[$i];
        }else{
          $promocion->f_serviciop=$idp[$i];

        }
        $promocion->cantidad=$cantidad[$i];
        $promocion->save();

      }
      Bitacora::bitacora('store','servicios','servicios',$servicios->id);
      return redirect('/servicios')->with('mensaje', '¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $servicio = Servicio::find($id);
      return view('Servicios.show',compact('servicio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $servicios = Servicio::find($id);
      $categorias = CategoriaServicio::where('estado',true)->orderBy('nombre','asc')->get();
      return view('Servicios.edit',compact('servicios','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $servicios = Servicio::find($id);
      $servicios->fill($request->all());
      $servicios->save();
      Bitacora::bitacora('update','servicios','servicios',$id);
      if($servicios->estado)
      {
        return redirect('/servicios')->with('mensaje', '¡Editado!');
      }
      else{
        return redirect('/servicios?estado=0')->with('mensaje', '¡Editado!');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Promocion::where('f_servicio',$id)->delete();
      $servicios = Servicio::findOrFail($id);
      $servicios->delete();
      Bitacora::bitacora('destroy','servicios','servicios',$id);
      return redirect('/servicios?estado=0');
    }

    public function desactivate($id){
      $servicios = Servicio::find($id);
      $servicios->estado = false;
      $servicios->save();
      Bitacora::bitacora('desactivate','servicios','servicios',$id);
      return Redirect::to('/servicios');
    }

    public function activate($id){
      $servicios = Servicio::find($id);
      $servicios->estado = true;
      $servicios->save();
      Bitacora::bitacora('activate','servicios','servicios',$id);
      return Redirect::to('/servicios?estado=0');
		}
		
		//SEP16: Funciones de busqueda en ingresos para buscar el paquete hositalario
		public function precio_paquete(Request $request){
			$paquete = Servicio::find($request->id);
			$precio = $paquete->precio;
			$id = $paquete->id;
			return compact('precio','id');
    }
    public static function comprobarServicio($f_servicio,$cantidad){
      $servicio=Servicio::find($f_servicio);
      $promos=$servicio->promos;
      $aux=1;
      
      foreach($promos as $promo){
        if($promo->f_divisionproducto!=null){
          $inventario=DivisionProducto::inventario($promo->f_divisionproducto,1);
          if($inventario<($promo->cantidad*$cantidad)){
            return 0;
          }
        }
      }
      return $aux;
    }
}