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
				$contador_empresa = Empresa::count();
				if($contador_empresa > 0){
					return $next($request);
				}else{
					return redirect('/grupo_promesa/create');
				}
      }
      return redirect("/login");
    }
}
