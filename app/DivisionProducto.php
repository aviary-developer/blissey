<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

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
  public static function inventario($id,$nor){//$nor se refiere a consulta 1 es normal dependiendo del ususario y 2 dos es consultar solo por farmacia
    $cc=0;
    $ts=DivisionProducto::busquedaTipo($nor);
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
    $contrario=Transacion::contrario();
    $ce=0;
    $envios=transacion::where('tipo',5)->where('localizacion',$contrario)->get();//envios a recepción no comfirmados
    foreach ($envios as $envio) {
      $dee=$envio->detalleTransaccion;
      foreach($dee as $de){
        if($de->f_producto==$id){
          $ce=$ce+$de->cantidad;
        }
      }
    }
    $cr=0;
    $requisiciones=transacion::where('tipo',6)->where('localizacion',$ts)->get(); //envios a recepción confirmados
    foreach ($requisiciones as $requisicion) {
      $der=$requisicion->detalleTransaccion;
      foreach($der as $dr){
        if($dr->f_producto==$id){
          $cr=$cr+$dr->cantidad;
        }
      }
    }
    $crc=0;
    $requisiciones=transacion::where('tipo',6)->where('localizacion',$contrario)->get(); //envios a recepción confirmados
    foreach ($requisiciones as $requisicion) {
      $derc=$requisicion->detalleTransaccion;
      foreach($derc as $drc){
        if($drc->f_producto==$id){
          $crc=$crc+$drc->cantidad;
        }
      }
    }
    $cm=0;
    $movidos=transacion::where('tipo',7)->where('localizacion',$ts)->get(); //movidos ya sea por vencimiento o próximos a vencer
    foreach ($movidos as $movido) {
      $dem=$movido->detalleTransaccion;
      foreach($dem as $dm){
        if($dm->f_producto==$id){
          $cm=$cm+$dm->cantidad;
        }
      }
    }
    return $cc-$cv+$cr-$ce-$crc-$cm;
  }
  public static function buscar($estado){
    $bitacora = DB::table('division_productos')
      ->select('division_productos.*','productos.nombre','productos.f_presentacion','productos.f_proveedor')
      ->join('productos','division_productos.f_producto','=','productos.id','left outer')
      ->where('productos.estado',$estado)
      ->orderBy('productos.nombre','ASC')
      ->get();
      return $bitacora;
  }
  public static function compras($id,$nor){
    $ts=DivisionProducto::busquedaTipo($nor);
    return DB::table('detalle_transacions')
    ->select('detalle_transacions.*')
    ->join('transacions','detalle_transacions.f_transaccion','=','transacions.id','left outer')
    ->where('transacions.tipo',1)
    ->where('detalle_transacions.f_producto',$id)
    ->where('transacions.localizacion',$ts)
    ->orderBy('transacions.fecha','DESC')
    ->get();
  }
  public static function conteo(){
    $divisiones=DivisionProducto::all();
    $conteo=0;
    foreach ($divisiones as $division) {
      if($division->stock>DivisionProducto::inventario($division->id,1) && $division->producto->estado){
        $conteo++;
      }
    }
    return $conteo;
  }
  public static function menor($id,$stock){
    $inventario=DivisionProducto::inventario($id,1);
    if($inventario<$stock){
      return true;
    }else{
      return false;
    }

  }
  public static function stock($f_proveedor){
    $divs=DivisionProducto::whereHas('producto',function ($query) {
      $query->where('estado',true);
    })->with('producto')->orderBy('codigo')->get();
      foreach ($divs as $division) {
        $division->menos=DivisionProducto::menor($division->id,$division->stock);
        $division->inventario=DivisionProducto::inventario($division->id,1);
      }
      if($f_proveedor!=""){
      $divisiones=$divs->where('menos',true)->where('producto.f_proveedor',$f_proveedor);
    }else{
      $divisiones=$divs->where('menos',true);
    }
    return $divisiones;
  }
  public static function busquedaTipo($nor){
    if($nor==1){
      return Transacion::tipoUsuario(); //Tipo de usuario
    }
    if($nor==2){
      return 0;//farmacia
    }
    if($nor==3){
      return 1;//Recepción
    }
  }
  public static function productos($id){
    return DB::table('division_productos')
    ->select('division_productos.*','productos.*')
    ->join('productos','division_productos.f_producto','=','productos.id','left outer')
    ->where('division_productos.f_division',$id)
    ->where('productos.estado',true)
    ->orderBy('productos.nombre','ASC')
    ->get();
  }
  public static function ubicacion($id,$inventario){
    $compras=DivisionProducto::compras($id,1);
    $cuenta=0;
    $i=0;
    $ultimos=[];
    foreach ($compras as $compra) {
      $cuenta=$cuenta+$compra->cantidad;
      $ultimos[$i]=$compra;
      if($cuenta>=$inventario){
        $estante=Estante::find($compra->f_estante);
        return $estante->codigo."|".$compra->nivel;
      }
      $i++;
    }
  }
  public static function num_meses($numero){
    if($numero==1){
      return "1 mes";
    }else {
      return $numero." meses";
    }
  }
}
