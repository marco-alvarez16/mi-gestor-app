<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestor De Tareas</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(59,130,246,.18), transparent 35%),
                linear-gradient(135deg, #0f172a, #111827 55%, #172554);
            font-family: Arial, Helvetica, sans-serif;
            color: white;
        }

        .hero-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .glass-card {
            border: 1px solid rgba(255,255,255,.12);
            background: rgba(255,255,255,.06);
            backdrop-filter: blur(14px);
            border-radius: 24px;
            box-shadow: 0 25px 60px rgba(0,0,0,.25);
        }

        .hero-title {
            font-size: clamp(2.5rem, 6vw, 4.8rem);
            font-weight: 800;
            line-height: 1;
        }

        .hero-text {
            color: #cbd5e1;
            max-width: 620px;
            font-size: 1.08rem;
        }

        .brand-badge {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(59,130,246,.16);
            color: #93c5fd;
            border: 1px solid rgba(147,197,253,.25);
        }

        .feature-box {
            background: rgba(255,255,255,.05);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 18px;
            padding: 20px;
        }
    </style>
</head>

<body>

<div class="container hero-wrapper">

    <div class="glass-card w-100 p-4 p-lg-5">

        <div class="row align-items-center g-5">

            <div class="col-lg-7">

                <span class="brand-badge mb-4">
                    Sistema de gestión de tareas
                </span>

                <h1 class="hero-title mb-4">
                    Administra tus tareas desde este sitio.
                </h1>

                <p class="hero-text mb-4">
                    Esta plataforma esta diseñada para poder administrar y 
                    organizar mejor tus tareas.
                </p>

                <div class="d-flex flex-wrap gap-3">

                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="btn btn-primary btn-lg px-4">
                            Ir al panel
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="btn btn-primary btn-lg px-4">
                            Iniciar sesión
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="btn btn-outline-light btn-lg px-4">
                                Crear cuenta
                            </a>
                        @endif
                    @endauth

                </div>

            </div>

            <div class="col-lg-5">

                <div class="feature-box mb-3">
                    <h5>Gestión rápida</h5>
                    <p class="text-light-emphasis mb-0">
                        Traeas de escuela, trabajo, etc.
                    </p>
                </div>

                <div class="feature-box mb-3">
                    <h5>Información segura</h5>
                    <p class="text-light-emphasis mb-0">
                        Tu información solo servira de guía.
                        Estara segura aquí.
                    </p>
                </div>

                <div class="feature-box">
                    <h5>Diseño adaptable</h5>
                    <p class="text-light-emphasis mb-0">
                        Interfaz sencilla y facil de usar.
                        Además es adaptable a cualquier dispositivo.
                    </p>
                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>