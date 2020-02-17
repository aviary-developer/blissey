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
  public static function foraneos($id){
    return DetalleCaja::where('f_caja',$id)->count();
  }
  public static function correlativo(){
    if(Caja::usuario()->count()>0){
      return Caja::usuario()->orderBy('nombre')->get()->last()->nombre+1;
    }else{
      return 1;
    }
  }
  public static function basico($numero) {
    $valor = array ('uno','dos','tres','cuatro','cinco','seis','siete',
    'ocho','nueve','diez','once','doce','trece','catorce','quince','dieciséis','diecisiete',
    'dieciocho','diecinueve','veinte','veintiuno','veintidos','veintitrés','veinticuatro',
    'veinticinco','veintiséis','veintisiete','veintiocho','veintinueve');
    return $valor[$numero - 1];
    }
    
    public static function decenas($n) {
    $decenas = array (30=>'treinta',40=>'cuarenta',50=>'cincuenta',60=>'sesenta',
    70=>'setenta',80=>'ochenta',90=>'noventa');
    if( $n <= 29) return Caja::basico($n);
    $x = $n % 10;
    if ( $x == 0 ) {
    return $decenas[$n];
    } else return $decenas[$n - $x].' y '. Caja::basico($x);
    }
    
    public static function centenas($n) {
    $cientos = array (100 =>'cien',200 =>'doscientos',300=>'trecientos',
    400=>'cuatrocientos', 500=>'quinientos',600=>'seiscientos',
    700=>'setecientos',800=>'ochocientos', 900 =>'novecientos');
    if( $n >= 100) {
    if ( $n % 100 == 0 ) {
    return $cientos[$n];
    } else {
    $u = (int) substr($n,0,1);
    $d = (int) substr($n,1,2);
    return (($u == 1)?'ciento':$cientos[$u*100]).' '.Caja::decenas($d);
    }
    } else return Caja::decenas($n);
    }
    
    public static function miles($n) {
    if($n > 999) {
    if( $n == 1000) {return 'mil';}
    else {
    $l = strlen($n);
    $c = (int)substr($n,0,$l-3);
    $x = (int)substr($n,-3);
    if($c == 1) {$cadena = 'mil '.Caja::centenas($x);}
    else if($x != 0) {$cadena = Caja::centenas($c).' mil '.Caja::centenas($x);}
    else $cadena = Caja::centenas($c). ' mil';
    return $cadena;
    }
    } else return Caja::centenas($n);
    }
    
    public static function millones($n) {
    if($n == 1000000) {return 'un millón';}
    else {
    $l = strlen($n);
    $c = (int)substr($n,0,$l-6);
    $x = (int)substr($n,-6);
    if($c == 1) {
    $cadena = ' millón ';
    } else {
    $cadena = ' millones ';
    }
    return Caja::miles($c).$cadena.(($x > 0)?Caja::miles($x):'');
    }
    }
    public static function convertir($n) {
    switch (true) {
    case ( $n >= 1 && $n <= 29) : return Caja::basico($n); break;
    case ( $n >= 30 && $n < 100) : return Caja::decenas($n); break;
    case ( $n >= 100 && $n < 1000) : return Caja::centenas($n); break;
    case ($n >= 1000 && $n <= 999999): return Caja::miles($n); break;
    case ($n >= 1000000): return millones($n);
    }
    }
    
}
