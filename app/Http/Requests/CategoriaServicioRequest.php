<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaServicioRequest extends FormRequest
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
            'nombre' => 'required | min:2 | max:30'
        ];
    }

    public function messages(){
       return [
            'nombre.required'=>'El campo nombre es obligatorio',
            'nombre.min'=>'El campo nombre necesita 2 caracteres como mínimo',
            'nombre.max'=>'El campo nombre soporta 30 caracteres como máximo',
       ];
    }
}
