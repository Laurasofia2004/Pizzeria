<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            abort(403, 'Unauthorized access');
        }

        // Obtener el rol del usuario
        $userRole = Auth::user()->role;

        // Verificar si el rol del usuario está en la lista de roles permitidos
        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized access');
        }

        // Si tiene uno de los roles permitidos, permitir acceso a la ruta
        return $next($request);
    }
}