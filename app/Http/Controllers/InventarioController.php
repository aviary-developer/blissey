<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\DivisionProducto;
use App\DetalleDevolucion;
use App\CambioProducto;

class InventarioController extends Controller
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
      $dp = DivisionProducto::buscar(true);
      return view('Inventarios.index',compact('dp','pagina'));
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
        $inventario=DivisionProducto::inventario($id,1);
        $compras=DivisionProducto::compras($id,1);
        $cuenta=0;
        $i=0;
        $ultimos=[];
        foreach ($compras as $compra) {
          $devoluciones=DetalleDevolucion::total($compra->id);
          $retirados=CambioProducto::total($compra->id);
          $diferencia=$compra->cantidad-$devoluciones-$retirados;
          if ($diferencia>0) {
            $cuenta=$cuenta+$diferencia;
            $compra->cantidad=$diferencia;
            $ultimos[$i]=$compra;
            if($cuenta>=$inventario)
            break;
            $i++;
          }
        }
          $diferencia=$cuenta-$inventario;
          if($diferencia!=0 && count($ultimos)>0){
            $fila=$ultimos[$i];
            $fila->cantidad=$fila->cantidad-$diferencia;
            $ultimos[$i]=$fila;
          }
          return $ultimos;
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
}
