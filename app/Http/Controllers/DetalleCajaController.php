<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transacion;
use App\Caja;
use App\Bitacora;
use DB;
use App\Http\Requests\DetalleCajaRequest;
use App\DetalleCaja;
use Illuminate\Support\Facades\Auth;

class DetalleCajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $pagina = ($request->get('page')!=null)?$request->get('page'):1;
      $pagina--;
      $pagina *= 10;
      $cajas=Caja::where('estado',true)->where('localizacion',Transacion::tipoUsuario())->orderBy('nombre','ASC')->get();
        return view('DetalleCajas.detalles',compact('cajas','pagina'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DetalleCajaRequest $request)
    {
      if($request->tipo==2){
        $total=DetalleCaja::arqueo(date('Y').'-'.date('m').'-'.date('d'));
      }else{
        $total=null;
      }
      DB::beginTransaction();
      try{
        $detalle=DetalleCaja::create([
          'f_caja'=>$request['f_caja'],
          'tipo'=>$request->tipo,
          'fecha'=>date('Y').'-'.date('m').'-'.date('d'),
          'f_usuario'=>Auth::user()->id,
          'importe'=>$request['importe'],
          'total'=>$total,
        ]);
      }catch(\Exception $e){
        DB::rollback();
        return redirect('/detalleCajas/create')->with('mensaje', 'Algo salio mal');
      }
      Bitacora::bitacora('store','detalle_cajas','detalleCajas',$detalle->id);
      DB::commit();
      return redirect('/detalleCajas/create')->with('mensaje', '¡Guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        //
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
    public function aperturar($id)
    {
      $caja=Caja::findOrFail($id);
      return view('DetalleCajas.aperturar',compact('caja'));
    }
    public function arqueo(){
      if(Transacion::tipoUsuario()==1 && date('G')<7){
        $fecha=\Carbon\Carbon::now()->subDay()->toDateString();
      }else{
        $fecha=\Carbon\Carbon::now()->toDateString();
      }
      $hasta=\Carbon\Carbon::now()->toDateString()." 07:00:00";
      $detalle=DetalleCaja::caja($fecha);
      $movimientos=Transacion::movimientosCaja($detalle->f_usuario,$detalle->updated_at,$fecha,$hasta);
      $tipoArqueo=1;
      return view('DetalleCajas.arqueo',compact('detalle','movimientos','tipoArqueo'));
    }
    public function cerrar($id){
      $caja=Caja::findOrFail($id);
      return view('DetalleCajas.cerrar',compact('caja'));
    }
    public function buscararqueo($f_apertura){
      $detalle=DetalleCaja::find($f_apertura);
      $tipoArqueo=2;
      $cierre="";
      $fecha=$detalle->created_at->formatLocalized('%Y-%m-%d');                            //Farmacia
      if($detalle->user->tipoUsuario==1){//Recepción
        $fechaaux=date("Y-m-d",strtotime($fecha."+ 1 days"));
        $ha=DetalleCaja::whereBetween('created_at',[$detalle->created_at,$fechaaux." 07:00:00"])
        ->where('id','<>',$detalle->id)
        ->where('f_usuario',$detalle->f_usuario)
        ->get()->first();
        echo $ha;
        $hasta=$fechaaux." 07:00:00";
        if($ha!=""){
          if($ha->tipo==2){
            $hasta=$ha->created_at;
            $tipoArqueo=3;
            $cierre=$ha;
          }
          else if($ha->create_at<$asta){
            $hasta=$ha->create_at;
          }
        }
        
      }else{ //Farmacia
        $ha=DetalleCaja::whereBetween('created_at',[$detalle->created_at,$fecha." 23:59:59"])
        ->where('id','<>',$detalle->id)
        ->where('f_usuario',$detalle->f_usuario)
        ->get()->first();
        $hasta=""; 
        if($ha!=""){
          if($ha->tipo==2){
            $hasta=$ha->created_at;
            $tipoArqueo=3;
            $cierre=$ha;
          }//Farmacia
          else if($ha->create_at<$asta){
            $hasta=$ha->create_at;
          }
        }
      }
      $movimientos=Transacion::movimientosCaja($detalle->f_usuario,$detalle->updated_at,$fecha,$hasta);
      echo $tipoArqueo;
      return view('DetalleCajas.arqueo',compact('detalle','movimientos','tipoArqueo','cierre'));
    }
    public static function arqueo_pdf(){
      if(Transacion::tipoUsuario()==1 && date('G')<7){
        $fecha=\Carbon\Carbon::now()->subDay()->toDateString();
      }else{
        $fecha=\Carbon\Carbon::now()->toDateString();
      }
      $hasta=\Carbon\Carbon::now()->toDateString()." 07:00:00";
      $detalle=DetalleCaja::caja($fecha);
      $movimientos=Transacion::movimientosCaja($detalle->f_usuario,$detalle->updated_at,$fecha,$hasta);
      $tipoArqueo=1;
      if($detalle->datosCaja->localizacion){
        $header = view('PDF.header.hospital');
      }else{
        $header = view('PDF.header.farmacia');
      }
      $footer = view('PDF.footer.numero_pagina');
      $main = view('DetalleCajas.PDF.arqueo',compact('detalle','movimientos','tipoArqueo'));
      $pdf = \PDF::loadHtml($main)->setOption('footer-html',$footer)->setOption('header-html',$header)->setPaper('Letter');
      return $pdf->stream('nombre.pdf');
    }
}
