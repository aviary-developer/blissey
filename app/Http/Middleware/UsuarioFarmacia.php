<?php

namespace App\Http\Middleware;

use Closure;

class UsuarioFarmacia
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
      if(auth()->check() && auth()->user()->tipoUsuario == 'Farmacia')
      {
        return $next($request);
      }
      if(auth()->check() && auth()->user()->tipoUsuario == 'Recepción')
      {
        return $next($request);
      }
      return redirect("/");
    }
}
