<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
  protected $fillable = [
    'f_solicitud','observacion','imagen','f_laboratorista'
  ];
  public function laboratorista(){
      return $this->belongsTo('App\User', 'f_laboratorista');
  }
}
