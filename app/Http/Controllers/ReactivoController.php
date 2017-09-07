<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Reactivo;
use Redirect;

class ReactivoController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $reactivos=Reactivo::orderBy('id','asc')->paginate(5);
    return view('Reactivos.index',compact('reactivos'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('Reactivos.create');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    if($request->ajax()){
      Reactivo::create($request->all());
      return response()->json([
        "mensaje"=>$request->all()
      ]);
    }
    Reactivo::create($request->All());
    return redirect('/reactivos')->with('mensaje','Registro Guardado');
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
    $reactivos=Reactivo::find($id);
    return response()->json(
      $reactivos->toArray()
    );
    /*$reactivos=Reactivo::find($id);
      return view('reactivos.edit', compact('reactivos'));*/
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
      $reactivos = Reactivo::find($id);
        $reactivos->fill($request->all());
        $reactivos->save();
        return response()->json([
          "mensaje"=>"Reactivo Actualizado"
        ]);
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
        $reactivos= Reactivo::find($id);
        $reactivos->delete();
        return Redirect::to('/reactivos');
  }
  public function listingReactivos(){
    $reactivos=Reactivo::orderBy('id', 'desc')->get();
    return response()->json(
      $reactivos->toArray()
    );
  }
}
