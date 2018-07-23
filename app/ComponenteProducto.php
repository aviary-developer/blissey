<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ComponenteProducto extends Model
{
  public function nombreUnidad($id){
    $nombre = Unidad::find($id);
    return $nombre->nombre;
  }

  public function nombreComponente($id){
    $nombre = Componente::find($id);
    return $nombre->nombre;
  }
  public function producto(){
    return $this->belongsTo('App\Producto','f_producto')->select(['id','nombre','f_presentacion','estado']);
  }
  public static function productos($id){
    return DB::table('componente_productos')
    ->select('componente_productos.*','productos.*')
    ->join('productos','componente_productos.f_producto','=','productos.id','left outer')
    ->where('componente_productos.f_componente',$id)
    ->where('productos.estado',true)
    ->orderBy('productos.nombre','ASC')
    ->get();
  }
}
