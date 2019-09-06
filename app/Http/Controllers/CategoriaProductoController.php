<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoriaProducto;
use App\Bitacora;
use Redirect;
use Response;
use App\Http\Requests\CategoriaProductoRequest;
use DB;

class CategoriaProductoController extends Controller
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
    $categorias = CategoriaProducto::buscar($estado);
    $activos = CategoriaProducto::where('estado',true)->count();
    $inactivos = CategoriaProducto::where('estado',false)->count();
    return view('CategoriaProductos.index',compact(
      'categorias',
      'estado',
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
    return view('CategoriaProductos.create');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(CategoriaProductoRequest $request)
  {
    DB::beginTransaction();
    try{
      $categoria=new CategoriaProducto;
      $categoria->fill($request->all());
      $categoria->save();
    }catch(Exception $e){
      DB::rollback();
      return redirect('/categoria_productos')->with('mensaje', '¡Algo salio mal!');
    }
    DB::commit();
    Bitacora::bitacora('store','categoria_productos','categoria_productos',$categoria->id);
    return redirect('/categoria_productos')->with('mensaje','¡Guardado!');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $categoria=CategoriaProducto::find($id);
    return view('CategoriaProductos.show',compact('categoria'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $categoria=CategoriaProducto::find($id);
    return view('CategoriaProductos.edit',compact('categoria'));
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
    $categoria=CategoriaProducto::find($id);
    if($request->nombre==$categoria->nombre){
      return redirect('/categoria_productos?estado'.$categoria->estado)->with('info', '¡No hay cambios!');
    }else{
      DB::beginTransaction();
      try{
        $validar['nombre']='required';
        $this->validate($request,$validar);
        $categoria->fill($request->all());
        $categoria->save();
      }catch(Exception $e){
        DB::rollback();
        return redirect('/categoria_productos')->with('mensaje', '¡Algo salio mal!');
      }
      DB::commit();
      Bitacora::bitacora('update','categoria_productos','categoria_productos',$categoria->id);
      return redirect('/categoria_productos')->with('mensaje','¡Editado!');
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
    try {
      $categoria_productos = CategoriaProducto::findOrFail($id);
      $categoria_productos->delete();
      Bitacora::bitacora('destroy','categoria_productos','categoria_productos',$id);
      DB::commit();
      return redirect('/categoria_productos?estado=0');
    } catch (\Exception $e) {
      DB::rollback();
      return redirect('/categoria_productos?estado=0');
    }

  }
  public function desactivate($id){
    $categoria_productos = CategoriaProducto::find($id);
    $categoria_productos->estado = false;
    $categoria_productos->save();
    Bitacora::bitacora('desactivate','categoria_productos','categoria_productos',$id);
    return Redirect::to('/categoria_productos');
  }

  public function activate($id){
    $categoria_productos = CategoriaProducto::find($id);
    $categoria_productos->estado = true;
    $categoria_productos->save();
    Bitacora::bitacora('activate','categoria_productos','categoria_productos',$id);
    return Redirect::to('/categoria_productos?estado=0');
  }
  public static function ingresoCategoria(CategoriaProductoRequest $request){
    $categoria=CategoriaProducto::create($request->All());
    Bitacora::bitacora('store','categoria_productos','categoria_productos',$categoria->id);
    return Response::json('success');
  }
  public static function llenarCategoria(){
    $categorias=CategoriaProducto::where('estado',true)->orderBy('nombre')->get(['id','nombre']);
    return Response::json($categorias);
  }
}
