<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelefonoUsuario extends Model
{
    protected $fillable = [
      'telefono', 'f_usuario'
    ];
}
