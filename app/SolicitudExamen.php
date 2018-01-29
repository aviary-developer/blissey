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

    public function nombreExamen($id){
        $examen = Examen::find($id);
        return $examen->nombreExamen;
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
    public function muestra(){
      return $this->belongsTo('App\Examen','tipoMuestra');
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
}
