{{-- ══════════════════════════════════════════════════════════════════════ --}}
{{-- ── TALLERES Y CAPACITACIONES: Próximos (convocatoria) + Ejecutados ──── --}}
{{-- Recibe: $talleresProximos, $talleresEjecutados (colecciones de arrays)   --}}
{{-- ══════════════════════════════════════════════════════════════════════ --}}
<div class="space-y-16 py-6 w-full" x-data="talleresModule({{ \Illuminate\Support\Js::from($talleresEjecutados) }})">

    {{-- ════ SECCIÓN A: PRÓXIMOS TALLERES / CAPACITACIONES ════ --}}
    <section id="seccion-por-hacer" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-10 scroll-mt-24">
        <div class="flex items-center gap-4 mb-8">
            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-sm flex-shrink-0"><i class="fa-solid fa-calendar-plus text-white text-sm"></i></div>
            <div>
                <span class="eyebrow text-indigo-600">Convocatorias abiertas</span>
                <h2 class="text-xl sm:text-2xl font-black text-slate-900 m-0 tracking-tight">Próximos Talleres y Capacitaciones</h2>
                <p class="text-slate-500 text-xs font-bold m-0">Convocatorias abiertas con flyer y bases de participación</p>
            </div>
            <div class="flex-1 h-px bg-slate-200 hidden sm:block"></div>
        </div>

        @if($talleresProximos->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($talleresProximos as $t)
                    <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 flex flex-col overflow-hidden border-l-4 border-l-indigo-600 group">
                        {{-- Flyer promocional --}}
                        <div class="h-44 bg-slate-100 relative overflow-hidden">
                            @if($t['flyer_is_image'] && $t['flyer_url'])
                                <img src="{{ $t['flyer_url'] }}" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 gap-1"><i class="fa-solid fa-file-pdf text-3xl"></i><span class="text-[10px] font-black uppercase tracking-wider">Flyer PDF</span></div>
                            @endif
                            <span class="absolute top-3 left-3 text-[9px] font-black uppercase tracking-wider px-2 py-0.5 rounded {{ $t['type'] === 'taller' ? 'bg-indigo-600 text-white' : 'bg-slate-900 text-white' }}">{{ $t['type_label'] }}</span>
                            <span class="absolute top-3 right-3 bg-indigo-50 text-indigo-700 border border-indigo-100 text-[9px] font-black px-2 py-0.5 rounded uppercase tracking-wider">Inscripciones Abiertas</span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-base font-black text-slate-900 leading-snug m-0 line-clamp-2 group-hover:text-indigo-600 transition-colors">{{ $t['title'] }}</h3>
                            <p class="text-slate-500 text-xs leading-relaxed font-medium line-clamp-2 mt-2 m-0">{{ $t['description'] }}</p>
                            <div class="mt-4 pt-4 border-t border-slate-100 space-y-2 text-xs font-bold text-slate-600">
                                <div class="flex items-center gap-2"><i class="fa-regular fa-calendar text-indigo-500 w-4 text-center"></i> {{ $t['scheduled_date'] }} @if($t['horario'])· <i class="fa-regular fa-clock"></i> {{ $t['horario'] }}@endif</div>
                                @if($t['location'])<div class="flex items-center gap-2 truncate"><i class="fa-solid fa-location-dot text-indigo-500 w-4 text-center"></i> {{ $t['location'] }}</div>@endif
                            </div>
                            <div class="mt-4 flex flex-wrap items-center gap-2">
                                @if($t['flyer_url'])
                                    <a href="{{ $t['flyer_url'] }}" target="_blank" class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-[11px] font-black uppercase tracking-wider px-3 py-2 rounded-lg transition decoration-none"><i class="fa-solid fa-eye"></i> Ver Convocatoria</a>
                                @endif
                                @foreach($t['attachments'] as $a)
                                    <a href="{{ $a['url'] }}" target="_blank" class="inline-flex items-center gap-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-[11px] font-black uppercase tracking-wider px-3 py-2 rounded-lg transition decoration-none"><i class="fa-solid {{ $a['is_pdf'] ? 'fa-file-pdf text-red-500' : 'fa-image text-blue-500' }}"></i> {{ $a['label'] }}</a>
                                @endforeach
                            </div>

                            {{-- Spot promocional de la convocatoria (TikTok / Facebook / YouTube) --}}
                            <x-video-gallery :videos="$t['videos']" heading="Video promocional" />
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center shadow-sm max-w-xl mx-auto">
                <div class="w-12 h-12 bg-slate-50 border border-slate-200 rounded-xl flex items-center justify-center mx-auto mb-3 text-slate-400"><i class="fa-solid fa-graduation-cap text-lg"></i></div>
                <h4 class="text-sm font-black text-slate-800 m-0">No hay convocatorias abiertas</h4>
                <p class="text-xs text-slate-400 font-medium mt-1 m-0">Todos los talleres programados han sido ejecutados.</p>
            </div>
        @endif
    </section>

    {{-- ════ SECCIÓN B: EJECUTADOS / HECHOS (con modal doble columna) ════ --}}
    <section id="seccion-hechas" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-10 scroll-mt-24">
        <div class="flex items-center gap-4 mb-8">
            <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center shadow-sm flex-shrink-0"><i class="fa-solid fa-user-graduate text-white text-sm"></i></div>
            <div>
                <span class="eyebrow text-emerald-600">Evidencias fotográficas</span>
                <h2 class="text-xl sm:text-2xl font-black text-slate-900 m-0 tracking-tight">Talleres y Capacitaciones Ejecutados</h2>
                <p class="text-slate-500 text-xs font-bold m-0">Galería de evidencias de los eventos realizados</p>
            </div>
            <div class="flex-1 h-px bg-slate-200 hidden sm:block"></div>
        </div>

        <template x-if="ejecutados.length > 0">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-for="ev in ejecutados" :key="ev.id">
                    <button type="button" @click="show(ev)" class="text-left bg-white border border-slate-200/80 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col overflow-hidden border-l-4 border-l-emerald-500 group cursor-pointer p-0">
                        <div class="h-44 bg-slate-100 relative overflow-hidden">
                            <img :src="ev.cover" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" x-show="ev.cover">
                            <div class="absolute inset-0 flex items-center justify-center text-slate-300" x-show="!ev.cover"><i class="fa-solid fa-image text-3xl"></i></div>
                            <span class="absolute top-3 left-3 text-[9px] font-black uppercase tracking-wider px-2 py-0.5 rounded text-white" :class="ev.type === 'taller' ? 'bg-indigo-600' : 'bg-slate-900'" x-text="ev.type_label"></span>
                            <span class="absolute bottom-3 right-3 bg-slate-900/80 text-white text-[10px] font-black px-2 py-0.5 rounded"><i class="fa-solid fa-images mr-1"></i><span x-text="ev.photos_count"></span></span>
                            {{-- Distintivo de difusión audiovisual --}}
                            <template x-if="ev.videos_count > 0">
                                <span class="absolute bottom-3 left-3 bg-red-600/90 text-white text-[10px] font-black px-2 py-0.5 rounded"><i class="fa-solid fa-clapperboard mr-1"></i><span x-text="ev.videos_count"></span></span>
                            </template>
                        </div>
                        <div class="p-6 flex-1 flex flex-col w-full">
                            <h3 class="text-base font-black text-slate-900 leading-snug m-0 line-clamp-2 group-hover:text-emerald-600 transition-colors" x-text="ev.title"></h3>
                            <div class="mt-4 pt-4 border-t border-slate-100 grid grid-cols-2 gap-2 text-xs font-bold text-slate-600 items-center">
                                <div><i class="fa-solid fa-users text-emerald-500 mr-1.5"></i><span class="text-slate-900 font-black" x-text="ev.attendees_count"></span> asist.</div>
                                <div class="text-right"><span class="inline-block text-[11px] font-black text-slate-900 bg-slate-100 border border-slate-200 px-2 py-0.5 rounded" x-text="ev.executed_date"></span></div>
                            </div>
                            <span class="mt-3 text-[10px] font-black text-emerald-600 uppercase tracking-wider inline-flex items-center gap-1">Ver galería <i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                    </button>
                </template>
            </div>
        </template>
        <template x-if="ejecutados.length === 0">
            <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center shadow-sm max-w-xl mx-auto">
                <div class="w-12 h-12 bg-slate-50 border border-slate-200 rounded-xl flex items-center justify-center mx-auto mb-3 text-slate-400"><i class="fa-solid fa-folder-open text-lg"></i></div>
                <h4 class="text-sm font-black text-slate-800 m-0">Sin registros históricos</h4>
                <p class="text-xs text-slate-400 font-medium mt-1 m-0">No se han cargado evidencias de talleres ejecutados.</p>
            </div>
        </template>
    </section>

    {{-- ════ MODAL DE DETALLE (DOBLE COLUMNA) ════ --}}
    <div x-show="open" x-cloak @keydown.escape.window="close()" class="fixed inset-0 z-[150] flex items-center justify-center p-3 sm:p-6" style="display:none;">
        <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-md" @click="close()"></div>

        <div class="relative bg-white rounded-2xl w-full max-w-5xl shadow-2xl overflow-hidden flex flex-col md:flex-row" style="height: 82vh;" x-show="open" x-transition>
            <template x-if="ev">
                <div class="w-full h-full flex flex-col md:flex-row">

                    {{-- COLUMNA IZQUIERDA: GALERÍA DE FOTOS DEL EVENTO --}}
                    <div class="w-full md:w-[60%] bg-slate-950 relative flex items-center justify-center h-1/2 md:h-full overflow-hidden">
                        <img :src="ev.photos[slide]" class="w-full h-full object-contain cursor-zoom-in" @click="lightbox = true" x-show="ev.photos.length">
                        <div class="absolute inset-0 flex items-center justify-center text-slate-600" x-show="!ev.photos.length"><i class="fa-solid fa-image text-5xl"></i></div>

                        {{-- Controles --}}
                        <template x-if="ev.photos.length > 1">
                            <div>
                                <button @click="prev()" class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/50 hover:bg-black/80 text-white border-none cursor-pointer flex items-center justify-center"><i class="fa-solid fa-chevron-left"></i></button>
                                <button @click="next()" class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/50 hover:bg-black/80 text-white border-none cursor-pointer flex items-center justify-center"><i class="fa-solid fa-chevron-right"></i></button>
                                <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1.5">
                                    <template x-for="(p, i) in ev.photos" :key="i">
                                        <button @click="go(i)" class="h-1.5 rounded-full transition-all border-none cursor-pointer" :class="slide === i ? 'bg-amber-500 w-5' : 'bg-white/40 w-1.5'"></button>
                                    </template>
                                </div>
                                <span class="absolute top-3 left-3 bg-black/60 text-white text-[11px] font-mono font-black px-2.5 py-1 rounded-full"><span x-text="slide + 1"></span> / <span x-text="ev.photos.length"></span></span>
                            </div>
                        </template>
                    </div>

                    {{-- COLUMNA DERECHA: INFO + INSUMOS SECUNDARIOS --}}
                    <div class="w-full md:w-[40%] bg-white flex flex-col h-1/2 md:h-full">
                        <div class="p-5 sm:p-6 overflow-y-auto flex-1">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-[9px] font-black uppercase tracking-widest px-2 py-0.5 rounded text-white" :class="ev.type === 'taller' ? 'bg-indigo-600' : 'bg-slate-900'" x-text="ev.type_label"></span>
                                <button @click="close()" class="text-slate-400 hover:text-slate-700 text-[11px] font-black uppercase tracking-wider bg-transparent border-none cursor-pointer">Cerrar <i class="fa-solid fa-xmark text-red-500"></i></button>
                            </div>

                            <h3 class="text-slate-900 font-black text-lg leading-snug m-0" x-text="ev.title"></h3>
                            <div class="flex flex-wrap gap-x-4 gap-y-1 mt-2 text-[11px] font-bold text-slate-500">
                                <span><i class="fa-regular fa-calendar-check text-emerald-500 mr-1"></i><span x-text="ev.executed_date"></span></span>
                                <span><i class="fa-solid fa-users text-emerald-500 mr-1"></i><span x-text="ev.attendees_count"></span> asistentes</span>
                            </div>
                            <p class="text-slate-600 text-xs font-medium leading-relaxed mt-3 bg-slate-50 border border-slate-100 rounded-xl p-3" x-text="ev.description"></p>

                            {{-- Difusión del evento en redes sociales --}}
                            <x-video-gallery-live items="ev.videos" heading="Video del evento" />

                            {{-- Insumos de convocatoria (minimizados / colapsables) --}}
                            <template x-if="ev.flyer_url || ev.attachments.length">
                                <div class="mt-4" x-data="{ openInsumos: false }">
                                    <button @click="openInsumos = !openInsumos" class="w-full flex items-center justify-between bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-xl px-3 py-2.5 text-[11px] font-black uppercase tracking-wider text-slate-600 border-none cursor-pointer">
                                        <span><i class="fa-solid fa-folder-open text-amber-500 mr-1.5"></i> Insumos de Convocatoria</span>
                                        <i class="fa-solid" :class="openInsumos ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                    </button>
                                    <div x-show="openInsumos" x-transition class="pt-3 space-y-2">
                                        <template x-if="ev.flyer_url">
                                            <a :href="ev.flyer_url" target="_blank" class="flex items-center gap-2 bg-white hover:bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-[11px] font-bold text-slate-700 transition decoration-none">
                                                <i class="fa-solid" :class="ev.flyer_is_pdf ? 'fa-file-pdf text-red-500' : 'fa-image text-blue-500'"></i> Flyer Promocional Original
                                            </a>
                                        </template>
                                        <template x-for="a in ev.attachments" :key="a.url">
                                            <a :href="a.url" target="_blank" class="flex items-center gap-2 bg-white hover:bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-[11px] font-bold text-slate-700 transition decoration-none">
                                                <i class="fa-solid" :class="a.is_pdf ? 'fa-file-pdf text-red-500' : 'fa-image text-blue-500'"></i> <span x-text="a.label"></span>
                                            </a>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    {{-- LIGHTBOX / ZOOM --}}
    <div x-show="lightbox" x-cloak @click="lightbox = false" @keydown.escape.window="lightbox = false" class="fixed inset-0 z-[200] bg-black/95 flex items-center justify-center p-4" style="display:none;">
        <img :src="ev ? ev.photos[slide] : ''" class="max-w-full max-h-full object-contain">
        <button @click="lightbox = false" class="absolute top-5 right-5 w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 text-white border-none cursor-pointer flex items-center justify-center"><i class="fa-solid fa-xmark text-lg"></i></button>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('talleresModule', (ejecutados) => ({
            ejecutados,
            open: false,
            ev: null,
            slide: 0,
            timer: null,
            lightbox: false,
            show(ev) {
                this.ev = ev;
                this.slide = 0;
                this.open = true;
                this.startAuto();
                document.body.style.overflow = 'hidden';
            },
            close() {
                this.open = false;
                this.lightbox = false;
                this.stopAuto();
                document.body.style.overflow = '';
            },
            startAuto() {
                this.stopAuto();
                if (this.ev && this.ev.photos.length > 1) {
                    this.timer = setInterval(() => this.next(), 5000);
                }
            },
            stopAuto() { clearInterval(this.timer); },
            next() { if (this.ev) this.slide = (this.slide + 1) % this.ev.photos.length; },
            prev() { if (this.ev) this.slide = (this.slide - 1 + this.ev.photos.length) % this.ev.photos.length; },
            go(i) { this.slide = i; this.startAuto(); },
        }));
    });
</script>
