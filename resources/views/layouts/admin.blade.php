<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Gestor de Tareas')
    </title>

    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        >   

    @vite('resources/js/app.js')

</head>


<body>


{{-- SIDEBAR --}}

<aside class="task-sidebar">


    <div class="sidebar-brand">


        <div class="sidebar-brand-icon">

            <i class="bi bi-clipboard-check"></i>

        </div>

    


        <div>

            <div class="sidebar-brand-title">

                Gestor de Tareas

            </div>

            <div class="sidebar-brand-subtitle">

                Organiza tus actividades

            </div>

        </div>


    </div>


    <nav class="sidebar-menu">

    <div class="sidebar-label">
        Principal
    </div>

    <a
        href="{{ route('dashboard') }}"
        class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"
    >
        <i class="bi bi-house-door-fill"></i>
        Dashboard
    </a>


    <div class="sidebar-label mt-3">
        Tareas
    </div>

    <a
        href="{{ route('tasks.index') }}"
        class="{{ request()->routeIs('tasks.index') ? 'active' : '' }}"
    >
        <i class="bi bi-list-task"></i>
        Mis tareas
    </a>

    <a
        href="{{ route('tasks.create') }}"
        class="{{ request()->routeIs('tasks.create') ? 'active' : '' }}"
    >
        <i class="bi bi-plus-circle-fill"></i>
        Nueva tarea
    </a>

    <a
        href="{{ route('tasks.completed') }}"
        class="{{ request()->routeIs('tasks.completed') ? 'active' : '' }}"
    >
        <i class="bi bi-check-circle-fill"></i>
        Completadas
    </a>


    <div class="sidebar-label mt-3">
        Cuenta
    </div>

    <a
        href="{{ route('profile.edit') }}"
        class="{{ request()->routeIs('profile.*') ? 'active' : '' }}"
    >
        <i class="bi bi-person-circle"></i>
        Mi perfil
    </a>

</nav>


</aside>


{{-- CONTENIDO --}}

<div class="task-main">


    <header class="task-topbar">


        <div>

            <h5 class="mb-0 fw-bold">

                @yield('page-title', 'Dashboard')

            </h5>

            <small class="text-muted">

                Gestor de tareas

            </small>

        </div>


        <div class="
            d-flex
            align-items-center
            gap-3
        ">


            <div class="
                text-end
                d-none
                d-sm-block
            ">

                <div class="fw-semibold">

                    {{ Auth::user()->name }}

                </div>

                <small class="text-muted">

                    Usuario

                </small>

            </div>


            <div class="user-avatar">

                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

            </div>


            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf


                <button
                    type="submit"
                    class="btn btn-outline-danger btn-sm"
                >

                    <i class="bi bi-box-arrow-right"></i>

                    Salir

                </button>


            </form>


        </div>


    </header>


    <main class="task-content">

        @yield('content')

    </main>


    <footer class="task-footer">

        © {{ date('Y') }} Gestor de Tareas

    </footer>


</div>


</body>

</html>