<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
  protected $fillable = [
    'nombre','codigo','precio','f_proveedor','f_presentacion'
  ];

  public static function buscar($nombre, $estado){
    return Producto::nombre($nombre)->estado($estado)->orderBy('nombre')->paginate(10);
  }

  public function scopeNombre($query, $nombre){
    if(trim($nombre)!=""){
      $query->where('nombre', 'ilike','%'.$nombre.'%')->orWhere('codigo', 'ilike','%'.$nombre.'%');
    }
  }

  public function scopeEstado($query, $estado){
    if($estado == null){
      $estado = 1;
    }
    $query->where('estado',$estado);
  }

  public function nombrePresentacion($id){
    $nombre = Presentacion::find($id);
    return $nombre->nombre;
  }

  public function nombreProveedor($id){
    $nombre = Proveedor::find($id);
    return $nombre->nombre;
  }
}
