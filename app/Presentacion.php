<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentacion extends Model
{
  protected $fillable = [
    'nombre'
  ];

  public static function buscar($estado){
    return Presentacion::estado($estado)->orderBy('nombre')->get();
  }

  public function scopeEstado($query, $estado){
    if($estado == null){
      $estado = 1;
    }
    $query->where('estado',$estado);
  }
  public static function foraneos($id){
    return Producto::where('f_presentacion',$id)->count();
  }
  public static function productos($id){
    return Producto::where('f_presentacion',$id)->where('estado',true)->orderBy('nombre','ASC')->get(['nombre']);
  }
}
