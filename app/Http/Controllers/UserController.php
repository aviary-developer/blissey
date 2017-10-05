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
      foreach ($request->telefono as $k => $val) {
        $telefono_usuario = new TelefonoUsuario;
        $telefono_usuario->f_usuario = $user->id;
        $telefono_usuario->telefono = $request->telefono[$k];
        $telefono_usuario->save();
      }
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
        //
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
        return view('Usuarios.edit',compact('usuarios','especialidades'));
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
        //
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
      if($usuario->foto != 'noImagen.jpg'){
        Storage::delete($usuario->foto);
      }
      if($usuario->firma != 'noImagen.jpg'){
        Storage::delete($usuario->firma);
      }
      if($usuario->sello != 'noImagen.jpg'){
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
