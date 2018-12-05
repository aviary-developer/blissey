<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
  protected $fillable=['nombre','estado'];
  public static function buscar($estado){
    return Division::estado($estado)->orderBy('nombre')->get();
  }
  public function scopeEstado($query, $estado){
    if($estado == null){
      $estado = 1;
    }
    $query->where('estado',$estado);
  }
  public static function foraneos($id){
    return DivisionProducto::where('f_division',$id)->count();
  }
}
