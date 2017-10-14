<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstanteRequest extends FormRequest
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
            'codigo'=>'required | min:1 | max:5 |unique:estantes',
            'cantidad'=>'required | min:1 | max:9',
        ];
    }
    public function messages(){
       return [
            'codigo.required'=>'El campo código identificador es obligatorio',
            'codigo.min'=>'El campo código identificador necesita 1 caracteres mínimos',
            'codigo.max'=>'El campo código identificador necesita 3 caracteres máximo',
            'codigo.unique'=>'',
       ];
    }
}
