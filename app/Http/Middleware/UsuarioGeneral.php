<?php

namespace App\Http\Middleware;

use Closure;
use App\Empresa;

class UsuarioGeneral
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
      if(auth()->check())
      {
        if(auth()->user()->cambio==1 && $request->method() != 'POST' )
        {
          return redirect('usuarios/'.auth()->user()->id);
        }
				$contador_empresa = Empresa::count();
				if($contador_empresa > 0 || $request->path() == 'grupo_promesa/create' || $request->method() == 'POST'){
					return $next($request);
				}else{
					return redirect('/grupo_promesa/create');
				}
      }
      return redirect("/login");
    }
}
