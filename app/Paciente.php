<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = [
      'nombre',
      'apellido',
      'direccion',
      'telefono',
      'sexo',
      'fechaNacimiento',
      'dui',
      'pais',
      'departamento',
      'alergia',
      'municipio'
    ];
    protected $dates = ['fechaNacimiento'];

    public static function buscar($nombre, $apellido, $sexo, $telefono, $dui, $direccion, $fecha_minima, $fecha_maxima, $estado){
      return Paciente::nombre($nombre)->apellido($apellido)->sexo($sexo)->telefono($telefono)->dui($dui)->direccion($direccion)->fecha($fecha_minima,$fecha_maxima)->estado($estado)->orderBy('apellido')->get();
    }

    public static function contar($nombre, $apellido, $sexo, $telefono, $dui, $direccion, $fecha_minima, $fecha_maxima, $estado){
      return Paciente::nombre($nombre)->apellido($apellido)->sexo($sexo)->telefono($telefono)->dui($dui)->direccion($direccion)->fecha($fecha_minima,$fecha_maxima)->estado($estado)->orderBy('apellido')->count();
    }

    public function scopeNombre($query, $nombre){
      if(trim($nombre)!=""){
        $query->where('nombre', 'like','%'.$nombre.'%');
      }
    }

    public function scopeApellido($query, $apellido){
      if(trim($apellido)!=""){
        $query->Where('apellido', 'like','%'.$apellido.'%');
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
        $query->where('telefono','like',$telefono."%");
      }
    }

    public function scopeDui($query, $dui){
      if(trim($dui)!=""){
        $query->where('dui','like',$dui."%");
      }
    }

    public function scopeDireccion($query, $direccion){
      if(trim($direccion)!=""){
        $query->where('direccion','like','%'.$direccion.'%');
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
    public function scopeFiltro($query,$filtro){
      $query->where('nombre', 'like','%'.$filtro.'%')->orWhere('apellido', 'like','%'.$filtro.'%')
      ->orWhere('telefono','like',$filtro."%")->orWhere('dui','like',$filtro."%");
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

    public function solicitudes(){
      return $this->hasMany('App\SolicitudExamen', 'f_paciente')->orderBy('created_at','desc');
		}

		public function hospitalizaciones()
		{
			return $this->hasMany('App\Hospitalizacion', 'f_paciente')->orderBy('created_at', 'desc');
		}

    public static function foraneos($id){
      $ingresos= Hospitalizacion::where('f_paciente',$id)->orWhere('f_responsable',$id)->count();
      $transacciones=Transacion::where('f_cliente',$id)->count();
      return $ingresos+$transacciones;

    }
}