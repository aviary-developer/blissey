<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DetalleCaja extends Model
{
    protected $fillable=['fecha','f_usuario'];

    public static function cajaApertura(){
      $detalle=DetalleCaja::where('fecha',date('Y').'-'.date('m').'-'.date('d'))->where('f_usuario',Auth::user()->id)->get()->last();
      if(count($detalle)==0){
        return false;
      }elseif($detalle->tipo==2){
        return false;
      }else{
        return true;
      }
    }
    public static function verificacionCaja($id){
      $detalle=DetalleCaja::where('f_caja',$id)->get()->last();
      if(count($detalle)==0){
        return false;
      }elseif($detalle->tipo==2){
        return false;
      }else{
        return true;
      }
    }
}
