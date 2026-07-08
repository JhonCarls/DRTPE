<x-branch-layout>
<style>
    .bt-scroll::-webkit-scrollbar { height: 6px; }
    .bt-scroll::-webkit-scrollbar-track { background: transparent; }
    .bt-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
</style>

<div class="space-y-6"
     x-data="branchDashboard({{ Js::from($mappedActivities) }}, {{ Js::from($announcements) }}, {{ Js::from($kpis) }})"
     x-init="init()">

    {{-- ══ CABECERA INSTITUCIONAL ══ --}}
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-red-600 to-red-700 text-white p-6 sm:p-8 shadow-lg shadow-red-900/20">
        <div class="absolute -right-8 -top-8 w-40 h-40 rounded-full bg-white/10"></div>
        <div class="absolute right-16 bottom-0 w-24 h-24 rounded-full bg-white/5"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-5">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-white/15 backdrop-blur-sm border border-white/20 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-building-flag text-2xl"></i>
                </div>
                <div>
                    <span class="inline-block text-[10px] font-black uppercase tracking-[0.2em] bg-white/15 border border-white/20 px-2.5 py-1 rounded-md">Jurisdicción Desconcentrada</span>
                    <h1 class="text-2xl sm:text-3xl font-black tracking-tight mt-2 m-0" style="font-family: 'Sora', sans-serif;">{{ $sedeName }}</h1>
                    <p class="text-red-100 text-xs font-bold mt-1 m-0"><i class="fa-regular fa-calendar-check mr-1"></i> Año Fiscal 2026 · Panel de Control Operativo</p>
                </div>
            </div>
            <a href="{{ route('branch-activities.create') }}" class="inline-flex items-center justify-center gap-2 bg-white text-red-700 hover:bg-red-50 font-black text-xs uppercase tracking-wider py-3 px-5 rounded-xl shadow-md transition-all decoration-none shrink-0">
                <i class="fa-solid fa-circle-plus"></i> Registrar Nueva Actividad
            </a>
        </div>
    </div>

    {{-- ══ CARRUSEL DE COMUNICADOS (altura fija, anti-CLS) ══ --}}
    <div class="bg-gradient-to-br from-slate-900 to-slate-950 text-white rounded-2xl p-5 sm:p-6 shadow-sm border border-slate-800 relative overflow-hidden"
         x-show="announcements.length > 0" x-cloak
         @mouseenter="pauseAnn()" @mouseleave="resumeAnn()">
        <div class="flex items-center justify-between mb-3">
            <span class="text-[10px] font-black uppercase tracking-widest flex items-center gap-2"><i class="fa-solid fa-bullhorn text-red-500"></i> Tablón de Comunicados</span>
            <div class="flex items-center gap-2">
                <span class="text-[10px] font-mono font-black text-slate-300 bg-black/40 px-2.5 py-0.5 rounded border border-white/10"><span x-text="activeAnnIdx + 1"></span> / <span x-text="announcements.length"></span></span>
                <div class="flex gap-1" x-show="announcements.length > 1">
                    <button @click="prevAnn()" class="w-6 h-6 bg-white/10 hover:bg-white/20 text-white border-none rounded-lg cursor-pointer flex items-center justify-center transition"><i class="fa-solid fa-chevron-left text-[10px]"></i></button>
                    <button @click="nextAnn()" class="w-6 h-6 bg-white/10 hover:bg-white/20 text-white border-none rounded-lg cursor-pointer flex items-center justify-center transition"><i class="fa-solid fa-chevron-right text-[10px]"></i></button>
                </div>
            </div>
        </div>
        {{-- Carril de altura FIJA: slides absolutos con cross-fade → sin saltos de layout --}}
        <div class="relative h-[110px] overflow-hidden">
            <template x-for="(ann, idx) in announcements" :key="ann.id">
                <div class="absolute inset-0 pr-2"
                     x-show="activeAnnIdx === idx"
                     x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                     x-cloak>
                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-[11px] font-mono font-bold mb-1.5">
                        <span class="text-[9px] font-black uppercase tracking-widest px-2 py-0.5 rounded" :class="ann.is_institucional ? 'bg-red-600 text-white' : 'bg-indigo-600 text-white'" x-text="ann.is_institucional ? 'Institucional' : 'Oficial Sede'"></span>
                        <span class="text-slate-400">Publicado: <span class="text-slate-200" x-text="ann.fecha_publicacion"></span></span>
                        <span class="text-amber-400">Vence: <span class="text-amber-300" x-text="ann.fecha_vencimiento"></span></span>
                    </div>
                    <h3 class="text-base font-black tracking-tight text-white m-0 uppercase line-clamp-1" x-text="ann.title"></h3>
                    <p class="text-xs text-slate-300 m-0 line-clamp-2 leading-relaxed font-medium mt-1" x-text="ann.content"></p>
                </div>
            </template>
        </div>
    </div>

    {{-- ══ CUADRÍCULA DE MÉTRICAS (KPIs animados) ══ --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        {{-- Rojo/Slate: Intervenciones --}}
        <div class="bg-white p-5 rounded-2xl border border-slate-200 border-l-4 border-l-red-600 shadow-xs">
            <div class="flex items-center justify-between">
                <div class="text-red-600 text-[9px] font-black uppercase tracking-widest flex items-center gap-1.5"><i class="fa-solid fa-clipboard-check"></i> Intervenciones</div>
                <div class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center"><i class="fa-solid fa-layer-group text-xs"></i></div>
            </div>
            <div class="text-3xl font-black text-slate-900 tracking-tight mt-2" x-text="fmt(metrics.totalActs)">0</div>
            <p class="text-[10px] font-bold text-slate-400 mt-1 m-0">Actividades registradas</p>
        </div>
        {{-- Indigo: Personas atendidas --}}
        <div class="bg-white p-5 rounded-2xl border border-slate-200 border-l-4 border-l-indigo-600 shadow-xs">
            <div class="flex items-center justify-between">
                <div class="text-indigo-600 text-[9px] font-black uppercase tracking-widest flex items-center gap-1.5"><i class="fa-solid fa-users"></i> Cobertura</div>
                <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center"><i class="fa-solid fa-user-group text-xs"></i></div>
            </div>
            <div class="text-3xl font-black text-slate-900 tracking-tight mt-2" x-text="fmt(metrics.totalAttendees)">0</div>
            <p class="text-[10px] font-bold text-slate-400 mt-1 m-0">Personas atendidas</p>
        </div>
        {{-- Emerald: Evidencias --}}
        <div class="bg-white p-5 rounded-2xl border border-slate-200 border-l-4 border-l-emerald-500 shadow-xs">
            <div class="flex items-center justify-between">
                <div class="text-emerald-600 text-[9px] font-black uppercase tracking-widest flex items-center gap-1.5"><i class="fa-solid fa-images"></i> Evidencias</div>
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center"><i class="fa-solid fa-camera text-xs"></i></div>
            </div>
            <div class="text-3xl font-black text-slate-900 tracking-tight mt-2" x-text="fmt(metrics.totalPhotos)">0</div>
            <p class="text-[10px] font-bold text-slate-400 mt-1 m-0">Fotografías cargadas</p>
        </div>
        {{-- Amber: Cumplimiento POI --}}
        <div class="bg-white p-5 rounded-2xl border border-slate-200 border-l-4 border-l-amber-500 shadow-xs">
            <div class="flex items-center justify-between">
                <div class="text-amber-600 text-[9px] font-black uppercase tracking-widest flex items-center gap-1.5"><i class="fa-solid fa-bullseye"></i> Metas POI</div>
                <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center"><i class="fa-solid fa-chart-line text-xs"></i></div>
            </div>
            <div class="text-3xl font-black text-slate-900 tracking-tight mt-2"><span x-text="metrics.cumplimiento">0</span>%</div>
            <div class="w-full h-1.5 bg-slate-100 rounded-full mt-2 overflow-hidden">
                <div class="h-full bg-amber-500 rounded-full transition-all duration-700" :style="'width: ' + metrics.cumplimiento + '%'"></div>
            </div>
            <p class="text-[10px] font-bold text-slate-400 mt-1 m-0">Meta anual: {{ $kpis['metaAnual'] }} intervenciones</p>
        </div>
    </div>

    {{-- ══ CENTRO DE CONTROL: FILTROS ══ --}}
    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs space-y-4">
        {{-- Buscador --}}
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400"><i class="fa-solid fa-magnifying-glass text-xs"></i></span>
            <input type="text" x-model="searchQuery" placeholder="Buscar por título o descripción (tolerante a errores)..."
                   class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 pl-10 pr-4 text-xs font-semibold text-slate-800 focus:outline-none focus:border-red-500 shadow-inner">
        </div>
        {{-- Filtro por tipo de intervención --}}
        <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
            <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest w-20 shrink-0"><i class="fa-solid fa-filter mr-1"></i> Tipo:</span>
            <div class="flex flex-wrap gap-2">
                <template x-for="opt in typeOptions" :key="opt.value">
                    <button @click="typeFilter = opt.value"
                            :class="typeFilter === opt.value ? 'bg-red-600 text-white border-red-600' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100'"
                            class="px-3 py-1.5 rounded-lg text-[11px] font-black uppercase tracking-wider border transition-all cursor-pointer flex items-center gap-1.5">
                        <i class="fa-solid text-[10px]" :class="opt.icon"></i><span x-text="opt.label"></span>
                    </button>
                </template>
            </div>
        </div>
        {{-- Filtro por periodo --}}
        <div class="flex flex-col sm:flex-row gap-2 sm:items-center pt-3 border-t border-slate-100">
            <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest w-20 shrink-0"><i class="fa-regular fa-calendar mr-1"></i> Periodo:</span>
            <div class="flex flex-wrap gap-2">
                <template x-for="opt in timeOptions" :key="opt.value">
                    <button @click="timeFilter = opt.value"
                            :class="timeFilter === opt.value ? 'bg-slate-900 text-white border-slate-900' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100'"
                            class="px-3 py-1.5 rounded-lg text-[11px] font-black uppercase tracking-wider border transition-all cursor-pointer" x-text="opt.label"></button>
                </template>
            </div>
        </div>
    </div>

    {{-- ══ GRILLA OPERATIVA DE ACTIVIDADES ══ --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100">
            <h3 class="text-xs font-black uppercase tracking-widest text-slate-500 m-0"><i class="fa-solid fa-table-list mr-1.5 text-red-500"></i> Registro de Actividades</h3>
            <span class="text-[11px] font-black text-slate-400"><span x-text="filtered.length"></span> resultado(s)</span>
        </div>

        <div class="overflow-x-auto bt-scroll" x-show="filtered.length > 0">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-400 text-[10px] uppercase font-black tracking-wider">
                    <tr>
                        <th class="px-5 py-3 w-20">Foto</th>
                        <th class="px-5 py-3">Actividad</th>
                        <th class="px-5 py-3 w-44">Tipo</th>
                        <th class="px-5 py-3 w-40 text-center">Registro</th>
                        <th class="px-5 py-3 w-24 text-center">Atendidos</th>
                        <th class="px-5 py-3 w-32 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    <template x-for="act in filtered" :key="act.id">
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-5 py-3">
                                <button type="button" @click="act.photos_count > 0 && openGallery(act)"
                                        class="w-12 h-11 rounded-xl bg-slate-50 border border-slate-200 overflow-hidden flex items-center justify-center relative group border-none cursor-pointer p-0">
                                    <img x-show="act.first_photo" :src="act.first_photo" class="w-full h-full object-cover">
                                    <i x-show="!act.first_photo" class="fa-solid fa-image text-slate-300 text-xs"></i>
                                    <span x-show="act.photos_count > 1" class="absolute bottom-0 right-0 bg-slate-900/80 text-white text-[8px] font-black px-1 rounded-tl" x-text="act.photos_count"></span>
                                </button>
                            </td>
                            <td class="px-5 py-3">
                                <h4 class="text-xs font-black text-slate-900 m-0 leading-snug line-clamp-1" x-text="act.title"></h4>
                                <p class="text-[11px] text-slate-400 line-clamp-1 mt-0.5 m-0 font-medium" x-text="act.description"></p>
                            </td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider border"
                                      :class="typeMeta(act.type).cls">
                                    <i class="fa-solid text-[9px]" :class="typeMeta(act.type).icon"></i><span x-text="typeMeta(act.type).label"></span>
                                </span>
                            </td>
                            <td class="px-5 py-3 text-center text-[11px] font-bold text-slate-500" x-text="act.date_string"></td>
                            <td class="px-5 py-3 text-center">
                                <span class="inline-flex items-center gap-1 font-black text-slate-900"><i class="fa-solid fa-user text-[10px] text-indigo-500"></i> <span x-text="fmt(act.attendees_count)"></span></span>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button type="button" @click="act.photos_count > 0 ? openGallery(act) : null" :disabled="act.photos_count === 0"
                                            class="w-7 h-7 bg-slate-50 hover:bg-emerald-50 border border-slate-200 text-slate-500 hover:text-emerald-600 rounded-lg flex items-center justify-center cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed" title="Ver galería">
                                        <i class="fa-solid fa-images text-[10px]"></i>
                                    </button>
                                    <a :href="act.url_edit" class="w-7 h-7 bg-slate-50 hover:bg-indigo-50 border border-slate-200 text-slate-500 hover:text-indigo-600 rounded-lg flex items-center justify-center decoration-none" title="Editar"><i class="fa-solid fa-pen-to-square text-[10px]"></i></a>
                                    <form :action="act.url_destroy" method="POST" @submit="if(!confirm('¿Eliminar esta actividad y sus evidencias? Esta acción no se puede deshacer.')) $event.preventDefault();" class="m-0">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="w-7 h-7 bg-slate-50 hover:bg-red-50 border border-slate-200 text-slate-400 hover:text-red-600 rounded-lg flex items-center justify-center border-none cursor-pointer" title="Eliminar"><i class="fa-solid fa-trash text-[10px]"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
        <div class="p-16 text-center text-slate-400" x-show="filtered.length === 0">
            <i class="fa-regular fa-folder-open text-3xl mb-3 block"></i>
            <span class="text-xs font-bold uppercase tracking-wider block">Sin actividades que coincidan con los filtros</span>
        </div>
    </div>

    {{-- ══ MODAL GALERÍA ══ --}}
    <div x-show="galleryOpen" x-cloak @keydown.escape.window="closeGallery()"
         class="fixed inset-0 z-50 flex items-center justify-center p-4"
         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-sm" @click="closeGallery()"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[92vh] overflow-hidden flex flex-col"
             x-show="galleryOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            <div class="flex items-center justify-between p-4 border-b border-slate-100">
                <h3 class="text-sm font-black text-slate-800 truncate m-0"><i class="fa-solid fa-images text-emerald-500 mr-2"></i><span x-text="galleryTitle"></span></h3>
                <button @click="closeGallery()" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-500 flex items-center justify-center border-none cursor-pointer"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="p-4 bg-slate-950 flex items-center justify-center relative" style="min-height: 320px;">
                <img :src="galleryPhotos[galleryIdx]" class="max-w-full max-h-[60vh] object-contain rounded-lg">
                <button x-show="galleryPhotos.length > 1" @click="galleryIdx = (galleryIdx - 1 + galleryPhotos.length) % galleryPhotos.length" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/60 hover:bg-black text-white flex items-center justify-center border-none cursor-pointer"><i class="fa-solid fa-chevron-left"></i></button>
                <button x-show="galleryPhotos.length > 1" @click="galleryIdx = (galleryIdx + 1) % galleryPhotos.length" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/60 hover:bg-black text-white flex items-center justify-center border-none cursor-pointer"><i class="fa-solid fa-chevron-right"></i></button>
                <span class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-black/70 text-white text-xs font-mono font-black py-1 px-3 rounded-full"><span x-text="galleryIdx + 1"></span> / <span x-text="galleryPhotos.length"></span></span>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('branchDashboard', (activities, announcements, kpis) => ({
            activities, announcements, kpis,
            searchQuery: '', typeFilter: 'all', timeFilter: 'all', sortBy: 'recent',
            activeAnnIdx: 0, annInterval: null,
            metrics: { totalActs: 0, totalAttendees: 0, totalPhotos: 0, cumplimiento: 0 },
            galleryOpen: false, galleryPhotos: [], galleryTitle: '', galleryIdx: 0,

            typeOptions: [
                { label: 'Todas', value: 'all', icon: 'fa-layer-group' },
                { label: 'Ferias', value: 'feria', icon: 'fa-store' },
                { label: 'Capacitaciones', value: 'capacitacion', icon: 'fa-chalkboard-user' },
                { label: 'Asesorías', value: 'asesoria', icon: 'fa-handshake-angle' },
            ],
            timeOptions: [
                { label: 'Todo', value: 'all' },
                { label: 'Últimos 7 días', value: '7days' },
                { label: 'Este mes', value: 'month' },
                { label: 'Año 2026', value: 'year' },
            ],

            init() {
                this.animateCounter('totalActs', this.kpis.totalActs, 600);
                this.animateCounter('totalAttendees', this.kpis.totalAttendees, 900);
                this.animateCounter('totalPhotos', this.kpis.totalPhotos, 800);
                this.animateCounter('cumplimiento', this.kpis.cumplimiento, 900);
                this.startCarousel();
            },

            startCarousel() {
                if (this.announcements.length <= 1) return;
                clearInterval(this.annInterval);
                this.annInterval = setInterval(() => { this.activeAnnIdx = (this.activeAnnIdx + 1) % this.announcements.length; }, 5000);
            },
            nextAnn() { this.activeAnnIdx = (this.activeAnnIdx + 1) % this.announcements.length; this.startCarousel(); },
            prevAnn() { this.activeAnnIdx = (this.activeAnnIdx - 1 + this.announcements.length) % this.announcements.length; this.startCarousel(); },
            pauseAnn() { clearInterval(this.annInterval); },
            resumeAnn() { this.startCarousel(); },

            animateCounter(key, target, duration) {
                target = Number(target) || 0;
                if (target === 0) { this.metrics[key] = 0; return; }
                let start = 0;
                const stepTime = Math.max(Math.floor(duration / target), 12);
                const increment = Math.max(1, Math.ceil(target / (duration / stepTime)));
                const timer = setInterval(() => {
                    start += increment;
                    if (start >= target) { this.metrics[key] = target; clearInterval(timer); }
                    else { this.metrics[key] = start; }
                }, stepTime);
            },

            typeMeta(t) {
                const m = {
                    feria: { label: 'Feria Laboral', cls: 'bg-red-50 text-red-600 border-red-200', icon: 'fa-store' },
                    capacitacion: { label: 'Capacitación', cls: 'bg-indigo-50 text-indigo-600 border-indigo-200', icon: 'fa-chalkboard-user' },
                    asesoria: { label: 'Asesoría', cls: 'bg-emerald-50 text-emerald-600 border-emerald-200', icon: 'fa-handshake-angle' },
                };
                return m[t] || { label: 'General', cls: 'bg-slate-100 text-slate-600 border-slate-200', icon: 'fa-circle-dot' };
            },

            levenshtein(a, b) {
                if (a.length === 0) return b.length; if (b.length === 0) return a.length;
                const matrix = [];
                for (let i = 0; i <= b.length; i++) matrix[i] = [i];
                for (let j = 0; j <= a.length; j++) matrix[0][j] = j;
                for (let i = 1; i <= b.length; i++) for (let j = 1; j <= a.length; j++) {
                    matrix[i][j] = (b.charAt(i - 1) === a.charAt(j - 1)) ? matrix[i - 1][j - 1]
                        : Math.min(matrix[i - 1][j - 1] + 1, matrix[i][j - 1] + 1, matrix[i - 1][j] + 1);
                }
                return matrix[b.length][a.length];
            },
            fuzzy(source, query) {
                if (!query) return true;
                const s = source.toLowerCase().normalize('NFD').replace(/[̀-ͯ]/g, '');
                const q = query.toLowerCase().normalize('NFD').replace(/[̀-ͯ]/g, '');
                if (s.includes(q)) return true;
                return q.split(/\s+/).every(w => w.length < 3 ? s.includes(w) : s.split(/\s+/).some(sw => this.levenshtein(sw, w) <= (w.length <= 4 ? 1 : 2)));
            },

            get filtered() {
                let r = [...this.activities];
                if (this.searchQuery.trim() !== '') r = r.filter(a => this.fuzzy(a.title + ' ' + a.description, this.searchQuery));
                if (this.typeFilter !== 'all') r = r.filter(a => a.type === this.typeFilter);
                if (this.timeFilter !== 'all') {
                    const now = new Date();
                    r = r.filter(a => {
                        const d = new Date(a.created_at);
                        if (this.timeFilter === '7days') return (now - d) / (1000 * 60 * 60 * 24) <= 7;
                        if (this.timeFilter === 'month') return d.getMonth() === now.getMonth() && d.getFullYear() === now.getFullYear();
                        if (this.timeFilter === 'year') return d.getFullYear() === 2026;
                        return true;
                    });
                }
                if (this.sortBy === 'attendees') r.sort((a, b) => b.attendees_count - a.attendees_count);
                else r.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                return r;
            },

            openGallery(act) { this.galleryPhotos = act.photos; this.galleryTitle = act.title; this.galleryIdx = 0; this.galleryOpen = true; },
            closeGallery() { this.galleryOpen = false; },
            fmt(v) { return new Intl.NumberFormat('en-US').format(Number(v) || 0); }
        }));
    });
</script>
</x-branch-layout>
