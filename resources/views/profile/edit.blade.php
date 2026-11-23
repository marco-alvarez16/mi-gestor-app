@extends('layouts.admin')

@section('title', 'Mi perfil')

@section('page-title', 'Mi perfil')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold mb-1">
        Mi perfil
    </h2>

    <p class="text-muted mb-0">
        Administra tu información personal y la seguridad de tu cuenta.
    </p>
</div>


<div class="row g-4">

    {{-- INFORMACIÓN DEL PERFIL --}}
    <div class="col-xl-7">

        <div class="card task-card">

            <div class="card-body">

                <h5 class="fw-bold mb-4">
                    Información personal
                </h5>

                <form
                    method="POST"
                    action="{{ route('profile.update') }}"
                    class="needs-validation"
                    novalidate
                >

                    @csrf
                    @method('PATCH')


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
                            value="{{ old('name', $user->name) }}"
                            class="form-control"
                            required
                            minlength="2"
                            maxlength="100"
                        >

                        <div class="invalid-feedback">
                            Ingresa un nombre válido.
                        </div>

                    </div>


                    <div class="mb-4">

                        <label
                            for="email"
                            class="form-label">

                            Correo electrónico

                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            class="form-control"
                            required
                        >

                        <div class="invalid-feedback">
                            Ingresa un correo válido.
                        </div>

                    </div>


                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-save me-1"></i>

                        Guardar cambios

                    </button>

                </form>

            </div>

        </div>

    </div>


    {{-- INFORMACIÓN DE CUENTA --}}
    <div class="col-xl-5">

        <div class="card task-card h-100">

            <div class="card-body">

                <h5 class="fw-bold mb-4">
                    Información de la cuenta
                </h5>


                <div class="text-center mb-4">

                    <div
                        class="user-avatar mx-auto mb-3"
                        style="
                            width: 90px;
                            height: 90px;
                            font-size: 2rem;
                        "
                    >

                        {{ strtoupper(substr($user->name, 0, 1)) }}

                    </div>


                    <h5 class="mb-1">

                        {{ $user->name }}

                    </h5>


                    <p class="text-muted">

                        {{ $user->email }}

                    </p>

                </div>


                <hr>


                <div class="mb-3">

                    <small class="text-muted">
                        Usuario desde
                    </small>

                    <div class="fw-semibold">

                        {{ $user->created_at->format('d/m/Y') }}

                    </div>

                </div>


                <div>

                    <small class="text-muted">
                        Total de tareas
                    </small>

                    <div class="fw-semibold">

                        {{ $user->tasks()->count() }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- CAMBIAR CONTRASEÑA --}}
<div class="card task-card mt-4">

    <div class="card-body">

        <h5 class="fw-bold mb-4">
            Seguridad
        </h5>

        <form
            method="POST"
            action="{{ route('password.update') }}"
        >

            @csrf
            @method('PUT')


            <div class="row">


                <div class="col-md-4 mb-3">

                    <label
                        for="current_password"
                        class="form-label">

                        Contraseña actual

                    </label>

                    <input
                        type="password"
                        id="current_password"
                        name="current_password"
                        class="form-control"
                        required
                    >

                </div>


                <div class="col-md-4 mb-3">

                    <label
                        for="password"
                        class="form-label">

                        Nueva contraseña

                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        minlength="8"
                        required
                    >

                </div>


                <div class="col-md-4 mb-3">

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

                </div>

            </div>


            <button
                type="submit"
                class="btn btn-primary">

                <i class="bi bi-shield-lock me-1"></i>

                Actualizar contraseña

            </button>

        </form>

    </div>

</div>

@endsection