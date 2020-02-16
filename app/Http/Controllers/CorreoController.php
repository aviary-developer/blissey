<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\CorreoRecuperacion;
use App\Http\Requests\CorreoRequest;
use App\User;
use Redirect;

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
    public function cpsw(Request $request){
      $usuario=User::where('email',$request->email)->get();
      foreach($usuario as $u){
        if(stripos($request->password,$u->email) === false && stripos($request->password,$u->name) === false){
          return "1";
        }else{
          return "error";
        }
      }
    }
}
