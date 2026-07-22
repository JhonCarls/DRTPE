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
                    Portal Oficial
                </p>
                <p class="text-red-200 text-[10px] font-semibold uppercase tracking-widest">
                    DRTPE Puno · Perú
                </p>
            </div>
            {{-- ════════════════════════════════════════════════════════════ --}}
            {{-- BARRA DE NAVEGACIÓN SUPERIOR (TOP NAVBAR - TOTALMENTE ENLAZADA) --}}
            {{-- ════════════════════════════════════════════════════════════ --}}
            
            <div id="top-navbar" class="relative hidden lg:block">

            <div class="max-w-full px-2 lg:px-6">
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
                                <a href="{{ route('portal.gerencia') }}" class="flex items-center gap-3 px-6 py-3 hover:bg-white/5 hover:text-white transition-colors border-b border-white/5 pb-3 mb-1 decoration-none"><i class="fa-solid fa-user-tie text-base text-red-500"></i>Gerencia Regional</a>

                                {{-- Submenú: Formaliza --}}
                                <div class="relative" @mouseenter="subMenu = 'formaliza'" @mouseleave="subMenu = null">
                                    <div class="flex items-center justify-between px-6 py-3 hover:bg-white/5 hover:text-white cursor-pointer transition-colors" :class="subMenu === 'formaliza' ? 'bg-white/5 text-white' : ''">
                                        <span class="flex items-center gap-3"><i class="fa-solid fa-file-contract text-base text-red-500"></i>Formaliza</span>
                                        <a href="{{ route('portal.formaliza_peru') }}" class="absolute inset-0 z-10"></a>
                                    </div>
                                </div>

                                {{-- Submenú: Dirección de Prevención y Solución de Conflictos --}}
                                <div class="relative" @mouseenter="subMenu = 'conflictos'" @mouseleave="subMenu = null">
                                    <div class="flex items-center justify-between px-6 py-3 hover:bg-white/5 hover:text-white cursor-pointer transition-colors border-t border-white/5 pt-3 mt-1" :class="subMenu === 'conflictos' ? 'bg-white/5 text-white' : ''">
                                        <span class="flex items-center gap-3"><i class="fa-solid fa-scale-balanced text-base text-red-500"></i>Prevención de Conflictos</span>
                                        <i class="fa-solid fa-chevron-right text-[10px] text-slate-500"></i>
                                    </div>
                                    <div x-show="subMenu === 'conflictos'" x-cloak class="absolute top-0 left-full ml-px bg-slate-950 border border-white/10 shadow-2xl py-3 w-72 text-slate-400 font-medium">
                                        <a href="{{ route('portal.Sconflictos') }}" class="block px-6 py-2 hover:bg-white/5 hover:text-white transition-colors decoration-none font-bold text-white border-b border-white/10 pb-2 mb-2">Dirección Principal</a>
                                        <a href="{{ route('portal.sub-negociaciones') }}" class="block px-6 py-2 hover:bg-white/5 hover:text-white transition-colors decoration-none">Negociaciones Colectivas</a>
                                        <a href="{{ route('portal.sub-inspeccion') }}" class="block px-6 py-2 hover:bg-white/5 hover:text-white transition-colors decoration-none">Inspección Laboral</a>
                                        <a href="{{ route('portal.sub-defensa') }}" class="block px-6 py-2 hover:bg-white/5 hover:text-white transition-colors decoration-none">Defensa Legal Gratuita</a>
                                    </div>
                                </div>
                                
                                {{-- Submenú: Dirección del Empleo --}}
                                <div class="relative" @mouseenter="subMenu = 'empleo'" @mouseleave="subMenu = null">
                                    <div class="flex items-center justify-between px-6 py-3 hover:bg-white/5 hover:text-white cursor-pointer transition-colors" :class="subMenu === 'empleo' ? 'bg-white/5 text-white' : ''">
                                        <span class="flex items-center gap-3"><i class="fa-solid fa-passport text-base text-red-500"></i>Dirección del Empleo</span>
                                        <i class="fa-solid fa-chevron-right text-[10px] text-slate-500"></i>
                                    </div>
                                    <div x-show="subMenu === 'empleo'" x-cloak class="absolute top-0 left-full ml-px bg-slate-950 border border-white/10 shadow-2xl py-3 w-72 text-slate-400 font-medium">
                                        <a href="{{ route('portal.empleo-general') }}" class="block px-6 py-2 hover:bg-white/5 hover:text-white transition-colors decoration-none">Información General</a>
                                        <a href="{{ route('portal.empleo-subdireccion') }}" class="block px-6 py-2 hover:bg-white/5 hover:text-white transition-colors decoration-none">Subdirección de Empleo</a>
                                        <a href="{{ route('portal.empleo-registros') }}" class="block px-6 py-2 hover:bg-white/5 hover:text-white transition-colors decoration-none">Registros Administrativos</a>
                                    </div>
                                </div>

                                {{-- Submenú: Órganos Desconcentrados --}}
                                <div class="relative" @mouseenter="subMenu = 'organos'" @mouseleave="subMenu = null">
                                    <div class="flex items-center justify-between px-6 py-3 hover:bg-white/5 hover:text-white cursor-pointer transition-colors border-t border-white/5 pt-3 mt-1" :class="subMenu === 'organos' ? 'bg-white/5 text-white' : ''">
                                        <span class="flex items-center gap-3"><i class="fa-solid fa-sitemap text-base text-red-500"></i>Órganos Desconcentrados</span>
                                        <i class="fa-solid fa-chevron-right text-[10px] text-slate-500"></i>
                                    </div>
                                    <div x-show="subMenu === 'organos'" x-cloak class="absolute top-0 left-full ml-px bg-slate-950 border border-white/10 shadow-2xl py-3 w-72 text-slate-400 font-medium">
                                        <a href="{{ route('portal.organos-juliaca') }}" class="block px-6 py-2 hover:bg-white/5 hover:text-white transition-colors decoration-none">Zona de Juliaca</a>
                                        <a href="{{ route('portal.organos-taraco') }}" class="block px-6 py-2 hover:bg-white/5 hover:text-white transition-colors decoration-none">Centro de Taraco</a>
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
        </div>


        {{-- Bloque Derecho: Botón de Acceso al Sistema Interno (Login) --}}
        <a href="{{ route('login') }}" class="flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 hover:border-white/40 px-5 py-2 rounded-xl text-xs font-bold text-white transition-all decoration-none">
            <i class="fa-solid fa-lock text-white text-sm"></i>
            <span class="hidden sm:inline">Acceso Interno</span>
        </a>
        
    </div>
</header>