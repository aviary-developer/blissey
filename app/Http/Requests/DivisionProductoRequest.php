<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DivisionProductoRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'codigo'=>'required|max:50',
            'pre'=>'required',
            'stock'=>'required',
        ];
    }
    public function messages(){
       return [
            'codigo.required'=>'El campo código de venta es requerido',
            'codigo.required'=>'El campo código debe tener máximo 50 caracteres',
            'pre.required'=>'El campo precio de venta es requerido',
            'stock.required'=>'El campo stock mínimo es requerido',

       ];
    }
}
