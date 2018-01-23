<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleResultado extends Model
{
  protected $fillable = [
    'f_resultado','f_espr','resultado','dato_controlado'
  ];
}
