<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaProducto extends Model
{
  protected $fillable=['nombre','estado'];
  public static function buscar($estado){
    return CategoriaProducto::estado($estado)->orderBy('nombre')->get();
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
  public static function foraneos($id){
    return Producto::where('f_categoria',$id)->count();
  }
  public static function productos($id){
    return Producto::where('f_categoria',$id)->where('estado',true)->orderBy('nombre','ASC')->get(['nombre']);
  }
}
