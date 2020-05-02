<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;
use App\Dependiente;
use Redirect;
use App\Http\Requests\ProveedoresRequest;
use Validator;
use App\Bitacora;
use Response;
use DB;

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
      $proveedores = Proveedor::buscar($estado);
      $activos = Proveedor::where('estado',true)->count();
      $inactivos = Proveedor::where('estado',false)->count();
      return view('Proveedores.index',compact(
        'proveedores',
        'estado',
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
        return view('Proveedores.create');
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
        ],[
          'nombre.required'=>'El campo proveedor es obligatorio',
          'nombre.min'=>'El campo proveedor necesita 3 caracteres mínimos',
          'nombre.max'=>'El campo proveedor necesita 50 caracteres máximo',
          'nombre.unique'=>'El campo proveedor ya ha sido registrado',
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
        $proveedor=Proveedor::create([
            'nombre'=>$request['nombre'],
            'correo'=>$request['correo'],
            'telefono'=>$request['telefono'],
        ]);
          $id_proveedor=$proveedor->id;
          $contador=count($request['nombrev']);
          $nombrev=$request['nombrev'];
          $apellidov=$request['apellidov'];
          $telefonov=$request['telefonov'];
          if($contador!=null){
            for($a=0;$a<$contador;$a++){
              $dp=Dependiente::create([
                'f_proveedor'=>$id_proveedor,
                'nombre'=>$nombrev[$a],
                'apellido'=>$apellidov[$a],
                'telefono'=>$telefonov[$a],
              ]);
              Bitacora::bitacora('store','dependientes','visitadores',$dp->id);
            }
          }
          Bitacora::bitacora('store','proveedors','proveedores',$proveedor->id);
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
        $validar=array();
        $men=array();
        if($request->nombre==$proveedor->nombre){
          $v1=1;
        }else{
          $validar['nombre']="required| min:5 |max:50 |unique:proveedors";
          $men['nombre.required']="El campo proveedor es requerido";
          $men['nombre.min']="El campo proveedor requiere mínimo 5 caracteres";
          $men['nombre.max']="El campo proveedor requiere máximo 50 caracteres";
          $men['nombre.unique']="Proveedor registrado, ingrese otro";
        }
        if($request->correo==$proveedor->correo){
          $v2=1;
        }else{
          if(trim($request->correo)!=""){
            $validar['correo']="email |unique:proveedors";
            $men['correo.email']="El texto ingresado no es un correo electrónico";
            $men['correo.unique']="Correo registrado, ingrese otro";
          }
        }
        if($request->telefono==$proveedor->telefono){
          $v3=1;
        }else{
          echo $request->telefono;
          if(trim($request->telefono)!=""){
            $validar['telefono']="size:9 |unique:proveedors";
            $men['telefono.size']="El campo teléfono debe contener 9 caracteres";
            $men['telefono.unique']="Teléfono registrado, ingrese otro";
          }
        }
        if($v1==1 && $v2==1 && $v3==1){
          return redirect('/proveedores')->with('info','¡No hay cambios!');
        }else{
          $this->validate($request,$validar,$men);
          $proveedor->fill($request->all());
          $proveedor->save();
          Bitacora::bitacora('update','proveedors','proveedores',$id);
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
      try {
        DB::beginTransaction();
        $dependientes=Dependiente::where('f_proveedor',$id)->get();
        foreach($dependientes as $d){
          $d->delete();
          Bitacora::bitacora('destroy','dependientes','visitadores',$d->id);
        }
        $proveedores = Proveedor::findOrFail($id);
        $proveedores->delete();
        Bitacora::bitacora('destroy','proveedors','proveedores',$id);
        DB::commit();
        return redirect('/proveedores?estado=0')->with('mensaje','¡Eliminado!');
      } catch (\Exception $e) {
        DB::rollback();
        return redirect('/proveedores?estado=0')->with('error','¡No se puede eliminar!');
      }
    }

    public function desactivate($id){
      $proveedores= Proveedor::find($id);
      $proveedores->estado = false;
      $proveedores->save();
      Bitacora::bitacora('desactivate','proveedors','proveedores',$id);
      return Redirect::to('/proveedores')->with('mensaje','¡Desactivado!');
    }

    public function activate($id){
      $proveedores = Proveedor::find($id);
      $proveedores->estado = true;
      $proveedores->save();
      Bitacora::bitacora('activate','proveedors','proveedores',$id);
      return Redirect::to('/proveedores?estado=0')->with('mensaje','¡Restaurado!');
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
    public static function ingresoProveedor(ProveedoresRequest $request){
      $p=Proveedor::create($request->All());
      Bitacora::bitacora('store','proveedors','proveedores',$p->id);
      return Response::json('success');
    }
    public static function llenarProveedor(){
      $proveedores=Proveedor::where('estado',true)->orderBy('nombre')->get(['id','nombre']);
      return Response::json($proveedores);
    }
    public static function pyp(){
      $proveedores = Proveedor::buscar(true);
      $header = view('PDF.header.farmacia');
      $footer = view('PDF.footer.numero_pagina');
      $main = view('Transacciones.PDF.productos',compact('proveedores'));
      $pdf = \PDF::loadHtml($main)->setPaper('Letter');
      return $pdf->stream('lotes.pdf');
    }
}