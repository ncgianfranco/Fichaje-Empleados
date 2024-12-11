<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAuthenticated
{
    /**
     * Gestiona las peticiones.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
                // Redirigir al usuario al login o a la página de inicio
                return redirect('/login'); // Cambiar '/login' a '/' si deseas redirigir a la página principal
        }
    
        // Permitir la solicitud si el usuario está autenticado
        return $next($request);
    }
}
