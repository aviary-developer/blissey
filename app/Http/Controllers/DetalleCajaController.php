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
      DB::beginTransaction();
      try{
        $detalle=DetalleCaja::create([
          'f_caja'=>$request['f_caja'],
          'tipo'=>$request->tipo,
          'fecha'=>date('Y').'-'.date('m').'-'.date('d'),
          'f_usuario'=>Auth::user()->id,
          'importe'=>$request['importe'],
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
      $detalle=DetalleCaja::caja();
      $movimientos=Transacion::movimentosCaja($detalle->f_usuario,$detalle->updated_at);
      return view('DetalleCajas.arqueo',compact('detalle','movimientos'));
    }
    public function cerrar($id){
      $caja=Caja::findOrFail($id);
      return view('DetalleCajas.cerrar',compact('caja'));
    }
}
