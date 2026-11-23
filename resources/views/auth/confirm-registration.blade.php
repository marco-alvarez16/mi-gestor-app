
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        Estás a un paso de completar tu registro.
        Confirma que tienes acceso a esta dirección
        de correo electrónico pulsando el botón.
    </div>

    <div class="mb-4 text-sm font-semibold text-gray-800">
        {{ $email }}
    </div>

    <form method="POST"
          action="{{ route('register.verify', ['token' => $token]) }}">
        @csrf

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                Confirmar mi correo
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
