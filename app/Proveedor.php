<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $fillable=['nombre','correo','telefono','estado'];

    public static function buscar($nombre, $estado){
      return Proveedor::nombre($nombre)->estado($estado)->orderBy('nombre')->paginate(10);
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
    public static function buscarId($nombre){ //Recibe nombre y retorna el id
      $fila=Proveedor::where('nombre','=',$nombre)->get();
      foreach($fila as $f){
        return $f->id;
      }
    }

    public static function buscarNombre($id){ //Recibe id y retorna el nombre
      $fila=Proveedor::find($id);
      return $fila->nombre;
    }

    public function visitador(){
      return $this->hasMany('App\Dependiente','f_proveedor');
    }

    public static function arrayProveedores(){
      $pro=Proveedor::where('estado',true)->orderBy('nombre')->get();
      $arrayP= [];
      foreach($pro as $p){
        $arrayP[$p->id]=$p->nombre;
      }
      return $arrayP;
    }
    public static function foreanos($id){
      return Producto::where('f_proveedor',$id)->count();
    }
}
