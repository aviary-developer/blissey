<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleDevolucion extends Model
{
    public static function total($id){
      return DetalleDevolucion::where('f_detalle_transaccion',$id)->sum('cantidad');
    }
    public static function total_filtro($id,$tipo){
      return DetalleDevolucion::where('f_detalle_transaccion',$id)->where('tipo',$tipo)->sum('cantidad');
    }
}
