<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    protected $fillable = [
      'numero', 'precio'
    ];

    public static function buscar($numero, $estado){
      return Habitacion::numero($numero)->estado($estado)->orderBy('numero','asc')->paginate(10);
    }

    public function scopeNumero($query, $numero){
      if(trim($numero)!=""){
        $query->where('numero',$numero);
      }
    }

    public function scopeEstado($query, $estado){
      if($estado == null){
        $estado = 0;
      }
      $query->where('estado',$estado);
    }
}
