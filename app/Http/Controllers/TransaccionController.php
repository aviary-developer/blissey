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
use DB;
use Auth;
use Validator;
use App\Paciente;
use App\Componente;
use App\Servicio;
use App\Estante;

class TransaccionController extends Controller
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
      $tipo= $request->tipo;
      $buscar=$request->buscar;
      $transacciones=Transacion::buscar($buscar,$tipo);
      return view('transacciones.index',compact('transacciones','tipo','buscar','pagina'));
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
      $estado=$request->estado;
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
      }
      if($tipo==2){
        $validar['factura']='required';
        $tipo_detalle=$request->tipo_detalle;
        if(isset($request->f_clientea)){
          $f_clientea=$request->f_clientea;
        }else{
          $f_clientea="";
        }
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
          ]);
        }
      }else{
        $transaccion= new Transacion;
        $transaccion->fecha=$request->fecha;
        if(isset($request->f_cliente)){
          $transaccion->f_cliente=$request->f_cliente;
        }
        $transaccion->factura=$request->factura;
        $transaccion->tipo=2;
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
          ]);
        }else{
          DetalleTransacion::create([
            'f_transaccion'=>$transaccion->id,
            'f_servicio'=>$f_producto[$i],
            'cantidad'=>$cantidad[$i],
            'precio'=>$precio[$i],
          ]);
        }
        }
      }
      }catch(\Exception $e){
        DB::rollback();
        return redirect('/')->with('error', '¡Algo salio mal!');
      }
      DB::commit();
      return redirect('/transacciones?tipo='.$tipo."&estado=".$estado)->with('mensaje', '¡Guardado!');
    }else{
      DB::rollback();
      $tran= new Transacion;
      if($tipo==0){
        return view('transacciones.create',compact('tran','tipo','fecha','f_proveedor','f_producto','cantidad','precio'))->withErrors($valida->errors());
      }else{
        return view('transacciones.create',compact('tran','tipo','fecha','f_clientea','f_cliente','f_producto','cantidad','precio','tipo_detalle'))->withErrors($valida->errors());
      }
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
        $transaccion->tipo=1;
        $transaccion->iva=$request->ivaincluido;
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
          $detalle->fecha_vencimiento = $request->fecha_vencimiento[$i];
          $detalle->f_transaccion=$transaccion->id;
          $detalle->precio = $request->precio[$i];
          $detalle->lote = $request->lote[$i];
          $detalle->f_producto=$request->f_producto[$i];
          $detalle->f_estante=$request->f_estante[$i];
          $detalle->nivel=$request->nivel[$i];
          $detalle->save();
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
      $productos=Producto::where('nombre','like','%'.$texto.'%')->take(3)->get();
      if(count($productos)>0){
        foreach($productos as $producto){
          $producto->presentacion;
          $divisiones=$producto->divisionProducto;
          foreach($divisiones as $division){
              $division->division;
              $division->unidad;
          }
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
        $division->inventario=DivisionProducto::inventario($division->id,1);
        if($division->inventario<1 && $tipo=='2'){
          return 1;
        }
        $division->unidad;
        return $division;
      }else{
        return 0;
      }
    }
    public static function buscarCliente($valor){
      $clientes=Paciente::where('nombre','like','%'.$valor.'%')
      ->orWhere('apellido', 'like','%'.$valor.'%')
      ->orWhere('telefono', 'like','%'.$valor.'%')
      ->orWhere('dui', 'like','%'.$valor.'%')->orderBy('nombre')->get();
      return $clientes;
    }
    public static function buscarVenta($texto){
      $productos=Producto::where('nombre','like','%'.$texto.'%')->orderBy('nombre','ASC')->where('estado',1)->get(['id','nombre','f_presentacion']);
      foreach ($productos as $p) {
        $p->presentacion;
        $p->divisionProducto;
        foreach ($p->divisionProducto as $dp) {
          $dp->division;
          if($dp->contenido!=null){
            $dp->unidad;
          }
          $dp->inventario=DivisionProducto::inventario($dp->id,1);
          $dp->ubicacion=DivisionProducto::ubicacion($dp->id,$dp->inventario);
        }
      }
      return $productos;
    }
    public static function buscarComponente($texto){
      $componentes=Componente::where('nombre','like','%'.$texto.'%')->get(['id','nombre']);
      foreach ($componentes as $c) {
        foreach ($c->componenteProducto as $cp) {
          $cp->producto;
          $cp->producto->presentacion;
          foreach ($cp->producto->divisionProducto as $dp) {
            $dp->division;
            if($dp->contenido!=null){
              $dp->unidad;
            }
            $dp->inventario=DivisionProducto::inventario($dp->id,1);
            $dp->ubicacion=DivisionProducto::ubicacion($dp->id,$dp->inventario);
          }
        }
      }
      return $componentes;
    }
    public function eliminarPedido($id,$tipo){
      DetalleTransacion::where('f_transaccion',$id)->delete();
      Transacion::destroy($id);
      if($tipo==0){
      return redirect('/transacciones?tipo='.$tipo);
    }else{
      return redirect('/requisiciones?tipo='.$tipo);
    }
    }
    public static function buscarServicio($texto){
      $servicios=Servicio::where('estado',true)->where('nombre', 'like','%'.$texto.'%')->orderBy('nombre')->get();
      $service = [];
      $i = 0;
      if($servicios != null){
        foreach($servicios as $servicio){
          if($servicio->categoria->nombre != "Honorarios" && $servicio->categoria->nombre != "Habitación" && $servicio->categoria->nombre != "Laboratorio Clínico" &&$servicio->categoria->nombre != "Rayos X" && $servicio->categoria->nombre != "Ultrasonografía"){
            $service[$i] = $servicio;
            $i++;
          }
        }
      }
      return $service;
    }
    public static function anularVenta($id,$comentario){
      echo $id;
      DB::beginTransaction();
      try {
        $t=Transacion::find($id);
        $t->tipo=3;
        $t->comentario=$comentario;

      } catch (\Exception $e) {
        DB::rollback();
        return redirect('/transacciones?tipo=2')->with('error', '¡Algo salio mal!');
      }
      $t->save();
      DB::commit();
      return redirect('/transacciones?tipo=2')->with('mensaje', '¡Anulado!');
    }
    public static function niveles($id){
      $estante=Estante::find($id);
      return $estante->cantidad;
    }
    public function devoluciones($id){
      $transaccion=Transacion::find($id);
      $detalles=$transaccion->detalleTransaccion;
      return view('Transacciones.devoluciones',compact('transaccion','detalles'));
    }
    public function guardarDevoluciones($id,Request $request){
      echo $request;
      echo $id;
    }
}
