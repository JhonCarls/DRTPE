{{-- ── CRONOLOGÍA OPERATIVA E HISTORIAL ──────────────────────── --}}
<div class="band-slate band-top-red relative">
    <section class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 py-16" x-data="{ limit: 10 }">

        {{-- Encabezado de la sección --}}
        <div class="mb-12">
            <div class="inline-flex items-center gap-3 bg-white border border-slate-200 shadow-sm rounded-2xl px-6 py-4">
                <div class="w-9 h-9 bg-red-600 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-timeline text-white text-sm"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-900 m-0">Cronología Operativa</h2>
                    <p class="text-slate-500 text-[11px] mt-0.5 font-medium m-0">Historial de cumplimiento de metas institucionales</p>
                </div>
            </div>
        </div>

        {{-- Contenedor de la lista de actividades --}}
        <div class="space-y-10">
        @if(isset($actividades))
            @foreach($actividades as $aIdx => $actividad)
                @if($actividad->subEvents->count() > 0)
                    @php
                        $latestSub = $actividad->subEvents->first();
                        $restSub   = $actividad->subEvents->skip(1)->values();
                    @endphp
                    
                    <article id="actividad-{{ $aIdx }}"
                             x-show="{{ $aIdx }} < limit"
                             x-transition.opacity.duration.500ms
                             style="display: {{ $aIdx < 10 ? 'block' : 'none' }}">

                        {{-- Cabecera de la Actividad Madre --}}
                        <div class="activity-header p-5 shadow-xl mb-0">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 relative z-10">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-amber-400/20 border border-amber-400/30 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-folder-open text-amber-400 text-sm"></i>
                                    </div>
                                    <h3 class="text-base sm:text-lg font-black text-white leading-snug">{{ $actividad->description }}</h3>
                                </div>
                                <div class="flex items-center gap-2 flex-wrap sm:flex-nowrap flex-shrink-0">
                                    <span class="bg-amber-400/18 border border-amber-400/30 text-amber-300 text-[9px] font-black px-3 py-1.5 rounded-lg uppercase tracking-widest">PP: {{ $actividad->category->pp_code ?? '000' }}</span>
                                    <span class="bg-white/10 border border-white/15 text-blue-200 text-[9px] font-bold px-3 py-1.5 rounded-lg">{{ $actividad->subEvents->count() }} {{ $actividad->subEvents->count() === 1 ? 'registro' : 'registros' }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Riel de la Línea de Tiempo --}}
                        <div class="relative timeline-rail ml-5 sm:ml-8 pl-6 sm:pl-10 space-y-5 pt-5 pb-3"
                             x-data="{ expanded: false }" 
                             id="timeline-section-{{ $aIdx }}">

                            {{-- REGISTRO MÁS RECIENTE (Siempre visible) --}}
                            <div id="subevent-{{ $latestSub->id }}"
                                 data-activity-idx="{{ $aIdx }}" 
                                 data-is-latest="1"
                                 class="relative reporte-wrapper group">
                                <div class="timeline-node"></div>
                                <div class="subevent-card">
                                    <div class="bg-gradient-to-r from-red-600 to-red-700 px-5 py-2 flex items-center gap-2">
                                        <i class="fa-solid fa-star text-amber-300 text-xs"></i>
                                        <span class="text-white text-[10px] font-black uppercase tracking-widest">Registro más reciente</span>
                                        <div class="ml-auto text-white/60 text-[10px] font-medium">{{ \Carbon\Carbon::parse($latestSub->event_date)->format('d M. Y') }}</div>
                                    </div>
                                    <div class="p-5 sm:p-7">
                                        <div class="flex flex-wrap items-center gap-3 mb-4">
                                            <span class="text-xs font-bold text-slate-600 bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200"><i class="fa-regular fa-calendar text-red-600 mr-1"></i>{{ \Carbon\Carbon::parse($latestSub->event_date)->format('d M. Y') }}</span>
                                            <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-200"><i class="fa-solid fa-users mr-1"></i>{{ $latestSub->attendees_count }} Asistentes</span>
                                        </div>
                                        <h4 class="text-xl sm:text-2xl font-black text-slate-900 mb-4 leading-tight">{{ $latestSub->report_title }}</h4>
                                        
                                        @if($latestSub->comment)
                                            <div class="bg-slate-50 border-l-4 border-slate-300 rounded-r-xl p-4 mb-5">
                                                <p class="text-slate-700 text-sm leading-relaxed font-medium">{{ $latestSub->comment }}</p>
                                            </div>
                                        @endif

                                        {{-- Galería del evento más reciente --}}
                                        @if(isset($latestSub->photos_sorted) && count($latestSub->photos_sorted) > 0)
                                            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200">
                                                <div class="grid grid-cols-2 gap-2 sm:gap-3 galeria-fotos">
                                                    @foreach($latestSub->photos_sorted as $pi => $foto)
                                                        <div class="foto-item relative overflow-hidden bg-slate-200 rounded-xl {{ $pi >= 4 ? 'foto-extra' : '' }} border-2 border-white shadow-sm">
                                                            <img src="{{ asset('storage/'.$foto) }}" class="foto-galeria w-full h-36 sm:h-52 object-cover" loading="lazy">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @if(count($latestSub->photos_sorted) > 4)
                                                    <button type="button" class="btn-mostrar-mas mt-3 w-full py-3 bg-white border border-slate-200 text-slate-600 text-xs font-bold uppercase rounded-xl flex items-center justify-center gap-2 shadow-sm hover:bg-slate-50 transition">
                                                        <i class="fa-solid fa-images text-red-500"></i><span>Ver {{ count($latestSub->photos_sorted) - 4 }} fotografías adicionales</span>
                                                    </button>
                                                @endif
                                            </div>
                                        @endif

                                        {{-- Difusión en redes: YouTube, Facebook y TikTok --}}
                                        <x-video-gallery :videos="$latestSub->videoEmbeds()" />
                                    </div>
                                </div>
                            </div>

                            {{-- REGISTROS ANTERIORES (Desplegables) --}}
                            @if($restSub->count() > 0)
                                <button id="expand-toggle-{{ $aIdx }}" @click="expanded = !expanded"
                                        class="w-full py-2.5 flex items-center justify-center gap-2 rounded-xl border text-xs font-bold uppercase tracking-wide transition-all"
                                        :class="expanded ? 'bg-slate-100 border-slate-300 text-slate-600 hover:bg-slate-200' : 'bg-white border-slate-200 text-slate-500 hover:bg-slate-50 hover:text-slate-700'">
                                    <i class="fa-solid transition-transform duration-300" :class="expanded ? 'fa-chevron-up' : 'fa-list-ul'"></i>
                                    <span x-text="expanded ? 'Ocultar registros anteriores' : 'Ver {{ $restSub->count() }} registro(s) anterior(es) de esta actividad'"></span>
                                </button>

                                <div x-show="expanded" x-transition class="space-y-5">
                                    @foreach($restSub as $reporte)
                                        <div id="subevent-{{ $reporte->id }}"
                                             data-activity-idx="{{ $aIdx }}" 
                                             data-is-latest="0"
                                             class="relative reporte-wrapper group">
                                            <div class="timeline-node" style="background:#475569;"></div>
                                            <div class="subevent-card border border-slate-100">
                                                <div class="p-5 sm:p-7">
                                                    <div class="flex flex-wrap items-center gap-3 mb-4">
                                                        <span class="text-xs font-bold text-slate-600 bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200"><i class="fa-regular fa-calendar text-slate-500 mr-1"></i>{{ \Carbon\Carbon::parse($reporte->event_date)->format('d M. Y') }}</span>
                                                        <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-200"><i class="fa-solid fa-users mr-1"></i>{{ $reporte->attendees_count }} Asistentes</span>
                                                    </div>
                                                    <h4 class="text-lg sm:text-xl font-black text-slate-800 mb-4 leading-snug">{{ $reporte->report_title }}</h4>
                                                    
                                                    @if($reporte->comment)
                                                        <div class="bg-slate-50 border-l-4 border-slate-200 rounded-r-xl p-4 mb-5">
                                                            <p class="text-slate-600 text-sm leading-relaxed font-medium">{{ $reporte->comment }}</p>
                                                        </div>
                                                    @endif

                                                    @if(isset($reporte->photos_sorted) && count($reporte->photos_sorted) > 0)
                                                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200">
                                                            <div class="grid grid-cols-2 gap-2 sm:gap-3 galeria-fotos">
                                                                @foreach($reporte->photos_sorted as $pi => $foto)
                                                                    <div class="foto-item relative overflow-hidden bg-slate-200 rounded-xl {{ $pi >= 4 ? 'foto-extra' : '' }} border-2 border-white shadow-sm">
                                                                        <img src="{{ asset('storage/'.$foto) }}" class="foto-galeria w-full h-36 sm:h-52 object-cover" loading="lazy">
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            @if(count($reporte->photos_sorted) > 4)
                                                                <button type="button" class="btn-mostrar-mas mt-3 w-full py-3 bg-white border border-slate-200 text-slate-600 text-xs font-bold uppercase rounded-xl flex items-center justify-center gap-2 hover:bg-slate-50 transition">
                                                                    <i class="fa-solid fa-images text-red-500"></i><span>Ver {{ count($reporte->photos_sorted) - 4 }} fotografías adicionales</span>
                                                                </button>
                                                            @endif
                                                        </div>
                                                    @endif

                                                    {{-- Difusión en redes del registro histórico --}}
                                                    <x-video-gallery :videos="$reporte->videoEmbeds()" />
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </article>
                @endif
            @endforeach
        @endif
        </div>

        {{-- Botón de paginación/carga masiva por JavaScript --}}
        @if(isset($actividades) && count($actividades) > 10)
            <div class="text-center mt-14" x-show="limit < {{ count($actividades) }}">
                <button @click="limit += 10" class="bg-red-600 hover:bg-red-700 text-white font-black text-xs uppercase tracking-widest px-10 py-4 rounded-full border border-red-500/30 shadow-lg hover:-translate-y-0.5 transition-all">
                    <i class="fa-solid fa-plus mr-2"></i> Cargar 10 actividades más
                </button>
            </div>
        @endif
        
    </section>
</div>