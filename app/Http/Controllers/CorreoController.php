<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\CorreoRecuperacion;
use App\Http\Requests\CorreoRequest;

class CorreoController extends Controller
{
    public static function envio(CorreoRequest $request){
      // $request->mail="ngrd94@gmail.com";
      // $request->mensaje="Este es un mensaje";
      // Mail::to($request->mail)->send(new CorreoRecuperacion($request));
    }
    public static function vista(){
      return view('auth.email');
    }
}
