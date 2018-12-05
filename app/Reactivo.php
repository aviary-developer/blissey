<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reactivo extends Model
{
  protected $fillable = [
      'nombre', 'fechaVencimiento', 'contenidoPorEnvase',
  ];
  public static function buscar($nombre, $estado){
    return Reactivo::nombre($nombre)->estado($estado)->orderBy('nombre')->get();
  }

  public function scopeNombre($query, $nombre){
    if(trim($nombre)!=""){
      $query->where('nombre', 'like','%'.$nombre.'%')->orWhere('nombre', 'like','%'.$nombre.'%')->orWhere('descripcion', 'like','%'.$nombre.'%');
    }
  }

  public function scopeEstado($query, $estado){
    if($estado == null){
      $estado = 1;
    }
    $query->where('estado',$estado);
  }
  public static function foraneos($id){
    return ExamenSeccionParametro::where('f_reactivo',$id)->count();
  }
}
