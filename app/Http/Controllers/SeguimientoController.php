<?php

namespace App\Http\Controllers;

use App\Seguimiento;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class SeguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
			$seguimiento = Seguimiento::find($request->id);
			$axu = $seguimiento->enfermeria->nombre.' '.$seguimiento->enfermeria->apellido;
			setlocale(LC_ALL, 'es');
			$seguimiento->fecha_f = $seguimiento->fecha->formatLocalized('%d de %B de %Y a las %H:%M');
			$seguimiento->nombre = $axu;
			return $seguimiento;
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
			DB::beginTransaction();
			try {
				$aux = explode('T',$request->fecha);
				$fecha = $aux[0] . ' ' . $aux[1];
				$seguimiento = new Seguimiento;
				$seguimiento->fecha = new Carbon($fecha);
				$seguimiento->descripcion = $request->descripcion;
				$seguimiento->f_ingreso = $request->f_ingreso;
				$seguimiento->f_enfermeria = Auth::user()->id;
				$seguimiento->save();
				DB::commit();
				return 1;
			} catch (Exception $e) {
				DB::rollback();
				return $e;
			}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seguimiento  $seguimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Seguimiento $seguimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seguimiento  $seguimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Seguimiento $seguimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seguimiento  $seguimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seguimiento $seguimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seguimiento  $seguimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seguimiento $seguimiento)
    {
        //
    }
}
