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

    @vite('resources/js/app.js')

</head>

<body>


<div class="auth-page">


    <div class="auth-container">


        <div class="row g-0">


            {{-- PANEL IZQUIERDO --}}

            <div class="col-lg-6 auth-brand">


                <div class="auth-logo">

                    <div class="logo-box">

                        <i class="bi bi-check2-square"></i>

                    </div>

                    Gestor de Tareas

                </div>


                <div>

                    <h1 class="auth-title">

                        Organiza tus tareas de forma sencilla.

                    </h1>


                    <p class="auth-description mt-4">

                        Registra tus actividades,
                        establece prioridades,
                        controla fechas límite
                        y mantén tus tareas organizadas
                        desde un solo lugar.

                    </p>

                </div>


                <div class="text-white-50 small">

                    Gestor de Tareas

                </div>


            </div>


            {{-- FORMULARIO --}}

            <div class="col-lg-6 auth-form">

                @yield('content')

            </div>


        </div>


    </div>


</div>


</body>

</html>