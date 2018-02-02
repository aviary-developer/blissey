<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Transacion extends Model
{
  protected $fillable = [
    'fecha','factura','f_cliente','f_proveedor','descuento','tipo','f_usuario','localizacion'
  ];
  protected $dates = ['fecha'];

  public static function buscar($buscar,$tipo,$estado,$anulado){
    return Transacion::factura($buscar)->tipo($tipo)->Localizacion()->estado($estado)->anulado($anulado)->orderBy('fecha','DESC')->paginate(10);
  }
  public function scopeFactura($query, $buscar){
    if(trim($buscar)!=""){
      $query->where('factura', 'ilike','%'.$buscar.'%');
    }
  }
  public function scopeTipo($query, $tipo){
      $query->where('tipo', '=',$tipo);
  }
  public function scopeLocalizacion($query){
    $tipoUsuario=Transacion::tipoUsuario();
    $query->where('localizacion', '=',$tipoUsuario);
  }
  public function scopeEstado($query, $estado){
      if($estado==1 || $estado==""){
        $query->where('factura', '=',null)->orWhere('factura','=','');
      }elseif($estado==0){
        $query->where('factura', '<>',null)->orWhere('factura','<>','');
      }
  }
  public function scopeAnulado($query, $anulado){
      if($anulado==0 || $anulado==""){
        $query->where('anulado',0);
      }elseif($anulado==1){
        $query->where('anulado',1);
      }
  }
  public static function arrayClientes(){ //Retorna los pacientes activos usando la función buscar
      $pacientes=Paciente::where('estado','=',true)->get();
      $arrayP = [];
      foreach($pacientes as $paciente){
        $arrayP[$paciente->id]=$paciente->apellido.", ".$paciente->nombre;
      }
      return $arrayP;
  }
  public static function arrayProveedores(){ //Retorna los pacientes activos usando la función buscar
      $proveedores=Proveedor::where('estado','=',true)->get();
      $arrayP = [];
      foreach($proveedores as $proveedor){
        $arrayP[$proveedor->id]=$proveedor->nombre;
      }
      return $arrayP;
  }
  public function cliente(){
    return $this->belongsTo('App\Paciente','f_cliente');
  }
  public function proveedor(){
    return $this->belongsTo('App\Proveedor','f_proveedor');
  }
  public function usuario(){
    return $this->belongsTo('App\User');
  }
  public function detalleTransaccion(){
    return $this->hasMany('App\DetalleTransacion','f_transaccion');
  }
  public static function tipoUsuario(){
    if(Auth::user()->tipoUsuario=='Recepción'){
      return 1;
    }elseif(Auth::user()->tipoUsuario=='Farmacia'){
      return 0;
    }elseif(Auth::user()->tipoUsuario=='Laboratorio'){
      return 2;
    }
  }
}
