<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DivisionProducto;
use App\DetalleDevolucion;
use App\DetalleTransacion;
use App\Devolucion;
use App\Bitacora;
use App\Inventario;
use App\Transacion;

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
        $cantidad=$request->cantidad;
        foreach($idv as $k => $valor){
            $detalle=DetalleTransacion::find($valor);
            $anterior=$detalle->cantidad;
            $nuevo=$cantidad[$k]+($request->cl[$k]-$request->ca[$k]);
            $detalle->cantidad=$nuevo;
            $detalle->f_estante=$f_estante[$k];
            $detalle->nivel=$nivel[$k];
            $detalle->save();
            $diferencia=$nuevo-$anterior;
            $ultimo=Inventario::where('f_divisionproducto',$detalle->f_producto)->where('localizacion',Transacion::tipoUsuario())->get()->last()->existencia_nueva;
            $ahora=$ultimo+$diferencia;
        Inventario::Actualizar($detalle->f_producto,Transacion::tipoUsuario(),15,$ultimo);  
        Inventario::Actualizar($detalle->f_producto,Transacion::tipoUsuario(),14,$ahora);          
        }
        Bitacora::bitacora('update','detalle_transacions','inventarios',$id);
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
    public static function salida(Request $request){
        $salida=new Devolucion();
        $salida->fecha=\Carbon\Carbon::now();
        $salida->justificacion=$request->justificar;
        $salida->tipo=1;
        $salida->save();

        $detalle= new DetalleDevolucion();
        $detalle->f_devolucion=$salida->id;
        $detalle->f_detalle_transaccion=$request->idTr;
        $detalle->cantidad=$request->cantidad;
        $detalle->tipo=1;
        $detalle->save();
        Bitacora::bitacora('update','salidas','inventarios',$request->idTr);
        return redirect('/inventarios')->with('mensaje', '!Acción exitosa¡');

    }
}
