<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
  protected $fillable = [
      'nombreExamen', 'tipoMuestra','area'
  ];
  public static function buscar($nombre, $estado){
    return Examen::nombre($nombre)->estado($estado)->orderBy('nombreExamen')->get();
  }

  public function scopeNombre($query, $nombre){
    if(trim($nombre)!=""){
      $query->where('nombreExamen', 'like','%'.$nombre.'%')->orWhere('nombreExamen', 'like','%'.$nombre.'%')->orWhere('tipoMuestra', 'like','%'.$nombre.'%');
    }
  }

  public function nombreSeccion($id){
    $nombre = Seccion::find($id);
    return $nombre->nombre;
  }
  public function nombreMuestra($id){
    $nombre = MuestraExamen::find($id);
    return $nombre->nombre;
  }

  public function nombreParametro($id){
    $nombre = Parametro::find($id);
    return $nombre->nombre;
  }
  public function nombreReactivo($id){
    $nombre = Reactivo::find($id);
    return $nombre->nombre;
  }

  public function scopeEstado($query, $estado){
    if($estado == null){
      $estado = 1;
    }
    $query->where('estado',$estado);
  }

  public function servicio(){
    return $this->hasOne('App\Servicio','f_examen');
  }

  public static function foraneos($id){
    $servicio= Servicio::where('f_examen','=',$id)->first();
    return DetalleTransacion::where('f_servicio',$servicio->id)->count();
  }
}
