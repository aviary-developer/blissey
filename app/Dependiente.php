<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependiente extends Model
{
    protected $fillable=['nombre','apellido','telefono','f_proveedor','estado'];

    public static function buscar($id_p,$estado){
        return Dependiente::estado($estado)->f_proveedor($id_p)->orderBy('nombre')->paginate(10);
    }
    public function scopeEstado($query, $estado){
      if($estado == null){
        $estado = 1;
      }
      $query->where('estado',$estado);
    }
    public function scopeF_proveedor($query, $id_p){
      $query->where('f_proveedor',$id_p);
    }

  public function proveedor(){
    return $this->belongsTo('App\Proveedor','f_proveedor');
  }
}
