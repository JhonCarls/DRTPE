@extends('layouts.portal')

@section('content')
{{-- Mapeo seguro y optimización de las colecciones de datos enviadas por el Controlador --}}
@php
    $mappedActivities = $activities->map(function($a) {
        return [
            'id' => $a->id,
            'title' => addslashes($a->title),
            'description' => addslashes(preg_replace('/\s+/', ' ', $a->description)),
            'created_at' => $a->created_at->toIso8601String(),
            'date_string' => $a->created_at->format('d/m/Y h:i A'),
            'attendees_count' => (int)($a->attendees_count ?? 0),
            'photos' => $a->photos ?? []
        ];
    })->values();

    // ── 🎯 SOLUCIÓN AL ERROR: FALLBACK AUTOMÁTICO DE COMUNICADOS ──────────
    // Si el controlador no inyecta la variable, la resolvemos defensivamente aquí
    if (!isset($announcements)) {
        // Evaluamos dinámicamente si la tabla tiene 'user_id', 'sede' o si usamos el slug de la URL
        $hasUserId = \Illuminate\Support\Facades\Schema::hasColumn('announcements', 'user_id');
        $hasSede = \Illuminate\Support\Facades\Schema::hasColumn('announcements', 'sede');
        
        $annQuery = \App\Models\Announcement::query();
        
        if ($hasUserId) {
            $annQuery->whereHas('user', function($q) use ($slug) {
                $q->where('sede', $slug);
            });
        } elseif ($hasSede) {
            $annQuery->where('sede', $slug);
        } else {
            // Fallback por texto si tu tabla usa una columna category tipo 'Sede Juliaca'
            $annQuery->where('category', 'like', '%' . $slug . '%');
        }
        
        $announcementsCollection = $annQuery->latest()->limit(5)->get();
    } else {
        $announcementsCollection = $announcements;
    }

    // Mapeo seguro para inyectar al estado virtual de Alpine.js
    $mappedAnnouncements = $announcementsCollection->map(function($an) {
        return [
            'id' => $an->id,
            'title' => addslashes($an->title),
            'content' => addslashes(preg_replace('/\s+/', ' ', $an->content ?? $an->description ?? '')),
            'date' => $an->created_at->format('d/m/Y'),
            'fecha_publicacion' => $an->published_at ? \Carbon\Carbon::parse($an->published_at)->format('d/m/Y') : $an->created_at->format('d/m/Y'),
            'fecha_vencimiento' => $an->expired_at ? \Carbon\Carbon::parse($an->expired_at)->format('d/m/Y') : 'Sin Límite',
            'is_urgent' => (bool)($an->is_urgent ?? false)
        ];
    })->values();
