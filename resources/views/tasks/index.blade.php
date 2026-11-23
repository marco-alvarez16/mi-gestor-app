@extends('layouts.admin')


@section('title', 'Mis tareas')


@section('page-title', 'Mis tareas')


@section('content')


<div class="
    d-flex
    justify-content-between
    align-items-center
    mb-4
">


    <div>

        <h2 class="fw-bold mb-1">

            Mis tareas

        </h2>

        <p class="text-muted mb-0">

            Consulta y administra tus tareas.

        </p>

    </div>


    <a
        href="{{ route('tasks.create') }}"
        class="btn btn-primary"
    >

        <i class="bi bi-plus-lg me-1"></i>

        Nueva tarea

    </a>


</div>


@if(session('success'))

    <div class="alert alert-success">

        {{ session('success') }}

    </div>

@endif


<div class="card task-card">


    <div class="card-body">


        <div class="table-responsive">


            <table class="
                table
                task-table
                align-middle
            ">


                <thead>


                    <tr>

                        <th>
                            Título
                        </th>

                        <th>
                            Fecha límite
                        </th>

                        <th>
                            Prioridad
                        </th>

                        <th>
                            Estado
                        </th>

                        <th>
                            Acciones
                        </th>

                    </tr>


                </thead>


                <tbody>


                @forelse($tasks as $task)


                    <tr>


                        <td>

                            <strong>
                                {{ $task->title }}
                            </strong>

                        </td>


                        <td>

                            {{ $task->due_date
                                ? $task->due_date->format('d/m/Y')
                                : 'Sin fecha'
                            }}

                        </td>


                        <td>


                            @if($task->priority === 'alta')

                                <span class="badge bg-danger">

                                    Alta

                                </span>


                            @elseif($task->priority === 'media')

                                <span class="
                                    badge
                                    bg-warning
                                    text-dark
                                ">

                                    Media

                                </span>


                            @else

                                <span class="badge bg-success">

                                    Baja

                                </span>

                            @endif


                        </td>


                        <td>


                            @if($task->status === 'pendiente')

                                <span class="
                                    badge
                                    bg-warning
                                    text-dark
                                ">

                                    Pendiente

                                </span>


                            @elseif($task->status === 'en_proceso')

                                <span class="badge bg-primary">

                                    En proceso

                                </span>


                            @else

                                <span class="badge bg-success">

                                    Completada

                                </span>

                            @endif


                        </td>


                        <td>


                            <div class="d-flex gap-2">


                                <a
                                    href="{{ route('tasks.edit', $task) }}"
                                    class="
                                        btn
                                        btn-sm
                                        btn-outline-primary
                                    "
                                >

                                    <i class="bi bi-pencil"></i>

                                </a>


                                <form
                                    method="POST"
                                    action="{{ route('tasks.destroy', $task) }}"
                                    class="delete-task-form"
                                >

                                    @csrf

                                    @method('DELETE')


                                    <button
                                        type="submit"
                                        class="
                                            btn
                                            btn-sm
                                            btn-outline-danger
                                        "
                                    >

                                        <i class="bi bi-trash"></i>

                                    </button>


                                </form>


                            </div>


                        </td>


                    </tr>


                @empty


                    <tr>

                        <td
                            colspan="5"
                            class="task-empty"
                        >

                            <i class="
                                bi
                                bi-clipboard
                                fs-1
                                d-block
                                mb-3
                            "></i>

                            No tienes tareas registradas.

                        </td>

                    </tr>


                @endforelse


                </tbody>


            </table>


        </div>


    </div>


</div>


@endsection