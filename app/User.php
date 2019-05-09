<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use App\Notifications\MyResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nombre',
        'apellido',
        'direccion',
        'fechaNacimiento',
        'dui',
        'sexo',
        'tipoUsuario',
        'juntaVigilancia',
        'administrador'
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
      return User::nombre($nombre)->estado($estado)->where('eliminar',true)->orderBy('apellido')->get();
    }

    public function scopeNombre($query, $nombre){
      if(trim($nombre)!=""){
        $query->where('nombre', 'like','%'.$nombre.'%')->orWhere('apellido', 'like','%'.$nombre.'%');
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

    public static function completed($id){
      $registro = User::find($id);
      $telefono = TelefonoUsuario::where('f_usuario',$id)->count();
      if($telefono < 1)
        return true;
      if($registro->foto == "noImgen.jpg")
        return true;
      return false;
    }

    public static function especialidad_principal($id){
      $registro = EspecialidadUsuario::where('f_usuario',$id)->where('principal',true)->first();
      if($registro != null){
        return $registro->f_especialidad;
      }
      return 0;
    }

    public static function nombre_especialidad_index($id){
      if($id != 0){
        $nombre = Especialidad::find($id);
        return $nombre->nombre;
      }
      return "Ninguna";
    }

    public static function password_correo(){
      $email = Auth::user()->email;
      $usuario = Auth::user()->name;
      $validacion = Auth::attempt(['password' => $email, 'name' => $usuario]);
      return $validacion;
    }

    public function union(){
      return $this->hasMany('App\EspecialidadUsuario','f_usuario')->orderBy('principal','desc');
    }

    public function servicio(){
      return $this->hasOne('App\Servicio','f_medico');
    }

    public function telephone(){
      return $this->hasMany('App\TelefonoUsuario','f_usuario');
    }

    public static function buscar_servicio($id){
      $r = User::find($id);
      return $r->servicio->id;
    }

    public function sendPasswordResetNotification($token){
        $this->notify(new MyResetPassword($token));
    }
}
