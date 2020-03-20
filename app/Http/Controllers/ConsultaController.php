<?php

namespace App\Http\Controllers;

use App\Consulta;
use App\Producto;
use App\Bitacora;
use App\Receta;
use App\DetalleReceta;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class ConsultaController extends Controller
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

        try{
            $consulta = Consulta::create($request->All());
            $consulta->f_medico = Auth::user()->id;
            $consulta->save();

						$codigo = str_pad($consulta->id, 10, "0", STR_PAD_LEFT);

						//MAR20: Se crea la receta
						$receta = new Receta;
						$receta->f_consulta = $consulta->id;
						$receta->barcode = $codigo;
						$receta->f_medico = Auth::user()->id;
						$receta->save();

            if(isset($request->nombre_producto)){
                foreach($request->nombre_producto as $k => $nombre_producto){
                    $producto = Producto::where('nombre',$nombre_producto)->first();
                    if($producto == null){
                        $id_p = null;
                    }else{
                        $id_p = $producto->id;
										}

										$detalle = new DetalleReceta;
										$detalle->f_receta = $receta->id;
    
                    $detalle->nombre_producto = $nombre_producto;
                    $detalle->f_producto = $id_p;
                    $detalle->cantidad_dosis = $request->cant_dosis[$k];
                    $detalle->forma_dosis = $request->forma_dosis[$k];
                    $detalle->cantidad_frecuencia = $request->cant_frec[$k];
                    $detalle->forma_frecuencia = $request->forma_frec[$k];
                    $detalle->cantidad_duracion = $request->cant_duracion[$k];
                    $detalle->forma_duracion = $request->forma_duracion[$k];
                    $detalle->observacion = $request->observacion[$k];
    
                    $detalle->save();
                }
            }
            if(isset($request->f_examen)){
                foreach($request->f_examen as $f_examen){
										$detalle = new DetalleReceta;
										$detalle->f_receta = $receta->id;
    
                    $detalle->f_examen = $f_examen;
    
                    $detalle->save();
                }
            }

            if(isset($request->f_tac)){
                foreach($request->f_tac as $f_tac){
										$detalle = new DetalleReceta;
										$detalle->f_receta = $receta->id;
    
                    $detalle->f_tac = $f_tac;
    
                    $detalle->save();
                }
            }

            if(isset($request->f_ultrasonografia)){
                foreach($request->f_ultrasonografia as $f_ultrasonografia){
										$detalle = new DetalleReceta;
										$detalle->f_receta = $receta->id;
    
                    $detalle->f_ultrasonografia = $f_ultrasonografia;
    
                    $detalle->save();
                }
            }

            if(isset($request->f_rayox)){
                foreach($request->f_rayox as $f_rayox){
										$detalle = new DetalleReceta;
										$detalle->f_receta = $receta->id;
    
                    $detalle->f_rayox = $f_rayox;
    
                    $detalle->save();
                }
            }


            if($request->texto != null || $request->texto != ""){
								$detalle = new DetalleReceta;
								$detalle->f_receta = $receta->id;

                $detalle->Texto = $request->texto;

                $detalle->save();
            }

            DB::commit();
            Bitacora::bitacora('store', 'consultas', 'consultas', $consulta->id);
        }catch(Exception $e){
            DB::rollback();
            return 0;
        }

        return $consulta->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function show(Consulta $consulta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function edit(Consulta $consulta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consulta $consulta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consulta $consulta)
    {
        //
    }

    //Consulta medica
    public function consulta(Request $request){
        $consulta = Consulta::find($request->id);
        setlocale(LC_ALL,'es');
        $fecha = $consulta->created_at->formatLocalized('%d de %B de %Y a las %H:%M');
        $medico = (($consulta->medico->sexo)?'Dr. ':'Dra. ').$consulta->medico->nombre.' '.$consulta->medico->apellido;
        return (compact('consulta','medico','fecha'));
    }

    public function ingresos(Request $request){
        $consultas = Consulta::where('f_ingreso',$request->id)->orderBy('created_at','desc')->get();
        setlocale(LC_ALL,'es');
        $fechas = [];
        $medicos = [];
        foreach($consultas as $k => $consulta){
            $fechas[$k] = $consulta->created_at->formatLocalized('%d de %B de %Y a las %H:%M');
            $medicos[$k] = (($consulta->medico->sexo)?'Dr. ':'Dra. ').$consulta->medico->nombre.' '.$consulta->medico->apellido;
        }
        return (compact('consultas','medicos','fechas'));
    }

    public function datos_producto (Request $request){
        $nombre = $request->valor;
        $producto = Producto::where('nombre','like','%'.$nombre.'%')->orderBy('nombre','asc')->first();
        if($producto != null){
            $presentacion = $producto->presentacion->nombre;
        }else{
            $presentacion = "¡No está disponible!";
        }
        return (compact(
            'presentacion',
            'divisiones'
        ));
    }
}
