{{-- ══════════════════════════════════════════════════════════════════════ --}}
{{-- ── COORDINACIONES INSTITUCIONALES REALIZADAS (módulo independiente) ─── --}}
{{-- Recibe: $coordinaciones (colección de arrays)                            --}}
{{-- ══════════════════════════════════════════════════════════════════════ --}}
<section id="seccion-coordinaciones" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-10 py-6 scroll-mt-24"
         x-data="coordinacionesModule({{ \Illuminate\Support\Js::from($coordinaciones) }})">

    <div class="flex items-center gap-4 mb-8">
        <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center shadow-sm flex-shrink-0"><i class="fa-solid fa-handshake-angle text-white text-sm"></i></div>
        <div>
            <span class="eyebrow text-amber-600">Cooperación interinstitucional</span>
            <h2 class="text-xl sm:text-2xl font-black text-slate-900 m-0 tracking-tight">Coordinaciones Institucionales Realizadas</h2>
            <p class="text-slate-500 text-xs font-bold m-0">Mesas de trabajo y acuerdos de cooperación interinstitucional</p>
        </div>
        <div class="flex-1 h-px bg-slate-200 hidden sm:block"></div>
    </div>

    <template x-if="items.length > 0">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <template x-for="c in items" :key="c.id">
                <button type="button" @click="show(c)" class="text-left bg-white border border-slate-200/80 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col overflow-hidden border-l-4 border-l-amber-500 group cursor-pointer p-0">
                    <div class="h-40 bg-slate-100 relative overflow-hidden">
                        <img :src="c.cover" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" x-show="c.cover">
                        <div class="absolute inset-0 flex items-center justify-center text-slate-300" x-show="!c.cover"><i class="fa-solid fa-handshake text-3xl"></i></div>
                        <span class="absolute bottom-3 right-3 bg-slate-900/80 text-white text-[10px] font-black px-2 py-0.5 rounded"><i class="fa-solid fa-images mr-1"></i><span x-text="c.photos_count"></span></span>
                        {{-- Distintivo de difusión audiovisual --}}
                        <template x-if="c.videos_count > 0">
                            <span class="absolute bottom-3 left-3 bg-red-600/90 text-white text-[10px] font-black px-2 py-0.5 rounded"><i class="fa-solid fa-clapperboard mr-1"></i><span x-text="c.videos_count"></span></span>
                        </template>
                    </div>
                    <div class="p-6 flex-1 flex flex-col w-full">
                        <h3 class="text-base font-black text-slate-900 leading-snug m-0 line-clamp-2 group-hover:text-amber-600 transition-colors" x-text="c.title"></h3>
                        <p class="text-slate-500 text-xs leading-relaxed font-medium line-clamp-2 mt-2 m-0" x-text="c.description"></p>
                        <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-slate-600">
                            <span><i class="fa-regular fa-calendar-check text-amber-500 mr-1.5"></i><span x-text="c.date"></span></span>
                            <span class="text-[10px] font-black text-amber-600 uppercase tracking-wider inline-flex items-center gap-1">Ver acta <i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                    </div>
                </button>
            </template>
        </div>
    </template>
    <template x-if="items.length === 0">
        <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center shadow-sm max-w-xl mx-auto">
            <div class="w-12 h-12 bg-slate-50 border border-slate-200 rounded-xl flex items-center justify-center mx-auto mb-3 text-slate-400"><i class="fa-solid fa-briefcase text-lg"></i></div>
            <h4 class="text-sm font-black text-slate-800 m-0">Sin coordinaciones registradas</h4>
            <p class="text-xs text-slate-400 font-medium mt-1 m-0">No se han reportado mesas de trabajo institucionales.</p>
        </div>
    </template>

    {{-- MODAL --}}
    <div x-show="open" x-cloak @keydown.escape.window="close()" class="fixed inset-0 z-[150] flex items-center justify-center p-3 sm:p-6" style="display:none;">
        <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-md" @click="close()"></div>
        <div class="relative bg-white rounded-2xl w-full max-w-5xl shadow-2xl overflow-hidden flex flex-col md:flex-row" style="height: 80vh;" x-show="open" x-transition>
            <template x-if="cur">
                <div class="w-full h-full flex flex-col md:flex-row">
                    {{-- Galería --}}
                    <div class="w-full md:w-[60%] bg-slate-950 relative flex items-center justify-center h-1/2 md:h-full overflow-hidden">
                        <img :src="cur.photos[slide]" class="w-full h-full object-contain cursor-zoom-in" @click="lightbox = true" x-show="cur.photos.length">
                        <div class="absolute inset-0 flex items-center justify-center text-slate-600" x-show="!cur.photos.length"><i class="fa-solid fa-image text-5xl"></i></div>
                        <template x-if="cur.photos.length > 1">
                            <div>
                                <button @click="prev()" class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/50 hover:bg-black/80 text-white border-none cursor-pointer flex items-center justify-center"><i class="fa-solid fa-chevron-left"></i></button>
                                <button @click="next()" class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/50 hover:bg-black/80 text-white border-none cursor-pointer flex items-center justify-center"><i class="fa-solid fa-chevron-right"></i></button>
                                <span class="absolute top-3 left-3 bg-black/60 text-white text-[11px] font-mono font-black px-2.5 py-1 rounded-full"><span x-text="slide + 1"></span> / <span x-text="cur.photos.length"></span></span>
                            </div>
                        </template>
                    </div>
                    {{-- Info --}}
                    <div class="w-full md:w-[40%] bg-white flex flex-col h-1/2 md:h-full">
                        <div class="p-5 sm:p-6 overflow-y-auto flex-1">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-[9px] font-black uppercase tracking-widest px-2 py-0.5 rounded bg-amber-500 text-white">Coordinación</span>
                                <button @click="close()" class="text-slate-400 hover:text-slate-700 text-[11px] font-black uppercase tracking-wider bg-transparent border-none cursor-pointer">Cerrar <i class="fa-solid fa-xmark text-red-500"></i></button>
                            </div>
                            <h3 class="text-slate-900 font-black text-lg leading-snug m-0" x-text="cur.title"></h3>
                            <div class="mt-2 text-[11px] font-bold text-slate-500"><i class="fa-regular fa-calendar-check text-amber-500 mr-1"></i><span x-text="cur.date"></span></div>
                            <p class="text-slate-600 text-xs font-medium leading-relaxed mt-3 bg-slate-50 border border-slate-100 rounded-xl p-3" x-text="cur.description"></p>

                            {{-- Difusión de la coordinación en redes sociales --}}
                            <x-video-gallery-live items="cur.videos" heading="Video de la coordinación" />
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    {{-- LIGHTBOX --}}
    <div x-show="lightbox" x-cloak @click="lightbox = false" @keydown.escape.window="lightbox = false" class="fixed inset-0 z-[200] bg-black/95 flex items-center justify-center p-4" style="display:none;">
        <img :src="cur ? cur.photos[slide] : ''" class="max-w-full max-h-full object-contain">
        <button @click="lightbox = false" class="absolute top-5 right-5 w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 text-white border-none cursor-pointer flex items-center justify-center"><i class="fa-solid fa-xmark text-lg"></i></button>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('coordinacionesModule', (items) => ({
                items,
                open: false,
                cur: null,
                slide: 0,
                timer: null,
                lightbox: false,
                show(c) {
                    this.cur = c;
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
                    if (this.cur && this.cur.photos.length > 1) {
                        this.timer = setInterval(() => this.next(), 5000);
                    }
                },
                stopAuto() { clearInterval(this.timer); },
                next() { if (this.cur) this.slide = (this.slide + 1) % this.cur.photos.length; },
                prev() { if (this.cur) this.slide = (this.slide - 1 + this.cur.photos.length) % this.cur.photos.length; },
            }));
        });
    </script>
</section>
