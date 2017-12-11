<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamenSeccionParametro extends Model
{
  protected $fillable = [
    'f_examen','f_seccion','f_parametro'
  ];

  public function nombreParametro($id){
    $nombre = Parametro::find($id);
    return $nombre->nombreParametro;
  }

  public function nombreSeccion($id){
    $nombre = Seccion::find($id);
    return $nombre->nombre;
  }
  public function seccion(){
    return $this->belongsTo('App\Seccion','f_seccion');
  }
  public function parametro(){
    return $this->belongsTo('App\Parametro','f_parametro');
  }
  public function reactivo(){
    return $this->belongsTo('App\Reactivo','f_reactivo');
  }
}
