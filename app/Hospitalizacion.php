<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospitalizacion extends Model
{
	protected $fillable = [
		'fecha_entrada',
		'f_paciente',
		'f_responsable',
		'f_medico',
		'expediente'
	];

	protected $dates = ['fecha_entrada', 'fecha_salida'];

	public static function buscar($estado, $usuario)
	{
		return Hospitalizacion::estado($estado)->usuario($usuario)->orderBy('expediente', 'asc')->paginate(10);
	}

	public function scopeEstado($query, $estado)
	{
		if ($estado == null || $estado != '2') {
			$query->where('estado', '<>', 2);
		} else {
			$query->where('estado', '=', 2);
		}
	}

	public function scopeUsuario($query, $usuario)
	{
		if ($usuario != null) {
			$query->where('f_medico', $usuario);
		}
	}

	public function paciente()
	{
		return $this->belongsTo('App\Paciente', 'f_paciente');
	}

	public function responsable()
	{
		return $this->belongsTo('App\Paciente', 'f_responsable');
	}
	public function medico()
	{
		return $this->belongsTo('App\User', 'f_medico');
	}
	public function ingreso()
	{
		return $this->hasMany('App\Ingreso', 'f_hospitalizacion')->orderBy('created_at','desc');
	}
}
