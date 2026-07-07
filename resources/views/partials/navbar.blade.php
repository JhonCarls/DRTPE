{{-- ════════════════════════════════════════════════════════════ --}}
{{-- BARRA DE NAVEGACIÓN SUPERIOR (TOP NAVBAR - TOTALMENTE ENLAZADA) --}}
{{-- ════════════════════════════════════════════════════════════ --}}
<div id="top-navbar"
     class="w-full bg-red-600 border-b border-red-700 relative z-40 shadow-xl hidden lg:block"
     style="top: var(--header-h);">
    <div class="max-w-full px-4 lg:px-6">
        <div class="flex items-center justify-around h-[var(--navbar-h)] text-xs font-black uppercase tracking-wider relative"
             x-data="{ openMenu: null }" 
             style="height: var(--navbar-h);">

            {{-- Enlace: Inicio --}}
            <a href="{{ route('public.viewer') }}" class="text-white hover:bg-white/10 h-full flex items-center gap-2 transition-all px-4 shrink-0 font-black decoration-none">
                <i class="fa-solid fa-house text-sm"></i> Inicio
            </a>

            {{-- Dropdown: Institucional --}}
            <div class="h-full flex items-center relative" @mouseenter="openMenu = 'institucional'" @mouseleave="openMenu = null">
                <button class="text-white hover:bg-white/10 h-full flex items-center gap-1.5 transition-all px-4 font-black border-none bg-transparent cursor-pointer" 
                        :class="openMenu === 'institucional' ? 'bg-white/10' : ''">
                    Institucional <i class="fa-solid fa-chevron-down text-[10px] text-white/80 transition-transform" :class="openMenu === 'institucional' ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="openMenu === 'institucional'" x-cloak x-transition class="absolute top-full left-0 bg-slate-950 border border-white/10 shadow-2xl py-4 w-72 text-sm text-slate-300 font-bold normal-case z-50">
                    <a href="{{ route('portal.sobre-nosotros') }}" class="flex items-center gap-3 px-6 py-3 hover:bg-white/5 hover:text-white transition-colors decoration-none"><i class="fa-solid fa-circle-info text-base text-red-500"></i> Sobre Nosotros</a>
                    <a href="{{ route('portal.organigrama') }}" class="flex items-center gap-3 px-6 py-3 hover:bg-white/5 hover:text-white transition-colors decoration-none"><i class="fa-solid fa-sitemap text-base text-red-500"></i> Organigrama</a>
                    <a href="{{ route('portal.directorio') }}" class="flex items-center gap-3 px-6 py-3 hover:bg-white/5 hover:text-white transition-colors decoration-none"><i class="fa-solid fa-address-book text-base text-red-500"></i> Directorio</a>
                    <a href="{{ route('portal.marco-legal') }}" class="flex items-center gap-3 px-6 py-3 hover:bg-white/5 hover:text-white transition-colors decoration-none"><i class="fa-solid fa-scale-balanced text-base text-red-500"></i> Marco Legal</a>
                </div>
            </div>

            {{-- Dropdown: Estructura Orgánica --}}
            <div class="h-full flex items-center relative" @mouseenter="openMenu = 'organica'" @mouseleave="openMenu = null" x-data="{ subMenu: null }">
                <button class="text-white hover:bg-white/10 h-full flex items-center gap-1.5 transition-all px-4 font-black border-none bg-transparent cursor-pointer" 
                        :class="openMenu === 'organica' ? 'bg-white/10' : ''">
                    Estructura Orgánica <i class="fa-solid fa-chevron-down text-[10px] text-white/80 transition-transform" :class="openMenu === 'organica' ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="openMenu === 'organica'" x-cloak x-transition class="absolute top-full left-0 bg-slate-950 border border-white/10 shadow-2xl py-4 w-80 text-sm text-slate-300 font-bold normal-case z-50">
                    <a href="{{ route('portal.gerencia') }}" class="flex items-center gap-3 px-6 py-3 hover:bg-white/5 hover:text-white transition-colors border-b border-white/5 pb-3 mb-1 decoration-none"><i class="fa-solid fa-user-tie text-base text-red-500"></i> Gerencia Regional</a>
                    
                    {{-- Submenú: Administración --}}
                    <div class="relative" @mouseenter="subMenu = 'admin'" @mouseleave="subMenu = null">
                        <div class="flex items-center justify-between px-6 py-3 hover:bg-white/5 hover:text-white cursor-pointer transition-colors" :class="subMenu === 'admin' ? 'bg-white/5 text-white' : ''">
                            <span class="flex items-center gap-3"><i class="fa-solid fa-calculator text-base text-red-500"></i> Oficina de Administración</span>
                            <i class="fa-solid fa-chevron-right text-[10px] text-slate-500"></i>
                        </div>
                        <div x-show="subMenu === 'admin'" x-cloak class="absolute top-0 left-full ml-px bg-slate-950 border border-white/10 shadow-2xl py-3 w-52 text-slate-400 font-medium">
                            <a href="{{ route('portal.admin-personal') }}" class="block px-6 py-2 hover:bg-white/5 hover:text-white transition-colors decoration-none">Personal</a>
                            <a href="{{ route('portal.admin-contabilidad') }}" class="block px-6 py-2 hover:bg-white/5 hover:text-white transition-colors decoration-none">Contabilidad</a>
                            <a href="{{ route('portal.admin-abastecimiento') }}" class="block px-6 py-2 hover:bg-white/5 hover:text-white transition-colors decoration-none">Abastecimiento</a>
                            <a href="{{ route('portal.admin-presupuesto') }}" class="block px-6 py-2 hover:bg-white/5 hover:text-white transition-colors decoration-none">Presupuesto</a>
                        </div>
                    </div>

                    {{-- Submenú: Dirección del Empleo --}}
                    <div class="relative" @mouseenter="subMenu = 'empleo'" @mouseleave="subMenu = null">
                        <div class="flex items-center justify-between px-6 py-3 hover:bg-white/5 hover:text-white cursor-pointer transition-colors" :class="subMenu === 'empleo' ? 'bg-white/5 text-white' : ''">
                            <span class="flex items-center gap-3"><i class="fa-solid fa-passport text-base text-red-500"></i> Dirección del Empleo</span>
                            <i class="fa-solid fa-chevron-right text-[10px] text-slate-500"></i>
                        </div>
                        <div x-show="subMenu === 'empleo'" x-cloak class="absolute top-0 left-full ml-px bg-slate-950 border border-white/10 shadow-2xl py-3 w-64 text-slate-400 font-medium">
                            <a href="{{ route('portal.empleo-general') }}" class="block px-6 py-2 hover:bg-white/5 hover:text-white transition-colors decoration-none">Información General</a>
                            <a href="{{ route('portal.empleo-registros') }}" class="block px-6 py-2 hover:bg-white/5 hover:text-white transition-colors decoration-none">Registros Administrativos</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Dropdown: Servicios --}}
            <div class="h-full flex items-center relative" @mouseenter="openMenu = 'servicios'" @mouseleave="openMenu = null">
                <button class="text-white hover:bg-white/10 h-full flex items-center gap-1.5 transition-all px-4 font-black border-none bg-transparent cursor-pointer" 
                        :class="openMenu === 'servicios' ? 'bg-white/10' : ''">
                    Servicios <i class="fa-solid fa-chevron-down text-[10px] text-white/80 transition-transform" :class="openMenu === 'servicios' ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="openMenu === 'servicios'" x-cloak x-transition class="absolute top-full left-0 bg-slate-950 border border-white/10 shadow-2xl py-4 w-72 text-sm text-slate-300 font-bold normal-case z-50">
                    <a href="{{ route('portal.servicio-empleo') }}" class="flex items-center gap-3 px-6 py-3 hover:bg-white/5 hover:text-white transition-colors decoration-none"><i class="fa-solid fa-briefcase text-base text-red-400"></i> Centro de Empleo Puno</a>
                    <a href="{{ route('portal.servicio-multas') }}" class="flex items-center gap-3 px-6 py-3 hover:bg-white/5 hover:text-white transition-colors decoration-none"><i class="fa-solid fa-receipt text-base text-red-400"></i> Fraccionamiento de Multas</a>
                    <a href="{{ route('portal.servicio-capacitacion') }}" class="flex items-center gap-3 px-6 py-3 hover:bg-white/5 hover:text-white transition-colors decoration-none"><i class="fa-solid fa-user-graduate text-base text-red-400"></i> Capacitación</a>
                    <a href="{{ route('portal.servicio-defensa') }}" class="flex items-center gap-3 px-6 py-3 hover:bg-white/5 hover:text-white transition-colors decoration-none"><i class="fa-solid fa-gavel text-base text-red-400"></i> Defensa Legal</a>
                </div>
            </div>

            {{-- Dropdown: Talleres --}}
            <div class="h-full flex items-center relative" @mouseenter="openMenu = 'talleres'" @mouseleave="openMenu = null">
                <button class="text-white hover:bg-white/10 h-full flex items-center gap-1.5 transition-all px-4 font-black border-none bg-transparent cursor-pointer" 
                        :class="openMenu === 'talleres' ? 'bg-white/10' : ''">
                    Talleres <i class="fa-solid fa-chevron-down text-[10px] text-white/80 transition-transform" :class="openMenu === 'talleres' ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="openMenu === 'talleres'" x-cloak x-transition class="absolute top-full right-0 bg-slate-950 border border-white/10 shadow-2xl py-4 w-80 text-sm text-slate-300 font-bold normal-case z-50">
                    <button onclick="scrollToSection('seccion-por-hacer')" class="w-full text-left flex items-center justify-between px-6 py-3 hover:bg-white/5 hover:text-white transition-colors bg-transparent border-none font-bold text-slate-300 group cursor-pointer">
                        <div class="flex items-center gap-3"><i class="fa-regular fa-clock text-base text-red-400 w-5 text-center"></i> Capacitaciones por Hacer</div>
                        <span class="text-[10px] font-mono font-black px-2 py-0.5 rounded {{ isset($capacitacionesPorHacer) && $capacitacionesPorHacer->count() > 0 ? 'bg-red-600 text-white animate-pulse' : 'bg-white/10 text-slate-500' }}">{{ isset($capacitacionesPorHacer) ? $capacitacionesPorHacer->count() : 0 }}</span>
                    </button>
                    <button onclick="scrollToSection('seccion-hechas')" class="w-full text-left flex items-center justify-between px-6 py-3 hover:bg-white/5 hover:text-white transition-colors bg-transparent border-none font-bold text-slate-300 cursor-pointer">
                        <div class="flex items-center gap-3"><i class="fa-solid fa-circle-check text-base text-red-400 w-5 text-center"></i> Capacitaciones Hechas</div>
                        <span class="text-[10px] font-mono font-black px-2 py-0.5 bg-white/10 text-slate-400 rounded">{{ isset($capacitacionesHechas) ? $capacitacionesHechas->count() : 0 }}</span>
                    </button>
                    <button onclick="scrollToSection('seccion-coordinaciones')" class="w-full text-left flex items-center justify-between px-6 py-3 hover:bg-white/5 hover:text-white transition-colors bg-transparent border-none font-bold text-slate-300 cursor-pointer">
                        <div class="flex items-center gap-3"><i class="fa-solid fa-handshake text-base text-red-400 w-5 text-center"></i> Coordinaciones Hechas</div>
                        <span class="text-[10px] font-mono font-black px-2 py-0.5 bg-white/10 text-slate-400 rounded">{{ isset($coordinacionesHechas) ? $coordinacionesHechas->count() : 0 }}</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>