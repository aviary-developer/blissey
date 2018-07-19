<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DetalleCaja extends Model
{
    protected $fillable=['fecha','f_usuario'];

    public static function cajaApertura(){
      return DetalleCaja::where('fecha',date('Y').'-'.date('m').'-'.date('d'))->where('f_usuario',Auth::user()->id)->exists();
    }
}
