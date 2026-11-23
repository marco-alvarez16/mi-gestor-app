@extends('layouts.admin')


@section('title', 'Nueva tarea')


@section('page-title', 'Nueva tarea')


@section('content')


<div class="mb-4">

    <h2 class="fw-bold mb-1">

        Registrar nueva tarea

    </h2>

    <p class="text-muted">

        Completa los siguientes campos.

    </p>

</div>


@if($errors->any())

    <div class="alert alert-danger">

        <ul class="mb-0">

            @foreach($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

            @endforeach

        </ul>

    </div>

@endif


<div class="card task-card">


    <div class="card-body">


        <form
            id="taskForm"
            method="POST"
            action="{{ route('tasks.store') }}"
            class="needs-validation task-form"
            novalidate
        >

            @csrf


            <div class="mb-3">


                <label
                    for="title"
                    class="form-label"
                >

                    Título

                </label>


                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
                    class="form-control"
                    minlength="3"
                    maxlength="150"
                    required
                >


                <div class="invalid-feedback">

                    El título debe tener entre
                    3 y 150 caracteres.

                </div>


            </div>


            <div class="mb-3">


                <label
                    for="description"
                    class="form-label"
                >

                    Descripción

                </label>


                <textarea
                    id="description"
                    name="description"
                    class="form-control"
                    rows="4"
                    maxlength="1000"
                >{{ old('description') }}</textarea>


                <div class="form-text">

                    Máximo 1000 caracteres.

                </div>


            </div>


            <div class="mb-3">


                <label
                    for="due_date"
                    class="form-label"
                >

                    Fecha límite

                </label>


                <input
                    type="date"
                    id="due_date"
                    name="due_date"
                    value="{{ old('due_date') }}"
                    class="form-control"
                >


                <div class="invalid-feedback">

                    Selecciona una fecha válida.

                </div>


            </div>


            <div class="row">


                <div class="col-md-6 mb-3">


                    <label
                        for="priority"
                        class="form-label"
                    >

                        Prioridad

                    </label>


                    <select
                        id="priority"
                        name="priority"
                        class="form-select"
                        required
                    >


                        <option value="">

                            Selecciona una prioridad

                        </option>


                        <option
                            value="alta"
                            {{ old('priority') === 'alta' ? 'selected' : '' }}
                        >

                            Alta

                        </option>


                        <option
                            value="media"
                            {{ old('priority') === 'media' ? 'selected' : '' }}
                        >

                            Media

                        </option>


                        <option
                            value="baja"
                            {{ old('priority') === 'baja' ? 'selected' : '' }}
                        >

                            Baja

                        </option>


                    </select>


                    <div class="invalid-feedback">

                        Selecciona una prioridad.

                    </div>


                </div>


                <div class="col-md-6 mb-3">


                    <label
                        for="status"
                        class="form-label"
                    >

                        Estado

                    </label>


                    <select
                        id="status"
                        name="status"
                        class="form-select"
                        required
                    >


                        <option
                            value="pendiente"
                            {{ old('status') === 'pendiente' ? 'selected' : '' }}
                        >

                            Pendiente

                        </option>


                        <option
                            value="en_proceso"
                            {{ old('status') === 'en_proceso' ? 'selected' : '' }}
                        >

                            En proceso

                        </option>


                        <option
                            value="completada"
                            {{ old('status') === 'completada' ? 'selected' : '' }}
                        >

                            Completada

                        </option>


                    </select>


                </div>


            </div>


            <div class="d-flex gap-2">


                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    <i class="bi bi-save me-1"></i>

                    Guardar tarea

                </button>


                <a
                    href="{{ route('tasks.index') }}"
                    class="btn btn-outline-secondary"
                >

                    Cancelar

                </a>


            </div>


        </form>


    </div>


</div>


@endsection