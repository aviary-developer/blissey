<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    protected $fillable = [
      'numero', 'precio', 'tipo'
    ];

    public static function buscar($tipo, $estado){
      return Habitacion::tipo($tipo)->estado($estado)->orderBy('numero','asc')->get();
    }

    public function scopeNumero($query, $numero){
      if(trim($numero)!=""){
        $query->where('numero',$numero);
      }
    }

    public function scopeTipo($query, $tipo){
      if($tipo == null || $tipo == -1){
        $signo = ">";
        $tipo = -1;
      }else{
        $signo = "=";
      }
      $query->where('tipo',$signo,$tipo);
    }

    public function scopeEstado($query, $estado){
      if($estado == null){
        $estado = 1;
      }
      $query->where('estado',$estado);
    }

    public function servicio(){
      return $this->hasOne('App\Servicio', 'f_habitacion');
    }

    public function camas(){
      return $this->hasMany('App\Cama', 'f_habitacion');
    }
}