@endphp

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,400&family=Sora:wght@400;700;800&display=swap');

    .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .focus-ring:focus-visible { outline: 3px solid #4f46e5; outline-offset: 2px; }
</style>

<div class="bg-[#f8fafc] min-h-screen pb-24 text-slate-800 antialiased relative"
     x-data="activitiesPortalComponent({{ json_encode($mappedActivities) }}, {{ json_encode($mappedAnnouncements) }})">

    {{-- Barra de Progreso Superior --}}
    <div class="fixed top-0 left-0 h-1.5 bg-gradient-to-r from-red-600 via-indigo-600 to-emerald-500 z-50 transition-all duration-100"
         :style="'width: ' + scrollPercent + '%'"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 pt-10">

        {{-- CABECERA INSTITUCIONAL ESTILO DASHBOARD --}}
        <header class="bg-white rounded-3xl p-6 sm:p-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border border-slate-200 shadow-[0_2px_12px_rgba(0,0,0,0.01)] relative overflow-hidden">
            <div class="flex items-center gap-4 relative z-10">
                <div class="w-14 h-14 bg-gradient-to-br from-red-600 to-red-700 rounded-2xl flex items-center justify-center text-white shadow-sm">
                    <i class="fa-solid fa-map-location-dot text-xl"></i>
                </div>
                <div>
                    <span class="text-red-600 font-black text-[10px] uppercase tracking-widest block leading-none">Gaceta Oficial de Transparencia</span>
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 uppercase tracking-tight mt-1.5" style="font-family: 'Sora', sans-serif;">{{ $sedeName }}</h1>
                </div>
            </div>
            <div class="text-[10px] font-mono font-black bg-slate-900 border border-slate-950 px-4 py-2.5 rounded-xl text-white shadow-xs tracking-wider uppercase z-10">
                <i class="fa-solid fa-feather-pointed text-red-500 mr-1.5"></i> Desconcentrado POI
            </div>
        </header>

        {{-- 📢 SECCIÓN DE ANUNCIOS EXCLUSIVOS EN FORMATO CARRUSEL AUTOMÁTICO (5S) --}}
        <div class="bg-gradient-to-r from-slate-900 to-slate-950 text-white rounded-2xl p-6 shadow-md border border-slate-800 relative overflow-hidden min-h-[120px] flex flex-col justify-center"
             x-show="announcements.length > 0" x-cloak>
            
            <div class="absolute right-6 top-6 z-20 flex items-center gap-2">
                <span class="text-[9px] font-mono font-black bg-red-600 text-white px-2 py-0.5 rounded uppercase tracking-wider animate-pulse">Avisos Vigentes</span>
                <div class="flex gap-1" x-show="announcements.length > 1">
                    <button @click="activeAnnIdx = (activeAnnIdx - 1 + announcements.length) % announcements.length" class="w-6 h-6 bg-white/10 hover:bg-white/20 text-white border-none rounded-lg cursor-pointer flex items-center justify-center"><i class="fa-solid fa-chevron-left text-[10px]"></i></button>
                    <button @click="activeAnnIdx = (activeAnnIdx + 1) % announcements.length" class="w-6 h-6 bg-white/10 hover:bg-white/20 text-white border-none rounded-lg cursor-pointer flex items-center justify-center"><i class="fa-solid fa-chevron-right text-[10px]"></i></button>
                </div>
            </div>

            <template x-for="(ann, idx) in announcements" :key="ann.id">
                <div class="space-y-2 pr-24" x-show="activeAnnIdx === idx" x-transition.opacity>
                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-[11px] font-mono font-bold">
                        <span class="text-[9px] font-black uppercase tracking-widest px-2 py-0.5 rounded" :class="ann.is_urgent ? 'bg-red-600 text-white' : 'bg-indigo-600 text-white'" x-text="ann.is_urgent ? 'Alerta Urgente' : 'Comunicado Sede'"></span>
                        <span class="text-slate-400">Publicación: <span class="text-slate-200" x-text="ann.fecha_publicacion"></span></span>
                        <span class="text-amber-400">Retiro: <span class="text-amber-300" x-text="ann.fecha_vencimiento"></span></span>
                    </div>
                    <h3 class="text-base font-black tracking-tight text-white m-0 uppercase mt-1" x-text="ann.title"></h3>
                    <p class="text-xs sm:text-sm text-slate-300 m-0 line-clamp-2 leading-relaxed text-justify font-medium" x-text="ann.content"></p>
                </div>
            </template>
        </div>

        {{-- CENTRO DE CONTROL: BUSCADOR Y FILTROS ORDENADOS --}}
        <section class="bg-white rounded-2xl p-6 border border-slate-200 shadow-[0_2px_12px_rgba(0,0,0,0.01)] space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                <div class="md:col-span-8 relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400"><i class="fa-solid fa-magnifying-glass text-sm"></i></span>
                    <input type="text" x-model="searchQuery" placeholder="🔍 Escribe lo que buscas (Búsqueda elástica tolerante a errores ortográficos)..."
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 pl-11 text-sm font-semibold text-slate-800 focus:outline-none focus:border-red-500 transition-all shadow-inner focus-ring">
                </div>
                <div class="md:col-span-4">
                    <select x-model="sortBy" class="w-full bg-white border border-slate-200 rounded-xl py-3 px-3 text-sm font-black text-slate-700 focus:outline-none focus:border-red-500 shadow-xs focus-ring cursor-pointer">
                        <option value="recent">▼ Ordenar por: Más recientes</option>
                        <option value="oldest">▲ Ordenar por: Más antiguas</option>
                        <option value="attendees">▼ Ordenar por: Mayor asistencia</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 sm:items-center pt-2">
                <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest w-24 shrink-0"><i class="fa-solid fa-layer-group mr-1"></i> Intervención:</span>
                <div class="flex flex-wrap gap-2">
                    <template x-for="typeOpt in typeFilterOptions" :key="typeOpt.value">
                        <button @click="typeFilter = typeOpt.value; limit = 10"
                                :class="typeFilter === typeOpt.value ? 'bg-slate-900 text-white font-black' : 'bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold border-slate-200/60'"
                                class="px-3.5 py-1.5 rounded-xl text-xs uppercase tracking-wider transition-all border border-transparent shadow-xs cursor-pointer focus-ring shrink-0"
                                x-text="typeOpt.label"></button>
                    </template>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 sm:items-center pt-4 border-t border-slate-100">
                <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest w-24 shrink-0"><i class="fa-regular fa-calendar-days mr-1"></i> Periodo:</span>
                <div class="flex flex-wrap gap-2">
                    <template x-for="filterOpt in timeFilterOptions" :key="filterOpt.value">
                        <button @click="timeFilter = filterOpt.value; limit = 10"
                                :class="timeFilter === filterOpt.value ? 'bg-indigo-600 text-white font-black' : 'bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold border-slate-200/60'"
                                class="px-3.5 py-1.5 rounded-xl text-xs uppercase tracking-wider transition-all border border-transparent shadow-xs cursor-pointer focus-ring shrink-0"
                                x-text="filterOpt.label"></button>
                    </template>
                </div>
            </div>
        </section>

        {{-- HISTORIAL OPERATIVO DE FILTRADO SENEADO --}}
        <section class="relative ml-2 sm:ml-6 space-y-8" x-ref="timelineContainer">
            <div class="absolute left-0 top-3 bottom-3 w-1 bg-slate-200 rounded-full pointer-events-none">
                <div class="w-full bg-indigo-600 rounded-full transition-all duration-500" :style="'height: ' + scrollPercent + '%'"></div>
            </div>

            <template x-for="(act, index) in displayedActivities" :key="act.id">
                <div class="relative pl-6 sm:pl-12">
                    <div class="absolute -left-[6px] top-8 w-4 h-4 rounded-full bg-white border-4 border-indigo-600 shadow-sm z-10"></div>

                    <article class="bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-xs hover:shadow-md transition-all duration-300 cursor-pointer flex flex-col lg:flex-row items-stretch group"
                             @click="viewActivity(act)">
                        
                        <div class="relative w-full lg:w-[420px] h-64 sm:h-80 lg:h-auto min-h-[280px] bg-slate-50 overflow-hidden shrink-0">
                            <img :src="act.photos.length > 0 ? '/storage/' + act.photos[0] : ''" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-102"
                                 x-show="act.photos.length > 0" alt="Evidencia">
                            
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-50 border-r border-slate-100" x-show="act.photos.length === 0">
                                <i class="fa-solid fa-image text-4xl mb-2"></i>
                                <span class="text-xs font-black uppercase tracking-widest">Sin Evidencias Fotográficas</span>
                            </div>

                            <div class="absolute inset-0 bg-slate-950/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <span class="bg-white text-slate-900 text-xs font-black py-2.5 px-4 rounded-xl shadow-md uppercase tracking-wider">
                                    <i class="fa-solid fa-book-open mr-1.5 text-red-600"></i> Desplegar Reporte Completo
                                </span>
                            </div>

                            <div class="absolute top-4 left-4">
                                <span class="bg-slate-900/85 backdrop-blur-md text-white text-[10px] font-mono font-black px-3 py-1.5 rounded-xl uppercase tracking-widest shadow-sm">
                                    <i class="fa-solid fa-camera text-red-500"></i> <span x-text="act.photos.length"></span> Capturas Técnicas
                                </span>
                            </div>
                        </div>

                        <div class="p-6 sm:p-8 lg:p-10 flex flex-col justify-between flex-1 space-y-4">
                            <div class="space-y-3.5">
                                <div class="flex flex-wrap items-center justify-between gap-3">
                                    <span class="text-xs font-black uppercase text-slate-400 font-mono tracking-wider">
                                        <i class="fa-regular fa-clock text-indigo-600 mr-1"></i> <span x-text="act.date_string"></span>
                                    </span>
                                    <span class="text-xs font-black uppercase tracking-wider text-emerald-800 bg-emerald-50 border border-emerald-100 px-3 py-1 rounded-lg">
                                        <i class="fa-solid fa-users mr-1.5"></i> Cobertura Real: <span x-text="act.attendees_count"></span> Personas
                                    </span>
                                </div>
                                <h3 class="text-xl sm:text-2xl font-black text-slate-900 leading-tight m-0 font-editorial-title group-hover:text-red-600 transition-colors" x-text="act.title"></h3>
                                <p class="text-slate-600 text-sm sm:text-base leading-relaxed text-justify m-0 font-medium line-clamp-4" x-text="act.description"></p>
                            </div>

                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-black text-indigo-600 uppercase tracking-widest group-hover:text-red-600 transition-colors">
                                <span>Examinar Transparencia e Imágenes</span>
                                <div class="w-9 h-9 rounded-full bg-slate-100 flex items-center justify-center group-hover:bg-red-600 group-hover:text-white transition-all duration-300">
                                    <i class="fa-solid fa-arrow-right text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </template>

            <div class="text-center pt-4" x-show="hasMore">
                <button @click="loadMore()" class="bg-white hover:bg-slate-50 text-slate-700 font-black text-xs uppercase tracking-wider py-3.5 px-10 rounded-xl border border-slate-200 shadow-xs hover:shadow-md transition-all cursor-pointer focus-ring">
                    <i class="fa-solid fa-circle-chevron-down mr-1.5 text-indigo-600"></i> Cargar Registros Siguiente Página
                </button>
            </div>
        </section>
    </div>

    {{-- MODAL GACETA PERIODÍSTICA --}}
    <div class="fixed inset-0 bg-slate-950/85 backdrop-blur-xs z-50 flex items-center justify-center p-4 sm:p-6"
         x-show="openModal" x-transition.opacity x-cloak role="dialog" aria-modal="true">
        
        <div class="bg-[#fefdfa] border-[8px] border-double border-slate-900 p-6 sm:p-10 max-w-6xl w-full max-h-[95vh] overflow-y-auto custom-scrollbar shadow-2xl rounded-xs relative"
             @click.away="closeActivity()"
             @touchstart="handleTouchStart($event)"
             @touchend="handleTouchEnd($event)">
            
            <template x-if="selectedActivity">
                <div class="space-y-6">
                    <div class="text-center space-y-2 border-b-4 border-slate-900 pb-4">
                        <div class="flex items-center justify-between border-b border-slate-400 pb-1 text-[9px] font-mono font-black text-slate-500 tracking-widest uppercase">
                            <span>AÑO FISCAL: 2026</span>
                            <span>REGISTRO OFICIAL DE TRANSPARENCIA OPERATIVA DE TRABAJO</span>
                            <span>DOCUMENTO DE TRANSPARENCIA EMITIDO</span>
                        </div>
                        <h2 class="font-editorial-title font-black text-3xl sm:text-5xl tracking-tight text-slate-950 leading-tight m-0 uppercase py-2" x-text="selectedActivity.title"></h2>
                        
                        <div class="border-t-2 border-b-2 border-slate-950 py-2.5 my-2 grid grid-cols-1 sm:grid-cols-3 gap-3 text-[11px] font-mono font-black text-slate-800 uppercase tracking-wider text-center bg-slate-100/50">
                            <div><i class="fa-solid fa-location-dot text-red-600 mr-1"></i> JURISDICCIÓN: {{ strtoupper($slug) }}</div>
                            <div><i class="fa-regular fa-clock"></i> COMPILACIÓN IMPRENTA: <span x-text="selectedActivity.date"></span></div>
                            <div><i class="fa-solid fa-users text-indigo-600"></i> COBERTURA ASISTENCIA: <span x-text="selectedActivity.attendees"></span> CIUDADANOS</div>
                        </div>
                    </div>

                    <div class="space-y-4" x-show="selectedActivity.photos.length > 0">
                        <div class="w-full h-[420px] sm:h-[600px] md:h-[720px] bg-slate-950 rounded-xl overflow-hidden relative border border-slate-300 group/lightbox shadow-inner">
                            <button @click="prevPhoto()" class="absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-black/60 hover:bg-black text-white flex items-center justify-center border-none cursor-pointer z-20"><i class="fa-solid fa-chevron-left text-base"></i></button>
                            <button @click="nextPhoto()" class="absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-black/60 hover:bg-black text-white flex items-center justify-center border-none cursor-pointer z-20"><i class="fa-solid fa-chevron-right text-sm"></i></button>

                            <div class="absolute top-4 right-4 flex gap-2 z-20 opacity-0 group-hover/lightbox:opacity-100 transition-opacity">
                                <button @click="toggleAutoplay()" :class="autoplay ? 'bg-amber-500 text-slate-950 font-black' : 'bg-black/60 text-white font-bold'" class="px-3 py-1.5 rounded-xl text-[10px] uppercase tracking-wider border-none cursor-pointer flex items-center gap-1.5 focus-ring">
                                    <i class="fa-solid" :class="autoplay ? 'fa-pause' : 'fa-play'"></i>
                                    <span x-text="autoplay ? 'Pausar (5s)' : 'Reproducir'"></span>
                                </button>
                                <button @click="zoomIn()" class="w-8 h-8 bg-black/60 text-white rounded-xl flex items-center justify-center border-none cursor-pointer text-xs focus-ring"><i class="fa-solid fa-magnifying-glass-plus"></i></button>
                                <button @click="zoomOut()" class="w-8 h-8 bg-black/60 text-white rounded-xl flex items-center justify-center border-none cursor-pointer text-xs focus-ring"><i class="fa-solid fa-magnifying-glass-minus"></i></button>
                            </div>

                            <div class="w-full h-full flex items-center justify-center overflow-hidden">
                                <img :src="activePhoto" class="max-w-full max-h-full object-contain transition-transform duration-250 select-none pointer-events-none" :style="'transform: scale(' + zoomScale + ') translate(' + panX + 'px, ' + panY + 'px)'">
                            </div>

                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-black/80 text-white text-xs font-mono font-black py-1.5 px-4 rounded-full z-20 tracking-wider shadow-md">
                                CAPTURA <span x-text="activePhotoIndex + 1"></span> DE <span x-text="selectedActivity.photos.length"></span>
                            </div>
                        </div>

                        <div class="flex items-center justify-center gap-2 py-1" x-show="selectedActivity.photos.length > 1">
                            <template x-for="(photo, idx) in selectedActivity.photos" :key="idx">
                                <button @click="activePhotoIndex = idx; activePhoto = '/storage/' + photo; resetZoom()" :class="activePhotoIndex === idx ? 'bg-indigo-600 w-6' : 'bg-slate-300 w-2'" class="h-2 rounded-full border-none transition-all duration-300 cursor-pointer focus-ring"></button>
                            </template>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-300 text-justify">
                        <div class="text-slate-950 font-editorial-body leading-relaxed text-base sm:text-lg sm:columns-2 gap-10 space-y-4 text-justify first-letter:text-6xl first-letter:font-serif first-letter:font-black first-letter:text-red-600 first-letter:mr-3 first-letter:float-left first-letter:leading-none">
                            <p class="m-0 text-slate-900 whitespace-pre-line font-medium" x-text="selectedActivity.description"></p>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-400 flex justify-end">
                        <button type="button" @click="closeActivity()" class="bg-slate-950 hover:bg-black text-white font-black text-xs uppercase tracking-wider py-3.5 px-6 rounded shadow-md transition border-none cursor-pointer flex items-center gap-2 focus-ring">
                            <i class="fa-solid fa-book-open-reader text-red-500"></i> Concluir Lectura de Acta
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        // Recibe y asimila los datos de actividades y comunicados en el cliente de Alpine
        Alpine.data('activitiesPortalComponent', (initialActivities, initialAnnouncements) => ({
            rawActivities: initialActivities,
            announcements: initialAnnouncements,
            
            searchQuery: '',
            timeFilter: 'all',
            typeFilter: 'all',
            sortBy: 'recent',
            limit: 10,

            activeAnnIdx: 0,

            openModal: false,
            selectedActivity: null,
            activePhotoIndex: 0,
            activePhoto: '',
            autoplay: true, 
            autoplayInterval: null,

            zoomScale: 1,
            panX: 0,
            panY: 0,

            showBackToTop: false,
            scrollPercent: 0,

            timeFilterOptions: [
                { label: 'Todas las fechas', value: 'all' },
                { label: 'Últimos 7 días', value: '7days' },
                { label: 'Este mes', value: 'month' },
                { label: 'Año Fiscal 2026', value: 'year' }
            ],

            typeFilterOptions: [
                { label: 'Todas las Intervenciones', value: 'all' },
                { label: 'Ferias Laborales', value: 'feria' },
                { label: 'Capacitaciones / Talleres', value: 'capacitacion' },
                { label: 'Asesorías Especializadas', value: 'asesoria' }
            ],

            init() {
                // Rotador automático fijado exactamente en 5000 milisegundos
                if (this.announcements.length > 1) {
                    setInterval(() => {
                        this.activeAnnIdx = (this.activeAnnIdx + 1) % this.announcements.length;
                    }, 5000);
                }

                window.addEventListener('scroll', () => {
                    this.showBackToTop = window.scrollY > 400;
                    let h = document.documentElement, b = document.body, st = 'scrollTop', sh = 'scrollHeight';
                    this.scrollPercent = (h[st] || b[st]) / ((h[sh] || b[sh]) - h.clientHeight) * 100;
                });

                window.addEventListener('keydown', (e) => {
                    if (!this.openModal) return;
                    if (e.key === 'Escape') this.closeActivity();
                    if (e.key === 'ArrowRight') this.nextPhoto();
                    if (e.key === 'ArrowLeft') this.prevPhoto();
                });
            },

            levenshtein(a, b) {
                if (a.length === 0) return b.length;
                if (b.length === 0) return a.length;
                let matrix = [];
                for (let i = 0; i <= b.length; i++) { matrix[i] = [i]; }
                for (let j = 0; j <= a.length; j++) { matrix[0][j] = j; }
                for (let i = 1; i <= b.length; i++) {
                    for (let j = 1; j <= a.length; j++) {
                        if (b.charAt(i - 1) === a.charAt(j - 1)) matrix[i][j] = matrix[i - 1][j - 1];
                        else matrix[i][j] = Math.min(matrix[i - 1][j - 1] + 1, matrix[i][j - 1] + 1, matrix[i - 1][j] + 1);
                    }
                }
                return matrix[b.length][a.length];
            },

            fuzzySearchMatch(sourceText, queryText) {
                if (!queryText) return true;
                let source = sourceText.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                let query = queryText.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                if (source.includes(query)) return true;
                let queryWords = query.split(/\s+/), sourceWords = source.split(/\s+/);
                return queryWords.every(qWord => {
                    if (qWord.length < 3) return source.includes(qWord);
                    return sourceWords.some(sWord => this.levenshtein(sWord, qWord) <= (qWord.length <= 4 ? 1 : 2));
                });
            },

            get filteredActivities() {
                let result = [...this.rawActivities];
                if (this.searchQuery.trim() !== '') {
                    result = result.filter(a => this.fuzzySearchMatch(a.title + ' ' + a.description + ' ' + a.date_string, this.searchQuery));
                }

                if (this.timeFilter !== 'all') {
                    let benchmarkDate = new Date(2026, 6, 1);
                    result = result.filter(a => {
                        let actDate = new Date(a.created_at);
                        if (this.timeFilter === '7days') {
                            let diffTime = Math.abs(benchmarkDate - actDate);
                            return Math.ceil(diffTime / (1000 * 60 * 60 * 24)) <= 7;
                        }
                        if (this.timeFilter === 'month') {
                            return actDate.getMonth() === benchmarkDate.getMonth() && actDate.getFullYear() === benchmarkDate.getFullYear();
                        }
                        if (this.timeFilter === 'year') {
                            return actDate.getFullYear() === benchmarkDate.getFullYear();
                        }
                        return true;
                    });
                }

                if (this.typeFilter !== 'all') {
                    result = result.filter(a => {
                        let contentText = (a.title + ' ' + a.description).toLowerCase();
                        if (this.typeFilter === 'feria') return contentText.includes('feria') || contentText.includes('itinerante');
                        if (this.typeFilter === 'capacitacion') return contentText.includes('capacita') || contentText.includes('taller') || contentText.includes('charla');
                        if (this.typeFilter === 'asesoria') return contentText.includes('asesor') || contentText.includes('orienta') || contentText.includes('consulta');
                        return true;
                    });
                }

                if (this.sortBy === 'recent') { result.sort((a, b) => new Date(b.created_at) - new Date(a.created_at)); } 
                else if (this.sortBy === 'oldest') { result.sort((a, b) => new Date(a.created_at) - new Date(b.created_at)); } 
                else if (this.sortBy === 'attendees') { result.sort((a, b) => b.attendees_count - a.attendees_count); } 
                return result;
            },

            get displayedActivities() { return this.filteredActivities.slice(0, this.limit); },
            get hasMore() { return this.limit < this.filteredActivities.length; },
            loadMore() { this.limit += 10; },

            viewActivity(act) {
                this.selectedActivity = act;
                this.activePhotoIndex = 0;
                this.activePhoto = act.photos[0] ? '/storage/' + act.photos[0] : '';
                this.resetZoom();
                this.openModal = true;
                if (this.autoplay) { this.startAutoplayTimer(); }
            },

            closeActivity() { this.openModal = false; this.stopAutoplayTimer(); },
            nextPhoto() {
                if (!this.selectedActivity || !this.selectedActivity.photos.length) return;
                this.activePhotoIndex = (this.activePhotoIndex + 1) % this.selectedActivity.photos.length;
                this.activePhoto = '/storage/' + this.selectedActivity.photos[this.activePhotoIndex];
                this.resetZoom();
            },
            prevPhoto() {
                if (!this.selectedActivity || !this.selectedActivity.photos.length) return;
                this.activePhotoIndex = (this.activePhotoIndex - 1 + this.selectedActivity.photos.length) % this.selectedActivity.photos.length;
                this.activePhoto = '/storage/' + this.selectedActivity.photos[this.activePhotoIndex];
                this.resetZoom();
            },

            zoomIn() { this.zoomScale = Math.min(this.zoomScale + 0.4, 3); },
            zoomOut() { this.zoomScale = Math.max(this.zoomScale - 0.4, 1); if(this.zoomScale === 1) this.resetZoom(); },
            resetZoom() { this.zoomScale = 1; this.panX = 0; this.panY = 0; },
            toggleAutoplay() {
                this.autoplay = !this.autoplay;
                if (this.autoplay) this.startAutoplayTimer(); else this.stopAutoplayTimer();
            },
            startAutoplayTimer() { this.stopAutoplayTimer(); this.autoplayInterval = setInterval(() => this.nextPhoto(), 5000); },
            stopAutoplayTimer() { if (this.autoplayInterval) clearInterval(this.autoplayInterval); },

            touchStartX: 0, touchEndX: 0,
            handleTouchStart(e) { this.touchStartX = e.changedTouches[0].screenX; },
            handleTouchEnd(e) { this.touchEndX = e.changedTouches[0].screenX; this.evaluateSwipeGesture(); },
            evaluateSwipeGesture() {
                let threshold = 60;
                if (this.touchStartX - this.touchEndX > threshold) this.nextPhoto();
                if (this.touchEndX - this.touchStartX > threshold) this.prevPhoto();
            }
        }));
    });
</script>
@endsection