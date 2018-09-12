<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    public static function devolucion($id){
      $transaccion=Transacion::find($id);
      $detalles=$transaccion->detalleTransaccion;
      $contador=0;
      foreach ($detalles as $detalle) {
        $cantidad=DetalleDevolucion::total($detalle->id);
        $contador=$contador+$cantidad;
      }
      return $contador;
    }
}
