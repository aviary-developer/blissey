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
}
