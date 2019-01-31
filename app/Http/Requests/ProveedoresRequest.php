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
            'nombre'=>'required| min:3 |max:50 |unique:proveedors',
        ];
    }
    public function messages(){
       return [
        'nombre.required'=>'El campo proveedor es obligatorio',
        'nombre.min'=>'El campo proveedor necesita 3 caracteres mínimos',
        'nombre.max'=>'El campo proveedor necesita 50 caracteres máximo',
        'nombre.unique'=>'El campo proveedor ya ha sido registrado',
      ];
  }
}
