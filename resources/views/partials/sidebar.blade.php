{{-- ════════════════════════════════════════════════════════════ --}}
{{-- CAPA DE SUPERPOSICIÓN Y BARRA LATERAL (TEMA OSCURO PREMIUM REGIONAL) --}}
{{-- ════════════════════════════════════════════════════════════ --}}
<div id="sidebar-overlay" onclick="closeSidebar()"></div>

<aside id="sidebar"
       class="bg-slate-950/98 backdrop-blur-xl border-r border-slate-700/50 shadow-2xl shadow-black/50 flex flex-col h-screen overflow-y-auto custom-scrollbar select-none text-slate-200 transition-all duration-300">

    {{-- 1. LOGO DE LA DIRECCIÓN REGIONAL --}}
    <div class="p-5 pb-4 border-b border-slate-800/80 bg-gradient-to-b from-slate-900/60 to-transparent">
        <div class="flex items-center gap-3 pt-1">
            <img src="{{ asset('images/logo.png') }}" alt="Logo"
                 class="w-11 h-11 object-contain rounded-xl bg-slate-900 p-1.5 border border-slate-700 shadow-md">
            <div>
                <p class="text-white font-black text-sm leading-tight m-0 tracking-tight" style="font-family: 'Sora', sans-serif;">DRTPE Puno</p>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-[0.2em] m-0 mt-0.5">Dirección Regional</p>
            </div>
        </div>
    </div>

    {{-- 2. SECCIÓN DESTACADA: SEDES DESCONCENTRADAS (DISEÑO DE ALTO IMPACTO VISUAL) --}}
    <div class="mx-3 my-4 p-4 bg-gradient-to-br from-red-800/70 via-red-950/50 to-slate-900/60 border-2 border-red-700/60 rounded-2xl shadow-xl shadow-red-900/30 backdrop-blur-md">
        {{-- Encabezado de la sección --}}
        <div class="flex items-center gap-2 mb-4 pb-2 border-b border-red-800/40">
            <div class="w-8 h-8 rounded-lg bg-red-700/80 flex items-center justify-center shadow-md">
                <i class="fa-solid fa-map-location-dot text-white text-sm"></i>
            </div>
            <p class="text-red-200 text-xs font-black uppercase tracking-[0.15em]">Sedes Desconcentradas</p>
        </div>

        <div class="space-y-3">
            {{-- Enlace Sede Juliaca Corregido --}}
<a href="{{ route('portal.sede', 'juliaca') }}"
   class="flex items-center gap-3 p-3 bg-slate-950/80 hover:bg-red-950/70 rounded-xl border border-slate-700/60 hover:border-red-500/60 transition-all duration-200 decoration-none group shadow-md hover:shadow-red-900/30">
    <div class="w-10 h-10 bg-gradient-to-br from-red-600 to-red-800 flex items-center justify-center rounded-lg shadow-lg group-hover:scale-110 transition-transform shrink-0">
        <i class="fa-solid fa-city text-white text-sm"></i>
    </div>
    <div class="flex-1 min-w-0">
        <p class="text-slate-100 text-sm font-black truncate m-0 group-hover:text-red-300 transition-colors">Sede Juliaca</p>
        <p class="text-slate-400 text-[11px] font-semibold mt-0.5 m-0 truncate group-hover:text-slate-300">Actividades Operativas Norte</p>
    </div>
    <i class="fa-solid fa-chevron-right text-red-500/80 opacity-0 group-hover:opacity-100 transition-opacity text-xs"></i>
</a>

{{-- Enlace Sede Taraco Corregido --}}
<a href="{{ route('portal.sede', 'taraco') }}"
   class="flex items-center gap-3 p-3 bg-slate-950/80 hover:bg-red-950/70 rounded-xl border border-slate-700/60 hover:border-red-500/60 transition-all duration-200 decoration-none group shadow-md hover:shadow-red-900/30">
    <div class="w-10 h-10 bg-gradient-to-br from-red-600 to-red-800 flex items-center justify-center rounded-lg shadow-lg group-hover:scale-110 transition-transform shrink-0">
        <i class="fa-solid fa-building-flag text-white text-sm"></i>
    </div>
    <div class="flex-1 min-w-0">
        <p class="text-slate-100 text-sm font-black truncate m-0 group-hover:text-red-300 transition-colors">Sede Taraco</p>
        <p class="text-slate-400 text-[11px] font-semibold mt-0.5 m-0 truncate group-hover:text-slate-300">Intervenciones Itinerantes</p>
    </div>
    <i class="fa-solid fa-chevron-right text-red-500/80 opacity-0 group-hover:opacity-100 transition-opacity text-xs"></i>
