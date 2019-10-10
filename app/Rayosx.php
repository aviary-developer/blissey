<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rayosx extends Model
{
  protected $fillable = [
    'nombre'
  ];
  public static function buscar($nombre, $estado){
    return Rayosx::nombre($nombre)->estado($estado)->orderBy('nombre')->get();
  }
  public function scopeNombre($query, $nombre){
    if(trim($nombre)!=""){
      $query->where('nombre', 'like','%'.$nombre.'%');
    }
  }

  public function scopeEstado($query, $estado){
    if($estado == null){
      $estado = 1;
    }
    $query->where('estado',$estado);
  }
  public function servicio(){
    return $this->hasOne('App\Servicio','f_rayox');
  }
  public static function foraneos($id){
    $servicio= Servicio::where('f_rayox','=',$id)->first();
    return DetalleTransacion::where('f_servicio',$servicio->id)->count();
  }
}
