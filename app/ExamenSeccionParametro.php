<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamenSeccionParametro extends Model
{
  protected $fillable = [
    'f_examen','f_seccion','f_parametro'
  ];
}
