<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\TelefonoUsuario;
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
        return view('usuarios.create');
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
        //
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
        //
    }
}
