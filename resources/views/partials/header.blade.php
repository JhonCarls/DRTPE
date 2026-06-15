{{-- ════════════════════════════════════════════════════════════ --}}
{{-- HEADER PRINCIPAL DEL PORTAL                                  --}}
{{-- ════════════════════════════════════════════════════════════ --}}
<header class="fixed top-0 left-0 right-0 z-50 bg-red-600 backdrop-blur-xl border-b border-white/10 shadow-2xl" style="height: var(--header-h);">
    <div class="h-full px-4 flex items-center justify-between gap-4">
        
        {{-- Bloque Izquierdo: Toggle Móvil + Logo + Títulos --}}
        <div class="flex items-center gap-3">
            {{-- Botón para abrir el Sidebar en pantallas móviles (lg:hidden) --}}
            <button id="sidebar-toggle" class="lg:hidden w-10 h-10 rounded-xl bg-white/10 hover:bg-white/20 border border-white/10 flex items-center justify-center transition cursor-pointer">
                <i class="fa-solid fa-bars text-white text-sm"></i>
            </button>
            
            {{-- Contenedor del Logo Institucional --}}
            <div class="bg-white/10 p-1.5 rounded-xl border border-white/15 shadow-lg">
                <img src="{{ asset('images/logo.png') }}" alt="Logo DRTPE" class="w-9 h-9 object-contain">
            </div>
            
            {{-- Textos de Identidad Institucional --}}
            <div class="hidden sm:block">
                <p class="text-white font-black text-base leading-tight tracking-tight" style="font-family: 'Sora', sans-serif;">
                    Portal Oficial de Actividades
                </p>
                <p class="text-red-200 text-[10px] font-semibold uppercase tracking-widest">
                    DRTPE Puno · Perú
                </p>
            </div>
        </div>

        {{-- Bloque Derecho: Botón de Acceso al Sistema Interno (Login) --}}
        <a href="{{ route('login') }}" class="flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 hover:border-white/40 px-5 py-2 rounded-xl text-xs font-bold text-white transition-all decoration-none">
            <i class="fa-solid fa-lock text-white text-sm"></i>
            <span class="hidden sm:inline">Acceso Interno</span>
        </a>
        
    </div>
</header>