<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
  protected $fillable = [
    'f_solicitud','observacion'
  ];
}
