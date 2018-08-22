<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DescripcionReactivo extends Model
{
  protected $fillable = [
    'descripcionExistencias','anterior','movimiento','posterior'
  ];
}
