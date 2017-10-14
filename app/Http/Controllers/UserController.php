<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\TelefonoUsuario;
use App\Especialidad;
use App\EspecialidadUsuario;
use Redirect;
use Carbon\Carbon;
use App\Http\Controllers;

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
      $request['password']=bcrypt($request['password']);
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
      return redirect('/usuarios')->with('mensaje', '¡Guardado!');
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
        return view('Usuarios.show',compact('usuario','telefonos','especialidad_principal','especialidades','id'));
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
      return redirect('/usuarios?estado=0');
    }
    public function desactivate($id){
      $usuario = User::find($id);
      $usuario->estado = false;
      $usuario->save();
      return Redirect::to('/usuarios');
    }

    public function activate($id){
      $usuario = User::find($id);
      $usuario->estado = true;
      $usuario->save();
      return Redirect::to('/usuarios?estado=0');
    }
}
