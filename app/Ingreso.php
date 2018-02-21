<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ingreso extends Model
{
    protected $fillable = [
      'fecha_ingreso', 
      'f_paciente', 
      'f_responsable',
      'f_medico', 
      'f_habitacion',
      'f_recepcion',
      'expediente'
    ];

    protected $dates = ['fecha_ingreso','fecha_alta'];

    public static function buscar($estado){
      return Ingreso::estado($estado)->orderBy('expediente','asc')->paginate(10);
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

    public function recepcion(){
      return $this->belongsTo('App\User', 'f_recepcion');
    }

    public function solicitud(){
      return $this->hasMany('App\SolicitudExamen', 'f_ingreso');
    }

    public static function servicio_gastos($id, $dia = -1){
      $ingreso = Ingreso::find($id);
      //Gastos por uso de habitaciones
      $dias = $ingreso->fecha_ingreso->diffInDays(Carbon::now());
      if($dia == -1){
        $dias++;
        $precio_habitacion = $ingreso->habitacion->precio;
        $total = $dias * $precio_habitacion;
        //Gastos por examenes de laboratorio
        if(count($ingreso->solicitud)>0){
          foreach($ingreso->solicitud as $solicitud){
            if($solicitud->estado != 0){
              $total += $solicitud->examen->servicio->precio;
            }
          }
        }
      }else{
        $fecha = $ingreso->fecha_ingreso->addDays($dia);
        $total = $ingreso->habitacion->precio;
        //Gastos por examenes de laboratorio
        if(count($ingreso->solicitud)>0){
          foreach($ingreso->solicitud as $solicitud){
            if($solicitud->estado != 0 && ($solicitud->created_at->format('d/m/Y') == $fecha->format('d/m/Y'))){
              $total += $solicitud->examen->servicio->precio;
            }
          }
        }
      }

      return $total;
    }
}
