<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ultrasonografia extends Model
{
  protected $fillable = [
    'nombre'
  ];
  public static function buscar($nombre, $estado){
    return ultrasonografia::nombre($nombre)->estado($estado)->orderBy('nombre')->get();
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
    return $this->hasOne('App\Servicio','f_ultrasonografia');
  }
  public static function foraneos($id){
    $servicio= Servicio::where('f_ultrasonografia','=',$id)->first();
    return DetalleTransacion::where('f_servicio',$servicio->id)->count();
  }
}
