<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventarioFarmacia extends Model
{
    protected $fillable = ['f_producto','tipo','existencia_anterior','cantidad','existencia_nueva','localizacion'];
}
