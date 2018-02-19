<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
  protected $fillable = [
      'nombreExamen', 'tipoMuestra','area'
  ];
  public static function buscar($nombre, $estado){
    return Examen::nombre($nombre)->estado($estado)->orderBy('nombreExamen')->paginate(10);
  }

  public function scopeNombre($query, $nombre){
    if(trim($nombre)!=""){
      $query->where('nombreExamen', 'ilike','%'.$nombre.'%')->orWhere('nombreExamen', 'ilike','%'.$nombre.'%')->orWhere('tipoMuestra', 'ilike','%'.$nombre.'%');
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
    return $this->belongsTo('App\Servicio','f_examen');
  }
}
