<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;

class CheckIfInactive
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
        if (Auth::check()) {
            // Comparamos usando la función de ayuda de Laravel que es más exacta
            if (Auth::user()->hasRole('Inactivo')) {
                
                // Si ya está en la página de cuenta inactiva o intentando cerrar sesión, déjalo pasar
                if ($request->is('denegado') || $request->is('logout')) {
                    return $next($request);
                }

                // De lo contrario, mándalo a la vista de bloqueo
                return redirect()->to('denegado');
            }
        }
        return $next($request);
    }
}
