<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = ['nombre','apellido','direccion','telefono','sexo','fechaNacimiento','dui'];
    protected $dates = ['fechaNacimiento'];

    public static function buscar($nombre, $apellido, $sexo, $telefono, $dui, $direccion, $fecha_minima, $fecha_maxima, $estado){
      return Paciente::nombre($nombre)->apellido($apellido)->sexo($sexo)->telefono($telefono)->dui($dui)->direccion($direccion)->fecha($fecha_minima,$fecha_maxima)->estado($estado)->orderBy('apellido')->paginate(10);
    }

    public static function contar($nombre, $apellido, $sexo, $telefono, $dui, $direccion, $fecha_minima, $fecha_maxima, $estado){
      return Paciente::nombre($nombre)->apellido($apellido)->sexo($sexo)->telefono($telefono)->dui($dui)->direccion($direccion)->fecha($fecha_minima,$fecha_maxima)->estado($estado)->orderBy('apellido')->count();
    }

    public function scopeNombre($query, $nombre){
      if(trim($nombre)!=""){
        $query->where('nombre', 'ilike','%'.$nombre.'%');
      }
    }

    public function scopeApellido($query, $apellido){
      if(trim($apellido)!=""){
        $query->Where('apellido', 'ilike','%'.$apellido.'%');
      }
    }

    public function scopeSexo($query, $sexo){
      if($sexo == 2 || $sexo == NULL){
        $query->where('sexo',true)->orWhere('sexo',false);
      }else{
        $query->where('sexo',$sexo);
      }
    }

    public function scopeTelefono($query, $telefono){
      if(trim($telefono)!=""){
        $query->where('telefono','ilike',$telefono."%");
      }
    }

    public function scopeDui($query, $dui){
      if(trim($dui)!=""){
        $query->where('dui','ilike',$dui."%");
      }
    }

    public function scopeDireccion($query, $direccion){
      if(trim($direccion)!=""){
        $query->where('direccion','ilike','%'.$direccion.'%');
      }
    }

    public function scopeFecha($query, $minima, $maxima){
      $query->where('fechaNacimiento','>=',$minima)->where('fechaNacimiento','<=',$maxima);
    }

    public function scopeEstado($query, $estado){
      if($estado == null){
        $estado = 1;
      }
      $query->where('estado',$estado);
    }


    public static function completed($id){
      $registro = Paciente::find($id);
      if(strlen($registro->telefono) != 9)
        return true;
      if($registro->direccion == null)
        return true;
      if($registro->fechaNacimiento->age >= 18 && strlen($registro->dui) != 10)
        return true;
      return false;
    }
}
