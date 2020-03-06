<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = [
      'nombre', 'precio', 'f_categoria'
    ];

    public static function buscar($estado,$tipo){
		if(auth()->user()->tipoUsuario == 'Farmacia'){
			return Servicio::join('categoria_servicios','categoria_servicios.id','servicios.f_categoria')->estado($estado)->where(
				function($query) use ($tipo){
				$query->where('categoria_servicios.nombre','Promociones');
			})->select('servicios.*')
			->orderBy('servicios.nombre')->get();
		}else{
			return Servicio::join('categoria_servicios','categoria_servicios.id','servicios.f_categoria')->estado($estado)->where(
				function($query) use ($tipo){
				$query->paquete($tipo)->cirugia($tipo);
			})->select('servicios.*')
			->orderBy('servicios.nombre')->get();
		}
    }

    public function scopeEstado($query, $estado){
      if($estado == null){
        $estado = 1;
      }
      $query->where('servicios.estado',$estado);
		}

		public function scopePaquete($query, $tipo){
			if($tipo == null){
				$signo = '<>';
			}else{
				$signo = '=';
			}
			$query->where('categoria_servicios.nombre',$signo,'Paquetes hospitalarios');
		}

	public function scopeCirugia($query, $tipo)
	{
		if ($tipo == null) {
			$query->where('categoria_servicios.nombre', '<>', 'Cirugías');
		} else {
			$query->orWhere('categoria_servicios.nombre', '=', 'Cirugías');
		}
	}

    public function nombreCategoria($id){
      $nombre = CategoriaServicio::find($id);
      return $nombre->nombre;
    }

    public function categoria(){
      return $this->belongsTo('App\CategoriaServicio','f_categoria');
    } 

    public function medico(){
      return $this->belongsTo('App\User','f_medico');
	} 

	public function promos(){
		return $this->hasMany('App\Promocion','f_servicio');
	  }
}
