<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
  protected $fillable = [
      'nombre'
  ];
  public static function buscar($estado){
    return Unidad::estado($estado)->orderBy('nombre')->get();
  }

  public function scopeEstado($query, $estado){
    if($estado == null){
      $estado = 1;
    }
    $query->where('estado',$estado);
  }
  public static function foraneos($id){
    $valor=ComponenteProducto::where('f_unidad',$id)->count();
    $valor=$valor+Parametro::where('unidad',$id)->count();
    return $valor;
  }
}
