<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transacion extends Model
{
  protected $fillable = [
    'fecha','factura','f_cliente','f_proveedor','descuento','tipo','f_usuario','localizacion'
  ];
  protected $dates = ['fecha'];

  public static function buscar($buscar){
    return Transacion::paginate(8);
  }

  public static function arrayClientes(){ //Retorna los pacientes activos usando la función buscar
      $pacientes=Paciente::buscar("",true);
      $arrayP = [];
      foreach($pacientes as $paciente){
        $arrayP[$paciente->id]=$paciente->apellido.", ".$paciente->nombre;
      }
      return $arrayP;
  }
  public static function arrayProveedores(){ //Retorna los pacientes activos usando la función buscar
      $proveedores=Proveedor::buscar("",true);
      $arrayP = [];
      foreach($proveedores as $proveedor){
        $arrayP[$proveedor->id]=$proveedor->nombre;
      }
      return $arrayP;
  }
  public function cliente(){
    return $this->belongsTo('App\Paciente');
  }
  public function proveedor(){
    return $this->belongsTo('App\Proveedor','f_proveedor');
  }
  public function usuario(){
    return $this->belongsTo('App\User');
  }
}
