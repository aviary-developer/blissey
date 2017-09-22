<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = ['nombre','apellido','direccion','telefono','sexo','fechaNacimiento'];
    protected $dates = ['fechaNacimiento'];

    public static function buscar($nombre, $estado){
      return Paciente::nombre($nombre)->estado($estado)->orderBy('apellido')->paginate(10);
    }

    public function scopeNombre($query, $nombre){
      if(trim($nombre)!=""){
        $query->where('nombre', 'ilike','%'.$nombre.'%')->orWhere('apellido', 'ilike','%'.$nombre.'%');
      }
    }

    public function scopeEstado($query, $estado){
      if($estado == null){
        $estado = 1;
      }
      $query->where('estado',$estado);
    }
}