</a>
        </div>
    </div>

    {{-- 3. DIRECCIONES TEXTUALES DE CONTACTO GENERAL --}}
    <div class="px-5 pb-5 border-b border-slate-800/80 space-y-4">
        <div class="space-y-3.5">
            <!-- Sede Puno -->
            <div class="flex items-start gap-3">
                <div class="w-7 h-7 rounded-lg bg-slate-900 border border-slate-700 flex items-center justify-center flex-shrink-0 mt-0.5 shadow-inner">
                    <i class="fa-solid fa-location-dot text-red-400 text-xs"></i>
                </div>
                <div>
                    <p class="text-slate-200 text-xs font-black m-0">Sede Puno</p>
                    <p class="text-slate-500 text-[11px] font-semibold leading-tight mt-0.5 m-0">Jr. Ayacucho N° 658, Puno</p>
                </div>
            </div>
            <!-- Sede Juliaca -->
            <div class="flex items-start gap-3">
                <div class="w-7 h-7 rounded-lg bg-slate-900 border border-slate-700 flex items-center justify-center flex-shrink-0 mt-0.5 shadow-inner">
                    <i class="fa-solid fa-location-dot text-blue-400 text-xs"></i>
                </div>
                <div>
                    <p class="text-slate-200 text-xs font-black m-0">Sede Juliaca</p>
                    <p class="text-slate-500 text-[11px] font-semibold leading-tight mt-0.5 m-0">Jr. Santiago Mamani N° 200, Juliaca</p>
                </div>
            </div>
            <!-- Sede Taraco -->
            <div class="flex items-start gap-3">
                <div class="w-7 h-7 rounded-lg bg-slate-900 border border-slate-700 flex items-center justify-center flex-shrink-0 mt-0.5 shadow-inner">
                    <i class="fa-solid fa-location-dot text-emerald-400 text-xs"></i>
                </div>
                <div>
                    <p class="text-slate-200 text-xs font-black m-0">Sede Taraco</p>
                    <p class="text-slate-500 text-[11px] font-semibold leading-tight mt-0.5 m-0">Plaza de Armas N° 105, Taraco</p>
                </div>
            </div>
        </div>

        {{-- Botones de Redes Sociales --}}
        <div class="flex gap-2.5 flex-wrap pt-1.5">
            <a href="https://www.facebook.com/DRTPEPunoOFICIAL/?locale=es_LA" target="_blank"
               class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-blue-700/80 hover:bg-blue-600 backdrop-blur-sm text-white rounded-lg text-[10px] font-black uppercase tracking-wider shadow-md decoration-none transition-all duration-200 hover:shadow-blue-900/30">
                <i class="fa-brands fa-facebook"></i> Facebook
            </a>
            <a href="#" target="_blank"
               class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-slate-800/80 hover:bg-slate-700 backdrop-blur-sm text-white rounded-lg text-[10px] font-black uppercase tracking-wider shadow-md decoration-none transition-all duration-200 hover:shadow-slate-900/30">
                <i class="fa-brands fa-tiktok"></i> TikTok
            </a>
        </div>
    </div>

    {{-- MENÚ EXCLUSIVO MÓVIL (Oculto en Escritorio) --}}
    <div class="lg:hidden px-4 py-4 border-b border-slate-800/80 space-y-2 bg-gradient-to-b from-slate-950/60 to-transparent"
         x-data="{ openMobileSec: null }">
        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest px-2 mb-1">Navegación del Portal</p>

        <div class="bg-slate-900/90 border border-slate-700 rounded-xl overflow-hidden shadow-md backdrop-blur-sm">
            <button
                @click="openMobileSec = openMobileSec === 'inst' ? null : 'inst'"
                class="w-full px-4 py-3 flex items-center justify-between font-bold text-xs text-slate-300 hover:text-white bg-transparent border-none cursor-pointer transition-colors">
                <span class="flex items-center gap-2.5"><i class="fa-solid fa-building text-red-500"></i> Institucional</span>
                <i class="fa-solid fa-chevron-down text-[10px] text-slate-500 transition-transform duration-200"
                   :class="openMobileSec === 'inst' ? 'rotate-180 text-white' : ''"></i>
            </button>
            <div class="bg-slate-950/80 px-4 py-2 space-y-2 text-[11px] font-bold text-slate-400 border-t border-slate-800/80 flex flex-col"
                 x-show="openMobileSec === 'inst'" x-cloak>
                <a href="#" class="py-1.5 hover:text-white flex items-center gap-2 decoration-none transition-colors"><i class="fa-solid fa-circle-info text-[9px] text-red-500/70"></i> Sobre Nosotros</a>
                <a href="#" class="py-1.5 hover:text-white flex items-center gap-2 decoration-none transition-colors"><i class="fa-solid fa-sitemap text-[9px] text-red-500/70"></i> Organigrama</a>
                <a href="#" class="py-1.5 hover:text-white flex items-center gap-2 decoration-none transition-colors"><i class="fa-solid fa-address-book text-[9px] text-red-500/70"></i> Directorio</a>
                <a href="#" class="py-1.5 hover:text-white flex items-center gap-2 decoration-none transition-colors"><i class="fa-solid fa-scale-balanced text-[9px] text-red-500/70"></i> Marco Legal</a>
            </div>
        </div>

        <div class="bg-slate-900/90 border border-slate-700 rounded-xl overflow-hidden shadow-md backdrop-blur-sm">
            <button
                @click="openMobileSec = openMobileSec === 'org' ? null : 'org'"
                class="w-full px-4 py-3 flex items-center justify-between font-bold text-xs text-slate-300 hover:text-white bg-transparent border-none cursor-pointer transition-colors">
                <span class="flex items-center gap-2.5"><i class="fa-solid fa-sitemap text-red-500"></i> Estructura Orgánica</span>
                <i class="fa-solid fa-chevron-down text-[10px] text-slate-500 transition-transform duration-200"
                   :class="openMobileSec === 'org' ? 'rotate-180 text-white' : ''"></i>
            </button>
            <div class="bg-slate-950/80 px-4 py-2 space-y-2 text-[11px] font-bold text-slate-400 border-t border-slate-800/80 flex flex-col"
                 x-show="openMobileSec === 'org'" x-cloak>
                <a href="#" class="py-1.5 hover:text-white flex items-center gap-2 decoration-none transition-colors"><i class="fa-solid fa-user-tie text-[9px] text-red-500/70"></i> Gerencia Regional</a>
                <p class="font-black text-[9px] text-slate-500 uppercase tracking-wider pt-1.5 border-t border-slate-800 m-0">Áreas Internas</p>
                <a href="#" class="py-1 hover:text-white pl-2 decoration-none transition-colors">&bull; Administración</a>
                <a href="#" class="py-1 hover:text-white pl-2 decoration-none transition-colors">&bull; Dirección del Empleo</a>
            </div>
        </div>
    </div>

    {{-- SECCIÓN TRÁMITES Y TRABAJO AUTÓNOMO --}}
    <p class="text-[11px] font-black text-slate-400 uppercase tracking-wider mt-6 mb-2 ml-5 flex items-center gap-1.5">
        <i class="fa-solid fa-gavel text-blue-400"></i> Tramitación y Formaliza
    </p>
    <div class="h-px bg-gradient-to-r from-transparent via-slate-700 to-transparent mx-4 mb-3 opacity-70"></div>

    <div class="px-3 space-y-1.5">
        {{-- Enlace 1: Registro REMYPE --}}
        <a href="https://www.gob.pe/remype" target="_blank"
           class="flex items-center gap-3 p-2.5 hover:bg-slate-800/60 rounded-xl border border-transparent hover:border-slate-700/60 transition-all duration-200 decoration-none group">
            <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center rounded-lg shadow-sm group-hover:scale-105 transition-transform shrink-0">
                <i class="fa-solid fa-building-shield text-white text-xs"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-slate-200 text-xs font-black truncate m-0 group-hover:text-blue-400 transition-colors">Registro REMYPE</p>
                <p class="text-slate-500 text-[10px] font-medium mt-0.5 m-0 truncate group-hover:text-slate-400">Acreditación de Micro y Pequeña Empresa</p>
            </div>
        </a>

        {{-- Enlace 2: SUNAFIL Denuncias --}}
        <a href="https://www.gob.pe/sunafil" target="_blank"
           class="flex items-center gap-3 p-2.5 hover:bg-slate-800/60 rounded-xl border border-transparent hover:border-slate-700/60 transition-all duration-200 decoration-none group">
            <div class="w-8 h-8 bg-gradient-to-br from-rose-600 to-red-600 flex items-center justify-center rounded-lg shadow-sm group-hover:scale-105 transition-transform shrink-0">
                <i class="fa-solid fa-scale-balanced text-white text-xs"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-slate-200 text-xs font-black truncate m-0 group-hover:text-red-400 transition-colors">Denuncias Virtuales</p>
                <p class="text-slate-500 text-[10px] font-medium mt-0.5 m-0 truncate group-hover:text-slate-400">Módulo de Inspección del Trabajo - SUNAFIL</p>
            </div>
        </a>

        {{-- Enlace 3: Formalízate Perú --}}
        <a href="https://www.gob.pe/mtpe" target="_blank"
           class="flex items-center gap-3 p-2.5 hover:bg-slate-800/60 rounded-xl border border-transparent hover:border-slate-700/60 transition-all duration-200 decoration-none group">
            <div class="w-8 h-8 bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center rounded-lg shadow-sm group-hover:scale-105 transition-transform shrink-0">
                <i class="fa-solid fa-passport text-white text-xs"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-slate-200 text-xs font-black truncate m-0 group-hover:text-slate-100 transition-colors">Asesoría de Formalización</p>
                <p class="text-slate-500 text-[10px] font-medium mt-0.5 m-0 truncate group-hover:text-slate-400">Servicio de Orientación y Guías del MTPE</p>
            </div>
        </a>
    </div>

    {{-- SECCIÓN PORTALES DE EMPLEO --}}
    <p class="text-[11px] font-black text-slate-400 uppercase tracking-wider mt-6 mb-2 ml-5 flex items-center gap-1.5">
        <i class="fa-solid fa-briefcase text-amber-400"></i> Oportunidades Laborales
    </p>
    <div class="h-px bg-gradient-to-r from-transparent via-slate-700 to-transparent mx-4 mb-3 opacity-70"></div>

    <div class="px-3 space-y-1.5">
        {{-- Enlace 1: Portal Empleos Perú --}}
        <a href="https://www.empleosperu.gob.pe" target="_blank"
           class="flex items-center gap-3 p-2.5 hover:bg-slate-800/60 rounded-xl border border-transparent hover:border-slate-700/60 transition-all duration-200 decoration-none group">
            <div class="w-8 h-8 bg-gradient-to-br from-emerald-600 to-teal-600 flex items-center justify-center rounded-lg shadow-sm group-hover:scale-105 transition-transform shrink-0">
                <i class="fa-solid fa-magnifying-glass-chart text-white text-xs"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-slate-200 text-xs font-black truncate m-0 group-hover:text-emerald-400 transition-colors">Portal Empleos Perú</p>
                <p class="text-slate-500 text-[10px] font-medium mt-0.5 m-0 truncate group-hover:text-slate-400">Bolsa nacional oficial de ofertas laborales</p>
            </div>
        </a>

        {{-- Enlace 2: Certificado Único Laboral --}}
        <a href="https://www.gob.pe/certificado-unico-laboral" target="_blank"
           class="flex items-center gap-3 p-2.5 hover:bg-slate-800/60 rounded-xl border border-transparent hover:border-slate-700/60 transition-all duration-200 decoration-none group">
            <div class="w-8 h-8 bg-gradient-to-br from-cyan-600 to-blue-600 flex items-center justify-center rounded-lg shadow-sm group-hover:scale-105 transition-transform shrink-0">
                <i class="fa-solid fa-id-card text-white text-xs"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-slate-200 text-xs font-black truncate m-0 group-hover:text-cyan-400 transition-colors">Certificado Único Laboral</p>
                <p class="text-slate-500 text-[10px] font-medium mt-0.5 m-0 truncate group-hover:text-slate-400">Emisión gratuita de antecedentes del MTPE</p>
            </div>
        </a>

        {{-- Enlace 3: Convocatorias CAS Estado --}}
        <a href="https://www.gob.pe/servir" target="_blank"
           class="flex items-center gap-3 p-2.5 hover:bg-slate-800/60 rounded-xl border border-transparent hover:border-slate-700/60 transition-all duration-200 decoration-none group">
            <div class="w-8 h-8 bg-gradient-to-br from-amber-600 to-orange-600 flex items-center justify-center rounded-lg shadow-sm group-hover:scale-105 transition-transform shrink-0">
                <i class="fa-solid fa-user-tie text-white text-xs"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-slate-200 text-xs font-black truncate m-0 group-hover:text-amber-400 transition-colors">Convocatorias CAS</p>
                <p class="text-slate-500 text-[10px] font-medium mt-0.5 m-0 truncate group-hover:text-slate-400">Buscador de plazas del sector público nacional</p>
            </div>
        </a>
    </div>

    <div class="h-8"></div>
</aside>