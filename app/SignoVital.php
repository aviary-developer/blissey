<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SignoVital extends Model
{
    protected $fillable = [
        'temperatura',
        'peso',
        'altura',
        'medida',
        'pulso',
        'sistole',
        'diastole',
        'frecuencia_cardiaca',
        'frecuencia_respiratoria',
        'f_ingreso',
        'glucosa'
    ];

    public function ingreso(){
      return $this->belongsTo('App\Ingreso', 'f_ingreso');
    }
}
