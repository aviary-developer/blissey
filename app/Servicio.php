<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = [
      'nombre', 'precio', 'f_categoria'
    ];

    public static function buscar($nombre, $estado){
      return Servicio::nombre($nombre)->estado($estado)->orderBy('nombre')->get();
    }

    public function scopeNombre($query, $nombre){
      if(trim($nombre)!=""){
        $query->where('nombre', 'like','%'.$nombre.'%');
      }
    }

    public function scopeEstado($query, $estado){
      if($estado == null){
        $estado = 1;
      }
      $query->where('estado',$estado);
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
}
