<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','nombre','apellido','direccion','fechaNacimiento',
        'dui','sexo','tipoUsuario','juntaVigilancia','administrador'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['fechaNacimiento'];

    public static function buscar($nombre, $estado){
      return User::nombre($nombre)->estado($estado)->orderBy('apellido')->paginate(10);
    }

    public function scopeNombre($query, $nombre){
      if(trim($nombre)!=""){
        $query->where('nombre', 'ilike','%'.$nombre.'%')->orWhere('apellido', 'ilike','%'.$nombre.'%');
      }
    }

    public function scopeEstado($query, $estado){
      if($estado == null){
        $estado = 1;
      }
      $query->where('estado',$estado);
    }

    public function telefono($id){
      $telefono = TelefonoUsuario::where('f_usuario',$id)->orderBy('created_at')->first();
      return ($telefono!=null)?$telefono->telefono:"Sin teléfono";
    }

    public function nombreEspecialidad($id){
      $nombre = Especialidad::find($id);
      return $nombre->nombre;
    }
}
