<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $fillable = [
      'fecha_ingreso', 'f_paciente', 'f_responsable',
      'f_medico', 'f_habitacion'
    ];

    protected $dates = ['fecha_ingreso','fecha_alta'];

    public static function buscar($estado){
      return Ingreso::estado($estado)->orderBy('estado','asc')->paginate(10);
    }

    public function scopeEstado($query, $estado){
      if($estado == null || $estado != '2'){
        $query->where('estado','<>',2);
      }else{
        $query->where('estado','=',2);
      }
    }

    public static function nombrePaciente($id){
      $nombre = Paciente::find($id);
      return $nombre->apellido.', '.$nombre->nombre;
    }

    public static function nombreMedico($id){
      $nombre = User::find($id);
      if($nombre->sexo){
        return 'Dr. '.$nombre->apellido.', '.$nombre->nombre;
      }else{
        return 'Dra. '.$nombre->apellido.', '.$nombre->nombre;
      }
    }

    public static function numeroHabitacion($id){
      $numero = Habitacion::find($id);
      return 'Habitación '.$numero->numero;
    }

    public function paciente(){
      return $this->belongsTo('App\Paciente','f_paciente');
    }
}
