<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleReceta extends Model
{
	public function producto()
	{
		return $this->belongsTo('App\Producto', 'f_producto');
	}

	public function examen()
	{
		return $this->belongsTo('App\Examen', 'f_examen');
	}

	public function ultrasonografia()
	{
		return $this->belongsTo('App\ultrasonografia', 'f_ultrasonografia');
	}

	public function tac()
	{
		return $this->belongsTo('App\Tac', 'f_tac');
	}

	public function rayox()
	{
		return $this->belongsTo('App\Rayosx', 'f_rayox');
	}
}
