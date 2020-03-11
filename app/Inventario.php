<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    public static function actualizar($f_dp,$localizacion,$tipo,$cantidad){
        $ultimo=Inventario::where('f_divisionproducto',$f_dp)->where('localizacion',$localizacion)->get()->last();
        $anterior=0;
        if($ultimo!=null){
            $anterior=$ultimo->existencia_nueva;
        }
        if($tipo==1|| $tipo==3 || $tipo==6 || $tipo==9 || $tipo==10 || $tipo==14){
            $nuevo=$anterior+$cantidad;
        }elseif($tipo==2 || $tipo==5 || $tipo==7 || $tipo==8 || $tipo==11 || $tipo==15){
            $nuevo=$anterior-$cantidad;
        }
        if($nuevo>-1){
        $inventario=new Inventario();
        $inventario->f_divisionproducto=$f_dp;
        $inventario->localizacion=$localizacion;
        $inventario->tipo_movimiento=$tipo;
        $inventario->existencia_anterior=$anterior;
        $inventario->cantidad=$cantidad;
        $inventario->existencia_nueva=$nuevo;
        $inventario->save();
        }
    }
}