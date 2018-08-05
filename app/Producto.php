<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
  protected $fillable = [
    'nombre','f_proveedor','f_presentacion','f_categoria'
  ];

  public static function buscar($f_proveedor,$f_categoria, $estado){
    return Producto::proveedor($f_proveedor)->categoria($f_categoria)->estado($estado)->orderBy('nombre')->get();
  }
  public function scopeEstado($query, $estado){
    if($estado == null){
      $estado = 1;
    }
    $query->where('estado',$estado);
  }
  public function scopeProveedor($query, $prov){
    if(!is_null($prov)){
      $query->where('f_proveedor',$prov);
    }
  }
  public function scopeCategoria($query, $cate){
    if(!is_null($cate)){
      $query->where('f_categoria',$cate);
    }
  }
  public function nombrePresentacion($id){
    $nombre = Presentacion::find($id);
    return $nombre->nombre;
  }

  public function nombreProveedor($id){
    $nombre = Proveedor::find($id);
    return $nombre->nombre;
  }
  public function presentacion(){
    return $this->belongsTo('App\Presentacion','f_presentacion')->select(['id','nombre']);
  }
  public function categoriaProducto(){
    return $this->belongsTo('App\CategoriaProducto','f_categoria')->select(['id','nombre']);
  }

  public static function arrayUnidades(){
    $unidades=Unidad::where('estado','=',true)->orderBy('nombre')->get();
    $arrayU= [];
    foreach($unidades as $unidad){
      $arrayU[$unidad->id]=$unidad->nombre;
    }
    return $arrayU;
  }
  public static function arrayPresentaciones(){
    $presentaciones=Presentacion::where('estado','=',true)->orderBy('nombre')->get();
    $arrayP= [];
    foreach($presentaciones as $presentacion){
      $arrayP[$presentacion->id]=$presentacion->nombre;
    }
    return $arrayP;
  }
  public function divisionProducto(){
    return $this->hasMany('App\DivisionProducto','f_producto')->select(['id','f_division','f_producto','cantidad','precio','codigo','contenido','stock']);
  }
}
