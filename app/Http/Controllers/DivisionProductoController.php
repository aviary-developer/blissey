<?php

namespace App\Http\Controllers;
use App\DivisionProducto;

use Illuminate\Http\Request;

class DivisionProductoController extends Controller
{
    function stockTodos(){
      $divisiones=DivisionProducto::whereHas('producto',function ($query) {
        $query->where('estado',true);})->get();
        foreach ($divisiones as $division) {
          $division->menos=DivisionProducto::menor($division->id,$division->stock);
        }
        $filtrados=$divisiones->where('menos',true);
        echo $filtrados;
    }
    function stockProveedor(){

    }
}
