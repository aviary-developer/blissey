<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
      'codigo_hospital',
      'nombre_hospital',
      'direccion_hospital',
      'telefono_hospital',
      'logo_hospital',
      'codigo_clinica',
      'nombre_clinica',
      'direccion_clinica',
      'telefono_clinica',
      'logo_clinica',
      'codigo_laboratorio',
      'nombre_laboratorio',
      'direccion_laboratorio',
      'telefono_laboratorio',
      'logo_laboratorio',
      'codigo_farmacia',
      'nombre_farmacia',
      'direccion_farmacia',
      'telefono_farmacia',
      'logo_farmacia'
    ];
}
