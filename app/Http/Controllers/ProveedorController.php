<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;
use App\Dependiente;
use Redirect;
use App\Http\Requests\ProveedoresRequest;
use Validator;

class ProveedorController extends Controller
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
      $proveedores = Proveedor::buscar($nombre,$estado);
      $activos = Proveedor::where('estado',true)->count();
      $inactivos = Proveedor::where('estado',false)->count();
      return view('Proveedores.index',compact(
        'proveedores',
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
        return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valida= Validator::make($request->all(),[
          'nombre'=>'required| min:5 |max:50 |unique:proveedors',
          'correo'=>'required| email |unique:proveedors',
          'telefono'=>'required| size:9 |unique:proveedors',
          'nombrev'=>'required',
        ],[
          'nombre.required'=>'El campo drogería es obligatorio',
          'nombre.min'=>'El campo drogería necesita 3 caracteres mínimos',
          'nombre.max'=>'El campo drogería necesita 50 caracteres máximo',
          'nombre.unique'=>'El campo drogería ya ha sido registrado',

          'correo.required'=>'El campo correo es obligatorio',
          'correo.email'=>'Ingrese un correo válido',
          'correo.unique'=>'El campo correo ya ha sido registrado',

          'telefono.required'=>'El campo teléfono es obligatorio',
          'telefono.size'=>'El teléfono necesita 9 caracteres incluyendo el guión',
          'telefono.unique'=>'El campo teléfono ya ha sido registrado',

          'nombrev.required'=>'No se ha ingresado ningún visitador',
        ]
      );
        if($valida->fails()){
          $nombre=$request->nombre;
          $correo=$request->correo;
          $telefono=$request->telefono;
          $nombrev=$request->nombrev;
          $apellidov=$request->apellidov;
          $telefonov=$request->telefonov;
        return view('Proveedores.create',compact('nombre','correo','telefono','nombrev','apellidov','telefonov'))->withErrors($valida->errors());
      }else{
        Proveedor::create([
            'nombre'=>$request['nombre'],
            'correo'=>$request['correo'],
            'telefono'=>$request['telefono'],
        ]);
        $id_proveedor=Proveedor::buscarId($request['nombre']);

          $contador=count($request['nombrev']);
          $nombrev=$request['nombrev'];
          $apellidov=$request['apellidov'];
          $telefonov=$request['telefonov'];
          for($a=0;$a<$contador;$a++){
            Dependiente::create([
              'f_proveedor'=>$id_proveedor,
              'nombre'=>$nombrev[$a],
              'apellido'=>$apellidov[$a],
              'telefono'=>$telefonov[$a],
            ]);
          }
          return redirect('/proveedores')->with('mensaje','¡Guardado!');
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
      $proveedor = Proveedor::find($id);
      return view('Proveedores.show',compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedor=Proveedor::find($id);
        return view('Proveedores.edit',compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   $v1=$v2=$v3=0;
        $proveedor=Proveedor::find($id);
        if($request->nombre==$proveedor->nombre){
          $v1=1;
        }else{
          $validar['nombre']="required| min:5 |max:40 |unique:proveedors";
          $men['nombre.required']="El campo drogería es requerido";
          $men['nombre.min']="El campo drogería requiere mínimo 5 caracteres";
          $men['nombre.max']="El campo drogería requiere máximo 40 caracteres";
          $men['nombre.unique']="Drogería registrada, ingrese otra";
        }
        if($request->correo==$proveedor->correo){
          $v2=1;
        }else{
          $validar['correo']="required| email |unique:proveedors";
          $men['correo.required']="El campo correo es requerido";
          $men['correo.email']="El texto ingresado no es un correo electrónico";
          $men['correo.unique']="Correo registrado, ingrese otro";
        }
        if($request->telefono==$proveedor->telefono){
          $v3=1;
        }else{
          $validar['telefono']="required| size:9 |unique:proveedors";
          $men['telefono.required']="El campo teléfono es requerido";
          $men['telefono.size']="El campo teléfono debe contener 9 caracteres";
          $men['telefono.unique']="Teléfono registrado, ingrese otro";
        }
        if($v1==1 && $v2==1 && $v3==1){
          return redirect('/proveedores')->with('info','¡No hay cambios!');
        }else{
          $this->validate($request,$validar,$men);
          $proveedor->fill($request->all());
          $proveedor->save();
          return redirect('/proveedores')->with('mensaje','¡Editado!');
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
      $proveedores = Proveedores::findOrFail($id);
      $proveedores->delete();
      return redirect('/proveedores?estado=0');
    }

    public function desactivate($id){
      $proveedores= Proveedor::find($id);
      $proveedores->estado = false;
      $proveedores->save();
      return Redirect::to('/proveedores');
    }

    public function activate($id){
      $proveedores = Proveedor::find($id);
      $proveedores->estado = true;
      $proveedores->save();
      return Redirect::to('/proveedores?estado=0');
    }

    public function existeNombre($nombre){
      $conteo=Proveedor::where('nombre','=',$nombre)->count();
      if($conteo==0){
        echo "false";
      }else{
        echo "true";
      }
    }

    public function existeCorreo($correo){
      $conteo=Proveedor::where('correo','=',$correo)->count();
      if($conteo==0){
        echo "false";
      }else{
        echo "true";
      }
    }

    public function existeTelefono($telefono){
      $conteo=Proveedor::where('telefono','=',$telefono)->count();
      if($conteo==0){
        echo "false";
      }else{
        echo "true";
      }
    }
}
