<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transacion extends Model
{
  protected $fillable = [
    'fecha','factura','f_cliente','f_proveedor','descuento','tipo','f_usuario','localizacion'
  ];

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
}
