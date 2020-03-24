<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = [
        'motivo',
        'historia',
        'examen_fisico',
        'diagnostico',
        'f_ingreso'
    ];

    public function medico(){
        return $this->belongsTo('App\User','f_medico');
    }

    public function recetas(){
        return $this->hasOne('App\Receta','f_consulta');
    }

    public function ingreso(){
        return $this->belongsTo('App\Ingreso','f_ingreso');
    }

    public static function dosis($i){
        switch($i){
            case 0: return "unidad";
            case 1: return "cucharadita";
            case 2: return "cucharada";
            case 3: return "mililitro";
            case 4: return "gota";
            case 5: return "cuarta parte";
            case 6: return "media parte";
            case 7: return "aplicación";
            case 8: return "UI";
            case 9: return "inhalaciones";
            default: return null;
        }
    }

    public static function tiempo($i){
        switch($i){
            case 0: return "minuto";
            case 1: return "hora";
            case 2: return "día";
            case 3: return "semana";
            case 4: return "mes";
            case 5: return "indefinido";
            default: return null;
        }
    }

    public static function tiempos($c,$i){
        if($c > 1){
            switch($i){
                case 0: return $c." minutos";
                case 1: return $c." horas";
                case 2: return $c." días";
                case 3: return $c." semanas";
                case 4: return $c." meses";
                case 5: return "tiempo indefinido";
                default: return null;
            }
        }else{
            switch($i){
                case 0: return $c." minuto";
                case 1: return $c." hora";
                case 2: return $c." día";
                case 3: return $c." semana";
                case 4: return $c." mes";
                case 5: return "tiempo indefinido";
                default: return null;
            }
        }
    }

    public static function articulo($texto){
        $ultima = substr($texto,-1,1);
        $penultima = substr($texto,-2,1);
        $art = "del";
        if ($ultima == 'a') {
            $art = 'de la';
        } else if ($ultima == 'o' || $ultima == 'e' || $ultima == 'i' || $ultima == 'u') {
            $art = 'del';
        } else if ($ultima == 's') {
            if ($penultima == 'a') {
            $art = 'de las';
            } else if ($penultima == 'o' || $penultima == 'e' || $penultima == 'i' || $penultima == 'u') {
            $art = 'de los';
            }
        } else if($ultima == 'l' && $penultima == 'a'){
					$art = '';
				} else {
            if ($penultima == 'a') {
            $art = 'de la';
            } else if ($penultima == 'o' || $penultima == 'e' || $penultima == 'i' || $penultima == 'u') {
            $art = 'del';
            }
        }
        return ($art);
    }
}
