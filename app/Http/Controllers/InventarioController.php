<?php

namespace App\Http\Controllers;

use App\Abono;
use Illuminate\Http\Request;
use App\DivisionProducto;
use App\DetalleDevolucion;
use App\DetalleTransacion;
use App\Devolucion;
use App\Bitacora;
use App\Inventario;
use App\Transacion;
use App\User;
use Carbon\Carbon;
use App\CambioProducto;

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
            if($diferencia > 0){
                Inventario::Actualizar($detalle->f_producto,Transacion::tipoUsuario(),14,abs($diferencia));            
            }else{
                Inventario::Actualizar($detalle->f_producto,Transacion::tipoUsuario(),15,abs($diferencia)); 
            }
        // Inventario::Actualizar($detalle->f_producto,Transacion::tipoUsuario(),15,$ultimo);  
        // Inventario::Actualizar($detalle->f_producto,Transacion::tipoUsuario(),14,$ahora);          
        }
      CambioProducto::actualizarCambio($detalle->f_producto);
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
        $d_t=DetalleTransacion::find($request->idTr);
        Inventario::Actualizar($d_t->f_producto,Transacion::tipoUsuario(),15,$request->cantidad);  
        CambioProducto::actualizarCambio($detalle->f_producto);
        Bitacora::bitacora('update','salidas','inventarios',$request->idTr);
        return redirect('/inventarios')->with('mensaje', '!Acción exitosa¡');
		}
		

	public function turno(Request $request){
		$r_fecha = $request->fecha;
		$usuario = $request->id;
		$fecha_min = Carbon::createFromFormat('Y-m-d',$r_fecha)->hour(7)->minute(0)->second(0);
		$fecha_max = Carbon::createFromFormat('Y-m-d', $r_fecha)->addDay()->hour(7)->minute(0)->second(0);

		$user = User::find($usuario);
		//Lista de abonos realizados
		$abonos = Abono::where('created_at', '>=', $fecha_min)->where('created_at', '<=', $fecha_max)->get();
		//Lista de productos
		$l_productos = DetalleTransacion::join('transacions','detalle_transacions.f_transaccion','transacions.id')->where('detalle_transacions.created_at', '>=', $fecha_min)->where('detalle_transacions.created_at', '<=', $fecha_max)->where('detalle_transacions.f_usuario', $usuario)->where('detalle_transacions.f_servicio',null)->where('transacions.tipo',2)->select('detalle_transacions.*')->get();
		//Listado de examenes de laboratorio clinico
		$l_laboratorios = DetalleTransacion::join('servicios','detalle_transacions.f_servicio','servicios.id')->join('categoria_servicios','servicios.f_categoria','categoria_servicios.id')->where('detalle_transacions.created_at', '>=', $fecha_min)->where('detalle_transacions.created_at', '<=', $fecha_max)->where('detalle_transacions.f_usuario', $usuario)->where('categoria_servicios.nombre','Laboratorio Clínico')->select('detalle_transacions.*')->get();
		//Listado de Ultrasonografía
		$l_ultras = DetalleTransacion::join('servicios', 'detalle_transacions.f_servicio', 'servicios.id')->join('categoria_servicios', 'servicios.f_categoria', 'categoria_servicios.id')->where('detalle_transacions.created_at', '>=', $fecha_min)->where('detalle_transacions.created_at', '<=', $fecha_max)->where('detalle_transacions.f_usuario', $usuario)->where('categoria_servicios.nombre', 'Ultrasonografía')->select('detalle_transacions.*')->get();
		//Listado de Rayos X
		$l_rayos = DetalleTransacion::join('servicios', 'detalle_transacions.f_servicio', 'servicios.id')->join('categoria_servicios', 'servicios.f_categoria', 'categoria_servicios.id')->where('detalle_transacions.created_at', '>=', $fecha_min)->where('detalle_transacions.created_at', '<=', $fecha_max)->where('detalle_transacions.f_usuario', $usuario)->where('categoria_servicios.nombre', 'Rayos X')->select('detalle_transacions.*')->get();
		//Listado de TACs
		$l_tacs = DetalleTransacion::join('servicios', 'detalle_transacions.f_servicio', 'servicios.id')->join('categoria_servicios', 'servicios.f_categoria', 'categoria_servicios.id')->where('detalle_transacions.created_at', '>=', $fecha_min)->where('detalle_transacions.created_at', '<=', $fecha_max)->where('detalle_transacions.f_usuario', $usuario)->where('categoria_servicios.nombre', 'TAC')->select('detalle_transacions.*')->get();
		//Listado de honorarios
		$l_honorarios = DetalleTransacion::join('servicios', 'detalle_transacions.f_servicio', 'servicios.id')->join('categoria_servicios', 'servicios.f_categoria', 'categoria_servicios.id')->where('detalle_transacions.created_at', '>=', $fecha_min)->where('detalle_transacions.created_at', '<=', $fecha_max)->where('detalle_transacions.f_usuario', $usuario)->where('categoria_servicios.nombre', 'Honorarios')->select('detalle_transacions.*')->get();
		//Listado por paquetes hospitalarios
		$l_paquetes = DetalleTransacion::join('servicios', 'detalle_transacions.f_servicio', 'servicios.id')->join('categoria_servicios', 'servicios.f_categoria', 'categoria_servicios.id')->where('detalle_transacions.created_at', '>=', $fecha_min)->where('detalle_transacions.created_at', '<=', $fecha_max)->where('detalle_transacions.f_usuario', $usuario)->where('categoria_servicios.nombre', 'Paquetes hospitalarios')->select('detalle_transacions.*')->get();
		//Listado por servicios
		$l_servicios = DetalleTransacion::join('servicios', 'detalle_transacions.f_servicio', 'servicios.id')->join('categoria_servicios', 'servicios.f_categoria', 'categoria_servicios.id')->where('detalle_transacions.created_at', '>=', $fecha_min)->where('detalle_transacions.created_at', '<=', $fecha_max)->where('detalle_transacions.f_usuario', $usuario)->where('categoria_servicios.nombre', '<>', 'Paquetes hospitalarios')->where('categoria_servicios.nombre', '<>', 'Honorarios')->where('categoria_servicios.nombre', '<>', 'TAC')->where('categoria_servicios.nombre', '<>', 'Rayos X')->where('categoria_servicios.nombre', '<>', 'Ultrasonografía')->where('categoria_servicios.nombre', '<>', 'Laboratorio Clínico')->select('detalle_transacions.*')->get();

		$header = view('PDF.header.hospital');
		$footer = view('PDF.footer.numero_pagina');
		$main = view('Ingresos.PDF.informe.turno', compact(
			'l_productos',
			'l_laboratorios',
			'l_ultras',
			'l_rayos',
			'l_tacs',
			'l_honorarios',
			'l_paquetes',
			'l_servicios',
			'fecha_min',
			'fecha_max',
			'user'
		));
		$pdf = \PDF::loadHtml($main)->setOption('footer-html', $footer)->setOption('header-html', $header)->setPaper('Letter')->setOrientation('landscape');
		return ($pdf->stream());
    }
    public function inventario_pdf(){
        $dp = DivisionProducto::buscar(true);
        if(Transacion::tipoUsuario()==1){
            $header = view('PDF.header.hospital');
        }else{
            $header = view('PDF.header.farmacia');
        }
          $footer = view('PDF.footer.numero_pagina');
          $main = view('Inventarios.PDF.inventario',compact('dp'));
          $pdf = \PDF::loadHtml($main)->setOption('footer-html',$footer)->setOption('header-html',$header)->setPaper('Letter');
          return $pdf->stream('inventario.pdf');
    }
}
