<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\TelefonoUsuario;
use App\Especialidad;
use App\EspecialidadUsuario;
use App\Bitacora;
use Redirect;
use Carbon\Carbon;
use App\Http\Controllers;
use Validator;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $estado = $request->get('estado');
      $nombre = $request->get('nombre');
      $usuarios = User::buscar($nombre,$estado);
      $activos = User::where('estado',true)->count();
      $inactivos = User::where('estado',false)->count();
      return view('Usuarios.index',compact('usuarios','estado','nombre','activos','inactivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $especialidades = Especialidad::where('estado',true)->orderBy('nombre','asc')->get();
      return view('usuarios.create',compact('especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $rules = [
        'nombre' => 'required | min:2 | max:30',
        'apellido' => 'required | min:2 | max:30',
        'fechaNacimiento' => 'required',
        'direccion' => 'required | min:2',
        'name' => 'required | min:4 | max:30 | unique:users',
        'email' => 'required | email | unique:users'
      ];
      $messages = [
        'nombre.required' => 'El campo nombre es obligatorio',
        'nombre.min' => 'El campo nombre necesita 2 caracteres como mínimo',
        'nombre.max' => 'El campo nombre soporta 30 caracteres como máximo',

        'apellido.required' => 'El campo apellido es obligatorio',
        'apellido.min' => 'El campo apellido necesita 2 caracteres como mínimo',
        'apellido.max' => 'El campo apellido soporta 30 caracteres como máximo',

        'fechaNaciento.required' => 'El campo fecha de nacimiento es obligatorio',

        'name.required' => 'El campo usuario es obligatorio',
        'name.min' => 'El campo usuario necesita 4 caracteres como mínimo',
        'name.max' => 'El campo usuario soporta 30 caracteres como máximo',
        'name.unique' => 'El usuario ya ha sido registrado',

        'email.required' => 'El campo correo es obligatorio',
        'email.email' => 'Ingrese un correo válido',
        'email.unique' => 'El correo ya ha sido registrado',

        'direccion.required' => 'El campo direccion es obligatorio',
        'direccion.min' => 'El campo direccion necesita 2 caracteres como mínimo',
      ];

      $valida = Validator::make($request->all(), $rules , $messages);
      
      if($valida->fails()){
        $nombre = $request->nombre;
        $apellido = $request->apellido;
        $sexo = $request->sexo;
        $fechaNacimiento = $request->fechaNacimiento;
        $dui = $request->dui;
        $direccion = $request->direccion;
        $name = $request->name;
        $email = $request->email;
        $tipoUsuario = $request->tipoUsuario;
        $administrador = $request->administrador;
        $juntaVigilancia = $request->juntaVigilancia;

        $especialidades = Especialidad::where('estado',true)->orderBy('nombre','asc')->get();

        $telefonos = $request->telefono;
        $especialidades_tabla = $request->especialidad;

        return view('Usuarios.create', compact(
          'nombre',
          'apellido',
          'sexo',
          'fechaNacimiento',
          'dui',
          'direccion',
          'name',
          'email',
          'tipoUsuario',
          'administrador',
          'juntaVigilancia',
          'especialidades',
          'telefonos',
          'especialidades_tabla'
        ))->withErrors($valida->errors());
      }else{
        DB::beginTransaction();
        try{
          $request['password']=bcrypt($request['email']);
          $user = User::create($request->All());
          if($request->hasfile('firma')){
            $user->firma = $request->file('firma')->store('public/firma');
          }
          if($request->hasfile('sello')){
            $user->sello = $request->file('sello')->store('public/sello');
          }
          if($request->hasfile('foto')){
            $user->foto = $request->file('foto')->store('public/foto');
          }
          $user->save();
          if (isset($request->telefono)) {
            foreach ($request->telefono as $k => $val) {
              $telefono_usuario = new TelefonoUsuario;
              $telefono_usuario->f_usuario = $user->id;
              $telefono_usuario->telefono = $request->telefono[$k];
              $telefono_usuario->save();
            }
          }
          if (isset($request->especialidad)) {
            foreach ($request->especialidad as $k => $val) {
              $especialidad_usuario = new EspecialidadUsuario;
              if($k == 0){
                $especialidad_usuario->principal = true;
              }else{
                $especialidad_usuario->principal = false;
              }
              $especialidad_usuario->f_usuario = $user->id;
              $especialidad_usuario->f_especialidad = $request->especialidad[$k];
              $especialidad_usuario->save();
            }
          }
          DB::commit();
        }catch(Exception $e){
          DB::rollback();
          return redirect('/usuarios')->with('mensaje', '¡Algo salio mal!');  
        }
        Bitacora::bitacora('store','users','usuarios',$user->id);
        return redirect('/usuarios')->with('mensaje', '¡Guardado!');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::find($id);
        $telefonos = TelefonoUsuario::where('f_usuario',$id)->get();
        $especialidad_principal = EspecialidadUsuario::where('f_usuario',$id)->where('principal',true)->first();
        $especialidades = EspecialidadUsuario::where('f_usuario',$id)->where('principal',false)->get();
        $bitacoras = Bitacora::where('f_usuario',$id)->orderBy('created_at','desc')->paginate(10);
        return view('Usuarios.show',compact('usuario','telefonos','especialidad_principal','especialidades','id','bitacoras'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuarios = User::find($id);
        $especialidades = Especialidad::where('estado',true)->orderBy('nombre','asc')->get();
        $especialidad_usuarios = EspecialidadUsuario::where('f_usuario',$id)->get();
        $telefono_usuarios = TelefonoUsuario::where('f_usuario',$id)->get();
        return view('Usuarios.edit',compact('usuarios','especialidades','telefono_usuarios','especialidad_usuarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $request['password']=bcrypt($request['password']);
      $user = User::find($id);
      $firma = $user->firma;
      $foto = $user->foto;
      $sello = $user->sello;
      $user->fill($request->all());
      if($request->hasfile('firma')){
        $user->firma = $request->file('firma')->store('public/firma');
        if($firma != "noImgen.jpg"){
          Storage::delete($firma);
        }
      }
      if($request->hasfile('sello')){
        $user->sello = $request->file('sello')->store('public/sello');
        if($sello != "noImgen.jpg"){
          Storage::delete($sello);
        }
      }
      if($request->hasfile('foto')){
        $user->foto = $request->file('foto')->store('public/foto');
        if($foto != "noImgen.jpg"){
          Storage::delete($foto);
        }
      }
      $user->save();
      if (isset($request->telefono)) {
        foreach ($request->telefono as $k => $val) {
          $telefono_usuario = new TelefonoUsuario;
          $telefono_usuario->f_usuario = $user->id;
          $telefono_usuario->telefono = $request->telefono[$k];
          $telefono_usuario->save();
        }
      }
      if (isset($request->especialidad)) {
        foreach ($request->especialidad as $k => $val) {
          $especialidad_usuario = new EspecialidadUsuario;
          if($k == 0){
            $especialidad_usuario->principal = true;
          }else{
            $especialidad_usuario->principal = false;
          }
          $especialidad_usuario->f_usuario = $user->id;
          $especialidad_usuario->f_especialidad = $request->especialidad[$k];
          $especialidad_usuario->save();
        }
      }
      foreach ($request->deletes as $k => $val) {
        if ($val != "ninguno") {
          $eliminar = TelefonoUsuario::findOrFail($val);
          $eliminar->delete();
        }
      }
      foreach ($request->delesp as $k => $val) {
        if ($val != "ninguno") {
          $eliminar = EspecialidadUsuario::findOrFail($val);
          $eliminar->delete();
        }
      }
      Bitacora::bitacora('update','users','usuarios',$id);
      if($user->estado)
      {
        return redirect('/usuarios')->with('mensaje', '¡Editado!');
      }
      else{
        return redirect('/usuarios?estado=0')->with('mensaje', '¡Editado!');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $usuario = User::findOrFail($id);
      if($usuario->foto != 'noImgen.jpg'){
        Storage::delete($usuario->foto);
      }
      if($usuario->firma != 'noImgen.jpg'){
        Storage::delete($usuario->firma);
      }
      if($usuario->sello != 'noImgen.jpg'){
        Storage::delete($usuario->sello);
      }
      $usuario->delete();
      Bitacora::bitacora('destroy','users','usuarios',$id);
      return redirect('/usuarios?estado=0');
    }
    public function desactivate($id){
      $usuario = User::find($id);
      $usuario->estado = false;
      $usuario->save();
      Bitacora::bitacora('desactivate','users','usuarios',$id);
      return Redirect::to('/usuarios');
    }

    public function activate($id){
      $usuario = User::find($id);
      $usuario->estado = true;
      $usuario->save();
      Bitacora::bitacora('activate','users','usuarios',$id);
      return Redirect::to('/usuarios?estado=0');
    }
}
