<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class EsAdminMiddleware
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


        $usuario = Auth::user();  //usuario logueado, no es lo mismo q la tabla de usuarios

        if ( !$usuario->esAdministrador() ) { //comparo con la funcion de su modelo si no es admin
            return redirect('/estudiante');
        } 

        //en caso de que sea administrador continua con el proceso
        return $next($request);
    }
}
