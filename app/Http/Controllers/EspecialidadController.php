<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Especialidad;
use App\Bitacora;
use Redirect;
use Carbon\Carbon;
use DB;
use App\Http\Requests\EspecialidadRequest;

class EspecialidadController extends Controller
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
      $especialidades = Especialidad::buscar($nombre,$estado);
      $activos = Especialidad::where('estado',true)->count();
      $inactivos = Especialidad::where('estado',false)->count();
      return view('Especialidades.index',compact(
        'especialidades',
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
        return view('Especialidades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EspecialidadRequest $request)
    {
      DB::beginTransaction();

      try {
        $especialidades = Especialidad::create($request->All());
      } catch (Exception $e) {
        DB::rollback();
        return redirect('/especialidades')->with('mensaje', 'Algo salio mal');
      }
      DB::commit();
      Bitacora::bitacora('store','especialidads','especialidades',$especialidades->id);
      return redirect('/especialidades')->with('mensaje', '¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $especialidad = Especialidad::find($id);
      $medicos = $especialidad->usuario_especialidad;
      return view('Especialidades.show',compact(
        'especialidad',
        'medicos'
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
      $especialidades = Especialidad::find($id);
      return view('Especialidades.edit',compact('especialidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EspecialidadRequest $request, $id)
    {
      $especialidades = Especialidad::find($id);
      DB::beginTransaction();
      try {
        $especialidades->fill($request->all());
        $especialidades->save();
      } catch (Exception $e) {
        DB::rollback();
        if($especialidades->estado)
        {
          return redirect('/especialidades')->with('mensaje', 'Algo salio mal');
        }
        else{
          return redirect('/especialidades?estado=0')->with('mensaje', 'Algo salio mal');
        }
      }
      DB::commit();
      Bitacora::bitacora('update','especialidads','especialidades',$id);
      if($especialidades->estado)
      {
        return redirect('/especialidades')->with('mensaje', '¡Editado!');
      }
      else{
        return redirect('/especialidades?estado=0')->with('mensaje', '¡Editado!');
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
      $especialidades = Especialidad::findOrFail($id);
      $especialidades->delete();
      Bitacora::bitacora('destroy','especialidads','especialidades',$id);
      return redirect('/especialidades?estado=0');
    }

    public function desactivate($id){
      $especialidades = Especialidad::find($id);
      $especialidades->estado = false;
      $especialidades->save();
      Bitacora::bitacora('desactivate','especialidads','especialidades',$id);
      return Redirect::to('/especialidades');
    }

    public function activate($id){
      $especialidades = Especialidad::find($id);
      $especialidades->estado = true;
      $especialidades->save();
      Bitacora::bitacora('activate','especialidads','especialidades',$id);
      return Redirect::to('/especialidades?estado=0');
    }

    public function guardar(Request $request){
      DB::beginTransaction();
      try {
        $especialidades = Especialidad::create($request->All());
      } catch (Exception $e) {
        DB::rollback();
        return 0;
      }
      DB::commit();
      Bitacora::bitacora('store','especialidads','especialidades',$especialidades->id);
      return $especialidades->id;
    }
}
