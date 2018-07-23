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

    public static function buscar($estado, $tipo,$usuario){
      return Ingreso::estado($estado)->tipo($tipo)->usuario($usuario)->orderBy('expediente','asc')->paginate(10);
    }

    public function scopeEstado($query, $estado){
      if($estado == null || $estado != '2'){
        $query->where('estado','<>',2);
      }else{
        $query->where('estado','=',2);
      }
    }

    public function scopeTipo($query, $tipo){
      if($tipo == null){
        $query->where('tipo',0);
      }else{
        $query->where('tipo', $tipo);
      }
    }

    public function scopeUsuario($query, $usuario){
      if($usuario != null){
        $query->where('f_medico',$usuario);
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

    public function transaccion(){
      return $this->hasOne('App\Transacion', 'f_ingreso');
    }

    public function signos(){
      return $this->hasMany('App\SignoVital', 'f_ingreso')->orderBy('created_at','desc');
    }

    public function consulta(){
      return $this->hasMany('App\Consulta','f_ingreso')->orderBy('created_at','desc');
    }

    public static function servicio_gastos($id, $dia = -1){
      $ingreso = Ingreso::find($id);
      //Gastos por uso de habitaciones
      $dias = $ingreso->fecha_ingreso->diffInDays(Carbon::now());
      if($dia == -1){
        $dias++;
        $precio_habitacion = $ingreso->habitacion->precio;
        $total = $precio_habitacion;
        //Gastos por examenes de laboratorio
        if($ingreso->transaccion->solicitud != null){
          foreach($ingreso->transaccion->solicitud as $solicitud){
            if($solicitud->estado != 0){
              if($solicitud->examen != null){
                $total += $solicitud->examen->servicio->precio;
              }else if($solicitud->rayox != null){
                $total += $solicitud->rayox->servicio->precio;
              }
            }
          }
        }
        foreach($ingreso->transaccion->detalleTransaccion->where('f_producto',null)->where('estado',true) as $detalle){
          if($detalle->servicio->categoria->nombre != "Honorarios" && $detalle->servicio->categoria->nombre != "Habitación" && $detalle->servicio->categoria->nombre != "Laboratorio Clínico"){
            $total += $detalle->precio;
          }
          if($detalle->servicio->categoria->nombre == "Habitación"){
            $total += $detalle->precio;
          }
        }
      }else{
        $fecha_mayor = $ingreso->fecha_ingreso->addDays(($dia+1));
        $fecha = $ingreso->fecha_ingreso->addDays($dia);
        $habitacion = DetalleTransacion::where('f_transaccion',$ingreso->transaccion->id)->where('created_at',$fecha)->count();
        if($habitacion == 0 && $ingreso->habitacion != null){
          $total = $ingreso->habitacion->precio;
        }else{
          $total = 0;
        }
        //Gastos por examenes de laboratorio
        if(count($ingreso->transaccion->solicitud)>0){
          foreach($ingreso->transaccion->solicitud as $solicitud){
            if($solicitud->estado != 0 && ($solicitud->created_at->between($fecha, $fecha_mayor))){
              if($solicitud->examen != null){
                $total += $solicitud->examen->servicio->precio;
              }else if($solicitud->rayox != null){
                $total += $solicitud->rayox->servicio->precio;
              }
            }
          }
        }
        foreach($ingreso->transaccion->detalleTransaccion->where('f_producto',null)->where('estado',true) as $detalle){
          if($detalle->servicio->categoria->nombre != "Honorarios" && $detalle->servicio->categoria->nombre != "Habitación" && $detalle->servicio->categoria->nombre != "Laboratorio Clínico" && ($detalle->created_at->between($fecha, $fecha_mayor))){
            $total += $detalle->precio;
          }
          if($detalle->servicio->categoria->nombre == "Habitación" && ($detalle->created_at == $fecha)){
            $total += $detalle->precio;
          }
        }
      }

      return $total;
    }

    public static function tratamiento_gastos($id, $dia = -1){
      $ingreso = Ingreso::find($id);
      $total = 0;
      if($dia == -1){
        if(count($ingreso->transaccion->detalleTransaccion->where('estado',true))>0){
          foreach($ingreso->transaccion->detalleTransaccion->where('estado',true) as $detalle){
            if($detalle->f_servicio == null){
              $total += $detalle->precio * $detalle->cantidad;
            }
          }
        }
      }else{
        $fecha = $ingreso->fecha_ingreso->addDays($dia);
        $fecha_mayor = $ingreso->fecha_ingreso->addDays(($dia+1));
        if(count($ingreso->transaccion->detalleTransaccion->where('estado',true))>0){
          foreach($ingreso->transaccion->detalleTransaccion->where('estado',true) as $detalle){
            if($detalle->f_servicio == null && ($detalle->created_at->between($fecha, $fecha_mayor))){
              $total += $detalle->precio * $detalle->cantidad;
            }
          }
        }
      }

      return $total;
    }

    public static function honorario_gastos($id,$dia = -1){
      $ingreso = Ingreso::find($id);
      $fecha = $ingreso->fecha_ingreso->addDays($dia);
      $fecha_mayor = $ingreso->fecha_ingreso->addDays(($dia+1));
      $total = 0;

      if($dia == -1){
        if(count($ingreso->transaccion->detalleTransaccion->where('f_producto',null)->where('estado',true)) > 0){
          foreach($ingreso->transaccion->detalleTransaccion->where('f_producto',null)->where('estado',true) as $detalle){
            if($detalle->servicio->categoria->nombre == 'Honorarios'){
              $total += $detalle->precio;
            }
          }
        }
      }else{
        if(count($ingreso->transaccion->detalleTransaccion->where('f_producto',null)->where('estado',true)) > 0){
          foreach($ingreso->transaccion->detalleTransaccion->where('f_producto',null)->where('estado',true) as $detalle){
            if($detalle->servicio->categoria->nombre == 'Honorarios' && ($detalle->created_at->between($fecha, $fecha_mayor))){
              $total += $detalle->precio;
            }
          }
        }
      }

      return $total;
    }

    public static function abonos($id, $dia = -1){
      $ingreso = Ingreso::find($id);
      $total = 0;
      
      if(count($ingreso->transaccion->abono)>0){
        if($dia == -1){
          foreach($ingreso->transaccion->abono as $abono){
            $total += $abono->monto;
          }
        }else{
          $fecha = $ingreso->fecha_ingreso->addDays($dia);
          $fecha_mayor = $ingreso->fecha_ingreso->addDays(($dia +1));
          foreach($ingreso->transaccion->abono as $abono){
            if($abono->created_at->between($fecha, $fecha_mayor)){
              $total += $abono->monto;
            }
          }
        }
      }

      return $total;
    }
}
