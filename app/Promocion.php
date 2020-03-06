<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    public function division(){
        return $this->belongsTo('App\DivisionProducto', 'f_divisionproducto');
    }
    public function servicio(){
        return $this->belongsTo('App\Servicio', 'f_serviciop');
    }
}
