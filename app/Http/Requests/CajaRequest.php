<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CajaRequest extends FormRequest
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
             'nombre'=>'required | min:5 | max:30 |unique:cajas',
             'localizacion'=>'required',
         ];
     }
     public function messages(){
        return [
             'caja.required'=>'El campo nombre es obligatorio',
             'caja.min'=>'El campo nombre necesita 5 caracteres mínimos',
             'caja.max'=>'El campo nombre necesita 30 caracteres máximo',
             'caja.unique'=>'El campo nombre ya ha sido registrado',

             'localizacion.required'=>'El campo localización es obligatorio',
        ];
     }
}
