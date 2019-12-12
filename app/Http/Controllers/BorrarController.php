<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BorrarController extends Controller
{
    public static function borrar($borrar){
        DB::beginTransaction();
        if($borrar=="transacciones"){
            DB::delete('delete from cambio_productos');
            DB::delete('delete from abonos');
            DB::delete('delete from solicitud_examens');
            DB::delete('delete from detalle_devolucions');
            DB::delete('delete from devolucions');
            DB::delete('delete from cambio_productos');
            DB::delete('delete from detalle_transacions');
            DB::delete('delete from transacions');
        }
        if($borrar=="examenes"){
            DB::delete('delete from cambio_productos');
            DB::delete('delete from abonos');
            DB::delete('delete from detalle_resultados');
            DB::delete('delete from resultados');
            DB::delete('delete from solicitud_examens');
            DB::delete('delete from detalle_devolucions');
            DB::delete('delete from devolucions');
            DB::delete('delete from cambio_productos');
            DB::delete('delete from detalle_transacions');
            DB::delete('delete from transacions');
            DB::delete('delete from servicios');
            DB::delete('delete from examen_seccion_parametros');
            DB::delete('delete from examens');
        }
    }
}
