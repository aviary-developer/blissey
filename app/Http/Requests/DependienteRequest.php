<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DependienteRequest extends FormRequest
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
            'nombre'=>'required | min:3 | max:25',
            'apellido'=>'required | min:3 | max:25',
            'telefono'=>'required | size:9',
        ];
    }
    public function messages()
    {
        return [
            'nombre.required'=>'El campo nombre es obligatorio',
            'nombre.min'=>'El campo nombre necesita 3 caracteres mínimos',
            'nombre.max'=>'El campo nombre necesita 25 caracteres máximo',

            'apellido.required'=>'El campo apellido es obligatorio',
            'apellido.min'=>'El campo apellido necesita 3 caracteres mínimos',
            'apellido.max'=>'El campo apellido necesita 25 caracteres máximo',

            'telefono.required'=>'El campo teléfono es obligatorio',
            'telefono.size'=>'El campo teléfon debe contener 9 caracteres incluyendo el guión',
        ];
    }
}
