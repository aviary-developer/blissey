<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cama extends Model
{

  protected $fillable = [
    'numero',
    'f_habitacion',
    'precio'
  ];
    public function habitacion(){
      return $this->belongsTo('App\Habitacion', 'f_habitacion');
    }

    public function servicio(){
      return $this->hasOne('App\Servicio', 'f_cama');
    }

    public function ingreso(){
      return $this->hasMany('App\Ingreso', 'f_cama');
    }
}
