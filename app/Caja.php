<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Caja extends Model
{
    protected $fillable = ['nombre','localizacion','estado'];

  public static function buscar($estado){
    return Caja::estado($estado)->usuario()->orderBy('nombre')->get();
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
  public static function foreanos($id){
    return DetalleCaja::where('f_caja',$id)->count();
  }
  public static function correlativo(){
    if(Caja::usuario()->count()>0){
      return Caja::usuario()->orderBy('nombre')->get()->last()->nombre+1;
    }else{
      return 1;
    }
  }
}
