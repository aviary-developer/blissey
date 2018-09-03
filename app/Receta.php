<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    public function producto(){
        return $this->belongsTo('App\Producto','f_producto');
    }

    public function examen(){
        return $this->belongsTo('App\Examen','f_examen');
    }

    public function ultrasonografia(){
        return $this->belongsTo('App\ultrasonografia','f_ultrasonografia');
    }

    public function tac(){
        return $this->belongsTo('App\Tac','f_tac');
    }

    public function rayox(){
        return $this->belongsTo('App\Rayosx','f_rayox');
    }

    public function consulta(){
        return $this->belongsTo('App\Consulta','f_consulta');
    }
}
