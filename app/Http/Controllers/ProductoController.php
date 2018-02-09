<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Presentacion;
use App\Division;
use App\Proveedor;
use App\Unidad;
use App\Componente;
use App\Bitacora;
use App\DivisionProducto;
use App\ComponenteProducto;
use Illuminate\Http\Request;
use Redirect;
use Response;
use DB;

class ProductoController extends Controller
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
      $productos = Producto::buscar($nombre,$estado);
      $activos = Producto::where('estado',true)->count();
      $inactivos = Producto::where('estado',false)->count();
      return view('Productos.index',compact(
        'productos',
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
      $presentaciones = Presentacion::where('estado',true)->orderBy('nombre','asc')->get();
      $proveedores = Proveedor::where('estado',true)->orderBy('nombre','asc')->get();
      $divisiones = Division::where('estado',true)->orderBy('nombre','asc')->get();
      $unidades = Unidad::where('estado',true)->orderBy('nombre','asc')->get();
      return view('Productos.create', compact('presentaciones','proveedores','divisiones','unidades'));
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
        $productos = Producto::create([
          'nombre'=>$request->nombre,
          'f_presentacion'=>$request->f_presentacion,
          'f_proveedor'=>$request->f_proveedor,
        ]);
        if(isset($request->divisiones)){
          foreach ($request->divisiones as $key => $division) {
            $divisiones_productos = new DivisionProducto;
            $divisiones_productos->f_producto = $productos->id;
            $divisiones_productos->f_division = $request->divisiones[$key];
            $divisiones_productos->cantidad = $request->cantidades[$key];
            $divisiones_productos->precio = $request->precios[$key];
            $divisiones_productos->codigo = $request->codigos[$key];
            if($request->idus[$key]!=0){
              $divisiones_productos->contenido = $request->idus[$key];
            }
            $divisiones_productos->save();
          }
        }
        if(isset($request->componentes)){
          foreach ($request->componentes as $key => $componentes) {
            $componentes_productos = new ComponenteProducto;
            $componentes_productos->f_producto = $productos->id;
            $componentes_productos->f_unidad = $request->unidades[$key];
            $componentes_productos->f_componente = $request->componentes[$key];
            $componentes_productos->cantidad = $request->cantidades_componentes[$key];
            $componentes_productos->save();
          }
        }
      }catch(\Exception $e){
        DB::rollback();
        return redirect('/productos')->with('mensaje', 'Algo salio mal');
      }

      DB::commit();
      Bitacora::bitacora('store','productos','productos',$productos->id);
      return redirect('/productos')->with('mensaje', '¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $producto = Producto::find($id);
      $divisiones = DivisionProducto::where('f_producto',$id)->orderBy('cantidad','asc')->get();
      $componentes = ComponenteProducto::where('f_producto',$id)->orderBy('cantidad','asc')->get();
      return view('Productos.show',compact('producto','divisiones','componentes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $productos = Producto::find($id);
      $presentaciones = Presentacion::where('estado',true)->orderBy('nombre','asc')->get();
      $proveedores = Proveedor::where('estado',true)->orderBy('nombre','asc')->get();
      $divisiones = Division::where('estado',true)->orderBy('nombre','asc')->get();
      $unidades = Unidad::where('estado',true)->orderBy('nombre','asc')->get();
      $divisiones_productos = DivisionProducto::where('f_producto',$id)->orderBy('cantidad','asc')->get();
      $componentes_productos = ComponenteProducto::where('f_producto',$id)->orderBy('cantidad','asc')->get();
      return view('Productos.edit',compact('productos','presentaciones','unidades','proveedores','divisiones','divisiones_productos','componentes_productos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      DB::beginTransaction();

       try{
        $productos = Producto::find($id);
        $productos->fill($request->all());
        $productos->save();
        if(isset($request->divisiones)){
          foreach ($request->divisiones as $key => $division) {
            $divisiones_productos = new DivisionProducto;
            $divisiones_productos->f_producto = $productos->id;
            $divisiones_productos->f_division = $request->divisiones[$key];
            $divisiones_productos->cantidad = $request->cantidades[$key];
            $divisiones_productos->precio = $request->precios[$key];
            $divisiones_productos->codigo = $request->codigos[$key];
            if($request->idus[$key]!=0){
              $divisiones_productos->contenido = $request->idus[$key];
            }
            $divisiones_productos->save();
          }
        }
        if(isset($request->componentes)){
          foreach ($request->componentes as $key => $componentes) {
            $componentes_productos = new ComponenteProducto;
            $componentes_productos->f_producto = $productos->id;
            $componentes_productos->f_unidad = $request->unidades[$key];
            $componentes_productos->f_componente = $request->componentes[$key];
            $componentes_productos->cantidad = $request->cantidades_componentes[$key];
            $componentes_productos->save();
          }
        }
        foreach ($request->divisiones_eliminadas as $key => $division_e) {
          if($division_e != "ninguno"){
            $eliminar = DivisionProducto::findOrFail($division_e);
            $eliminar->delete();
          }
        }
        foreach ($request->componentes_eliminados as $key => $componente_e) {
          if($componente_e != "ninguno"){
            $eliminar = ComponenteProducto::findOrFail($componente_e);
            $eliminar->delete();
          }
        }
       }catch(\Exception $e){
        DB::rollback();
        if($productos->estado)
        {
          return redirect('/productos')->with('mensaje', 'Algo salio mal');
        }
        else{
          return redirect('/productos?estado=0')->with('mensaje', 'Algo salio mal');
        }
       }

      DB::commit();
      Bitacora::bitacora('update','productos','productos',$id);
      if($productos->estado)
      {
        return redirect('/productos')->with('mensaje', '¡Editado!');
      }
      else{
        return redirect('/productos?estado=0')->with('mensaje', '¡Editado!');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $productos = Producto::findOrFail($id);
      $productos->delete();
      Bitacora::bitacora('destroy','productos','productos',$id);
      return redirect('/productos?estado=0');
    }

    public function desactivate($id){
      $productos = Producto::find($id);
      $productos->estado = false;
      $productos->save();
      Bitacora::bitacora('desactivate','productos','productos',$id);
      return Redirect::to('/productos');
    }

    public function activate($id){
      $productos = Producto::find($id);
      $productos->estado = true;
      $productos->save();
      Bitacora::bitacora('activate','productos','productos',$id);
      return Redirect::to('/productos?estado=0');
    }

    public function buscarComponentes($texto){
      $componentes = Componente::where('nombre','ilike','%'.$texto.'%')->where('estado',true)->orderBy('nombre','asc')->take(6)->get();
      if(count($componentes)>0){
        return Response::json($componentes);
      }else{
        return null;
      }
    }
    public function existeCodigo($codigo){
      return DivisionProducto::where('codigo',$codigo)->count();
    }
}
