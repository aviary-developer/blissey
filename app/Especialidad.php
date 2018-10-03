<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $fillable = [
      'nombre'
    ];

    public static function buscar($nombre, $estado){
      return Especialidad::nombre($nombre)->estado($estado)->orderBy('nombre')->get();
    }

    public function scopeNombre($query, $nombre){
      if(trim($nombre)!=""){
        $query->where('nombre', 'like','%'.$nombre.'%');
      }
    }

    public function scopeEstado($query, $estado){
      if($estado == null){
        $estado = 1;
      }
      $query->where('estado',$estado);
    }

    public static function nombreEspecialidad($id){
      $retorno = Especialidad::find($id);
      return $retorno->nombre;
    }
    
    public function usuario_especialidad(){
      return $this->hasMany('App\EspecialidadUsuario','f_especialidad');
    }

    public static function contar_medicos($id){
      $cantidad = EspecialidadUsuario::where('f_especialidad',$id)->count();

      if($cantidad != 0){
        return true;
      }else{
        return false;
      }
    }
}
