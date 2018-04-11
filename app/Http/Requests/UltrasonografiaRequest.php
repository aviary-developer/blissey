<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UltrasonografiaRequest extends FormRequest
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
           'nombre' => 'required | unique:ultrasonografias',
       ];
     }
     public function messages(){
        return [
             'nombre.required'=>'El campo Nombre es obligatorio',
             'nombre.unique'=>'El nombre de Ultrasonografía ya ha sido registrado anteriormente',
        ];
     }
}
