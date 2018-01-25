<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class UsuarioAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $usuarios = DB::table('users')->count();
      if($usuarios < 1)
      {
        if($request->path() == 'usuarios/create' || $request->method() == 'POST')
        {
          return $next($request);
        }
        return redirect('usuarios/create');
      }
      else {
        if(auth()->check()){
          $id = auth()->user()->id;
          if(auth()->check() && auth()->user()->administrador)
          {
            return $next($request);
          }else if(auth()->check() && $request->path() == 'usuarios/'.$id && $request->method() == 'GET'){
            return $next($request);
          }
        }else{
          return redirect("/login");
        }
      }
      return redirect("/");
    }
}
