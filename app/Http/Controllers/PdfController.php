<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{
  public function github (){
    //return "HOLA";
    return \PDF::loadView('temporal')->stream('nombre-archivo.pdf');
  }
}
