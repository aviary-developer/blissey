<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParametroRequest extends FormRequest
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
          'nombreParametro' => 'required | unique:parametros',
      ];
  }
  public function messages(){
     return [
          'nombreParametro.required'=>'El campo Nombre es obligatorio',
          'nombreParametro.unique'=>'El nombre ya ha sido registrado anteriormente',
     ];
  }
}
