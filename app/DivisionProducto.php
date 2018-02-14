<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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
    $cc=0;
    $compras=Transacion::where('tipo',1)->get();
    foreach ($compras as $compra) {
      $dec=$compra->detalleTransaccion;
      foreach($dec as $dc){
        if($dc->f_producto==$id){
          $cc=$cc+$dc->cantidad;
        }
      }
    }
    $cv=0;
    $ventas=Transacion::where('tipo',2)->get();
    foreach ($ventas as $venta) {
      $dev=$venta->detalleTransaccion;
      foreach($dev as $dv){
        if($dv->f_producto==$id){
          $cv=$cv+$dv->cantidad;
        }
      }
    }
    return $cc-$cv;
  }
  public static function buscar($nombre,$estado){
    $bitacora = DB::table('division_productos')
      ->select('division_productos.*','productos.nombre','productos.f_presentacion','productos.f_proveedor')
      ->join('productos','division_productos.f_producto','=','productos.id','left outer')
      ->where('productos.nombre','ILIKE','%'.$nombre.'%')
      ->where('productos.estado',$estado)
      ->orderBy('productos.nombre','ASC')
      ->paginate(10);
      // ->get();
      return $bitacora;
  }
  public static function inventarioFarmacia($id){
    $existe=InventarioFarmacia::where('f_producto',$id)->where('localizacion',0)->get()->last();
    if (count($existe)>0) {
      return $existe->existencia_nueva;
    } else {
      return 0;
    }
  }

}
