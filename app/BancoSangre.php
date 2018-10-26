<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BancoSangre extends Model
{
  protected $fillable = [
    'tipoSangre', 'pruebaCruzada', 'fechaVencimiento'
  ];

  protected $dates = ['fechaVencimiento'];
  public static function buscar($nombre, $estado){
    return BancoSangre::nombre($nombre)->estado($estado)->orderBy('tipoSangre')->get();
  }
  public function scopeNombre($query, $nombre){
    if(trim($nombre)!=""){
      $query->where('tipoSangre', 'like','%'.$nombre.'%')->orWhere('anticuerpos', 'like','%'.$nombre.'%')->orWhere('fechaVencimiento', 'like','%'.$nombre.'%');
    }
  }

  public function scopeEstado($query, $estado){
    if($estado == null){
      $estado = 1;
    }
    $query->where('estado',$estado);
  }
}
