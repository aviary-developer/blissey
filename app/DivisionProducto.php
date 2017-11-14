<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DivisionProducto extends Model
{
  protected $fillable = [
    'f_division','f_producto','cantidad','precio','codigo'
  ];
  public function nombreDivision($id){
    $nombre = Division::find($id);
    return $nombre->nombre;
  }
  public function producto(){
    return $this->belongsTo('App\Producto','f_producto');
  }
  public function division(){
    return $this->belongsTo('App\Division','f_division');
  }

}
