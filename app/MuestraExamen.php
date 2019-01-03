<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MuestraExamen extends Model
{
  protected $fillable = [
      'nombre'
  ];
  public static function buscar($nombre, $estado){
    return MuestraExamen::nombre($nombre)->estado($estado)->orderBy('nombre')->get();
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
  public static function nombreUnidad($id){
    $n= MuestraExamen::find($id);
    return $n->nombre;
  }
  public static function foraneos($id){
    return Examen::where('tipoMuestra',$id)->count();
  }
}
