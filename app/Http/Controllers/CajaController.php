<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Caja;
use Redirect;
use App\Bitacora;
use DB;

class CajaController extends Controller
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
      $cajas = Caja::buscar($estado);
      $activos = Caja::where('estado',true)->count();
      $inactivos = Caja::where('estado',false)->count();
      return view('Cajas.index',compact(
        'cajas',
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
        return view('Cajas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $caja=new Caja;
      $caja->fill($request->all());
      $caja->save();
      Bitacora::bitacora('store','cajas','cajas',$caja->id);
      return redirect('/cajas')->with('mensaje','¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $caja= Caja::find($id);
      return view('Cajas.show',compact('caja'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $caja= Caja::find($id);
      return view('Cajas.edit',compact('caja'));
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
      $caja=Caja::find($id);
      $nv=1; //No necesita validar = true
      if($caja->nombre!=$request->nombre){
        $nv=0;
        $validar['nombre']='required | min:5 | max:30 |unique:cajas';

        $mensaje['nombre.required']='El campo código identificador es obligatorio';
        $mensaje['nombre.min']='El campo nombre necesita 5 caracteres mínimos';
        $mensaje['nombre.max']='El campo nombre necesita 30 caracteres máximo';
        $mensaje['nombre.unique']='El campo código identificador ya ha sido registrado';
      }
      if($caja->localizacion!=$request->localizacion){
        $nv=0;
        $validar['localizacion']='required';
        $mensaje['localizacion.required']='El campo localización es obligatorio';
      }
      if($nv==1){
        return redirect('/cajas?estado'.$caja->estado)->with('info', '¡No hay cambios!');
      }
      else{
        $this->validate($request,$validar,$mensaje);
        $caja->fill($request->all());
        $caja->save();
        Bitacora::bitacora('update','cajas','cajas',$caja->id);
        return redirect('/cajas?estado'.$caja->estado)->with('mensaje','¡Editado!');
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
       DB::beginTransaction();
       try {
         $cajas = Caja::findOrFail($id);
         $cajas->delete();
         Bitacora::bitacora('destroy','cajas','cajas',$id);
         DB::commit();
         return redirect('/cajas?estado=0');
       } catch (\Exception $e) {
         DB::rollback();
         return redirect('/cajas?estado=0');

       }

     }

     public function desactivate($id){
       $cajas = Caja::find($id);
       $cajas->estado = false;
       $cajas->save();
       Bitacora::bitacora('desactivate','cajas','cajas',$id);
       return Redirect::to('/cajas');
     }
     public function activate($id){
       $cajas = Caja::find($id);
       $cajas->estado = true;
       $cajas->save();
       Bitacora::bitacora('activate','cajas','cajas',$id);
       return Redirect::to('/cajas?estado=0');
     }
}
