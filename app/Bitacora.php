<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class Bitacora extends Model
{
    protected $fillable = [
      'f_usuario', 'tabla', 'tipo', 'ruta', 'indice'
    ];

    public static function bitacora($tipo, $tabla, $ruta, $id)
    {
      if(Auth::check())
      {
        Bitacora::create([
          'f_usuario' => Auth::user()->id,
          'tipo' => $tipo,
          'tabla' => $tabla,
          'ruta' => $ruta,
          'indice' => $id
        ]);
      }
    }

    public static function existeRegistro($id,$tabla)
    {
      $var = 'select count(*) from '.$tabla.' where id = '.$id;
      return DB::table($tabla)->where('id',$id)->count();
    }

    public static function nombreUsuario($id)
    {
      $usuario = User::find($id);
      return $usuario->nombre.' '.$usuario->apellido;
    }

    public static function buscar($usuario, $inicial, $final,$store,$update,$destroy,$activate,$desactivate,$login,$logout){
      return Bitacora::usuario($usuario)->Fecha($inicial, $final)->Estado($store,$update,$destroy,$activate,$desactivate,$login,$logout)->orderBy('created_at','desc')->get();
    }

    public static function scopeUsuario($query, $usuario){
      if(Auth::user()->administrador==1){
        if($usuario != null){
          $query->where('f_usuario',$usuario);
        }
      }else{
        $query->where('f_usuario',Auth::user()->id);
      }
    }

    public static function scopeFecha($query,$inicial,$final){
      $query->where('created_at','>=',$inicial)->where('created_at','<=',$final);
    }

    public static function scopeEstado($query,$store,$update,$destroy,$activate,$desactivate,$login,$logout){
      $store = ($store==1)?'store':false;
      $update = ($update==1)?'update':false;
      $destroy = ($destroy==1)?'destroy':false;
      $activate = ($activate==1)?'activate':false;
      $desactivate = ($desactivate==1)?'desactivate':false;
      $login = ($login==1)?'login':false;
      $logout = ($logout==1)?'logout':false;

      $query->where('tipo',$store)->orWhere('tipo',$update)->orWhere('tipo',$destroy)->orWhere('tipo',$activate)->orWhere('tipo',$desactivate)->orWhere('tipo',$login)->orWhere('tipo',$logout);
    }
}
