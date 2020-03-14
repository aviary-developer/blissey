<?php

namespace App\Http\Controllers;
use App\DivisionProducto;
use App\Transacion;

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
    public static function stockBajo_pdf(){
      $divisiones=DivisionProducto::stock("");

        if(Transacion::tipoUsuario()==1){
            $header = view('PDF.header.hospital');
        }else{
            $header = view('PDF.header.farmacia');
        }
          $footer = view('PDF.footer.numero_pagina');
          $main = view('Transacciones.PDF.stock',compact('divisiones'));
          $pdf = \PDF::loadHtml($main)->setOption('footer-html',$footer)->setOption('header-html',$header)->setPaper('Letter');
          return $pdf->stream('stock.pdf');
    }
}