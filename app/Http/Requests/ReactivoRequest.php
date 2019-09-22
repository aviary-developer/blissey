<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReactivoRequest extends FormRequest
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
          'nombre' => 'required | unique:reactivos',
          'fechaVencimiento' => 'required',
      ];
  }
  public function messages(){
     return [
          'nombre.required'=>'El campo Nombre es obligatorio',
          'nombre.required'=>'El campo Fecha de vencimiento es obligatorio',
          'nombre.unique'=>'El nombre ya ha sido registrado anteriormente',
     ];
  }
}
