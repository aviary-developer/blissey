<?php

namespace App\Http\Controllers;

use App\Division;
use Illuminate\Http\Request;
use App\Http\Requests\DivisionRequest;
use Redirect;
use Response;
use App\Bitacora;
use App\DivisionProducto;
use DB;

class DivisionController extends Controller
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
      $divisiones = Division::buscar($estado);
      $activos = Division::where('estado',true)->count();
      $inactivos = Division::where('estado',false)->count();
      return view('Divisiones.index',compact(
        'divisiones',
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
        return view('Divisiones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DivisionRequest $request)
    {
      $division=new Division();
      $division->fill($request->all());
      $division->save();
      Bitacora::bitacora('store','divisions','divisiones',$division->id);
        return redirect('/divisiones')->with('mensaje','¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
          $division=Division::find($id);
          return view('Divisiones.show',compact('division'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $division=Division::find($id);
        return view('Divisiones.edit',compact('division'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
      $division=Division::find($id);
      if($request->nombre==$division->nombre){
        return redirect('/divisiones?estado'.$division->estado)->with('info', '¡No hay cambios!');
      }else{
        $validar['nombre']='required';
        $this->validate($request,$validar);
        $division->fill($request->all());
        $division->save();
        Bitacora::bitacora('update','divisions','divisiones',$division->id);
        return redirect('/divisiones')->with('mensaje','¡Editado!');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      DB::beginTransaction();
      try {
        $division = Division::findOrFail($id);
        $division->delete();
        Bitacora::bitacora('destroy','divisions','divisiones',$id);
        DB::commit();
        return redirect('/divisiones?estado=0');
      } catch (\Exception $e) {
        DB::rollback();
        return redirect('/divisiones?estado=0');
      }
    }

    public function desactivate($id){
      $divisiones = Division::find($id);
      $divisiones->estado = false;
      $divisiones->save();
      Bitacora::bitacora('desactivate','divisions','divisiones',$id);
      return Redirect::to('/divisiones');
    }
    public function activate($id){
      $divisiones = Division::find($id);
      $divisiones->estado = true;
      $divisiones->save();
      Bitacora::bitacora('activate','divisions','divisiones',$id);
      return Redirect::to('/divisiones?estado=0');
    }
    public static function ingresoDivision(DivisionRequest $request){
      $d=Division::create($request->All());
      Bitacora::bitacora('store','divisions','divisiones',$d->id);
      return Response::json('success');
    }
    public static function llenarDivision(){
      $divisiones=Division::where('estado',true)->orderBy('nombre')->get(['id','nombre']);
      return Response::json($divisiones);
		}
	
	public function f_a(){
		$divisiones = DivisionProducto::get();
		$texto = "";
		foreach($divisiones as $division){
			//$texto .= "update division_productos set precio = ".$division->precio." where id = ".$division->id.";\n";
			echo "update division_productos set precio = " . $division->precio . " where id = " . $division->id . ";<br>";
		}
		//return $texto;
	}
}
