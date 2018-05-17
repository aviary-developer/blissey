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

    public function medico(){
        return $this->belongsTo('App\Users','f_medico');
    }
}