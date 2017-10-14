<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estante extends Model
{
  protected $fillable = ['codigo', 'cantidad','estado'];
}
