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

    public function paciente(){
      return $this->belongsTo('App\Paciente', 'f_paciente');
    }

    public function responsable(){
      return $this->belongsTo('App\Paciente', 'f_responsable');
    }

    public function habitacion(){
      return $this->belongsTo('App\Habitacion', 'f_habitacion');
    }

    public function medico(){
      return $this->belongsTo('App\User', 'f_medico');
    }
}
