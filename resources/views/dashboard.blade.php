@extends('layouts.admin')


@section('title', 'Dashboard')


@section('page-title', 'Dashboard')


@section('content')


<div class="mb-4">

    <h2 class="fw-bold mb-1">

        Hola, {{ Auth::user()->name }}

    </h2>

    <p class="text-muted mb-0">

        Aquí tienes un resumen de tus tareas.

    </p>

</div>


<div class="row g-4 mb-4">


    <div class="col-md-6 col-xl-3">

        <div class="card task-card h-100">

            <div class="card-body">

                <div class="
                    d-flex
                    justify-content-between
                ">

                    <div>

                        <div class="stat-label">
                            Pendientes
                        </div>

                        <div class="stat-number">
                            {{ $stats['pending'] }}
                        </div>

                    </div>


                    <div class="stat-icon">

                        <i class="bi bi-clock"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-6 col-xl-3">

        <div class="card task-card h-100">

            <div class="card-body">

                <div class="
                    d-flex
                    justify-content-between
                ">

                    <div>

                        <div class="stat-label">
                            Completadas
                        </div>

                        <div class="stat-number">
                            {{ $stats['completed'] }}
                        </div>

                    </div>


                    <div class="stat-icon">

                        <i class="bi bi-check-circle"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-6 col-xl-3">

        <div class="card task-card h-100">

            <div class="card-body">

                <div class="
                    d-flex
                    justify-content-between
                ">

                    <div>

                        <div class="stat-label">
                            Total
                        </div>

                        <div class="stat-number">
                            {{ $stats['total'] }}
                        </div>

                    </div>


                    <div class="stat-icon">

                        <i class="bi bi-list-check"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-6 col-xl-3">

        <div class="card task-card h-100">

            <div class="card-body">

                <div class="
                    d-flex
                    justify-content-between
                ">

                    <div>

                        <div class="stat-label">
                            Para hoy
                        </div>

                        <div class="stat-number">
                            {{ $stats['today'] }}
                        </div>

                    </div>


                    <div class="stat-icon">

                        <i class="bi bi-calendar-event"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


</div>


<div class="row g-4">


    <div class="col-xl-8">

        <div class="card task-card">

            <div class="card-body">


                <div class="
                    d-flex
                    justify-content-between
                    align-items-center
                    mb-4
                ">

                    <div>

                        <h5 class="fw-bold mb-1">

                            Tareas recientes

                        </h5>

                        <small class="text-muted">

                            Últimas tareas registradas

                        </small>

                    </div>


                    <a
                        href="{{ route('tasks.index') }}"
                        class="btn btn-sm btn-outline-primary"
                    >

                        Ver todas

                    </a>


                </div>


                <div class="table-responsive">


                    <table class="
                        table
                        task-table
                        align-middle
                    ">


                        <thead>

                            <tr>

                                <th>
                                    Tarea
                                </th>

                                <th>
                                    Prioridad
                                </th>

                                <th>
                                    Estado
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                        @forelse($recentTasks as $task)


                            <tr>


                                <td>

                                    {{ $task->title }}

                                </td>


                                <td>

                                    {{ ucfirst($task->priority) }}

                                </td>


                                <td>

                                    {{ str_replace('_', ' ', ucfirst($task->status)) }}

                                </td>


                            </tr>


                        @empty


                            <tr>

                                <td
                                    colspan="3"
                                    class="task-empty"
                                >

                                    Todavía no tienes tareas.

                                </td>

                            </tr>


                        @endforelse


                        </tbody>


                    </table>


                </div>


            </div>

        </div>

    </div>


    <div class="col-xl-4">


        <div class="card task-card">


            <div class="card-body">


                <h5 class="fw-bold">

                    Acciones rápidas

                </h5>


                <p class="text-muted small mb-4">

                    Accesos frecuentes

                </p>


                <div class="d-grid gap-3">


                    <a
                        href="{{ route('tasks.create') }}"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-plus-lg me-2"></i>

                        Nueva tarea

                    </a>


                    <a
                        href="{{ route('tasks.index') }}"
                        class="btn btn-outline-primary"
                    >

                        Ver mis tareas

                    </a>


                    <a
                        href="{{ route('tasks.completed') }}"
                        class="btn btn-outline-secondary"
                    >

                        Ver completadas

                    </a>


                </div>


            </div>


        </div>


    </div>


</div>


@endsection