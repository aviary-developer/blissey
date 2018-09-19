<?php

namespace App\Http\Controllers;
use App\DivisionProducto;

use Illuminate\Http\Request;

class DivisionProductoController extends Controller
{
    function stockTodos(Request $request){
      $f_proveedor=$request->f_proveedor;
      $divisiones=DivisionProducto::stock($f_proveedor);

      return view('Transacciones.stockBajo',compact('divisiones','f_proveedor'));
    }

    function stockProveedor($f_proveedor){
      $divisiones=DivisionProducto::stock($f_proveedor);
      return view('Transacciones.pedidoProveedor',compact('divisiones','f_proveedor'));
    }
    public static function sacarProximos($tipo){
      $divisiones=DivisionProducto::all();
      foreach ($divisiones as $division) {
        DivisionProducto::totalProximos($division->id,$tipo);
      }
    }
    // function proximos(){
    //   DivisionProducto::proximos();
    // }
}
