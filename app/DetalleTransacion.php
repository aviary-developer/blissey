<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleTransacion extends Model
{
  protected $fillable = [
    'f_producto','f_servicio','precio','descuento','cantidad','fecha_vencimiento','lote','f_transaccion','f_estante','nivel'
  ];
  protected $dates = ['fecha_vencimiento'];

public function divisionProducto(){
  return $this->belongsTo('App\DivisionProducto','f_producto');
}
public function servicio(){
  return $this->belongsTo('App\Servicio','f_servicio');
}
public function estante(){
  return $this->belongsTo('App\Estante','f_estante');
}
public function transaccion(){
  return $this->belongsTo('App\Transacion','f_transaccion');
}
public static function cuenta($id){
  $cuenta=DetalleTransacion::where('f_producto',$id)->count();

  if($cuenta>0){
    return false;
  }else{
    return true;
  }
}
public static function descuento($id){
  return Transacion::find($id)->descuento;
}

}
