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
    if($diferencia>0 && $i>0){
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
      if(CambioProducto::where('f_detalle_transaccion',$fila->id)->count()==0){
        if($fila->fecha_vencimiento<=$date){
          if($fila->cantidad>0){
            $cambio=new CambioProducto();
            $cambio->fecha=$date;
            $cambio->f_detalle_transaccion=$fila->id;
            $cambio->cantidad=$fila->cantidad;
            $cambio->estado=0;
            $cambio->localizacion=DivisionProducto::busquedaTipo($tipo);
            $cambio->save();
          }
          $total_vencidos=$total_vencidos+$fila->cantidad;
        }
      }
    }
    return $total_vencidos;
  }
  public static function buscar($estado){
    return $retirados=CambioProducto::estado($estado)->orderBy('id','DESC')->where('cantidad','>',0)->where('localizacion',Transacion::tipoUsuario())->get();
  }
  public function scopeEstado($query, $estado){
    if($estado!=""){
      $query->where('estado',$estado);
    }
  }
  public function transaccion(){
    return $this->belongsTo('App\DetalleTransacion','f_detalle_transaccion');
  }
  public static function conteo(){
    $date = \Carbon\Carbon::now()->format('Y-m-d');
    $todos=CambioProducto::where('estado',0)->where('cantidad','>',0)->where('localizacion',Transacion::tipoUsuario())->get();
    $conteo=0;
    foreach ($todos as $cambio){
      if($cambio->transaccion->fecha_vencimiento<$date){
        $conteo++;
      }
    }
    return $conteo;
  }
  public static function proximos(){
    $date = \Carbon\Carbon::now()->format('Y-m-d');
    $todos=CambioProducto::where('estado',0)->where('cantidad','>',0)->where('localizacion',Transacion::tipoUsuario())->get();
    $conteo=0;
    // echo Transacion::tipoUsuario();
    // echo $todos;
    foreach ($todos as $cambio){
      if($cambio->transaccion->fecha_vencimiento>=$date){
        $conteo++;
      }
    }
    return $conteo;
  }
  public static function descartar(){
    CambioProductoController::lugar(2); //farmacia
    CambioProductoController::lugar(3); //Recepción hospital
  }
  public static function total($id){
    return CambioProducto::where('f_detalle_transaccion',$id)->where('estado','<>',0)->sum('cantidad');
  }

  public static function actualizarCambio($id){  
    $cambios= CambioProducto::
    select('cambio_productos.*')
    ->join('detalle_transacions','cambio_productos.f_detalle_transaccion','=','detalle_transacions.id','left outer')
    ->where('cambio_productos.localizacion',Transacion::tipoUsuario())
    ->where('detalle_transacions.f_producto',$id)
    ->where('detalle_transacions.id','<>',null)
    ->get(); 
  
    $lotes= DivisionProducto::lotes($id);
    foreach($cambios as $cambio){
      $borrar=1;
      foreach($lotes as $lote){
        if($cambio->f_detalle_transaccion==$lote->id){
          $borrar=0;     
          $cambioAux=CambioProducto::find($cambio->id);
          $cambioAux->cantidad=$lote->cantidad;
          $cambioAux->save();
        }
      }
      if($borrar==1){
        CambioProducto::find($cambio->id)->delete();
      }
    }
  }
}
