@extends('layouts.auth')


@section('title', 'Crear cuenta')


@section('content')


<div class="mb-4">

    <h2>
        Crear cuenta
    </h2>

    <p class="text-muted">
        Regístrate para comenzar a administrar tus tareas.
    </p>

</div>


@if($errors->any())

    <div class="alert alert-danger">

        @foreach($errors->all() as $error)

            <div>
                {{ $error }}
            </div>

        @endforeach

    </div>

@endif


<form
    id="registerForm"
    method="POST"
    action="{{ route('register') }}"
    class="needs-validation"
    novalidate
>

    @csrf


    <div class="mb-3">

        <label
            for="name"
            class="form-label">

            Nombre completo

        </label>


        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
            class="form-control"
            minlength="2"
            maxlength="100"
            required
        >


        <div class="invalid-feedback">

            Ingresa un nombre válido.

        </div>

    </div>


    <div class="mb-3">

        <label
            for="email"
            class="form-label">

            Correo electrónico

        </label>


        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            class="form-control"
            required
        >


        <div class="invalid-feedback">

            Ingresa un correo válido.

        </div>

    </div>


    <div class="mb-3">

        <label
            for="password"
            class="form-label">

            Contraseña

        </label>


        <input
            type="password"
            id="password"
            name="password"
            class="form-control"
            minlength="8"
            required
        >


        <div class="form-text">

            Mínimo 8 caracteres,
            una mayúscula,
            una minúscula
            y un número.

        </div>


        <div class="invalid-feedback">

            La contraseña no cumple los requisitos.

        </div>

    </div>


    <div class="mb-4">

        <label
            for="password_confirmation"
            class="form-label">

            Confirmar contraseña

        </label>


        <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            class="form-control"
            required
        >


        <div class="invalid-feedback">

            Las contraseñas deben coincidir.

        </div>

    </div>


    <div class="d-grid">

        <button
            type="submit"
            class="btn btn-taskflow">

            Crear cuenta

        </button>

    </div>


</form>


<div class="text-center mt-4">

    <span class="text-muted">

        ¿Ya tienes una cuenta?

    </span>


    <a
        href="{{ route('login') }}"
        class="text-decoration-none fw-semibold">

        Iniciar sesión

    </a>

</div>


@endsection