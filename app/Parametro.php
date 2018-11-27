<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Unidad;

class Parametro extends Model
{
  protected $fillable = [
      'nombreParametro', 'valorMinimo','valorMaximo', 'valorMinimoFemenino','valorMaximoFemenino','valorPredeterminado','unidad'
  ];
  public static function buscar($nombre, $estado){
    return Parametro::nombre($nombre)->estado($estado)->orderBy('nombreParametro')->get();
  }

  public function scopeNombre($query, $nombre){
    if(trim($nombre)!=""){
      $query->where('nombreParametro', 'like','%'.$nombre.'%')->orWhere('nombreParametro', 'like','%'.$nombre.'%')->orWhere('unidad', 'like','%'.$nombre.'%');
    }
  }

  public function scopeEstado($query, $estado){
    if($estado == null){
      $estado = 1;
    }
    $query->where('estado',$estado);
  }
  public static function nombreUnidad($id){
    $n= Unidad::find($id);
    return $n->nombre;
  }
  public function unidad(){
    return $this->belongsTo('App\Unidad','unidad');
  }
  public static function foraneos($id){
    return ExamenSeccionParametro::where('f_parametro',$id)->count();
  }
}
