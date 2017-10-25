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
}
