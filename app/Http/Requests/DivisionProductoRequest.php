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
            'pre'=>'required|',
            'stock'=>'required',
        ];
    }
    public function messages(){
       return [
            'pre.required'=>'El campo precio de venta es requerido',
            'stock.required'=>'El campo stock mínimo es requerido',

       ];
    }
}
