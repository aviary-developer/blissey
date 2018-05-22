<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaProducto extends Model
{
  protected $fillable=['nombre','estado'];
  public static function buscar($nombre,$estado){
    return CategoriaProducto::nombre($nombre)->estado($estado)->orderBy('nombre')->paginate(10);
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
  public static function arrayCategorias(){
    $categorias=CategoriaProducto::where('estado',true)->orderBy('nombre')->get();
    $arrayC= [];
    foreach($categorias as $categoria){
      $arrayC[$categoria->id]=$categoria->nombre;
    }
    return $arrayC;
  }
}
