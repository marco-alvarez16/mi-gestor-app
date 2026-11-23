<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    // Comprobar correo y contraseña
    $request->authenticate();

    $user = $request->user();

    // Comprobar si tiene una sesión activa
    // durante los últimos 10 minutos
    $sessionIsActive =
        $user->active_session_id !== null &&
        $user->last_activity_at !== null &&
        $user->last_activity_at->greaterThan(
            now()->subMinutes(10)
        );

    if ($sessionIsActive) {

        // Cancelar el nuevo inicio de sesión
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        throw ValidationException::withMessages([
            'email' =>
                'Esta cuenta ya tiene una sesión activa. '
                . 'Debes esperar 10 minutos de inactividad '
                . 'para iniciar sesión en otro dispositivo.',
        ]);
    }

    // Crear nueva sesión
    $request->session()->regenerate();

    // Guardar cuál es la única sesión autorizada
    $user->active_session_id =
        $request->session()->getId();

    $user->last_activity_at = now();

    $user->save();

    return redirect()->intended(
        route('dashboard', absolute: false)
    );
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
{
    $user = $request->user();

    if (
        $user &&
        $user->active_session_id === $request->session()->getId()
    ) {
        $user->active_session_id = null;
        $user->last_activity_at = null;
        $user->save();
    }

    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
}
}
