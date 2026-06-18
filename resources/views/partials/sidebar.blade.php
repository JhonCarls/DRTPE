{{-- ════════════════════════════════════════════════════════════ --}}
{{-- CAPA DE SUPERPOSICIÓN Y BARRA LATERAL (TEMA OSCURO PREMIUM REGIONAL) --}}
{{-- ════════════════════════════════════════════════════════════ --}}
<div id="sidebar-overlay" onclick="closeSidebar()"></div>

<aside id="sidebar" 
       class="bg-slate-950/95 backdrop-blur-md border-r border-slate-800/80 shadow-2xl flex flex-col h-screen overflow-y-auto custom-scrollbar select-none text-slate-300 transition-all duration-300">
    
    {{-- 1. LOGO DE LA DIRECCIÓN REGIONAL --}}
    <div class="p-5 pb-4 border-b border-slate-800/60 bg-slate-950/40">
        <div class="flex items-center gap-3 pt-1">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-11 h-11 object-contain rounded-xl bg-slate-900 p-1.5 border border-slate-800 shadow-inner">
            <div>
                <p class="text-white font-black text-sm leading-tight m-0" style="font-family: 'Sora', sans-serif;">DRTPE Puno</p>
                <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest m-0 mt-0.5">Dirección Regional</p>
            </div>
        </div>
    </div>

    {{-- 2. SECCIÓN DESTACADA: SEDES DESCONCENTRADAS (CON DEGRADADO GUINDA INTEGRADO) --}}
    <div class="mx-4 my-4 p-3.5 bg-gradient-to-br from-red-950/40 to-slate-900/40 border border-red-900/40 rounded-2xl shadow-lg">
        <p class="text-red-400 text-[10px] font-black uppercase tracking-widest flex items-center gap-1.5 mb-2.5 px-1">
            <i class="fa-solid fa-map-location-dot animate-pulse text-red-500"></i> Sedes Desconcentradas
        </p>
        
        <div class="space-y-2">
            {{-- Enlace Sede Juliaca --}}
            <a href="#" onclick="scrollToSection('seccion-juliaca')" class="flex items-center gap-3 p-2 bg-slate-950/50 hover:bg-red-950/40 rounded-xl border border-slate-800/60 hover:border-red-500/30 transition-all duration-200 decoration-none group shadow-inner">
                <div class="w-8 h-8 bg-gradient-to-br from-red-600 to-red-700 flex items-center justify-center rounded-lg shadow-md group-hover:scale-105 transition-transform shrink-0">
                    <i class="fa-solid fa-city text-white text-xs"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-slate-200 text-xs font-black truncate m-0 group-hover:text-red-400 transition-colors">Sede Juliaca</p>
                    <p class="text-slate-500 text-[9px] font-bold m-0 truncate">Actividades Operativas Norte</p>
                </div>
            </a>

            {{-- Enlace Sede Taraco --}}
            <a href="#" onclick="scrollToSection('seccion-taraco')" class="flex items-center gap-3 p-2 bg-slate-950/50 hover:bg-red-950/40 rounded-xl border border-slate-800/60 hover:border-red-500/30 transition-all duration-200 decoration-none group shadow-inner">
                <div class="w-8 h-8 bg-gradient-to-br from-red-600 to-red-700 flex items-center justify-center rounded-lg shadow-md group-hover:scale-105 transition-transform shrink-0">
                    <i class="fa-solid fa-building-flag text-white text-xs"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-slate-200 text-xs font-black truncate m-0 group-hover:text-red-400 transition-colors">Sede Taraco</p>
                    <p class="text-slate-500 text-[9px] font-bold m-0 truncate">Intervenciones Itinerantes</p>
                </div>
            </a>
        </div>
    </div>

    {{-- 3. DIRECCIONES TEXTUALES DE CONTACTO GENERAL --}}
    <div class="px-4 pb-4 border-b border-slate-800/60 space-y-3">
        <div class="space-y-2.5">
            <div class="flex items-start gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center flex-shrink-0 mt-0.5"><i class="fa-solid fa-location-dot text-red-500/90 text-xs"></i></div>
                <div><p class="text-slate-200 text-xs font-black m-0">Sede Puno</p><p class="text-slate-500 text-[11px] font-bold leading-tight mt-0.5 m-0">Jr. Ayacucho N° 658, Puno</p></div>
            </div>
            <div class="flex items-start gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center flex-shrink-0 mt-0.5"><i class="fa-solid fa-location-dot text-blue-500/90 text-xs"></i></div>
                <div><p class="text-slate-200 text-xs font-black m-0">Sede Juliaca</p><p class="text-slate-500 text-[11px] font-bold leading-tight mt-0.5 m-0">Jr. Santiago Mamani N° 200, Juliaca</p></div>
            </div>
            <div class="flex items-start gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center flex-shrink-0 mt-0.5"><i class="fa-solid fa-location-dot text-emerald-500/90 text-xs"></i></div>
                <div><p class="text-slate-200 text-xs font-black m-0">Sede Taraco</p><p class="text-slate-500 text-[11px] font-bold leading-tight mt-0.5 m-0">Plaza de Armas N° 105, Taraco</p></div>
            </div>
        </div>
        
        {{-- Botones de Redes Sociales Integrados con el Fondo Oscuro --}}
        <div class="flex gap-2 flex-wrap pt-1">
            <a href="https://www.facebook.com/DRTPEPunoOFICIAL/?locale=es_LA" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-[10px] font-black uppercase tracking-wider shadow-md decoration-none transition-colors"><i class="fa-brands fa-facebook"></i> Facebook</a>
            <a href="#" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-800 hover:bg-slate-700 text-white rounded-lg text-[10px] font-black uppercase tracking-wider shadow-md decoration-none transition-colors"><i class="fa-brands fa-tiktok"></i> TikTok</a>
        </div>
    </div>

    {{-- MENÚ EXCLUSIVO MÓVIL (Oculto en Escritorio - Mimetizado con el fondo) --}}
    <div class="lg:hidden px-4 py-4 border-b border-slate-800/60 space-y-1.5 bg-slate-950/40" x-data="{ openMobileSec: null }">
        <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest px-2 mb-2">Navegación del Portal</p>

        <div class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden shadow-sm">
            <button @click="openMobileSec = openMobileSec === 'inst' ? null : 'inst'" class="w-full px-4 py-3 flex items-center justify-between font-bold text-xs text-slate-300 hover:text-white bg-transparent border-none cursor-pointer">
                <span class="flex items-center gap-2.5"><i class="fa-solid fa-building text-red-500"></i> Institucional</span>
                <i class="fa-solid fa-chevron-down text-[10px] text-slate-500 transition-transform duration-200" :class="openMobileSec === 'inst' ? 'rotate-180 text-white' : ''"></i>
            </button>
            <div class="bg-slate-950/50 px-4 py-2 space-y-2 text-[11px] font-bold text-slate-400 border-t border-slate-800/80 flex flex-col" x-show="openMobileSec === 'inst'" x-cloak>
                <a href="#" class="py-1 hover:text-white flex items-center gap-2 decoration-none transition-colors"><i class="fa-solid fa-circle-info text-[9px] text-red-500/70"></i> Sobre Nosotros</a>
                <a href="#" class="py-1 hover:text-white flex items-center gap-2 decoration-none transition-colors"><i class="fa-solid fa-sitemap text-[9px] text-red-500/70"></i> Organigrama</a>
                <a href="#" class="py-1 hover:text-white flex items-center gap-2 decoration-none transition-colors"><i class="fa-solid fa-address-book text-[9px] text-red-500/70"></i> Directorio</a>
                <a href="#" class="py-1 hover:text-white flex items-center gap-2 decoration-none transition-colors"><i class="fa-solid fa-scale-balanced text-[9px] text-red-500/70"></i> Marco Legal</a>
            </div>
        </div>

        <div class="bg-white/5 border border-slate-800 rounded-xl overflow-hidden shadow-sm">
            <button @click="openMobileSec = openMobileSec === 'org' ? null : 'org'" class="w-full px-4 py-3 flex items-center justify-between font-bold text-xs text-slate-300 hover:text-white bg-transparent border-none cursor-pointer">
                <span class="flex items-center gap-2.5"><i class="fa-solid fa-sitemap text-red-500"></i> Estructura Orgánica</span>
                <i class="fa-solid fa-chevron-down text-[10px] text-slate-500 transition-transform duration-200" :class="openMobileSec === 'org' ? 'rotate-180 text-white' : ''"></i>
            </button>
            <div class="bg-slate-950/50 px-4 py-2 space-y-2 text-[11px] font-bold text-slate-400 border-t border-slate-800/80 flex flex-col" x-show="openMobileSec === 'org'" x-cloak>
                <a href="#" class="py-1 hover:text-white flex items-center gap-2 decoration-none transition-colors"><i class="fa-solid fa-user-tie text-[9px] text-red-500/70"></i> Gerencia Regional</a>
                <p class="font-black text-[9px] text-slate-500 uppercase tracking-wider pt-1.5 border-t border-slate-800 m-0">Áreas Internas</p>
                <a href="#" class="py-0.5 hover:text-white pl-2 decoration-none transition-colors">&bull; Administración</a>
                <a href="#" class="py-0.5 hover:text-white pl-2 decoration-none transition-colors">&bull; Dirección del Empleo</a>
            </div>
        </div>
    </div>

    {{-- SECCIÓN TRÁMITES Y TRABAJO AUTÓNOMO (Links de Formaliza) --}}
    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-6 mb-1 ml-4 flex items-center gap-1.5"><i class="fa-solid fa-gavel text-blue-400"></i> Tramitación y Formaliza</p>
    <div class="h-px bg-slate-800 mx-4 mb-2"></div>
    
    <div class="px-3 space-y-1">
        {{-- Enlace 1: Registro REMYPE --}}
        <a href="https://www.gob.pe/remype" target="_blank" class="flex items-center gap-3 p-2 hover:bg-white/5 rounded-xl border border-transparent hover:border-slate-800 transition-all decoration-none group">
            <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center rounded-lg shadow-sm group-hover:scale-105 transition-transform shrink-0">
                <i class="fa-solid fa-building-shield text-white text-xs"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-slate-200 text-xs font-black truncate m-0 group-hover:text-blue-400 transition-colors">Registro REMYPE</p>
                <p class="text-slate-500 text-[9px] font-medium mt-0.5 m-0 truncate">Acreditación de Micro y Pequeña Empresa</p>
            </div>
        </a>

        {{-- Enlace 2: SUNAFIL Denuncias --}}
        <a href="https://www.gob.pe/sunafil" target="_blank" class="flex items-center gap-3 p-2 hover:bg-white/5 rounded-xl border border-transparent hover:border-slate-800 transition-all decoration-none group">
            <div class="w-8 h-8 bg-gradient-to-br from-rose-600 to-red-600 flex items-center justify-center rounded-lg shadow-sm group-hover:scale-105 transition-transform shrink-0">
                <i class="fa-solid fa-scale-balanced text-white text-xs"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-slate-200 text-xs font-black truncate m-0 group-hover:text-red-400 transition-colors">Denuncias Virtuales</p>
                <p class="text-slate-500 text-[9px] font-medium mt-0.5 m-0 truncate">Módulo de Inspección del Trabajo - SUNAFIL</p>
            </div>
        </a>

        {{-- Enlace 3: Formalízate Perú --}}
        <a href="https://www.gob.pe/mtpe" target="_blank" class="flex items-center gap-3 p-2 hover:bg-white/5 rounded-xl border border-transparent hover:border-slate-800 transition-all decoration-none group">
            <div class="w-8 h-8 bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center rounded-lg shadow-sm group-hover:scale-105 transition-transform shrink-0">
                <i class="fa-solid fa-passport text-white text-xs"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-slate-200 text-xs font-black truncate m-0 group-hover:text-slate-100 transition-colors">Asesoría de Formalización</p>
                <p class="text-slate-500 text-[9px] font-medium mt-0.5 m-0 truncate">Servicio de Orientación y Guías del MTPE</p>
            </div>
        </a>
    </div>

    {{-- SECCIÓN PORTALES DE EMPLEO (Bolsa de Trabajo del Perú) --}}
    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-6 mb-1 ml-4 flex items-center gap-1.5"><i class="fa-solid fa-briefcase text-amber-400"></i> Oportunidades Laborales</p>
    <div class="h-px bg-slate-800 mx-4 mb-2"></div>

    <div class="px-3 space-y-1">
        {{-- Enlace 1: Portal Empleos Perú --}}
        <a href="https://www.empleosperu.gob.pe" target="_blank" class="flex items-center gap-3 p-2 hover:bg-white/5 rounded-xl border border-transparent hover:border-slate-800 transition-all decoration-none group">
            <div class="w-8 h-8 bg-gradient-to-br from-emerald-600 to-teal-600 flex items-center justify-center rounded-lg shadow-sm group-hover:scale-105 transition-transform shrink-0">
                <i class="fa-solid fa-magnifying-glass-chart text-white text-xs"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-slate-200 text-xs font-black truncate m-0 group-hover:text-emerald-400 transition-colors">Portal Empleos Perú</p>
                <p class="text-slate-500 text-[9px] font-medium mt-0.5 m-0 truncate">Bolsa nacional oficial de ofertas laborales</p>
            </div>
        </a>

        {{-- Enlace 2: Certificado Único Laboral --}}
        <a href="https://www.gob.pe/certificado-unico-laboral" target="_blank" class="flex items-center gap-3 p-2 hover:bg-white/5 rounded-xl border border-transparent hover:border-slate-800 transition-all decoration-none group">
            <div class="w-8 h-8 bg-gradient-to-br from-cyan-600 to-blue-600 flex items-center justify-center rounded-lg shadow-sm group-hover:scale-105 transition-transform shrink-0">
                <i class="fa-solid fa-id-card text-white text-xs"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-slate-200 text-xs font-black truncate m-0 group-hover:text-cyan-400 transition-colors">Certificado Único Laboral</p>
                <p class="text-slate-500 text-[9px] font-medium mt-0.5 m-0 truncate">Emisión gratuita de antecedentes del MTPE</p>
            </div>
        </a>

        {{-- Enlace 3: Convocatorias CAS Estado --}}
        <a href="https://www.gob.pe/servir" target="_blank" class="flex items-center gap-3 p-2 hover:bg-white/5 rounded-xl border border-transparent hover:border-slate-800 transition-all decoration-none group">
            <div class="w-8 h-8 bg-gradient-to-br from-amber-600 to-orange-600 flex items-center justify-center rounded-lg shadow-sm group-hover:scale-105 transition-transform shrink-0">
                <i class="fa-solid fa-user-tie text-white text-xs"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-slate-200 text-xs font-black truncate m-0 group-hover:text-amber-400 transition-colors">Convocatorias CAS</p>
                <p class="text-slate-500 text-[9px] font-medium mt-0.5 m-0 truncate">Buscador de plazas del sector público nacional</p>
            </div>
        </a>
    </div>
    
    <div class="h-8"></div>
</aside>