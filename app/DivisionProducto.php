<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DivisionProducto extends Model
{
  public function nombreDivision($id){
    $nombre = Division::find($id);
    return $nombre->nombre;
  }
}
