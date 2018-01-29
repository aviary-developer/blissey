<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
      'codigo_hospital',
      'nombre_hospital',
      'correo_hospital',
      'direccion_hospital',
      'logo_hospital',
      'codigo_clinica',
      'nombre_clinica',
      'correo_clinica',
      'direccion_clinica',
      'logo_clinica',
      'codigo_laboratorio',
      'nombre_laboratorio',
      'correo_laboratorio',
      'direccion_laboratorio',
      'logo_laboratorio',
      'codigo_farmacia',
      'nombre_farmacia',
      'correo_farmacia',
      'direccion_farmacia',
      'logo_farmacia'
    ];
}
