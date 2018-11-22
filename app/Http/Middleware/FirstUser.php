<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class FirstUser
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
			if($usuarios < 1){
				return redirect('usuarios/create');
			}
      return $next($request);
    }
}
