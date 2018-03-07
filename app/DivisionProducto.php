<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class DivisionProducto extends Model
{
  protected $fillable = [
    'f_division','f_producto','cantidad','precio','codigo','contenido','stock'
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
  public static function inventario($id,$nor){//$nor se refiere a consulta normal o de recepción 1 es normal y 2 es de recepcion
    $cc=0;
    if($nor==1){
      $ts=Transacion::tipoUsuario(); //Tipo de usuario
    }
    if($nor==2){
      $ts=0;
    }
    $compras=Transacion::where('tipo',1)->where('localizacion',$ts)->get(); //compras
    foreach ($compras as $compra) {
      $dec=$compra->detalleTransaccion;
      foreach($dec as $dc){
        if($dc->f_producto==$id){
          $cc=$cc+$dc->cantidad;
        }
      }
    }
    $cv=0;
    $ventas=Transacion::where('tipo',2)->where('localizacion',$ts)->get(); //ventas
    foreach ($ventas as $venta) {
      $dev=$venta->detalleTransaccion;
      foreach($dev as $dv){
        if($dv->f_producto==$id){
          $cv=$cv+$dv->cantidad;
        }
      }
    }
    $ce=0;
    $envios=transacion::where('tipo',5)->get();//envios a recepción no comfirmados
    foreach ($envios as $envio) {
      $dee=$envio->detalleTransaccion;
      foreach($dee as $de){
        if($de->f_producto==$id){
          $ce=$ce+$de->cantidad;
        }
      }
    }
    $cr=0;
    $requisiciones=transacion::where('tipo',6)->get(); //envios a recepción confirmados
    foreach ($requisiciones as $requisicion) {
      $der=$requisicion->detalleTransaccion;
      foreach($der as $dr){
        if($dr->f_producto==$id){
          $cr=$cr+$dr->cantidad;
        }
      }
    }
    if($ts==0){
      return $cc-$cv-$ce-$cr;
    }elseif($ts==1){
      return $cc-$cv+$cr;
    }
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
  public static function compras($id){
    return DB::table('detalle_transacions')
    ->select('detalle_transacions.*')
    ->join('transacions','detalle_transacions.f_transaccion','=','transacions.id','left outer')
    ->where('transacions.tipo',1)
    ->where('detalle_transacions.f_producto',$id)
    ->orderBy('transacions.fecha','DESC')
    ->get();
  }
}
