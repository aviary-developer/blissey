<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EspecialidadUsuario extends Model
{
    protected $fillable = [
      'f_usuario', 'f_especialidad', 'suma', 'principal'
    ];

    public static function nombreEspecialidad($id){
      $retorno = Especialidad::find($id);
      return $retorno->nombre;
    }

    public function usuario(){
      return $this->belongsTo('App\User','f_usuario');
    }

    public function especialidad(){
      return $this->belongsTo('App\Especialidad','f_especialidad');
    }
}
