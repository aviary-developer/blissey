<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DivisionProducto extends Model
{
  protected $fillable = [
    'f_division','f_producto','cantidad','precio','codigo','contenido'
  ];
  public function nombreDivision($id){
    $nombre = Division::find($id);
    return $nombre->nombre;
  }
  public function producto(){
    return $this->belongsTo('App\Producto','f_producto');
  }
  public function division(){
    return $this->belongsTo('App\Division','f_division')->select(['id','nombre']);
  }
  public function unidad(){
    return $this->belongsTo('App\Unidad','contenido')->select(['id','nombre']);
  }
  public function inventarioFarmaciaUltimo(){
     return $this->hasMany('App\InventarioFarmacia','f_producto');
  }
  public static function inventario($id){
    $existe=InventarioFarmacia::where('f_producto',$id)->where('localizacion',Transacion::tipoUsuario())->get()->last();
    if (count($existe)>0) {
      return $existe->existencia_nueva;
    } else {
      return 0;
    }
  }

}
