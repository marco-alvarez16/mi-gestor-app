@extends('layouts.admin')
@section('title', 'Editar tarea')
@section('page-title', 'Editar tarea')
@section('content')


<div class="mb-4">
    <h2 class="fw-bold mb-1">
        Editar tarea
    </h2>

    <p class="text-muted">
        Modifica la información de la tarea.
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
            action="{{ route('tasks.update', $task) }}"
            class="needs-validation task-form"
            novalidate
        >
            @csrf

            @method('PUT')


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
                    value="{{ old('title', $task->title) }}"
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
                >{{ old('description', $task->description) }}</textarea>


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
                    value="{{ old(
                        'due_date',
                        optional($task->due_date)->format('Y-m-d')
                    ) }}"
                    class="form-control"
                >


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


                        <option
                            value="alta"
                            {{ old('priority', $task->priority) === 'alta' ? 'selected' : '' }}
                        >

                            Alta

                        </option>


                        <option
                            value="media"
                            {{ old('priority', $task->priority) === 'media' ? 'selected' : '' }}
                        >

                            Media

                        </option>


                        <option
                            value="baja"
                            {{ old('priority', $task->priority) === 'baja' ? 'selected' : '' }}
                        >

                            Baja

                        </option>


                    </select>


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
                            {{ old('status', $task->status) === 'pendiente' ? 'selected' : '' }}
                        >

                            Pendiente

                        </option>


                        <option
                            value="en_proceso"
                            {{ old('status', $task->status) === 'en_proceso' ? 'selected' : '' }}
                        >

                            En proceso

                        </option>


                        <option
                            value="completada"
                            {{ old('status', $task->status) === 'completada' ? 'selected' : '' }}
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

                    Guardar cambios

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