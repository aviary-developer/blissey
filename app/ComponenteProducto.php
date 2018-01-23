<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
  public function proveedor(){
    return $this->belongsTo('App\Producto','f_producto')->select(['id','nombre','f_presentacion','estado']);
  }
}
