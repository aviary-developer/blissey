<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentacion extends Model
{
  protected $fillable = [
    'nombre'
  ];

  public static function buscar($nombre, $estado){
    return Presentacion::nombre($nombre)->estado($estado)->orderBy('nombre')->paginate(10);
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
    return Producto::where('f_presentacion',$id)->count();
  }
}
