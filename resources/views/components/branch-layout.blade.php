<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Operativo de Sede - DRTPE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;900&family=Sora:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'DM Sans', sans-serif; background-color: #f8fafc; }
    </style>
</head>
<body class="antialiased text-slate-800">

    {{-- BARRA SUPERIOR INSTITUCIONAL --}}
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-red-600 rounded-xl flex items-center justify-center text-white font-bold shadow-xs">
                    <i class="fa-solid fa-building-flag text-sm"></i>
                </div>
                <div>
                    <span class="text-xs font-black uppercase tracking-widest text-red-600 block leading-none">DRTPE PUNO</span>
                    <span class="text-sm font-black text-slate-900 uppercase tracking-tight">Sede Desconcentrada {{ ucfirst(auth()->user()->sede) }}</span>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-black text-slate-800 m-0 leading-none">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider m-0 mt-1">Operador Autorizado</p>
                </div>
                
                {{-- Botón de Salida Seguro --}}
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 border border-slate-200 hover:border-red-200 px-3 py-2 rounded-xl text-xs font-bold transition-all cursor-pointer">
                        <i class="fa-solid fa-power-off text-[11px]"></i>
                        <span>Salir</span>
                    </button>
                </form>
            </div>
        </div>
    </header>

    {{-- CONTENEDOR PRINCIPAL --}}
    <main class="py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>

</body>
</html>