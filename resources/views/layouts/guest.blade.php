<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Acceso Institucional | {{ config('app.name', 'DRTPE Puno') }}</title>

    {{-- Precarga de tipografía sin bloquear el render (preconnect + display=swap) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    {{-- Tailwind + Alpine compilados (sin CDN bloqueante) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-image: url('/images/fondodash.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .card-accent {
            position: absolute; top: 0; left: 0; right: 0; height: 5px;
            background: linear-gradient(90deg, #1e293b 0%, #b91c1c 50%, #1e293b 100%);
            border-radius: 1.5rem 1.5rem 0 0;
        }
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #f8fafc inset !important;
            transition: background-color 5000s ease-in-out 0s;
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="antialiased selection:bg-red-700 selection:text-white min-h-screen flex items-center justify-center p-4 relative text-slate-900">

    <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-[2px] z-0"></div>

    <main class="w-full max-w-md relative z-10">
        <div class="glass-card rounded-3xl shadow-[0_20px_50px_-12px_rgba(0,0,0,0.5)] border border-white/50 relative p-8 sm:p-10">
            <div class="card-accent"></div>

            {{-- Isotipo institucional --}}
            <div class="text-center mb-8">
                <div class="w-20 h-20 mx-auto bg-white rounded-2xl shadow-md border border-slate-100 p-2.5 mb-2 transition-transform hover:scale-105">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo DRTPE Puno" class="w-full h-full object-contain" loading="lazy" decoding="async">
                </div>
            </div>

            {{ $slot }}
        </div>

        <div class="mt-8 text-center">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm font-bold text-white/70 hover:text-white transition-colors bg-black/20 hover:bg-black/40 px-5 py-2.5 rounded-full backdrop-blur-sm border border-white/10 decoration-none">
                <i class="fa-solid fa-arrow-left"></i> Volver al Portal
            </a>
        </div>
    </main>
</body>
</html>
