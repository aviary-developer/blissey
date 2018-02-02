<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BancoSangre extends Model
{
  protected $fillable = [
    'tipoSangre', 'anticuerpos', 'pruebaCruzada', 'fechaVencimiento'
  ];
  public static function buscar($nombre, $estado){
    return BancoSangre::nombre($nombre)->estado($estado)->orderBy('tipoSangre')->paginate(10);
  }
  public function scopeNombre($query, $nombre){
    if(trim($nombre)!=""){
      $query->where('tipoSangre', 'ilike','%'.$nombre.'%')->orWhere('anticuerpos', 'ilike','%'.$nombre.'%')->orWhere('fechaVencimiento', 'ilike','%'.$nombre.'%');
    }
  }

  public function scopeEstado($query, $estado){
    if($estado == null){
      $estado = 1;
    }
    $query->where('estado',$estado);
  }
}
