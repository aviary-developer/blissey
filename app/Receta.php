<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{

	public function detalle()
	{
		return $this->hasMany('App\DetalleReceta', 'f_receta');
	}

	public function consulta()
	{
		return $this->belongsTo('App\Consulta', 'f_consulta');
	}
}
