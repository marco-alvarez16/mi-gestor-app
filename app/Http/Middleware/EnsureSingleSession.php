<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureSingleSession
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        if (Auth::check()) {

            $user = $request->user();

            $currentSessionId =
                $request->session()->getId();


            // Si esta no es la sesión autorizada,
            // cerrar inmediatamente
            if (
                !$user->active_session_id ||
                $user->active_session_id !== $currentSessionId
            ) {

                Auth::guard('web')->logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return redirect()
                    ->route('login')
                    ->withErrors([
                        'email' =>
                            'Tu sesión ya no se encuentra activa.'
                    ]);
            }


            // Actualizar la última actividad
            $user->last_activity_at = now();

            $user->save();
        }

        return $next($request);
    }
}