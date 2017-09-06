<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reactivo extends Model
{
  protected $fillable = [
      'nombre', 'descripcion', 'contenidoPorEnvase',
  ];
}
