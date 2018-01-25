<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleTransacion extends Model
{
  protected $fillable = [
    'f_producto','f_servicio','precio','descuento','cantidad','condicion','fecha_vencimiento','lote','f_transaccion'
  ];
  protected $dates = ['fecha_vencimiento'];

public function divisionProducto(){
  return $this->belongsTo('App\DivisionProducto','f_producto');
}
public static function cuenta($id){
  $cuenta=DetalleTransacion::where('f_producto',$id)->count();

  if($cuenta>0){
    return false;
  }else{
    return true;
  }
}

}
