<?php

namespace App\Http\Controllers;

use App\Receta;
use App\Consulta;
use App\DivisionProducto;
use \Milon\Barcode\DNS1D;
use Illuminate\Http\Request;

class RecetaController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
				$consulta = Consulta::find($id);
				if($consulta->recetas != null){
					$main = view('Recetas.PDF.prueba',compact('consulta'));
					//Tamaño oficio 178 y 140 Carta
					$pdf = \PDF::loadHtml($main)->setOption('page-width','216')->setOption('page-height','140')->setOption('margin-top','8')->setOption('margin-bottom','30');
					return $pdf->stream('nombre.pdf');
				}else{
					return "No existe receta";
				}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //
    }

    public function buscar_solicitud(Request $request){
        $recetas = Receta::where('barcode',$request->codigo)->first();
        if($recetas->detalle->count() > 0){
            $lab = $recetas->detalle->where('f_examen','!=',null);
            $ultra = $recetas->detalle->where('f_ultrasonografia','!=',null);
            $tac = $recetas->detalle->where('f_tac','!=',null);
            $rayo = $recetas->detalle->where('f_rayox','!=',null);
    
            $total_lab = $lab->count();
            $total_ultra = $ultra->count();
            $total_tac = $tac->count();
            $total_rayo = $rayo->count();
    
            $lab_v = [];
            if($total_lab > 0){
                $k = 0;
                foreach($lab as $labo){
                    $lab_v[$k]['id']=$labo->f_examen;
                    $lab_v[$k]['nombre']=$labo->examen->nombreExamen;
                    $k++;
                }
            }
            $ultra_v = [];
            if($total_ultra > 0){
                $k = 0;
                foreach($ultra as $ultras){
                    $ultra_v[$k]['id']=$ultras->f_ultrasonografia;
                    $ultra_v[$k]['nombre']=$ultras->ultrasonografia->nombre;
                    $k++;
                }
            }
            $tac_v = [];
            if($total_tac > 0){
                $k = 0;
                foreach($tac as $tacs){
                    $tac_v[$k]['id'] = $tacs->f_tac;
                    $tac_v[$k]['nombre']=$tacs->tac->nombre;
                    $k++;
                }
            }
            $rayo_v = [];
            if($total_rayo > 0){
                $k = 0;
                foreach($rayo as $rayox){
                    $rayo_v[$k]['id']=$rayox->f_rayox;
                    $rayo_v[$k]['nombre']=$rayox->rayox->nombre;
                    $k++;
                }
            }
    
            if($total_lab == 0 && $total_ultra == 0 && $total_tac == 0 && $total_rayo == 0){
                $cero = true;
            }else{
                $cero = false;
            }
    
            $consulta = $recetas->consulta;
            $paciente = $consulta->ingreso->paciente->nombre.' '.$consulta->ingreso->paciente->apellido;
            $id_p = $consulta->ingreso->f_paciente;
            $fecha = $consulta->created_at->format('d/m/Y');
    
            return (compact(
                'lab_v',
                'ultra_v',
                'tac_v',
                'rayo_v',
                'total_lab',
                'total_ultra',
                'total_tac',
                'total_rayo',
                'cero',
                'paciente',
                'id_p',
                'fecha'
            ));
        }else{
            $cero = true;

            return (compact('cero','recetas'));
        }
    }

    public function buscar_medicamento(Request $request){
        $recetas = Receta::where('barcode',$request->codigo)->get();
        if($recetas->detalle->count() > 0){
            $medicamentos = $recetas->detalle->where('f_producto','!=',null);
            $total_medicamento = $medicamentos->count();

            $productos = [];
            $divisiones = [];
            if($total_medicamento == 0){
                $cero = true;
            }else{
                $cero = false;

                $i = 0;

                foreach($medicamentos as $medicamento){
                    $productos[$i]['id'] = $medicamento->producto->id;
                    $productos[$i]['nombre'] = $medicamento->producto->nombre;
                    $productos[$i]['presentacion'] = $medicamento->producto->presentacion->nombre;
                    
                    $j = 0;
                    foreach($medicamento->producto->divisionProducto as $div){
                        $divisiones[$i][$j]['id'] = $div->id;
                        $divisiones[$i][$j]['nombre'] = $div->division->nombre;
                        $divisiones[$i][$j]['cantidad'] = $div->cantidad;
                        if($div->contenido != null){
                            $divisiones[$i][$j]['contenido'] = $div->unidad->nombre;
                        }else{
                            $divisiones[$i][$j]['contenido'] = 0;
                        }
                        $divisiones[$i][$j]['precio'] = $div->precio;
                        $divisiones[$i][$j]['inventario'] = DivisionProducto::inventario($div->id, 1);
                        $inv = $divisiones[$i][$j]['inventario'];
                        $ubi = DivisionProducto::ubicacion($div->id, $inv);
                        $aux = explode('|',$ubi);
                        if($inv > 0){
                            $divisiones[$i][$j]['estante'] = $aux[0];
                            $divisiones[$i][$j]['nivel'] = $aux[1];
                        }else{
                            $divisiones[$i][$j]['estante'] = 0;
                            $divisiones[$i][$j]['nivel'] = 0;
                        }
                        $j++;
                    }

                    $i++;
                }

            }

            $consulta = $recetas->consulta;
            $paciente = $consulta->ingreso->hospitalizacion->paciente->nombre.' '.$consulta->ingreso->hospitalizacion->paciente->apellido;
            $id_p = $consulta->ingreso->hospitalizacion->f_paciente;
            $fecha = $consulta->created_at->format('d/m/Y');
            return (compact(
                'cero',
                'productos',
                'divisiones',
                'total_medicamento',
                'paciente',
                'id_p',
                'fecha'
            ));
        }else{
            $cero = true;
            return (compact('cero','recetas'));
        }
		}
	
	public function buscar(Request $request){
		$valor = $request->valor;
		$recetas = Receta::where('nombre_receta','LIKE','%'.$valor.'%')->orderBy('nombre_receta')->get();
		$lista = [];
		foreach($recetas as $k => $receta){
			$lista[$k]["id"] = $receta->id;
			$lista[$k]["nombre"] = $receta->nombre_receta;
			$lista[$k]['fecha'] = $receta->created_at->format('d-m-Y');
			$lista[$k]['medico'] = (($receta->consulta->medico->sexo)?"Dr. ":"Dra. ").$receta->consulta->medico->nombre.' '.$receta->consulta->medico->apellido;
			$lista[$k]["diagnostico"] = $receta->consulta->diagnostico;
		}
		return $lista;
	}

	public function ver(Request $request){
		$receta = Receta::find($request->id);
		$medicamentos = [];
		$laboratorios = [];
		$ultrasonografias = [];
		$rayos_xs = [];
		$tacs = [];
        $texto = null;
        if($receta->nombre_receta!=null){
            $nombre = $receta->nombre_receta;
        }else{
            $nombre="Sin nombre";
        }
		$i = 0;
		foreach($receta->detalle->where('nombre_producto','<>',null) as $k => $detalle){
			$medicamentos[$i]['nombre'] = $detalle->nombre_producto;
			$medicamentos[$i]['dosis'] = $detalle->cantidad_dosis.' ';
			if($detalle->forma_dosis == 0 && $detalle->f_producto != null){
				$medicamentos[$i]['dosis'] .= $detalle->producto->presentacion->nombre;
				$medicamentos[$i]["presentacion"] = $detalle->producto->presentacion->nombre;
			}else{
				$medicamentos[$i]['dosis'] .= Consulta::dosis($detalle->forma_dosis);
				$medicamentos[$i]["presentacion"] = "¡No está disponible!";
			}
			$medicamentos[$i]['cant_dosis'] = $detalle->cantidad_dosis;
			$medicamentos[$i]['forma_dosis'] = $detalle->forma_dosis;
			$medicamentos[$i]['texto_dosis'] = Consulta::dosis($detalle->forma_dosis);
			$medicamentos[$i]['frecuencia'] = Consulta::tiempos($detalle->cantidad_frecuencia, $detalle->forma_frecuencia);
			$medicamentos[$i]['cant_frec'] = $detalle->cantidad_frecuencia;
			$medicamentos[$i]['forma_frec'] = $detalle->forma_frecuencia;
			$medicamentos[$i]['texto_frec'] = Consulta::tiempo($detalle->forma_frecuencia);
			$medicamentos[$i]['duracion'] = Consulta::tiempos($detalle->cantidad_duracion, $detalle->forma_duracion);
			$medicamentos[$i]['cant_duracion'] = $detalle->cantidad_duracion;
			$medicamentos[$i]['forma_duracion'] = $detalle->forma_duracion;
			$medicamentos[$i]['texto_duracion'] = Consulta::tiempo($detalle->forma_duracion);
			$medicamentos[$i]['nota'] = ($detalle->observacion == null)?"":$detalle->observacion;
			$medicamentos[$i]['f_producto'] = $detalle->f_producto;
			$i++;
		}
		$j = 0;
		foreach($receta->detalle->where('f_examen','<>',null) as $k => $detalle){
			$laboratorios[$j]['nombre'] = $detalle->examen->nombreExamen;
			$laboratorios[$j]['f_examen'] = $detalle->f_examen;
			$j++;
		}
		$l = 0;
		foreach ($receta->detalle->where('f_ultrasonografia', '<>', null) as $k => $detalle) {
			$ultrasonografias[$l]['nombre'] = Consulta::articulo($detalle->ultrasonografia->nombre).' '.$detalle->ultrasonografia->nombre;
			$ultrasonografias[$l]['texto'] = $detalle->ultrasonografia->nombre;
			$ultrasonografias[$l]['f_ultrasonografia'] = $detalle->f_ultrasonografia;
			$l++;
		}
		$m = 0;
		foreach ($receta->detalle->where('f_rayox', '<>', null) as $k => $detalle) {
			$rayos_xs[$m]['nombre'] = Consulta::articulo
			($detalle->rayox->nombre).' '.$detalle->rayox->nombre;
			$rayos_xs[$m]['texto'] = $detalle->rayox->nombre;
			$rayos_xs[$m]['f_rayox'] = $detalle->f_rayox;
			$m++;
		}
		$n = 0;
		foreach ($receta->detalle->where('f_tac', '<>', null) as $k => $detalle) {
			$tacs[$n]['nombre'] = Consulta::articulo($detalle->tac->nombre).' '.$detalle->tac->nombre;
			$tacs[$n]['texto'] = $detalle->tac->nombre;
			$tacs[$n]['f_tac'] = $detalle->f_tac;
			$n++;
		}
		if($receta->detalle->where('Texto','<>',null)->count() > 0){
			$texto = $receta->detalle->where('Texto','<>',null)->first()->Texto;
		}
		return compact(
			'medicamentos',
			'laboratorios',
			'ultrasonografias',
			'rayos_xs',
			'tacs',
			'texto',
			'nombre'
		);
    }
    
    public function verEditarReceta(Request $request){
		$receta = Receta::where('f_consulta','=',$request->id)->first();
		$medicamentos = [];
		$laboratorios = [];
		$ultrasonografias = [];
		$rayos_xs = [];
		$tacs = [];
        $texto = null;
        if($receta->nombre_receta!=null){
            $nombre = $receta->nombre_receta;
        }else{
            $nombre="Sin nombre";
        }
		$i = 0;
		foreach($receta->detalle->where('nombre_producto','<>',null) as $k => $detalle){
			$medicamentos[$i]['nombre'] = $detalle->nombre_producto;
			$medicamentos[$i]['dosis'] = $detalle->cantidad_dosis.' ';
			if($detalle->forma_dosis == 0 && $detalle->f_producto != null){
				$medicamentos[$i]['dosis'] .= $detalle->producto->presentacion->nombre;
				$medicamentos[$i]["presentacion"] = $detalle->producto->presentacion->nombre;
			}else{
				$medicamentos[$i]['dosis'] .= Consulta::dosis($detalle->forma_dosis);
				$medicamentos[$i]["presentacion"] = "¡No está disponible!";
			}
			$medicamentos[$i]['cant_dosis'] = $detalle->cantidad_dosis;
			$medicamentos[$i]['forma_dosis'] = $detalle->forma_dosis;
			$medicamentos[$i]['texto_dosis'] = Consulta::dosis($detalle->forma_dosis);
			$medicamentos[$i]['frecuencia'] = Consulta::tiempos($detalle->cantidad_frecuencia, $detalle->forma_frecuencia);
			$medicamentos[$i]['cant_frec'] = $detalle->cantidad_frecuencia;
			$medicamentos[$i]['forma_frec'] = $detalle->forma_frecuencia;
			$medicamentos[$i]['texto_frec'] = Consulta::tiempo($detalle->forma_frecuencia);
			$medicamentos[$i]['duracion'] = Consulta::tiempos($detalle->cantidad_duracion, $detalle->forma_duracion);
			$medicamentos[$i]['cant_duracion'] = $detalle->cantidad_duracion;
			$medicamentos[$i]['forma_duracion'] = $detalle->forma_duracion;
			$medicamentos[$i]['texto_duracion'] = Consulta::tiempo($detalle->forma_duracion);
			$medicamentos[$i]['nota'] = ($detalle->observacion == null)?"":$detalle->observacion;
			$medicamentos[$i]['f_producto'] = $detalle->f_producto;
			$i++;
		}
		$j = 0;
		foreach($receta->detalle->where('f_examen','<>',null) as $k => $detalle){
			$laboratorios[$j]['nombre'] = $detalle->examen->nombreExamen;
			$laboratorios[$j]['f_examen'] = $detalle->f_examen;
			$j++;
		}
		$l = 0;
		foreach ($receta->detalle->where('f_ultrasonografia', '<>', null) as $k => $detalle) {
			$ultrasonografias[$l]['nombre'] = Consulta::articulo($detalle->ultrasonografia->nombre).' '.$detalle->ultrasonografia->nombre;
			$ultrasonografias[$l]['texto'] = $detalle->ultrasonografia->nombre;
			$ultrasonografias[$l]['f_ultrasonografia'] = $detalle->f_ultrasonografia;
			$l++;
		}
		$m = 0;
		foreach ($receta->detalle->where('f_rayox', '<>', null) as $k => $detalle) {
			$rayos_xs[$m]['nombre'] = Consulta::articulo
			($detalle->rayox->nombre).' '.$detalle->rayox->nombre;
			$rayos_xs[$m]['texto'] = $detalle->rayox->nombre;
			$rayos_xs[$m]['f_rayox'] = $detalle->f_rayox;
			$m++;
		}
		$n = 0;
		foreach ($receta->detalle->where('f_tac', '<>', null) as $k => $detalle) {
			$tacs[$n]['nombre'] = Consulta::articulo($detalle->tac->nombre).' '.$detalle->tac->nombre;
			$tacs[$n]['texto'] = $detalle->tac->nombre;
			$tacs[$n]['f_tac'] = $detalle->f_tac;
			$n++;
		}
		if($receta->detalle->where('Texto','<>',null)->count() > 0){
			$texto = $receta->detalle->where('Texto','<>',null)->first()->Texto;
		}
		return compact(
			'medicamentos',
			'laboratorios',
			'ultrasonografias',
			'rayos_xs',
			'tacs',
			'texto',
			'nombre'
		);
	}
}
