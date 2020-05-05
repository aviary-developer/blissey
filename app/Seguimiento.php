<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
	protected $dates = ['fecha'];
	protected $fillable = ['f_ingreso','f_enfermeria','descripcion','fecha'];

	public function enfermeria()
	{
		return $this->belongsTo('App\User', 'f_enfermeria');
	}
}
