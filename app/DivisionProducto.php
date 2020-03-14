<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\Http\Controllers\DivisionProductoController;

class DivisionProducto extends Model
{
  protected $fillable = [
    'f_division','f_producto','cantidad','precio','codigo','contenido','stock'
  ];
  public static function nombreDivision($id){
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
    $ts=DivisionProducto::busquedaTipo($nor);
    $ultimo=Inventario::where('f_divisionproducto',$id)->where('localizacion',$ts)->get()->last();
    if($ultimo!=null){
      return $ultimo->existencia_nueva;
    }else{
      return 0;
    }
    $cc=0;
    
    $dec=DivisionProducto::filtroDetalles(1,$ts,$id);//Compras
    foreach($dec as $dc){
      if($dc->f_producto==$id){
        $restar=DetalleDevolucion::total($dc->id);
        $aux=$dc->cantidad-$restar;
        $cc=$cc+$aux;
      }
    }
    $cv=0;
    $dev=DivisionProducto::filtroDetalles(2,$ts,$id);//Ventas    
    foreach($dev as $dv){
      if($dv->f_producto==$id){
        $restar=DetalleDevolucion::total($dv->id);
        $aux=$dv->cantidad-$restar;
        $cv=$cv+$aux;
      }
    }
    $contrario=Transacion::contrario($ts);
    $ce=0;
    $dee=DivisionProducto::filtroDetalles(5,$contrario,$id);//Envios al contrario no confirmados 
    foreach($dee as $de){
      if($de->f_producto==$id){
        $ce=$ce+$de->cantidad;
      }
    }
    $cr=0;
    $der=DivisionProducto::filtroDetalles(6,$ts,$id);//Recibidos del contrario asignados 
    foreach($der as $dr){
      if($dr->f_producto==$id){
        $restar=DetalleDevolucion::total($dr->id);
        $aux=$dr->cantidad-$restar;
        $cr=$cr+$aux;
      }
    }
    $crc=0;
    $derc=DivisionProducto::filtroDetalles(6,$contrario,$id);//envios el contrario confirmados 
    foreach($derc as $drc){
      if($drc->f_producto==$id){
        $crc=$crc+$drc->cantidad;
      }
    }
    $cm=0;
    $dem=DivisionProducto::filtroDetalles(7,$ts,$id);//movidos ya sea por vencimiento o próximos a vencer
      foreach($dem as $dm){
        if($dm->f_producto==$id){
          $cm=$cm+$dm->cantidad;
        }
      }
    $ci=0;
    $dei=DivisionProducto::filtroDetalles(10,$ts,$id);//Entradas por cambio o reingreso
    foreach($dei as $di){
      if($di->f_producto==$id){
        $restar=DetalleDevolucion::total($di->id);
        $aux=$di->cantidad-$restar;
        $ci=$ci+$aux;
      }
    }
    return $cc-$cv+$cr-$ce-$crc-$cm+$ci;
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
    ->where(function ($query){
      $query->where('tipo',1)->orWhere('tipo',6)->orWhere('tipo',10);
    })
    ->where('detalle_transacions.f_producto',$id)
    ->where('transacions.localizacion',$ts)
    ->orderBy('detalle_transacions.created_at','DESC')
    // ->orderBy('detalle_transacions.fecha_vencimiento','DESC')
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
    // $divs=DivisionProducto::whereHas('producto',function ($query) use ($f_proveedor) {
    //   if($f_proveedor!=""){
    //   $query->where('estado',true)->where('f_proveedor',$f_proveedor);
    //   }else{
    //     $query->where('estado',true);
    //   }
    // })->with('producto')->orderBy('codigo')->get();
    $divs=DB::table('division_productos')
      ->select('division_productos.*','productos.nombre','productos.f_presentacion')
      ->join('productos','division_productos.f_producto','=','productos.id','left outer')
      ->where('productos.estado',true)
      ->orderBy('productos.nombre','ASC')
      ->get();

      foreach ($divs as $division) {
        $division->menos=DivisionProducto::menor($division->id,$division->stock);
        $division->inventario=DivisionProducto::inventario($division->id,1);
      }
      $divisiones=$divs->where('menos',true);
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
    ->select('division_productos.*','productos.nombre')
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
  public static function proximos(){
    DivisionProductoController::sacarProximos(2); //farmacia
    DivisionProductoController::sacarProximos(3); //Recepción hospital
  }
  public static function totalProximos($id,$tipo){
    $inventario=DivisionProducto::inventario($id,$tipo);
    $compras=DivisionProducto::compras($id,$tipo);
    $cuenta=0;
    $i=0;
    $ultimos=[];
    foreach ($compras as $compra) {
      $devoluciones=DetalleDevolucion::total($compra->id);
      $retirados=CambioProducto::total($compra->id);
      $diferencia=$compra->cantidad-$devoluciones-$retirados;
      if ($diferencia>0) {
        $cuenta=$cuenta+$diferencia;
        $compra->cantidad=$diferencia;
        $ultimos[$i]=$compra;
        if($cuenta>=$inventario)
        break;
        $i++;
      }
    }
      $diferencia=$cuenta-$inventario;
      if($diferencia!=0 && $ultimos!=null && isset($ultimos[$i])){
        $fila=$ultimos[$i];
        $fila->cantidad=$fila->cantidad-$diferencia;
        $ultimos[$i]=$fila;
      }

      $date = \Carbon\Carbon::now();
      $date = $date->format('Y-m-d');
      foreach ($ultimos as $ultimo) {
        $meses=DivisionProducto::find($ultimo->f_producto)->n_meses;
        $fecha_a=\Carbon\Carbon::now();
        $fecha_a=$fecha_a->addMonths($meses);
        $fecha_a=$fecha_a->toDateString();
        $fecha_v=$ultimo->fecha_vencimiento;
        if(!($fecha_v>$fecha_a)){
          $cambio=CambioProducto::where('f_detalle_transaccion',$ultimo->id)->get()->last();
          if($cambio==null){
            $cambio=new CambioProducto();
          }
          $cambio->fecha=$date;
          $cambio->f_detalle_transaccion=$ultimo->id;
          $cambio->cantidad=$ultimo->cantidad;
          $cambio->estado=0;
          $cambio->localizacion=DivisionProducto::busquedaTipo($tipo);
          $cambio->save();
        }
      }
  }
  public static function lotes($id){
        $inventario=DivisionProducto::inventario($id,1);
        $compras=DivisionProducto::compras($id,1);
        $cuenta=0;
        $i=0;
        $ultimos=[];
        if(!$inventario){
          return $ultimos;
        }
        foreach ($compras as $compra) {
          $compra->estante=Estante::find($compra->f_estante)->codigo;
          $devoluciones=DetalleDevolucion::total($compra->id);
          $retirados=CambioProducto::total($compra->id);
          $diferencia=$compra->cantidad-$devoluciones-$retirados;
          if ($diferencia>0) {
            $cuenta=$cuenta+$diferencia;
            $compra->cantidad=$diferencia;
            $ultimos[$i]=$compra;
            if($cuenta>=$inventario)
            break;
            $i++;
          }
        }
          $diferencia=$cuenta-$inventario;
          if($diferencia!=0 && $ultimos!=null && isset($ultimos[$i])){
            $fila=$ultimos[$i];
            $fila->cantidad=$fila->cantidad-$diferencia;
            $fila->cantidad=$fila->cantidad;

            $ultimos[$i]=$fila;
          }
        //   for ($i = 0; $i < count($ultimos); $i++) {
        //     for ($j = 1; $j < (count($ultimos) - $i); $j++) {
        //         if ($ultimos[$j - 1]->fecha_vencimiento > $ultimos[$j]->fecha_vencimiento) {
        //             $temporal = $ultimos[$j - 1];
        //             $ultimos[$j - 1] = $ultimos[$j];
        //             $ultimos[$j] = $temporal;
        //         }
        //     }
        // }
        // if($diferencia!=0){
        // $ultimos[0]->cantidad=$ultimos[0]->cantidad-$diferencia;
        // }
          return $ultimos;

  } 
  public static function filtroDetalles($tipo,$localizacion,$idp){//Recibe tipo de transacción, localización, id producto
    return DB::table('detalle_transacions')
    ->select('detalle_transacions.*')
    ->join('transacions','transacions.id','=','detalle_transacions.f_transaccion','left outer')
    ->where('transacions.localizacion',$localizacion)
    ->where('transacions.tipo',$tipo)
    ->where('detalle_transacions.f_producto',$idp)
    ->where('transacions.id','<>',null)
    ->get();
  }
  public static function buscarLote($idProducto,$idDetalle){
    $lotes=DivisionProducto::lotes($idProducto);
    foreach($lotes as $lote){
      if($lote->id==$idDetalle){
        return $lote->cantidad;
      }
    }
    return 0;
  }
  public static function nombreCompleto($id){
    $division=DivisionProducto::find($id);
    if($division->unidad==null){
      return $division->division->nombre." ".$division->cantidad." ".$division->producto->presentacion->nombre;
    }else{
      return $division->division->nombre." ".$division->cantidad." ".$division->unidad->nombre;
    }
  }
}