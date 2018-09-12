<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleDevolucion extends Model
{
    public static function total($id){
      return DetalleDevolucion::where('f_detalle_transaccion',$id)->sum('cantidad');
    }
}
