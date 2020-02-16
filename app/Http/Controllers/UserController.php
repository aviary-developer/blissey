<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\TelefonoUsuario;
use App\Especialidad;
use App\EspecialidadUsuario;
use App\Bitacora;
use App\Servicio;
use App\CategoriaServicio;
use Redirect;
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
      $pagina = ($request->get('page')!=null)?$request->get('page'):1;
      $pagina--;
      $pagina *= 10;
      $estado = $request->get('estado');
      $nombre = $request->get('nombre');
      $usuarios = User::buscar($nombre,$estado);
      $activos = User::where('estado',true)->count();
      $inactivos = User::where('estado',false)->where('eliminar',true)->count();
      return view('Usuarios.index',compact(
        'usuarios',
        'estado',
        'nombre',
        'activos',
        'inactivos',
        'pagina'
      ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $especialidades = Especialidad::where('estado',true)->orderBy('nombre','asc')->get();
      return view('Usuarios.create',compact('especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        $user->cambio=1;
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

        if($request->tipoUsuario == "Médico" || $request->tipoUsuario == "Gerencia"){
          $categoria_existe = CategoriaServicio::where('nombre','Honorarios')->first();
          if($categoria_existe==null){
            $categoria = new CategoriaServicio;
            $categoria->nombre = "Honorarios";
            $categoria->save();
          }else{
            $categoria = $categoria_existe;
          }

          $servicio = new Servicio;
          $servicio->nombre = (($user->sexo)?"Dr. ":"Dra. ").$user->nombre.' '.$user->apellido;
          $servicio->precio = $request->precio;
          $servicio->retencion = $request->retencion;
          $servicio->f_categoria = $categoria->id;
          $servicio->f_medico = $user->id;
          $servicio->save();

          Bitacora::bitacora('store','servicios','servicios',$servicio->id);
        }


        DB::commit();
      }catch(Exception $e){
        DB::rollback();
        return redirect('/usuarios')->with('mensaje', '¡Algo salio mal!');
      }
      Bitacora::bitacora('store','users','usuarios',$user->id);
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
      $pagina = 0;
      $usuario = User::find($id);
      $telefonos = TelefonoUsuario::where('f_usuario',$id)->get();
      $especialidad_principal = EspecialidadUsuario::where('f_usuario',$id)->where('principal',true)->first();
      $especialidades = EspecialidadUsuario::where('f_usuario',$id)->where('principal',false)->get();
      $bitacoras = Bitacora::where('f_usuario',$id)->orderBy('created_at','desc')->get();
      return view('Usuarios.show',compact(
        'usuario',
        'telefonos',
        'especialidad_principal',
        'especialidades',
        'id',
        'bitacoras',
        'pagina'
      ));
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
        $servicio = Servicio::where('f_medico',$id)->first();
        return view('Usuarios.edit',compact(
          'usuarios',
          'especialidades',
          'telefono_usuarios',
          'especialidad_usuarios',
          'servicio'
        ));
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
      $user = User::find($id);
      DB::beginTransaction();
      try{
        $firma = $user->firma;
        $foto = $user->foto;
        $sello = $user->sello;
        $contra = $user->password;
        $user->fill($request->all());
        $user->password = $contra;
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
        $especialidad_flag = false;
        foreach ($request->delesp as $k => $val) {
          if ($val != "ninguno") {
            $eliminar = EspecialidadUsuario::findOrFail($val);
            if($eliminar->principal){
              $especialidad_flag = true;
            }
            $eliminar->delete();
          }
        }
        if($especialidad_flag){
          $primer_especialidad = EspecialidadUsuario::where('f_usuario',$id)->orderBy('created_at')->first();
          if($primer_especialidad != null){
            $primer_especialidad->principal = true;
            $primer_especialidad->save();
          }
        }
        if (isset($request->especialidad)) {
          $existe_esp_principal = EspecialidadUsuario::where('principal',true)->where('f_usuario',$id)->count();
          foreach ($request->especialidad as $k => $val) {
            $especialidad_usuario = new EspecialidadUsuario;
            if($k == 0 && $existe_esp_principal == 0){
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

        if(isset($request->id_servicio)){
          $servicio = Servicio::find($request->id_servicio);
          $servicio->precio = $request->precio;
          $servicio->retencion = $request->retencion;
          $servicio->save();

          Bitacora::bitacora('update','servicios','servicios',$servicio->id);
        }


        DB::commit();
      }catch(Exception $e){
        DB::rollback();
        return redirect('/usuarios')->with('mensaje', '¡Algo salio mal!');
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
      $telefonos = TelefonoUsuario::where('f_usuario',$id)->get();
      foreach($telefonos as $telefono){
        $telefono->delete();
      }
      if($usuario->foto != 'noImgen.jpg'){
        Storage::delete($usuario->foto);
      }
      if($usuario->firma != 'noImgen.jpg'){
        Storage::delete($usuario->firma);
      }
      if($usuario->sello != 'noImgen.jpg'){
        Storage::delete($usuario->sello);
      }
      $usuario->eliminar = false;
      $usuario->save();
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

    public function psw(Request $request){
      $actual = $request['actual'];
      $id = Auth::user()->id;
      $validador = Auth::attempt(['id' => $id, 'password' => $actual]);
      if(stripos($request['nueva'],Auth::user()->name) === false && stripos($request['nueva'],Auth::user()->email) === false){
        if($validador){
          $nueva = bcrypt($request['nueva']);
          $usuario = User::find($id);
          $usuario->password = $nueva;
          $usuario->cambio=0;
          $usuario->save();
          Bitacora::bitacora('update','users','usuarios',$id);
          return redirect('/logout');
        }else{
          return "error";
        }
      }else{
          return "serror";
      }
    }
}
