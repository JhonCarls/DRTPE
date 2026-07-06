<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intranet de Sede - DRTPE PUNO</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;900&family=Sora:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'DM Sans', sans-serif; background-color: #f8fafc; }
        .scrollbar-thin::-webkit-scrollbar { width: 5px; height: 5px; }
        .scrollbar-thin::-webkit-scrollbar-track { background: transparent; }
        .scrollbar-thin::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
    </style>
</head>
<body class="antialiased text-slate-800 min-h-screen bg-[#f8fafc]">

    <nav x-data="{ openSidebar: false }" class="relative z-50">
        {{-- BARRA SUPERIOR MÓVIL --}}
        <div class="sm:hidden flex items-center justify-between bg-white border-b border-slate-200 px-4 py-3 shadow-sm sticky top-0 z-40">
            <button @click="openSidebar = true" class="text-slate-500 hover:text-indigo-600 focus:outline-none transition-colors p-2 -ml-2">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 decoration-none">
                <span class="font-black text-slate-800 text-sm tracking-widest">DRTPE</span>
            </a>
            <div class="w-8 h-8 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-sm shadow-sm">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
        </div>

        {{-- CAPA OSCURA MÓVIL --}}
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 sm:hidden"
             x-show="openSidebar"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="openSidebar = false"
             style="display: none;">
        </div>

        {{-- SIDEBAR ESTRUCTURAL IZQUIERDO --}}
        <aside :class="openSidebar ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-900 flex flex-col transition-transform duration-300 ease-in-out sm:translate-x-0 shadow-2xl border-r border-slate-800 h-screen">
            
            <div class="h-20 flex items-center justify-between px-6 bg-slate-950/50 border-b border-slate-800 shrink-0">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group w-full bg-white p-2 rounded-xl shadow-lg border border-slate-200 transition-transform hover:scale-105 decoration-none">
                    <div class="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center text-white"><i class="fa-solid fa-building-flag text-xs"></i></div>
                    <div class="flex flex-col text-left">
                        <span class="text-slate-900 font-black text-xs leading-none uppercase tracking-widest">DRTPE</span>
                        <span class="text-slate-500 font-bold text-[9px] uppercase tracking-widest">Sede {{ ucfirst(auth()->user()->sede) }}</span>
                    </div>
                </a>
                <button @click="openSidebar = false" class="sm:hidden text-slate-400 hover:text-white p-2 ml-2">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto py-6 px-4 space-y-1.5 scrollbar-thin">
                <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 ml-2 mt-2">Principal</div>
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3.5 rounded-xl font-bold transition-all group decoration-none {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-chart-pie text-lg"></i>
                    <span>Página Principal Sede</span>
                </a>

                <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 ml-2 mt-6">Operaciones de Sede</div>
                <a href="{{ route('branch-activities.index') }}"
                   class="flex items-center gap-3 px-4 py-3.5 rounded-xl font-bold transition-all group decoration-none {{ request()->routeIs('branch-activities.index') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-folder-open text-lg"></i>
                    <span>Gestionar Historial</span>
                </a>
                <a href="{{ route('branch-activities.create') }}"
                   class="flex items-center gap-3 px-4 py-3.5 rounded-xl font-bold transition-all group decoration-none {{ request()->routeIs('branch-activities.create') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-circle-plus text-lg"></i>
                    <span>Registrar Actividad</span>
                </a>

                {{-- REORGANIZACIÓN: NUEVA SECCIÓN DE ALERTAS DIRECTA EN TU BARRA LATERAL --}}
                <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 ml-2 mt-6">Alertas y Avisos</div>
                <a href="{{ route('announcements.create') }}"
                   class="flex items-center gap-3 px-4 py-3.5 rounded-xl font-bold transition-all duration-300 group {{ request()->routeIs('announcements.create') ? 'bg-gradient-to-r from-red-600 to-red-700 text-white shadow-[0_0_20px_rgba(220,38,38,0.4)] border border-red-500/50' : 'text-slate-300 hover:bg-white/10 hover:text-white hover:translate-x-1' }}">
                    <i class="fa-solid fa-bullhorn text-lg"></i>
                    <span>Publicar Comunicado</span>
                </a>
            </div>

            <div class="p-4 border-t border-slate-800 bg-slate-950/30 shrink-0">
                <div class="flex items-center gap-3 mb-3 px-2">
                    <div class="w-10 h-10 rounded-full bg-indigo-500/20 text-indigo-400 border border-indigo-500/30 flex items-center justify-center font-black">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-white truncate m-0">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-slate-400 truncate m-0 mt-0.5">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <a href="{{ route('profile.edit') }}" class="flex items-center justify-center gap-2 px-3 py-2 text-xs font-bold text-slate-300 bg-slate-800 hover:bg-indigo-600 hover:text-white rounded-lg transition-colors border border-slate-700 hover:border-indigo-500 decoration-none">
                        <i class="fa-solid fa-user-gear"></i> Perfil
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 text-xs font-bold text-slate-300 bg-slate-800 hover:bg-red-600 hover:text-white rounded-lg transition-colors border border-slate-700 border-none cursor-pointer">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Salir
                        </button>
                    </form>
                </div>
            </div>
        </aside>
    </nav>

    <div class="sm:pl-72 flex flex-col min-h-screen">
        <header class="bg-white border-b border-slate-200 h-16 items-center justify-between px-8 sticky top-0 z-30 shadow-xs hidden sm:flex">
            <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Jurisdicción Desconcentrada de Trabajo y Promoción del Empleo</span>
            <span class="text-xs font-bold text-slate-500">Módulo Operador</span>
        </header>

        <main class="p-6 sm:p-8 flex-1 max-w-7xl w-full mx-auto">
            {{ $slot }}
        </main>
    </div>

</body>
</html>