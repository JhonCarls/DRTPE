{{-- ════════════════════════════════════════════════════════════ --}}
{{-- CAPA DE SUPERPOSICIÓN Y BARRA LATERAL (SIDEBAR)              --}}
{{-- ════════════════════════════════════════════════════════════ --}}
<div id="sidebar-overlay" onclick="closeSidebar()"></div>

<aside id="sidebar">
    
    {{-- MENÚ EXCLUSIVO MÓVIL (Visible solo en pantallas menores a lg) --}}
    <div class="lg:hidden px-4 py-2 border-b border-white/5 space-y-1" x-data="{ openMobileSec: null }">
        <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest px-2 mb-2">Navegación del Portal</p>

        {{-- Sección Móvil: Institucional --}}
        <div class="bg-white/5 rounded-xl overflow-hidden">
            <button @click="openMobileSec = openMobileSec === 'inst' ? null : 'inst'" class="w-full px-4 py-3 flex items-center justify-between font-bold text-xs text-slate-200 hover:text-white bg-transparent border-none cursor-pointer">
                <span class="flex items-center gap-2.5"><i class="fa-solid fa-building text-red-500"></i> Institucional</span>
                <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="openMobileSec === 'inst' ? 'rotate-180' : ''"></i>
            </button>
            <div class="bg-black/40 px-4 py-2 space-y-2 text-[11px] font-medium text-slate-400 border-t border-white/5 flex flex-col" x-show="openMobileSec === 'inst'" x-cloak>
                <a href="#" class="py-1.5 hover:text-white flex items-center gap-2 decoration-none"><i class="fa-solid fa-circle-info text-[9px] text-red-500"></i> Sobre Nosotros</a>
                <a href="#" class="py-1.5 hover:text-white flex items-center gap-2 decoration-none"><i class="fa-solid fa-sitemap text-[9px] text-red-500"></i> Organigrama</a>
                <a href="#" class="py-1.5 hover:text-white flex items-center gap-2 decoration-none"><i class="fa-solid fa-address-book text-[9px] text-red-500"></i> Directorio</a>
                <a href="#" class="py-1.5 hover:text-white flex items-center gap-2 decoration-none"><i class="fa-solid fa-scale-balanced text-[9px] text-red-500"></i> Marco Legal</a>
            </div>
        </div>

        {{-- Sección Móvil: Estructura Orgánica --}}
        <div class="bg-white/5 rounded-xl overflow-hidden">
            <button @click="openMobileSec = openMobileSec === 'org' ? null : 'org'" class="w-full px-4 py-3 flex items-center justify-between font-bold text-xs text-slate-200 hover:text-white bg-transparent border-none cursor-pointer">
                <span class="flex items-center gap-2.5"><i class="fa-solid fa-sitemap text-red-500"></i> Estructura Orgánica</span>
                <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="openMobileSec === 'org' ? 'rotate-180' : ''"></i>
            </button>
            <div class="bg-black/40 px-4 py-2 space-y-2 text-[11px] font-medium text-slate-400 border-t border-white/5 flex flex-col" x-show="openMobileSec === 'org'" x-cloak>
                <a href="#" class="py-1.5 hover:text-white flex items-center gap-2 decoration-none"><i class="fa-solid fa-user-tie text-[9px] text-red-500"></i> Gerencia Regional</a>
                <p class="font-black text-[9px] text-slate-500 uppercase tracking-wider pt-1 border-t border-white/5 m-0">Áreas Internas</p>
                <a href="#" class="py-1 hover:text-white pl-2 decoration-none">&bull; Administración</a>
                <a href="#" class="py-1 hover:text-white pl-2 decoration-none">&bull; Dirección del Empleo</a>
            </div>
        </div>

        {{-- Sección Móvil: Servicios --}}
        <div class="bg-white/5 rounded-xl overflow-hidden">
            <button @click="openMobileSec = openMobileSec === 'serv' ? null : 'serv'" class="w-full px-4 py-3 flex items-center justify-between font-bold text-xs text-slate-200 hover:text-white bg-transparent border-none cursor-pointer">
                <span class="flex items-center gap-2.5"><i class="fa-solid fa-briefcase text-red-500"></i> Servicios</span>
                <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="openMobileSec === 'serv' ? 'rotate-180' : ''"></i>
            </button>
            <div class="bg-black/40 px-4 py-2 space-y-2 text-[11px] font-medium text-slate-400 border-t border-white/5 flex flex-col" x-show="openMobileSec === 'serv'" x-cloak>
                <a href="#" class="py-1.5 hover:text-white decoration-none">&bull; Centro de Empleo Puno</a>
                <a href="#" class="py-1.5 hover:text-white decoration-none">&bull; Fraccionamiento de Multas</a>
                <a href="#" class="py-1.5 hover:text-white decoration-none">&bull; Capacitaciones Externas</a>
            </div>
        </div>

        {{-- Sección Móvil: Talleres --}}
        <div class="bg-white/5 rounded-xl overflow-hidden mb-4">
            <button @click="openMobileSec = openMobileSec === 'tal' ? null : 'tal'" class="w-full px-4 py-3 flex items-center justify-between font-bold text-xs text-slate-200 hover:text-white bg-transparent border-none cursor-pointer">
                <span class="flex items-center gap-2.5"><i class="fa-solid fa-user-graduate text-red-500"></i> Talleres</span>
                <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="openMobileSec === 'tal' ? 'rotate-180' : ''"></i>
            </button>
            <div class="bg-black/40 px-2 py-2 text-[11px] font-bold border-t border-white/5 flex flex-col" x-show="openMobileSec === 'tal'" x-cloak>
                <button onclick="scrollToSection('seccion-por-hacer'); closeSidebar()" class="w-full text-left py-2 px-2 hover:bg-white/5 text-slate-300 rounded flex justify-between items-center bg-transparent border-none cursor-pointer">
                    <span>Capacitaciones por Hacer</span>
                    <span class="text-[9px] font-mono font-black px-1.5 py-0.5 rounded bg-red-600 text-white">{{ isset($capacitacionesPorHacer) ? $capacitacionesPorHacer->count() : 0 }}</span>
                </button>
                <button onclick="scrollToSection('seccion-hechas'); closeSidebar()" class="w-full text-left py-2 px-2 hover:bg-white/5 text-slate-300 rounded flex justify-between items-center bg-transparent border-none cursor-pointer">
                    <span>Capacitaciones Hechas</span>
                    <span class="text-[9px] font-mono font-black px-1.5 py-0.5 rounded bg-white/10 text-slate-400">{{ isset($capacitacionesHechas) ? $capacitacionesHechas->count() : 0 }}</span>
                </button>
                <button onclick="scrollToSection('seccion-coordinaciones'); closeSidebar()" class="w-full text-left py-2 px-2 hover:bg-white/5 text-slate-300 rounded flex justify-between items-center bg-transparent border-none cursor-pointer">
                    <span>Coordinaciones Hechas</span>
                    <span class="text-[9px] font-mono font-black px-1.5 py-0.5 rounded bg-white/10 text-slate-400">{{ isset($coordinacionesHechas) ? $coordinacionesHechas->count() : 0 }}</span>
                </button>
            </div>
        </div>
    </div>

    {{-- LOGO DE LA DIRECCIÓN Y DATOS DE CONTACTO GENERALES --}}
    <div class="p-5 pb-4">
        <div class="flex items-center gap-3 mb-5 pt-1">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 h-12 object-contain rounded-xl bg-white/10 p-1.5 border border-white/10">
            <div>
                <p class="text-white font-black text-sm leading-tight m-0" style="font-family: 'Sora', sans-serif;">DRTPE Puno</p>
                <p class="text-slate-500 text-[10px] uppercase tracking-wider m-0">Dirección Regional</p>
            </div>
        </div>
        <div class="space-y-3 mb-4">
            <div class="flex items-start gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-red-600/20 border border-red-500/25 flex items-center justify-center flex-shrink-0 mt-0.5"><i class="fa-solid fa-location-dot text-red-400 text-[11px]"></i></div>
                <div><p class="text-slate-200 text-xs font-bold m-0">Sede Puno</p><p class="text-slate-500 text-[11px] leading-snug m-0">Jr. Ayacucho N° 658, Puno</p></div>
            </div>
            <div class="flex items-start gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-blue-600/20 border border-blue-500/25 flex items-center justify-center flex-shrink-0 mt-0.5"><i class="fa-solid fa-location-dot text-blue-400 text-[11px]"></i></div>
                <div><p class="text-slate-200 text-xs font-bold m-0">Sede Juliaca</p><p class="text-slate-500 text-[11px] leading-snug m-0">Jr. Santiago Mamani N° 200, Juliaca</p></div>
            </div>
        </div>
        <div class="flex gap-2 flex-wrap">
            <a href="https://www.facebook.com/DRTPEPunoOFICIAL/?locale=es_LA" target="_blank" class="social-badge badge-fb"><i class="fa-brands fa-facebook"></i> Facebook</a>
            <a href="#" target="_blank" class="social-badge badge-tt"><i class="fa-brands fa-tiktok"></i> TikTok</a>
        </div>
    </div>

    {{-- 🎯 MODIFICADO: SECCIÓN TRÁMITES Y TRABAJO AUTÓNOMO (Links de Formaliza) --}}
    <p class="sb-label"><i class="fa-solid fa-gavel mr-1.5 text-blue-400"></i>Tramitación y Formaliza</p>
    <div class="sb-sep"><span class="text-blue-400">Trámites y Registros</span></div>
    
    {{-- Enlace 1: Registro REMYPE --}}
    <a href="https://www.gob.pe/remype" target="_blank" class="sb-item group block decoration-none">
        <div class="sb-thumb bg-gradient-to-br from-blue-600 to-indigo-700 flex items-center justify-center rounded-xl border border-blue-500/20 shadow-inner group-hover:scale-105 transition-transform duration-200">
            <i class="fa-solid fa-building-shield text-white text-xs"></i>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-slate-200 text-xs font-semibold leading-snug truncate m-0 group-hover:text-blue-400 transition-colors">Registro REMYPE</p>
            <p class="text-slate-500 text-[9px] mt-0.5 font-medium m-0">Acreditación de Micro y Pequeña Empresa</p>
        </div>
    </a>

    {{-- Enlace 2: SUNAFIL Denuncias --}}
    <a href="https://www.gob.pe/sunafil" target="_blank" class="sb-item group block decoration-none">
        <div class="sb-thumb bg-gradient-to-br from-rose-600 to-red-700 flex items-center justify-center rounded-xl border border-red-500/20 shadow-inner group-hover:scale-105 transition-transform duration-200">
            <i class="fa-solid fa-scale-balanced text-white text-xs"></i>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-slate-200 text-xs font-semibold leading-snug truncate m-0 group-hover:text-blue-400 transition-colors">Denuncias Virtuales</p>
            <p class="text-slate-500 text-[9px] mt-0.5 font-medium m-0">Módulo de Inspección del Trabajo - SUNAFIL</p>
        </div>
    </a>

    {{-- Enlace 3: Formalízate Perú --}}
    <a href="https://www.gob.pe/mtpe" target="_blank" class="sb-item group block decoration-none">
        <div class="sb-thumb bg-gradient-to-br from-slate-700 to-slate-900 flex items-center justify-center rounded-xl border border-slate-600/30 shadow-inner group-hover:scale-105 transition-transform duration-200">
            <i class="fa-solid fa-passport text-white text-xs"></i>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-slate-200 text-xs font-semibold leading-snug truncate m-0 group-hover:text-blue-400 transition-colors">Asesoría de Formalización</p>
            <p class="text-slate-500 text-[9px] mt-0.5 font-medium m-0">Servicio de Orientación y Guías del MTPE</p>
        </div>
    </a>

    {{-- 🎯 MODIFICADO: SECCIÓN PORTALES DE EMPLEO (Bolsa de Trabajo del Perú) --}}
    <p class="sb-label"><i class="fa-solid fa-briefcase mr-1.5 text-amber-400"></i>Oportunidades Laborales</p>
    <div class="sb-sep mt-1"><span class="text-amber-400">Bolsa de Trabajo</span></div>

    {{-- Enlace 1: Portal Empleos Perú --}}
    <a href="https://www.empleosperu.gob.pe" target="_blank" class="sb-item group block decoration-none">
        <div class="sb-thumb bg-gradient-to-br from-emerald-600 to-teal-700 flex items-center justify-center rounded-xl border border-emerald-500/20 shadow-inner group-hover:scale-105 transition-transform duration-200">
            <i class="fa-solid fa-magnifying-glass-chart text-white text-xs"></i>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-slate-200 text-xs font-semibold leading-snug truncate m-0 group-hover:text-amber-400 transition-colors">Portal Empleos Perú</p>
            <p class="text-slate-500 text-[9px] mt-0.5 font-medium m-0">Bolsa nacional oficial de ofertas laborales</p>
        </div>
    </a>

    {{-- Enlace 2: Certificado Único Laboral --}}
    <a href="https://www.gob.pe/certificado-unico-laboral" target="_blank" class="sb-item group block decoration-none">
        <div class="sb-thumb bg-gradient-to-br from-cyan-600 to-blue-700 flex items-center justify-center rounded-xl border border-cyan-500/20 shadow-inner group-hover:scale-105 transition-transform duration-200">
            <i class="fa-solid fa-id-card text-white text-xs"></i>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-slate-200 text-xs font-semibold leading-snug truncate m-0 group-hover:text-amber-400 transition-colors">Certificado Único Laboral</p>
            <p class="text-slate-500 text-[9px] mt-0.5 font-medium m-0">Emisión gratuita de antecedentes del MTPE</p>
        </div>
    </a>

    {{-- Enlace 3: Convocatorias CAS Estado --}}
    <a href="https://www.gob.pe/servir" target="_blank" class="sb-item group block decoration-none">
        <div class="sb-thumb bg-gradient-to-br from-amber-600 to-orange-700 flex items-center justify-center rounded-xl border border-amber-500/20 shadow-inner group-hover:scale-105 transition-transform duration-200">
            <i class="fa-solid fa-user-tie text-white text-xs"></i>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-slate-200 text-xs font-semibold leading-snug truncate m-0 group-hover:text-amber-400 transition-colors">Convocatorias CAS</p>
            <p class="text-slate-500 text-[9px] mt-0.5 font-medium m-0">Buscador de plazas del sector público nacional</p>
        </div>
    </a>
    
    <div class="h-8"></div>
</aside>