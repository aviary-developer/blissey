<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudExamen extends Model
{
    protected $fillable = [
        'codigo_muestra',
        'f_examen',
        'f_paciente'
    ];

    public function nombrePaciente($id){
        $paciente = Paciente::find($id);
        return $paciente->apellido.', '.$paciente->nombre;
    }
    public function edadPaciente($id){
      $paciente = Paciente::find($id);
      return $paciente->fechaNacimiento->age.' años';
    }
    
    public function quitar_tildes($cadena) {
    $no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
    $permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
    $texto = str_replace($no_permitidas, $permitidas ,$cadena);
    return $texto;
    }
    public function nombreExamen($id){
      $examen = Examen::find($id);
      return $examen->nombreExamen;
  }
    public function nombreUltra($id){
        $examen = ultrasonografia::find($id);
        return $examen->nombre;
    }
    public function nombreRayox($id){
        $examen = Rayosx::find($id);
        return $examen->nombre;
    }
    public function nombreTac($id){
        $examen = Tac::find($id);
        return $examen->nombre;
    }
    public function servicio($tipo,$id){
      if($tipo==1){
        return Servicio::where('f_examen',$id)->get()->first();
      }
      if($tipo==2){
        return Servicio::where('f_ultrasonografia',$id)->get()->first();
      }
      if($tipo==3){
        return Servicio::where('f_rayox',$id)->get()->first();
      }
      if($tipo==4){
        return Servicio::where('f_tac',$id)->get()->first();
      }
    }
    public function paciente(){
      return $this->belongsTo('App\Paciente','f_paciente');
    }
    public function pacientes(){
      return $this->hasMany('App\Paciente','f_paciente');
    }
    public function examen(){
      return $this->belongsTo('App\Examen','f_examen');
    }
    public function ultrasonografia(){
      return $this->belongsTo('App\ultrasonografia','f_ultrasonografia');
    }
    public function rayox(){
      return $this->belongsTo('App\Rayosx','f_rayox');
    }
    public function tac(){
      return $this->belongsTo('App\Tac','f_tac');
    }
    public function muestra(){
      return $this->belongsTo('App\Examen','tipoMuestra');
    }
    public function resultado(){
      return $this->belongsTo('App\Resultado','f_solicitud');
    }
    public function transaccion(){
      return $this->belongsTo('App\Transacion','f_transaccion');
    }

    public function examenesPaciente($id){
        $examenes = SolicitudExamen::where('f_paciente',$id)->where('estado','<>',3)->orderBy('estado')->get();
        foreach($examenes as $examen){
            if($examen->estado == 0){
                return 0;
            }else if($examen->estado == 1){
                return 1;
            }else{
                return 2;
            }
        }
    }

    public static function areas($i){
        switch($i){
            case 0: return "HEMATOLOGIA"; break;
            case 1: return "EXAMENES DE ORINA"; break;
            case 2: return "EXAMENES DE HECES"; break;
            case 3: return "BACTERIOLOGIA"; break;
            case 4: return "QUIMICA SANGUINEA"; break;
            case 5: return "INMUNOLOGIA"; break;
            case 6: return "ENZIMAS"; break;
            case 7: return "PRUEBAS ESPECIALES"; break;
            case 8: return "OTROS"; break;
            default: return ""; break;
        }
    }

    public static function colores($i){
        switch($i){
            case 0: return "#E74C3C"; break;
            case 1: return "#8E44AD"; break;
            case 2: return "#3498DB"; break;
            case 3: return "#16A085"; break;
            case 4: return "#2ECC71"; break;
            case 5: return "#F39C12"; break;
            case 6: return "#D35400"; break;
            case 7: return "#C0392B"; break;
            case 8: return "#9B59B6"; break;
            case 9: return "#2980B9"; break;
            case 10: return "#1ABC9C"; break;
            case 11: return "#27AE60"; break;
            case 12: return "#F1C40F"; break;
            case 13: return "#E67E22"; break;
            default: return ""; break;
        }
    }
}