<?php

namespace App\Http\Controllers;
use App\DivisionProducto;

use Illuminate\Http\Request;

class DivisionProductoController extends Controller
{
    function stockTodos(Request $request){
      $f_proveedor=$request->f_proveedor;
      $divs=DivisionProducto::whereHas('producto',function ($query) {
        $query->where('estado',true);
      })->with('producto')->get();
        foreach ($divs as $division) {
          $division->menos=DivisionProducto::menor($division->id,$division->stock);
          $division->inventario=DivisionProducto::inventario($division->id,1);
        }
        if($f_proveedor!=""){
        $divisiones=$divs->where('menos',true)->where('producto.f_proveedor',$f_proveedor);
      }else{
        $divisiones=$divs->where('menos',true);
      }

        return view('Transacciones.stockBajo',compact('divisiones'));

    }
    function stockProveedor(){

    }
}
