<?php

namespace App\Http\Controllers;
use App\Dependiente;
use Illuminate\Http\Request;
use App\Http\Requests\DependienteRequest;
use App\Bitacora;

class DependienteController extends Controller
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
      $id_proveedor=$request->id;
      $estado=$request->estado;
      $visitadores=Dependiente::buscar($id_proveedor,$estado);
      $activos = Dependiente::where('f_proveedor','=',$id_proveedor)->where('estado',true)->count();
      $inactivos = Dependiente::where('f_proveedor','=',$id_proveedor)->where('estado',false)->count();
      return view('Visitadores.index',compact(
        'id_proveedor',
        'estado',
        'nombre',
        'visitadores',
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
    public function create(Request $request)
    {
      $id=$request->id;
      return view('Visitadores.create',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DependienteRequest $request)
    {
        $dp=Dependiente::create($request->all());
        Bitacora::bitacora('store','dependientes','visitadores',$dp->id);
        return redirect('/visitadores?id='.$request->f_proveedor)->with('mensaje','¡Guardado!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   $visitador=Dependiente::find($id);
        return view('Visitadores.show',compact('visitador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visitador=Dependiente::find($id);
        return view('Visitadores.edit',compact('visitador'));
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
        $visitador=Dependiente::find($id);
        $nv=1; //No necesita validar=true
        if($visitador['nombre']!=$request['nombre']){
          $nv=0;
          $validar['nombre']='required | min:3 | max:25';
        }
        if($visitador['apellido']!=$request['apellido']){
          $nv=0;
          $validar['apellido']='required | min:3 | max:25';
        }
        if($visitador['telefono']!=$request['telefono']){
          $nv=0;
          $validar['telefono']='required | size:9';
        }
        if($nv==1){
          return redirect('/visitadores?estado='.$visitador->estado.'&id='.$visitador->f_proveedor)->with('info', '¡No hay cambios!');
        }else{
          $this->validate($request,$validar);
          $visitador->fill($request->all());
          $visitador->save();
          Bitacora::bitacora('update','dependientes','visitadores',$visitador->id);
          return redirect('/visitadores?estado='.$visitador->estado.'&id='.$visitador->f_proveedor)->with('mensaje','¡Editado!');
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
        $dependiente=Dependiente::findOrFail($id);
        $p=$dependiente->f_proveedor;
        $e=$dependiente->estado;
        Dependiente::destroy($id);
        Bitacora::bitacora('destroy','dependientes','visitadores',$id);
        return redirect('/visitadores?estado=0&id='.$p);
    }
    public function desactivate($id){
      $dependiente= Dependiente::find($id);
      $dependiente->estado = false;
      $dependiente->save();
      Bitacora::bitacora('desactivate','dependientes','visitadores',$id);
      return redirect('/visitadores?estado=1&id='.$dependiente->f_proveedor);
    }

    public function activate($id){
      $dependiente = Dependiente::find($id);
      $dependiente->estado = true;
      $dependiente->save();
      Bitacora::bitacora('activate','dependientes','visitadores',$id);
      return redirect('/visitadores?estado=0&id='.$dependiente->f_proveedor);
    }
}
