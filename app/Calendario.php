<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $fillable = [
        'fecha_inicio',
        'fecha_final',
        'f_usuario',
        'tipo_usuario',
        'titulo',
        'descripcion',
        'color'
    ];

    public function usuario(){
        return $this->belongsTo('App\User', 'f_usuario');
    }
}
