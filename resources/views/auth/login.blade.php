@extends('layouts.auth')


@section('title', 'Iniciar sesión')


@section('content')


<div class="mb-4">

    <h2>
        Iniciar sesión
    </h2>

    <p class="text-muted">
        Ingresa tus datos para continuar.
    </p>

</div>


@if(session('status'))

    <div class="alert alert-success">

        {{ session('status') }}

    </div>

@endif


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
    method="POST"
    action="{{ route('login') }}"
    class="needs-validation"
    novalidate
>

    @csrf


    <div class="mb-3">

        <label
            for="email"
            class="form-label">

            Correo electrónico

        </label>


        <div class="input-group">

            <span class="input-group-text bg-white">

                <i class="bi bi-envelope"></i>

            </span>


            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control"
                placeholder="correo@ejemplo.com"
                required
                autofocus
            >

            <div class="invalid-feedback">

                Ingresa un correo válido.

            </div>

        </div>

    </div>


    <div class="mb-3">

        <label
            for="password"
            class="form-label">

            Contraseña

        </label>


        <div class="input-group">

            <span class="input-group-text bg-white">

                <i class="bi bi-lock"></i>

            </span>


            <input
                type="password"
                id="password"
                name="password"
                class="form-control"
                required
            >

            <div class="invalid-feedback">

                Ingresa tu contraseña.

            </div>

        </div>

    </div>


    <div class="
        d-flex
        justify-content-between
        align-items-center
        mb-4
    ">




        @if(Route::has('password.request'))

            <a
                href="{{ route('password.request') }}"
                class="text-decoration-none">

                ¿Olvidaste tu contraseña?

            </a>

        @endif


    </div>


    <div class="d-grid">

        <button
            type="submit"
            class="btn btn-taskflow">

            Iniciar sesión

        </button>

    </div>


</form>


<hr class="my-4">


<div class="text-center">

    <span class="text-muted">

        ¿No tienes una cuenta?

    </span>


    <a
        href="{{ route('register') }}"
        class="text-decoration-none fw-semibold">

        Crear cuenta

    </a>

</div>


@endsection