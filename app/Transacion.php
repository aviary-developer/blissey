<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transacion extends Model
{
  protected $fillable = [
    'fecha','factura','f_cliente','f_proveedor','descuento','tipo','f_usuario','localizacion'
  ];
}
