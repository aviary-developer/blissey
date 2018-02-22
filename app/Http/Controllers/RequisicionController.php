<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\DivisionProducto;
use App\transacion;
use Auth;
use App\DetalleTransacion;

class RequisicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $tipo= $request->tipo;
      $buscar=$request->buscar;
        $transacciones=Transacion::buscar($buscar,$tipo);
        return view('Requisiciones.index',compact('transacciones','tipo','buscar'));
        //Transacion::llenar();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Requisiciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $f_producto=$request->f_producto;
      $cantidad=$request->cantidad;
      $transaccion= Transacion::create([
        'fecha'=>$request->fecha,
        'f_usuario'=>Auth::user()->id,
        'localizacion'=>1,
        'tipo'=>4,
      ]);
      for ($i=0; $i <count($f_producto) ; $i++) {
        DetalleTransacion::create([
          'f_transaccion'=>$transaccion->id,
          'cantidad'=>$cantidad[$i],
          'f_producto'=>$f_producto[$i],
        ]);
        //$arrayP=divisionProducto::arrayFechas($f_producto[$i]);
      }
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
    public static function buscar($texto){
      $productos=Producto::where('nombre','ILIKE','%'.$texto.'%')->where('estado',1)->get(['id','nombre','f_presentacion']);
      foreach ($productos as $p) {
        $p->presentacion;
        $p->divisionProducto;
        foreach ($p->divisionProducto as $dp) {
          $dp->division;
          if($dp->contenido!=null){
            $dp->unidad;
          }
          $dp->inventario=DivisionProducto::inventario($dp->id,2);
        }
      }
      return $productos;
    }
}
