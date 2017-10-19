<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
  protected $fillable=['nombre','estado'];
  public static function buscar($nombre,$estado){
    return Division::nombre($nombre)->estado($estado)->orderBy('nombre')->paginate(10);
  }
  public function scopeNombre($query, $nombre){
    if(trim($nombre)!=""){
      $query->where('nombre', 'ilike','%'.$nombre.'%');
    }
  }
  public function scopeEstado($query, $estado){
    if($estado == null){
      $estado = 1;
    }
    $query->where('estado',$estado);
  }
}
