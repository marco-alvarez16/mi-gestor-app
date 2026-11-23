@extends('layouts.admin')


@section('title', 'Tareas completadas')


@section('page-title', 'Tareas completadas')


@section('content')


<div class="mb-4">

    <h2 class="fw-bold mb-1">

        Tareas completadas

    </h2>

    <p class="text-muted">

        Consulta las actividades que ya terminaste.

    </p>

</div>


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

                    </tr>


                </thead>


                <tbody>


                @forelse($tasks as $task)


                    <tr>


                        <td>

                            {{ $task->title }}

                        </td>


                        <td>

                            {{ $task->due_date
                                ? $task->due_date->format('d/m/Y')
                                : 'Sin fecha'
                            }}

                        </td>


                        <td>

                            {{ ucfirst($task->priority) }}

                        </td>


                        <td>

                            <span class="badge bg-success">

                                Completada

                            </span>

                        </td>


                    </tr>


                @empty


                    <tr>

                        <td
                            colspan="4"
                            class="task-empty"
                        >

                            No tienes tareas completadas.

                        </td>

                    </tr>


                @endforelse


                </tbody>


            </table>


        </div>


    </div>


</div>


@endsection