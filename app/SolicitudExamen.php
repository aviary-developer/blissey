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
}
