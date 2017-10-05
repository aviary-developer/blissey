<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
  protected $fillable = [
      'nombreParametro', 'valorMinimo','valorMaximo','valorPredeterminado'
  ];
  public static function buscar($nombre, $estado){
    return Parametro::nombre($nombre)->estado($estado)->orderBy('nombreParametro')->paginate(10);
  }

  public function scopeNombre($query, $nombre){
    if(trim($nombre)!=""){
      $query->where('nombreParametro', 'ilike','%'.$nombre.'%')->orWhere('nombreParametro', 'ilike','%'.$nombre.'%')->orWhere('unidad', 'ilike','%'.$nombre.'%');
    }
  }

  public function scopeEstado($query, $estado){
    if($estado == null){
      $estado = 1;
    }
    $query->where('estado',$estado);
  }
}
