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
use App\Devolucion;
use App\DetalleDevolucion;
use App\CambioProducto;
use App\Bitacora;
use App\Inventario;
use App\SolicitudExamen;

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
      return view('Transacciones.index',compact('transacciones','tipo','buscar','pagina'));
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
      $solicitud=$request->solicitud;
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
        $descuento=$request->descuento;
        if($descuento==null || $descuento==""){
          $descuento=0;
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

        if($f_producto!=null){
        for ($i=0; $i < count($f_producto); $i++) {
          DetalleTransacion::create([
            'f_transaccion'=>$transaccion->id,
            'f_producto'=>$request->f_producto[$i],
            'cantidad'=>$cantidad[$i],
            'f_usuario'=>Auth::user()->id,
          ]);
        }
      }
      }else{
        $transaccion= new Transacion;
        $transaccion->fecha=$request->fecha;
        if(isset($request->f_cliente)){
          $transaccion->f_cliente=$request->f_cliente;
        }
        $transaccion->factura=$request->factura;
        $transaccion->tipo=2;
        $transaccion->mostrar_factura=1;
        $transaccion->f_usuario=Auth::user()->id;
        $transaccion->localizacion=Transacion::tipoUsuario();
        $transaccion->descuento=$descuento;
        $transaccion->save();

        if($solicitud!=null){
          for ($i=0; $i < count($solicitud); $i++) {
            $sol=SolicitudExamen::find($solicitud[$i]);
            $sol->cancelado=true;
            $sol->f_transaccion=$transaccion->id;
            $sol->save();
          }
        }

        if($f_producto!=null){
          for ($i=0; $i < count($f_producto); $i++) {
            if($tipo_detalle[$i]==1){
            DetalleTransacion::create([
              'f_transaccion'=>$transaccion->id,
              'f_producto'=>$f_producto[$i],
              'cantidad'=>$cantidad[$i],
              'precio'=>$precio[$i],
              'f_usuario'=>Auth::user()->id,
            ]);
            Inventario::Actualizar($f_producto[$i],Transacion::tipoUsuario(),2,$cantidad[$i]);
        }else{
          DetalleTransacion::create([
            'f_transaccion'=>$transaccion->id,
            'f_servicio'=>$f_producto[$i],
            'cantidad'=>$cantidad[$i],
            'precio'=>$precio[$i],
            'f_usuario'=>Auth::user()->id,
          ]);
          $servi=Servicio::find($f_producto[$i]);
            $promos=$servi->promos;
            foreach($promos as $promo){
              if($promo->f_divisionproducto!=null){
                Inventario::Actualizar($promo->f_divisionproducto,Transacion::tipoUsuario(),2,($promo->cantidad*$cantidad[$i]));
              }
            }
        }
        }
      }
      }
      }catch(\Exception $e){
        DB::rollback();
        return redirect('/')->with('error', '¡Algo salio mal!');
      }
      Bitacora::bitacora('store','transacions','transacciones',$transaccion->id);
      DB::commit();
      if($f_producto!=null && $tipo==2){
        for ($i=0; $i < count($f_producto); $i++) {
          if($tipo_detalle[$i]==1){
          CambioProducto::actualizarCambio($f_producto[$i]);
          }else{
            $servicio=Servicio::find($f_producto[$i]);
            $promos=$servicio->promos;
            foreach($promos as $promo){
              if($promo->f_divisionproducto!=null){
                CambioProducto::actualizarCambio($promo->f_divisionproducto);
              }
            }
          }
        }
      }
      return redirect('/transacciones?tipo='.$tipo."&estado=".$estado)->with('mensaje', '¡Guardado!');
    }else{
      DB::rollback();
      $tran= new Transacion;
      if($tipo==0){
        return view('Transacciones.create',compact('tran','tipo','fecha','f_proveedor','f_producto','cantidad','precio'))->withErrors($valida->errors());
      }else{
        return view('Transacciones.create',compact('tran','tipo','fecha','f_clientea','f_cliente','f_producto','cantidad','precio','tipo_detalle'))->withErrors($valida->errors());
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
        $transaccion->f_usuario=Auth::user()->id;
        $transaccion->save();

        if($request->estado==null){
          $contador=0;
        }else{
          $contador = count($request->estado);
        }
        if($request->eliminado==null){
          $cont_eliminados=0;
        }else{
          $cont_eliminados=count($request->eliminado);
        }
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
            $detalle->f_usuario=Auth::user()->id;
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
          
          Inventario::Actualizar($request->f_producto[$i],Transacion::tipoUsuario(),1,$request->cantidad[$i]);
        }
        Bitacora::bitacora('update','transacions','transacciones',$transaccion->id);
        DB::commit();
        for($i=0;$i<$contador;$i++){
          CambioProducto::actualizarCambio($request->f_producto[$i]);
        }
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
      $productos=Producto::where('nombre','like','%'.$texto.'%')->orderBy('nombre','ASC')->take(7)->get();
      if($productos!=null){
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
      if($divisiones!=null){
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
      if($division!=null){
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
      $clientes=Paciente::where('estado',true)->filtro($valor)->orderBy('nombre')->take(10)->get();
      return $clientes;
    }
    public static function buscarVenta($texto){
      $productos=DB::table('division_productos')
      ->select('productos.nombre','division_productos.id','division_productos.precio','division_productos.cantidad','division_productos.codigo','presentacions.nombre as p_nombre','divisions.nombre as d_nombre','unidads.nombre as u_nombre')
      ->join('productos','productos.id','=','division_productos.f_producto','left outer')
      ->join('presentacions','presentacions.id','=','productos.f_presentacion','left outer')
      ->join('divisions','divisions.id','=','division_productos.f_division','left outer')
      ->join('unidads','unidads.id','=','division_productos.contenido','left outer')
      ->where('productos.estado',true)
      ->where('productos.nombre','like','%'.$texto.'%')
      ->orwhere('division_productos.codigo','like','%'.$texto.'%')
      ->orderBy('productos.nombre','ASC')
      ->whereExists(function ($query){
        $query->from('inventarios')
          ->whereRaw('division_productos.id = inventarios.f_divisionproducto');
        })
      ->take(10)
      ->get();
      foreach($productos as $key => $producto){
        $producto->inventario=DivisionProducto::inventario($producto->id,1);
            if($producto->inventario>0){
              $lotes=DivisionProducto::lotes($producto->id);
              $producto->lote=$lotes[(count($lotes))-1]->lote;
            $producto->ubicacion=DivisionProducto::ubicacion($producto->id,$producto->inventario);
          }
      }
      return $productos;
    }
    public static function buscarComponente($texto){
      $componentes=DB::table('componente_productos')
      ->select('componentes.nombre as co_nombre','division_productos.id','productos.nombre','division_productos.precio','division_productos.cantidad','division_productos.codigo','division_productos.codigo','presentacions.nombre as p_nombre','divisions.nombre as d_nombre','unidads.nombre as u_nombre')
      ->join('componentes','componentes.id','=','componente_productos.f_componente','left outer')
      ->join('productos','productos.id','=','componente_productos.f_producto','left outer')
      ->join('division_productos','productos.id','=','division_productos.f_producto','left outer')
      ->join('presentacions','presentacions.id','=','productos.f_presentacion','left outer')
      ->join('divisions','divisions.id','=','division_productos.f_division','left outer')
      ->join('unidads','unidads.id','=','division_productos.contenido','left outer')
      ->where('productos.estado',true)
      ->where('componentes.nombre','like','%'.$texto.'%')
      ->orderBy('componentes.nombre','ASC')
      ->whereExists(function ($query){
        $query->from('inventarios')
          ->whereRaw('division_productos.id = inventarios.f_divisionproducto');
        })
      ->take(40)
      ->get();
      foreach($componentes as $key => $componente){
        $componente->inventario=DivisionProducto::inventario($componente->id,1);
            if($componente->inventario>0){
              $lotes=DivisionProducto::lotes($componente->id);
              $componente->lote=$lotes[(count($lotes))-1]->lote;
            $componente->ubicacion=DivisionProducto::ubicacion($componente->id,$componente->inventario);
          }
      }
      return $componentes;
    }
    public function eliminarPedido($id,$tipo){
      DetalleTransacion::where('f_transaccion',$id)->delete();
			Transacion::destroy($id);
			if($tipo == 0){
				return redirect('/transacciones?tipo='.$tipo)->with('mensaje', '¡Eliminado!');;
			}else{
				return redirect('/requisiciones?tipo='.$tipo)->with('mensaje', '¡Eliminado!');;
			}
    }

    public static function buscarServicio($texto,$tipo){
      if($tipo=='b'){
        if(Auth::user()->tipoUsuario=="Recepción"){
      $servicios=DB::table('servicios')
      ->select('servicios.id','servicios.precio',DB::raw('concat(categoria_servicios.nombre," ",servicios.nombre) as nombre'))
      ->join('categoria_servicios','servicios.f_categoria','=','categoria_servicios.id','left outer')
      ->where('servicios.estado',true)
      ->where('categoria_servicios.nombre','<>','Honorarios')
      ->where('categoria_servicios.nombre','<>','Habitación')
      ->where('categoria_servicios.nombre','<>','Cama')
      ->where('categoria_servicios.nombre','<>','Paquetes hospitalarios')
      ->Where(DB::raw('concat(categoria_servicios.nombre," ",servicios.nombre)'), 'like','%'.$texto.'%')
      ->orderBy('servicios.nombre','ASC')
      ->take(20)
      ->get();
        }else{
          $servicios=DB::table('servicios')
          ->select('servicios.id','servicios.precio',DB::raw('concat(categoria_servicios.nombre," ",servicios.nombre) as nombre'))
          ->join('categoria_servicios','servicios.f_categoria','=','categoria_servicios.id','left outer')
          ->where('servicios.estado',true)
          ->where('categoria_servicios.nombre','Promociones')
          ->Where(DB::raw('concat(categoria_servicios.nombre," ",servicios.nombre)'), 'like','%'.$texto.'%')
          ->orderBy('servicios.nombre','ASC')
          ->take(20)
          ->get();
        }
      }else{
				
        $servicios=DB::table('servicios')
        ->select('servicios.id','servicios.precio',DB::raw('concat(categoria_servicios.nombre," ",servicios.nombre) as nombre'))
        ->join('categoria_servicios','servicios.f_categoria','=','categoria_servicios.id','left outer')
        ->where('servicios.estado',true)
        ->where('categoria_servicios.nombre','<>','Honorarios')
        ->where('categoria_servicios.nombre','<>','Habitación')
        ->where('categoria_servicios.nombre','<>','Cama')
        ->where('categoria_servicios.nombre','<>','Rayos X')
        ->where('categoria_servicios.nombre','<>','TAC')
        ->where('categoria_servicios.nombre','<>','Laboratorio Clínico')
        ->where('categoria_servicios.nombre','<>','Ultrasonografía')
        ->Where(DB::raw('concat(categoria_servicios.nombre," ",servicios.nombre)'), 'like','%'.$texto.'%')
        ->whereNotExists(function ($query){
          $query->from('promocions')
            ->whereRaw('servicios.id = promocions.f_servicio');
          })
        ->orderBy('servicios.nombre','ASC')
        ->take(20)
        ->get();
      }
      return $servicios;
    }
    public static function anularVenta($id,$comentario){
      echo $id;
      DB::beginTransaction();
      try {
        $t=Transacion::find($id);
        $t->tipo=3;
        $t->comentario=$comentario;

        $detalles=$t->detalleTransaccion;

        foreach($detalles as $detalle){
          if($detalle->f_producto!=null && $detalle->f_producto!=""){
            Inventario::Actualizar($detalle->f_producto,Transacion::tipoUsuario(),3,$detalle->cantidad);        
          }
          if($detalle->f_servicio!=null && $detalle->f_servicio!=""){
            $servi=Servicio::find($detalle->f_servicio);
            $promos=$servi->promos;
            foreach($promos as $promo){
              if($promo->f_divisionproducto!=null){
                Inventario::Actualizar($promo->f_divisionproducto,Transacion::tipoUsuario(),3,($promo->cantidad*$detalle->cantidad));
              }
            }
          }
        }
      } catch (\Exception $e) {
        DB::rollback();
        return redirect('/transacciones?tipo=2')->with('error', '¡Algo salio mal!');
      }
      $t->save();
      DB::commit();
      foreach($detalles as $detalle){
        if($detalle->f_producto!=null && $detalle->f_producto!=""){
          CambioProducto::actualizarCambio($detalle->f_producto);
        }
        if($detalle->f_servicio!=null && $detalle->f_servicio!=""){
          $servi=Servicio::find($detalle->f_servicio);
          $promos=$servi->promos;
          foreach($promos as $promo){
            if($promo->f_divisionproducto!=null){
              CambioProducto::actualizarCambio($promo->f_divisionproducto);
            }
          }
        }
      }
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
      DB::beginTransaction();
      try {
        echo $request;
        echo $id;
        $dev=new Devolucion();
        $dev->fecha=\Carbon\Carbon::now();
        $dev->justificacion=$request->justificacion;
        $dev->save();
        $detalles=DetalleTransacion::where('f_transaccion',$id)->get();
        $contador=0;
        $total=0;
        $tran=Transacion::find($id);
        foreach ($detalles as $detalle) {
          if(isset($request['cantidad'.$detalle->id])){
            if($request['cantidad'.$detalle->id]!="" && $request['cantidad'.$detalle->id]!=0){
              $detalle_dev=new DetalleDevolucion();
              $detalle_dev->f_devolucion=$dev->id;
              $detalle_dev->f_detalle_transaccion=$detalle->id;
              $detalle_dev->cantidad=$request['cantidad'.$detalle->id];
              $detalle_dev->save();
              $contador++;
              $descontado=$detalle->precio-($detalle->precio*($detalle->descuento/100));
              $subtotal=$request['cantidad'.$detalle->id]*$descontado;
              $total=$total+$subtotal;
            }
          }
        }
        $total=$total-($total*($tran->descuento/100));
        if(!$tran->iva){
          $total=$total*1.13;
        }
        $totdevr=new Transacion();//Guardar una transaccion con el total a devolver
        $totdevr->fecha=\Carbon\Carbon::now();
        $totdevr->f_proveedor=$tran->f_proveedor;
        $totdevr->f_usuario=Auth::user()->id;
        $totdevr->localizacion=Transacion::tipoUsuario();
        $totdevr->factura=$tran->factura;
        $totdevr->comentario=$request->justificacion;
        if ($tran->tipo==1) {
          $totdevr->tipo=8;
        } else {
          $totdevr->tipo=9;
        }
        $totdevr->devolucion=$total;
        $totdevr->save();
        foreach ($detalles as $detalle) {
          if(isset($request['cantidad'.$detalle->id])){
            if($request['cantidad'.$detalle->id]!="" && $request['cantidad'.$detalle->id]!=0){
            Inventario::Actualizar($detalle->f_producto,Transacion::tipoUsuario(),$totdevr->tipo,$request['cantidad'.$detalle->id]);        
            }
          }
        }
        if($contador==0){
          DB::rollback();
          return redirect('transacciones/'.$id)->with('mensaje', '¡No hay cambios!');
        }else{
          DB::commit();
          foreach ($detalles as $detalle) {
            if(isset($request['cantidad'.$detalle->id])){
              if($request['cantidad'.$detalle->id]!="" && $request['cantidad'.$detalle->id]!=0){
                CambioProducto::actualizarCambio($detalle->f_producto); 
              }
            }
          }
          return redirect('transacciones/'.$id)->with('mensaje', '¡Devoluciones guardas!');
        }
      } catch (\Exception $e) {
        DB::rollback();
        return redirect('transacciones/'.$id)->with('error', '¡Algo salio mal!');
      }
    }
    Public static function factura(Request $request){
      $transaccion=Transacion::find($request->id);
      if($transaccion->detalleTransaccion->count()>8){
        $header = view('Transacciones.PDF.header');
  
        $footer = view('Transacciones.PDF.footer');
  
        $main = view('Transacciones.PDF.factura2',compact('transaccion'));
  
        $pdf = \PDF::loadHtml($main)->setOption('footer-html',$footer)->setOption('header-html',$header)->setPaper('Letter');
        return $pdf->stream('factura2.pdf');
      }else{
        $header = view('Transacciones.PDF.header');
  
        $footer = view('Transacciones.PDF.footer');
  
        $main = view('Transacciones.PDF.factura',compact('transaccion'));
  
        $pdf = \PDF::loadHtml($main)->setOption('footer-html',$footer)->setOption('header-html',$header)->setPaper('Letter');
        return $pdf->stream('factura1.pdf');
      }
    }
    public static function validarFactura($factura){
      $contador=Transacion::where('factura',$factura)->where('localizacion',Transacion::tipoUsuario())->where('f_ingreso',null)->where('tipo',2)->count();
      if($contador>0){
        return 0;
      }else{
        return 1;
      }
    }
}