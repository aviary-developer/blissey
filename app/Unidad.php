<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
  protected $fillable = [
      'nombre'
  ];
  public static function buscar($nombre, $estado){
    return Unidad::nombre($nombre)->estado($estado)->orderBy('nombre')->paginate(10);
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
  public static function foreanos($id){
    $valor=ComponenteProducto::where('f_unidad',$id)->count();
    $valor=$valor+Parametro::where('unidad',$id)->count();
    return $valor;
  }
}
