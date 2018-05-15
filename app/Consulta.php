<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = [
        'motivo',
        'historia',
        'examen_fisico',
        'diagnostico',
        'f_ingreso'
    ];
}
