<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleTransacion extends Model
{
  protected $fillable = [
    'f_producto','f_servicio','precio','descuento','cantidad','condicion','fecha_vencimiento','lote','f_transaccion'
  ];

public function divisionProducto(){
  return $this->belongsTo('App\DivisionProducto','f_producto');
}

}
