<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    protected $fillable=['nombre','estado'];
    public static function buscar($estado){
      return Componente::estado($estado)->orderBy('nombre')->get();
    }
    public function scopeEstado($query, $estado){
      if($estado == null){
        $estado = 1;
      }
      $query->where('estado',$estado);
    }
    public function componenteProducto(){
      return $this->hasMany('App\ComponenteProducto','f_componente')->select(['id','f_componente','f_producto','cantidad','f_unidad']);
    }
    public static function foraneos($id){
      return ComponenteProducto::where('f_componente',$id)->count();
    }
}
