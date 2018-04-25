<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\DivisionProducto;
use App\CambioProducto;
use App\Transacion;
use Auth;
use App\DetalleTransacion;
class CambioProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $estado=$request->estado;
      if($estado==null){
        $retirados=CambioProducto::orderBy('id','DESC')->where('localizacion',Transacion::tipoUsuario())->paginate(10);
      }else{
        $retirados=CambioProducto::buscar($estado);
      }
      return view('CambioProductos.index',compact('retirados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public static function descartar(){
      $productos=Producto::where('estado',1)->orderBy('nombre')->get();
      $activo=false;
      $transaccion=new Transacion();
      $f = \Carbon\Carbon::now();
      $f = $f->format('Y-m-d');
      $transaccion->fecha=$f;
      $transaccion->f_usuario=Auth::user()->id;
      $transaccion->localizacion=Transacion::tipoUsuario();
      $transaccion->tipo=7;
      foreach ($productos as $producto) {
        $divisiones=$producto->divisionProducto;
        foreach ($divisiones as $division) {
          $cantidad= CambioProducto::mover($division->id);
          if($cantidad>0){
            if(!$activo){
              $transaccion->save();
              $activo=true;
            }
            if($cantidad>0){
              $detalle=new DetalleTransacion();
              $detalle->cantidad=$cantidad;
              $detalle->f_transaccion=$transaccion->id;
              $detalle->f_producto=$division->id;
              $detalle->save();
            }
          }

        }
      }
    }
}
