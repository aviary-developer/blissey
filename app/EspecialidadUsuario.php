<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EspecialidadUsuario extends Model
{
    protected $fillable = [
      'f_usuario', 'f_especialidad', 'suma', 'principal'
    ];
}
