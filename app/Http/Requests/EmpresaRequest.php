<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'codigo_hospital' => 'required | min:2 | max:30',
            'nombre_hospital' => 'required | min:2',
            'direccion_hospital' => 'required | min:2',

            'codigo_clinica' => 'required | min:2 | max:30',
            'nombre_clinica' => 'required | min:2',
            'direccion_clinica' => 'required | min:2',

            'codigo_laboratorio' => 'required | min:2 | max:30',
            'nombre_laboratorio' => 'required | min:2',
            'direccion_laboratorio' => 'required | min:2',

            'codigo_farmacia' => 'required | min:2 | max:30',
            'nombre_farmacia' => 'required | min:2',
            'direccion_farmacia' => 'required | min:2',
        ];
    }

    public function messages(){
       return [
            'codigo_hospital.required'=>'El campo código de hospital es obligatorio',
            'codigo_hospital.min'=>'El campo código de hospital necesita 2 caracteres como mínimo',
            'codigo_hospital.max'=>'El campo código de hospital soporta 30 caracteres como máximo',

            'nombre_hospital.required'=>'El campo nombre de hospital es obligatorio',
            'nombre_hospital.min'=>'El campo nombre de hospital necesita 2 caracteres como mínimo',
            'nombre_hospital.max'=>'El campo nombre de hospital soporta 30 caracteres como máximo',

            'direccion_hospital.required'=>'El campo dirección del hospital es obligatorio',
            'direccion_hospital.min'=>'El campo dirección del hospital necesita 2 caracteres como mínimo',
            'direccion_hospital.max'=>'El campo dirección del hospital soporta 30 caracteres como máximo',

            'codigo_laboratorio.required'=>'El campo código de laboratorio es obligatorio',
            'codigo_laboratorio.min'=>'El campo código de laboratorio necesita 2 caracteres como mínimo',
            'codigo_laboratorio.max'=>'El campo código de laboratorio soporta 30 caracteres como máximo',

            'nombre_laboratorio.required'=>'El campo nombre de laboratorio es obligatorio',
            'nombre_laboratorio.min'=>'El campo nombre de laboratorio necesita 2 caracteres como mínimo',
            'nombre_laboratorio.max'=>'El campo nombre de laboratorio soporta 30 caracteres como máximo',

            'direccion_laboratorio.required'=>'El campo dirección del laboratorio es obligatorio',
            'direccion_laboratorio.min'=>'El campo dirección del laboratorio necesita 2 caracteres como mínimo',
            'direccion_laboratorio.max'=>'El campo dirección del laboratorio soporta 30 caracteres como máximo',

            'codigo_clinica.required'=>'El campo código de clinica es obligatorio',
            'codigo_clinica.min'=>'El campo código de clinica necesita 2 caracteres como mínimo',
            'codigo_clinica.max'=>'El campo código de clinica soporta 30 caracteres como máximo',

            'nombre_clinica.required'=>'El campo nombre de clinica es obligatorio',
            'nombre_clinica.min'=>'El campo nombre de clinica necesita 2 caracteres como mínimo',
            'nombre_clinica.max'=>'El campo nombre de clinica soporta 30 caracteres como máximo',

            'direccion_clinica.required'=>'El campo dirección del clinica es obligatorio',
            'direccion_clinica.min'=>'El campo dirección del clinica necesita 2 caracteres como mínimo',
            'direccion_clinica.max'=>'El campo dirección del clinica soporta 30 caracteres como máximo',

            'codigo_farmacia.required'=>'El campo código de farmacia es obligatorio',
            'codigo_farmacia.min'=>'El campo código de farmacia necesita 2 caracteres como mínimo',
            'codigo_farmacia.max'=>'El campo código de farmacia soporta 30 caracteres como máximo',

            'nombre_farmacia.required'=>'El campo nombre de farmacia es obligatorio',
            'nombre_farmacia.min'=>'El campo nombre de farmacia necesita 2 caracteres como mínimo',
            'nombre_farmacia.max'=>'El campo nombre de farmacia soporta 30 caracteres como máximo',

            'direccion_farmacia.required'=>'El campo dirección del farmacia es obligatorio',
            'direccion_farmacia.min'=>'El campo dirección del farmacia necesita 2 caracteres como mínimo',
            'direccion_farmacia.max'=>'El campo dirección del hospital soporta 30 caracteres como máximo',

       ];
    }
}
