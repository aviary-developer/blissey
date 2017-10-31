<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $fillable = [
      'fecha_ingreso', 'f_paciente', 'f_responsable',
      'f_medico', 'f_habitacion'
    ];
}
