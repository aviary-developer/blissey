<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estante extends Model
{
  protected $fillable = ['codigo', 'cantidad','estado','localizacion'];

  public static function buscar($estado){
    return Estante::estado($estado)->orderBy('codigo')->get();
  }
  public function scopeEstado($query, $estado){
    if($estado == null){
      $estado = 1;
    }
    $query->where('estado',$estado);
  }

  public static function arrayEstante(){
    $estantes=Estante::where('estado',1)->where('localizacion',Transacion::tipoUsuario())->get();
    $arrayE=[];
    foreach ($estantes as $e) {
      $arrayE[$e->id]=$e->codigo;
    }
    return $arrayE;
  }
  public static function foreanos($id){
    return DetalleTransacion::where('f_estante',$id)->count();
  }
}
