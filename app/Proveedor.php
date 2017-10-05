<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $fillable=['nombre','correo','telefono','estado'];

    public static function buscar($nombre, $estado){
      return Proveedor::nombre($nombre)->estado($estado)->orderBy('nombre')->paginate(10);
    }

    public function scopeNombre($query, $nombre){
      if(trim($nombre)!=""){
        $query->where('nombre', 'ilike','%'.$nombre.'%');
      }
    }

    public function scopeEstado($query, $estado){
      if($estado == null){
        $estado = 1;
      }
      $query->where('estado',$estado);
    }
    public static function buscarId($nombre){
      $fila=Proveedor::where('nombre','=',$nombre)->get();
      foreach($fila as $f){
        return $f->id;
      }
    }
}
