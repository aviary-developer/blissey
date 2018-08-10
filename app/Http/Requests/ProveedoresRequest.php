<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProveedoresRequest extends FormRequest
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
            'nombre'=>'required| min:5 |max:50 |unique:proveedors',
            'correo'=>'required| email |unique:proveedors',
            'telefono'=>'required| size:9 |unique:proveedors',
        ];
    }
    public function messages(){
       return [
        'nombre.required'=>'El campo proveedor es obligatorio',
        'nombre.min'=>'El campo proveedor necesita 3 caracteres mínimos',
        'nombre.max'=>'El campo proveedor necesita 50 caracteres máximo',
        'nombre.unique'=>'El campo proveedor ya ha sido registrado',

        'correo.required'=>'El campo correo es obligatorio',
        'correo.email'=>'Ingrese un correo válido',
        'correo.unique'=>'El campo correo ya ha sido registrado',

        'telefono.required'=>'El campo teléfono es obligatorio',
        'telefono.size'=>'El teléfono necesita 9 caracteres incluyendo el guión',
        'telefono.unique'=>'El campo teléfono ya ha sido registrado',
      ];
  }
}
