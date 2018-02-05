<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngresoRequest extends FormRequest
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
            'f_paciente' => 'required',
            'f_habitacion' => 'required'
        ];
    }

    public function messages(){
        return [
            'f_paciente.required'=>'Es necesario agregar un paciente',
            'f_habitacion.required'=>'Es necesario una habitacion disponible'
        ];
    }
}
