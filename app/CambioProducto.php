<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\CambioProductoController;

class CambioProducto extends Model
{
  protected $fillable=['fecha','f_detalle_transaccion','cantidad','estado','localizacion'];
    protected $dates = ['fecha'];
  public static function mover($id,$tipo){//tipo 1=según el logueo 2=farmacia 3= recepción
    $inventario=DivisionProducto::inventario($id,$tipo);
    $compras=DivisionProducto::compras($id,$tipo);
    $cuenta=0;
    $i=0;
    $ultimos=[];
    foreach ($compras as $compra) {
      $cuenta=$cuenta+$compra->cantidad;
      $ultimos[$i]=$compra;
      if($cuenta>=$inventario)
      break;
      $i++;
    }
    $diferencia=$cuenta-$inventario;
    if($diferencia>0){
      $fila=$ultimos[$i];
      $fila->cantidad=$fila->cantidad-$diferencia;
      $ultimos[$i]=$fila;
    }
    $total_vencidos=0;
    $producto=0;
    foreach ($ultimos as $fila) {
      $producto=$fila->f_producto;
      $date = \Carbon\Carbon::now();
      $date = $date->format('Y-m-d');
      if($fila->fecha_vencimiento<=$date){
        if($fila->cantidad>0){
          $cambio=new CambioProducto();
          $cambio->fecha=$date;
          $cambio->f_detalle_transaccion=$fila->id;
          $cambio->cantidad=$fila->cantidad;
          $cambio->estado=0;
          $cambio->localizacion=DivisionProducto::busquedaTipo($tipo);;
          $cambio->save();
        }
        $total_vencidos=$total_vencidos+$fila->cantidad;
      }
    }
    return $total_vencidos;
  }
  public static function buscar($estado){
    return $retirados=CambioProducto::where('estado',$estado)->orderBy('id','DESC')->where('localizacion',Transacion::tipoUsuario())->paginate(10);
  }
  public function transaccion(){
    return $this->belongsTo('App\DetalleTransacion','f_detalle_transaccion');
  }
  public static function conteo(){
    return CambioProducto::where('estado',0)->get()->count();
  }
  public static function descartar(){
    CambioProductoController::lugar(2); //farmacia
    CambioProductoController::lugar(3); //Recepción hospital
  }
}
