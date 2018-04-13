<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CambioProducto extends Model
{
  protected $fillable=['fecha','f_detalle_transaccion','cantidad','estado'];
  public static function mover($id){
    $inventario=DivisionProducto::inventario($id,1);
    $compras=DivisionProducto::compras($id,1);
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
    if($diferencia!=0){
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
        // $cambio=new CambioProducto();
        // $cambio->fecha=$date;
        // $cambio->f_detalle_transaccion=$fila->id;
        // $cambio->cantidad=$fila->cantidad;
        // $cambio->estado=0;
        // $cambio->save();
        $total_vencidos=$total_vencidos+$fila->cantidad;
      }
    }
    return $total_vencidos;
  }
}
