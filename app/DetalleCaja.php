<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DetalleCaja extends Model
{
    protected $fillable=['fecha','f_usuario','tipo','f_caja','importe','total'];

    public function datosCaja(){
      return $this->belongsTo('App\Caja','f_caja');
    }
    public function user(){
      return $this->belongsTo('App\User','f_usuario');
    }

    public static function cajaApertura(){
      $detalle=DetalleCaja::where('fecha',date('Y').'-'.date('m').'-'.date('d'))->where('f_usuario',Auth::user()->id)->get()->last();
      if(Transacion::tipoUsuario()==0){
        if($detalle==null){
          return false;
        }elseif($detalle->tipo==2){
          return false;
        }else{
          return true;
        }
      }elseif(Transacion::tipoUsuario()==1){
        if($detalle==null){
          if(date('G')<7){
            $fecha=\Carbon\Carbon::now()->subDay()->toDateString();
            $detalle=DetalleCaja::where('fecha',$fecha)->where('f_usuario',Auth::user()->id)->get()->last();
            if($detalle==null){
              return false;
            }elseif($detalle->tipo==2){
              return false;
            }else{
              return true;
            }
          }else{
            return false;
          }
        }elseif($detalle->tipo==2){
          return false;
        }else{
          return true;
        }
        }
    }
    public static function verificacionCaja($id){
      $detalle=DetalleCaja::where('f_caja',$id)->where('fecha',date('Y').'-'.date('m').'-'.date('d'))->get()->last();
      if($detalle==null){
        return false;
      }elseif($detalle->tipo==2){
        return false;
      }else{
        return true;
      }
    }
    public static function usuario($id){
      $detalle=DetalleCaja::where('f_caja',$id)->get()->last();
      return $detalle;
    }
    public static function caja($fecha,$f_caja){
      $caja=DetalleCaja::where('fecha',$fecha)->where('f_caja',$f_caja)->where('tipo',1)->get()->last();
      return $caja;
    }
    public static function arqueo($fecha,$f_caja){
      $total=0;
      $detalle=DetalleCaja::caja($fecha,$f_caja);
      $total=$total+$detalle->importe;
      $movimientos=Transacion::movimientosCaja($detalle->f_usuario,$detalle->updated_at,$fecha,\Carbon\Carbon::now()->toDateString()." 07:00:00");
      foreach ($movimientos as $movimiento) {
        $valor=$movimiento->valorTotal($movimiento->id);
        if($movimiento->tipo==2){
          $total=$total+$valor;
        }
        if($movimiento->tipo==8){
          $total=$total+number_format($movimiento->devolucion,2,'.','');
        }
        if($movimiento->tipo==1){
          $total=$total-$valor;
        }
        if($movimiento->tipo==9){
          $total=$total-$movimiento->devolucion;
        }
        if($movimiento->tipo==12){
          $total=$total+$movimiento->devolucion;
        }
        if($movimiento->tipo==13){
          $total=$total-$movimiento->devolucion;
        }
      }
      return $total;
    }
    public static function caja_en_uso(){
      $caja=DetalleCaja::where('f_usuario',Auth::user()->id)->get()->last();
      return $caja->datosCaja->id;
    }
}
