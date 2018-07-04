<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estante extends Model
{
  protected $fillable = ['codigo', 'cantidad','estado','localizacion'];

  public static function buscar($codigo,$estado){
    return Estante::codigo($codigo)->estado($estado)->orderBy('codigo')->paginate(10);
  }
  public function scopeCodigo($query, $codigo){
    if(trim($codigo)!=""){
      $query->where('codigo', 'like','%'.$codigo.'%');
    }
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
