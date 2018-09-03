<?php

namespace App\Http\Controllers;

use App\Receta;
use App\Consulta;
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
        $header = view('PDF.header.hospital');
        $footer = view('PDF.footer.numero_pagina');
        $main = view('Recetas.PDF.contenido',compact('consulta'));
        $pdf = \PDF::loadHtml($main)->setOption('footer-html',$footer)->setOption('header-html',$header)->setPaper('Letter');
        return $pdf->stream('nombre.pdf');
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
        $recetas = Receta::where('barcode',$request->codigo)->get();
        if($recetas->count() > 0){
            $lab = $recetas->where('f_examen','!=',null);
            $ultra = $recetas->where('f_ultrasonografia','!=',null);
            $tac = $recetas->where('f_tac','!=',null);
            $rayo = $recetas->where('f_rayox','!=',null);
    
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
    
            $consulta = $recetas[0]->consulta;
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
}
