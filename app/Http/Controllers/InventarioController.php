<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\DivisionProducto;
use App\DetalleDevolucion;
use App\CambioProducto;
use App\Estante;
use App\DetalleTransacion;

class InventarioController extends Controller
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
      $dp = DivisionProducto::buscar(true);
      return view('Inventarios.index',compact('dp','pagina'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DivisionProducto::lotes($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto=DivisionProducto::find($id);
        $lotes=DivisionProducto::lotes($id);
        return view('Inventarios.edit',compact('producto','lotes'));
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
        $idv=$request->idv;
        $f_estante=$request->f_estante;
        $nivel=$request->nivel;
        foreach($idv as $k => $valor){
            $detalle=DetalleTransacion::find($valor);
            $detalle->f_estante=$f_estante[$k];
            $detalle->nivel=$nivel[$k];
            $detalle->save();
        }
        Return redirect('/inventarios')->with('mensaje', '¡Editado!');
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
