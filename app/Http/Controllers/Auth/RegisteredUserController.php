<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PendingRegistration;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'email' => mb_strtolower(trim((string) $request->input('email'))),
        ]);

        $validated = $request->validate([
            'name' => [
                'required', 'string', 'min:2', 'max:100',
                "regex:/^[\pL\s'-]+$/u"
            ],
            'email' => [
                'required', 'string', 'lowercase',
                'email:rfc', 'max:255',
                'unique:' . User::class
            ],
            'password' => [
                'required', 'confirmed',
                Password::min(8)->letters()->mixedCase()->numbers()
            ],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener mínimo 2 caracteres.',
            'name.regex' => 'El nombre contiene caracteres no permitidos.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa un correo válido con un dominio que pueda recibir correo.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        PendingRegistration::where('email', $validated['email'])->delete();

        $token = Str::random(64);

        $pending = PendingRegistration::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'token_hash' => hash('sha256', $token),
            'expires_at' => now()->addHours(24),
        ]);

        // El enlace ahora solamente muestra la página de confirmación.
        $verificationUrl = URL::route(
            'register.confirm',
            ['token' => $token]
        );

        try {
            Mail::raw(
                "Hola {$validated['name']},\n\n"
                . "Recibimos una solicitud para crear una cuenta.\n\n"
                . "Para continuar, abre este enlace:\n\n"
                . $verificationUrl
                . "\n\nEste enlace caduca en 24 horas.\n\n"
                . "Si no solicitaste este registro, ignora este mensaje.",
                function ($message) use ($validated) {
                    $message->to($validated['email'])
                        ->subject('Verifica tu correo electrónico');
                }
            );
        } catch (\Throwable $e) {
            $pending->delete();
            report($e);

            throw ValidationException::withMessages([
                'email' => 'No pudimos enviar el correo de verificación. Comprueba la dirección e inténtalo de nuevo.',
            ]);
        }

        return redirect()->route('login')->with(
            'status',
            'Te enviamos un enlace de verificación. Abre el correo para completar tu registro. El enlace caduca en 24 horas.'
        );
    }

    // GET: muestra la página, pero NO crea la cuenta.
    public function confirm(string $token): View|RedirectResponse
    {
        $pending = PendingRegistration::where(
            'token_hash',
            hash('sha256', $token)
        )->first();

        if (!$pending) {
            return redirect()->route('register')->withErrors([
                'email' => 'El enlace no es válido o ya fue utilizado.',
            ]);
        }

        if ($pending->expires_at->isPast()) {
            $pending->delete();

            return redirect()->route('register')->withErrors([
                'email' => 'El enlace ha caducado. Debes solicitar un registro nuevo.',
            ]);
        }

        if (User::where('email', $pending->email)->exists()) {
            $pending->delete();

            return redirect()->route('login')->with(
                'status',
                'Esta dirección ya tiene una cuenta. Puedes iniciar sesión.'
            );
        }

        return view('auth.confirm-registration', [
            'token' => $token,
            'email' => $pending->email,
        ]);
    }

    // POST: crea la cuenta únicamente después de pulsar el botón.
    public function verify(string $token): RedirectResponse
    {
        $pending = PendingRegistration::where(
            'token_hash',
            hash('sha256', $token)
        )->first();

        if (!$pending) {
            return redirect()->route('register')->withErrors([
                'email' => 'El enlace no es válido o ya fue utilizado.',
            ]);
        }

        if ($pending->expires_at->isPast()) {
            $pending->delete();

            return redirect()->route('register')->withErrors([
                'email' => 'El enlace ha caducado. Debes solicitar un registro nuevo.',
            ]);
        }

        if (User::where('email', $pending->email)->exists()) {
            $pending->delete();

            return redirect()->route('login')->with(
                'status',
                'Esta dirección ya tiene una cuenta. Puedes iniciar sesión.'
            );
        }

        $user = User::create([
            'name' => $pending->name,
            'email' => $pending->email,
            'password' => $pending->password,
        ]);

        $user->forceFill([
            'email_verified_at' => now(),
        ])->save();

        $pending->delete();

        return redirect()->route('login')->with(
            'status',
            '¡Correo verificado correctamente! Tu cuenta ya está creada. Ahora puedes iniciar sesión.'
        );
    }
}
