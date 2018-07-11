<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $fillable = ['nombre','localizacion','estado'];

  public static function buscar($nombre,$estado){
    return Caja::nombre($nombre)->estado($estado)->orderBy('nombre')->paginate(10);
  }
  public function scopeNombre($query, $nombre){
    if(trim($nombre)!=""){
      $query->where('nombre', 'like','%'.$nombre.'%');
    }
  }
  public function scopeEstado($query, $estado){
    if($estado == null){
      $estado = 1;
    }
    $query->where('estado',$estado);
  }
  public static function foreanos($id){
    return DetalleCaja::where('f_caja',$id)->count();
  }
}
