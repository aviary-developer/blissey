<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
  protected $fillable = [
      'nombre'
  ];
  public static function buscar($nombre, $estado){
    return Seccion::nombre($nombre)->estado($estado)->orderBy('nombre')->paginate(10);
  }
  public function nombreSeccion($id){
    $nombre = Seccion::find($id);
    return $nombre->nombre;
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
