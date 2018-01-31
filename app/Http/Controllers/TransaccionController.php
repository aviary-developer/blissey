<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Response;
use App\Transacion;
use App\DetalleTransacion;
use App\DivisionProducto;
use App\Division;
use App\Presentacion;
use App\InventarioFarmacia;
use DB;
use Auth;
use Validator;
use App\Paciente;
use App\Componente;
use App\Servicio;

class TransaccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    $tipo= $request->tipo;
    $estado=$request->estado;
    if(Auth::check()){
      $transacciones=Transacion::buscar($tipo,$estado);
      return view('transacciones.index',compact('transacciones','tipo','estado'));
    }else{
      return redirect('/');
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tipo=$request->tipo;
        return view('Transacciones.create',compact('tipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $tipo=$request->tipo;
      $fecha=$request->fecha;
      $f_proveedor=$request->f_proveedor;
      $f_producto=$request->f_producto;
      $cantidad=$request->cantidad;
      $precio=$request->precio;
      $validar['f_producto']='required';
      if($tipo==0){
        $validar['f_proveedor']='required';
        $validar['fecha']='required';
      }else{
        $validar['factura']='required';
      }
      $mensaje['fecha.required']="El campo fecha es obligatorio";
      $mensaje['f_producto.required']="No agregó nungún detalle";
      $mensaje['f_proveedor.required']="Ningún proveedor seleccionado";
      $mensaje['factura.required']="El campo número de factura es obligatorio";
      $valida= Validator::make($request->all(),$validar,$mensaje);


      if(!$valida->fails()){
        DB::beginTransaction();
        try{
          if($tipo==0){
        $transaccion=Transacion::create([
          'fecha'=>$request->fecha,
          'f_proveedor'=>$request->f_proveedor,
          'tipo'=>$tipo,
          'f_usuario'=>Auth::user()->id,
          'localizacion'=>Transacion::tipoUsuario(),
        ]);

        for ($i=0; $i < count($f_producto); $i++) {
          DetalleTransacion::create([
            'f_transaccion'=>$transaccion->id,
            'f_producto'=>$request->f_producto[$i],
            'cantidad'=>$cantidad[$i],
            'condicion'=>0,
          ]);
        }
      }else{
        $transaccion= new Transacion;
        $transaccion->fecha=$request->fecha;
        $tipo_detalle=$request->tipo_detalle;
        if(isset($request->f_cliente)){
          $transaccion->f_cliente=$request->f_cliente;
        }
        $transaccion->factura=$request->factura;
        $transaccion->tipo=$tipo;
        $transaccion->f_usuario=Auth::user()->id;
        $transaccion->localizacion=Transacion::tipoUsuario();
        $transaccion->save();

        for ($i=0; $i < count($f_producto); $i++) {
          if($tipo_detalle[$i]==1){
          DetalleTransacion::create([
            'f_transaccion'=>$transaccion->id,
            'f_producto'=>$f_producto[$i],
            'cantidad'=>$cantidad[$i],
            'precio'=>$precio[$i],
            'condicion'=>1,
          ]);
          $inventario= InventarioFarmacia::where('f_producto',$f_producto[$i])->where('localizacion',Transacion::tipoUsuario())->get()->last();
          InventarioFarmacia::create([
          'f_producto'=>$f_producto[$i],
          'tipo'=>0,
          'existencia_anterior'=>$inventario->existencia_nueva,
          'cantidad'=>$cantidad[$i],
          'existencia_nueva'=>$inventario->existencia_nueva-$cantidad[$i],
          'localizacion'=>Transacion::tipoUsuario(),
          ]);
        }else{
          DetalleTransacion::create([
            'f_transaccion'=>$transaccion->id,
            'f_servicio'=>$f_producto[$i],
            'cantidad'=>$cantidad[$i],
            'precio'=>$precio[$i],
            'condicion'=>1,
          ]);
        }
        }
      }
      }catch(\Exception $e){
        DB::rollback();
        return redirect('/')->with('error', '¡Algo salio mal!');
      }
      DB::commit();
      return redirect('/transacciones?tipo='.$tipo)->with('mensaje', '¡Guardado!');
    }else{
      DB::rollback();
      $tran= new Transacion;
      return view('transacciones.create',compact('tran','tipo','fecha','f_proveedor','f_producto','cantidad','precio'))->withErrors($valida->errors());
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
        $transaccion=Transacion::find($id);

        return view('Transacciones.show',compact('transaccion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $this->validate($request,['factura'=>'required']);
        $transaccion = Transacion::findOrFail($id);
        $transaccion->fecha=$request->fecha;
        $transaccion->factura=$request->factura;
        $transaccion->descuento=$request->descuentog;
        $transaccion->save();

        $contador = count($request->estado);
        $cont_eliminados=count($request->eliminado);
        DB::beginTransaction();
        for($i=0;$i<$cont_eliminados;$i++){
          $bor=DetalleTransacion::findOrFail($request->eliminado[$i]);
          $bor->delete();
        }

        for($i=0;$i<$contador;$i++){
          if($request->estado[$i]!='nuevo'){
            $detalle=DetalleTransacion::findOrFail($request->estado[$i]);
          }else{
            $detalle= new DetalleTransacion;
          }
          $detalle->descuento = $request->descuento[$i];
          $detalle->cantidad = $request->cantidad[$i];
          $detalle->condicion = '1';
          $detalle->fecha_vencimiento = $request->fecha_vencimiento[$i];
          $detalle->f_transaccion=$transaccion->id;
          $detalle->precio = $request->precio[$i];
          $detalle->lote = $request->lote[$i];
          $detalle->f_producto=$request->f_producto[$i];
          $detalle->save();

          $inventario= InventarioFarmacia::where('f_producto',$request->f_producto[$i])->where('localizacion',Transacion::tipoUsuario())->get()->last();
          if(count($inventario)>0){
            $ea=$inventario->existencia_nueva;
          }else{
            $ea=0;
          }
          InventarioFarmacia::create([
          'f_producto'=>$request->f_producto[$i],
          'tipo'=>1,
          'existencia_anterior'=>$ea,
          'cantidad'=>$request->cantidad[$i],
          'existencia_nueva'=>$ea+$request->cantidad[$i],
          'localizacion'=>Transacion::tipoUsuario(),
          ]);
        }
        DB::commit();
        Return redirect('/transacciones?tipo=0')->with('mensaje', '¡Pedido Confirmado!');
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
    public function buscarProductos($id,$texto){
      $productos=Producto::where('f_proveedor','=',$id)->where('nombre','ilike','%'.$texto.'%')->get();
      if(count($productos)>0){
        foreach($productos as $producto){
          $producto->presentacion;
        }
        return Response::json($productos);
      }else{
        return null;
      }
    }
    public function buscarDivisiones($id){
      $divisiones=DivisionProducto::where('f_producto','=',$id)->get();
      if(count($divisiones)>0){
        foreach($divisiones as $division){
            $division->division;
            $division->unidad;
        }
        return Response::json($divisiones);
      }else{
        return null;
      }
    }

    public static function nombreDivision($id){
      $nombre=Division::find($id);
      return $nombre->nombre;
    }

    public static function nombrePresentacion($id,$tipo){
      if($tipo=="1"){
        $nombre=Presentacion::find($id);
        return $nombre->nombre;
      }else{
        $producto=Producto::find($id);
        $producto->presentacion;
        return $producto;
      }
    }

    public function confirmarPedido($id){
      $transaccion=Transacion::find($id);
      return view('Transacciones.confirmar',compact('transaccion'));
    }
    public function buscarDivision($codigo,$tipo){
      $division=DivisionProducto::where('codigo','=',$codigo)->first();
      if(count($division)==1){
        $division->inventario=DivisionProducto::inventario($division->id);
        if($division->inventario<1 && $tipo=='1'){
          return 0;
        }
        $division->unidad;
        return $division;
      }else{
        return 0;
      }
    }
    public static function buscarCliente($valor){
      $clientes=Paciente::where('nombre','ILIKE','%'.$valor.'%')
      ->orWhere('apellido', 'ILIKE','%'.$valor.'%')
      ->orWhere('telefono', 'ILIKE','%'.$valor.'%')
      ->orWhere('dui', 'ILIKE','%'.$valor.'%')->orderBy('nombre')->get();
      return $clientes;
    }
    public static function buscarVenta($texto){
      $productos=Producto::where('nombre','ILIKE','%'.$texto.'%')->where('estado',1)->get(['id','nombre','f_presentacion']);
      foreach ($productos as $p) {
        $p->presentacion;
        $p->divisionProducto;
        foreach ($p->divisionProducto as $dp) {
          $dp->division;
          if($dp->contenido!=null){
            $dp->unidad;
          }
          $dp->inventario=DivisionProducto::inventario($dp->id);
        }
      }
      return $productos;
    }
    public static function buscarComponente($texto){
      $componentes=Componente::where('nombre','ILIKE','%'.$texto.'%')->get(['id','nombre']);
      foreach ($componentes as $c) {
        foreach ($c->componenteProducto as $cp) {
          $cp->producto;
          $cp->producto->presentacion;
          foreach ($cp->producto->divisionProducto as $dp) {
            $dp->division;
            if($dp->contenido!=null){
              $dp->unidad;
            }
            $dp->inventario=DivisionProducto::inventario($dp->id);
          }
        }
      }
      return $componentes;
    }
    public function eliminarPedido($id){
      DetalleTransacion::where('f_transaccion',$id)->delete();
      Transacion::destroy($id);
      return redirect('/transacciones?tipo=0');

    }
    public static function buscarServicio($texto){
    $servicios=Servicio::where('estado',true)->where('nombre', 'ilike','%'.$texto.'%')->orderBy('nombre')->get();
      return $servicios;
    }
}
