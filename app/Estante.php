<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Estante extends Model
{
  protected $fillable = ['codigo', 'cantidad','estado','localizacion'];

  public static function buscar($estado){
    return Estante::estado($estado)->usuario()->orderBy('codigo')->get();
  }
  public function scopeEstado($query, $estado){
    if($estado == null){
      $estado = 1;
    }
    $query->where('estado',$estado);
  }
  public function scopeUsuario($query){
    // if(!Auth::user()->administrador){
      if(Auth::user()->tipoUsuario=='Farmacia'){
        $query->where('localizacion',0);
      }elseif(Auth::user()->tipoUsuario=='Recepción'){
        $query->where('localizacion',1);
      }
    // }
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
  public static function correlativo(){
    if(Estante::usuario()->count()>0){
    return Estante::usuario()->orderBy('codigo')->get()->last()->codigo+1;
    }else{
      return 1;
    }
  }
}
