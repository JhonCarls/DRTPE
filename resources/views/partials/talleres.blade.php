{{-- ====================================================================== --}}
{{-- ── SUB-MÓDULO DE TALLERES, CAPACITACIONES Y COORDINACIONES (LIGHT) ── --}}
{{-- ====================================================================== --}}
<div class="space-y-16 py-6 w-full">

    {{-- ════════════════════════════════════════════════════════════ --}}
    {{-- SECCIÓN A: CAPACITACIONES POR HACER / PRÓXIMOS TALLERES      --}}
    {{-- ════════════════════════════════════════════════════════════ --}}
    <section id="seccion-por-hacer" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-10 scroll-mt-24">
        <div class="flex items-center gap-4 mb-8">
            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-sm flex-shrink-0">
                <i class="fa-solid fa-calendar-plus text-white text-sm"></i>
            </div>
            <div>
                <h2 class="text-xl font-black text-slate-900 m-0 tracking-tight">Capacitaciones por Hacer</h2>
                <p class="text-slate-400 text-xs font-bold m-0">Próximos talleres programados para la inserción y orientación laboral</p>
            </div>
            <div class="flex-1 h-px bg-slate-200 hidden sm:block"></div>
        </div>

        @if(isset($capacitacionesPorHacer) && $capacitacionesPorHacer->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($capacitacionesPorHacer as $taller)
                    <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between border-l-4 border-l-indigo-600 relative overflow-hidden group">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="bg-indigo-50 border border-indigo-100 text-indigo-700 text-[9px] font-black px-2 py-0.5 rounded uppercase tracking-wider">Inscripciones Abiertas</span>
                                <div class="text-slate-400 text-xs"><i class="fa-regular fa-clock"></i> {{ $taller->time ?? '09:00 AM' }}</div>
                            </div>
                            <h3 class="text-base font-black text-slate-900 leading-snug m-0 group-hover:text-indigo-600 transition-colors line-clamp-2 h-12">{{ $taller->title }}</h3>
                            <p class="text-slate-500 text-xs leading-relaxed font-medium line-clamp-3 m-0 text-justify">{{ $taller->description }}</p>
                        </div>

                        <div class="mt-4 pt-4 border-t border-slate-100 space-y-2 text-xs font-bold text-slate-600">
                            <div class="flex items-center gap-2"><i class="fa-solid fa-location-dot text-indigo-500 w-4 text-center"></i> {{ $taller->location }}</div>
                            <div class="flex items-center gap-2"><i class="fa-solid fa-users text-indigo-500 w-4 text-center"></i> Dirigido a: <span class="text-slate-500 font-medium truncate">{{ $taller->target_audience ?? 'Público General' }}</span></div>
                            <div class="flex items-center justify-between pt-2">
                                <span class="text-[11px] font-black text-slate-900 bg-slate-100 border border-slate-200 px-2 py-0.5 rounded">
                                    <i class="fa-regular fa-calendar text-indigo-600 mr-1"></i>{{ \Carbon\Carbon::parse($taller->scheduled_at)->format('d/m/Y') }}
                                </span>
                                <a href="#" class="text-[10px] font-black text-indigo-600 uppercase tracking-wider hover:text-indigo-700 flex items-center gap-1 decoration-none">Inscribirme <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center shadow-sm max-w-xl mx-auto">
                <div class="w-12 h-12 bg-slate-50 border border-slate-200 rounded-xl flex items-center justify-center mx-auto mb-3 text-slate-400">
                    <i class="fa-solid fa-graduation-cap text-lg"></i>
                </div>
                <h4 class="text-sm font-black text-slate-800 m-0">No hay capacitaciones pendientes</h4>
                <p class="text-xs text-slate-400 font-medium mt-1 m-0">Todos los talleres programados para este período han sido ejecutados con éxito.</p>
            </div>
        @endif
    </section>

    {{-- ════════════════════════════════════════════════════════════ --}}
    {{-- SECCIÓN B: CAPACITACIONES HECHAS / EJECUTADAS                --}}
    {{-- ════════════════════════════════════════════════════════════ --}}
    <section id="seccion-hechas" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-10 scroll-mt-24">
        <div class="flex items-center gap-4 mb-8">
            <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center shadow-sm flex-shrink-0">
                <i class="fa-solid fa-user-graduate text-white text-sm"></i>
            </div>
            <div>
                <h2 class="text-xl font-black text-slate-900 m-0 tracking-tight">Capacitaciones Hechas</h2>
                <p class="text-slate-400 text-xs font-bold m-0">Historial de talleres y seminarios concluidos con métricas de impacto</p>
            </div>
            <div class="flex-1 h-px bg-slate-200 hidden sm:block"></div>
        </div>

        @if(isset($capacitacionesHechas) && $capacitacionesHechas->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($capacitacionesHechas as $taller)
                    <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between border-l-4 border-l-emerald-500 group">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="bg-emerald-50 border border-emerald-100 text-emerald-700 text-[9px] font-black px-2 py-0.5 rounded uppercase tracking-wider"><i class="fa-solid fa-circle-check mr-1"></i>Ejecutado</span>
                                <span class="text-slate-400 text-xs font-mono font-bold">FOLIO #{{ $taller->id }}</span>
                            </div>
                            <h3 class="text-base font-black text-slate-900 leading-snug m-0 group-hover:text-emerald-600 transition-colors line-clamp-2 h-12">{{ $taller->title }}</h3>
                            <p class="text-slate-500 text-xs leading-relaxed font-medium line-clamp-3 m-0 text-justify">{{ $taller->description }}</p>
                        </div>

                        <div class="mt-4 pt-4 border-t border-slate-100 grid grid-cols-2 gap-2 text-xs font-bold text-slate-600 items-center">
                            <div class="text-slate-500 font-medium"><i class="fa-solid fa-users text-emerald-500 mr-1.5 w-4 text-center"></i><span class="text-slate-900 font-black">{{ number_format($taller->certified_count ?? 0) }}</span> certificados</div>
                            <div class="text-right">
                                <span class="inline-block text-[11px] font-black text-slate-900 bg-slate-100 border border-slate-200 px-2 py-0.5 rounded">
                                    {{ \Carbon\Carbon::parse($taller->executed_at)->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center shadow-sm max-w-xl mx-auto">
                <div class="w-12 h-12 bg-slate-50 border border-slate-200 rounded-xl flex items-center justify-center mx-auto mb-3 text-slate-400">
                    <i class="fa-solid fa-folder-open text-lg"></i>
                </div>
                <h4 class="text-sm font-black text-slate-800 m-0">Sin registros históricos</h4>
                <p class="text-xs text-slate-400 font-medium mt-1 m-0">No se han cargado evidencias físicas de talleres ejecutados en el presente mes fiscal.</p>
            </div>
        @endif
    </section>

    {{-- ════════════════════════════════════════════════════════════ --}}
    {{-- SECCIÓN C: COORDINACIONES HECHAS / MESAS DE TRABAJO          --}}
    {{-- ════════════════════════════════════════════════════════════ --}}
    <section id="seccion-coordinaciones" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-10 scroll-mt-24">
        <div class="flex items-center gap-4 mb-8">
            <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center shadow-sm flex-shrink-0">
                <i class="fa-solid fa-handshake-angle text-white text-sm"></i>
            </div>
            <div>
                <h2 class="text-xl font-black text-slate-900 m-0 tracking-tight">Coordinaciones Hechas</h2>
                <p class="text-slate-400 text-xs font-bold m-0">Alianzas y acuerdos de cooperación interinstitucional sectorial</p>
            </div>
            <div class="flex-1 h-px bg-slate-200 hidden sm:block"></div>
        </div>

        @if(isset($coordinacionesHechas) && $coordinacionesHechas->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($coordinacionesHechas as $coordinacion)
                    <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between border-l-4 border-l-amber-500 group">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="bg-amber-50 border border-amber-200 text-amber-700 text-[9px] font-black px-2 py-0.5 rounded uppercase tracking-wider">Acuerdo Regional</span>
                                <span class="text-slate-400 text-xs font-medium"><i class="fa-solid fa-handshake"></i> Convenio</span>
                            </div>
                            <h3 class="text-base font-black text-slate-900 leading-snug m-0 group-hover:text-amber-600 transition-colors line-clamp-2 h-12">{{ $coordinacion->title }}</h3>
                            <p class="text-slate-500 text-xs leading-relaxed font-medium line-clamp-3 m-0 text-justify">{{ $coordinacion->description }}</p>
                        </div>

                        <div class="mt-4 pt-4 border-t border-slate-100 flex flex-col space-y-2 text-xs font-bold text-slate-600">
                            <div class="flex items-center gap-2 truncate"><i class="fa-solid fa-building text-amber-500 w-4 text-center"></i> Entidad: <span class="text-slate-500 font-medium truncate">{{ $coordinacion->institution_name ?? 'Alianza Sector Privado' }}</span></div>
                            <div class="flex items-center justify-between pt-1">
                                <span class="inline-block text-[11px] font-black text-slate-900 bg-slate-100 border border-slate-200 px-2 py-0.5 rounded">
                                    <i class="fa-regular fa-calendar-check mr-1 text-amber-500"></i>{{ \Carbon\Carbon::parse($coordinacion->signed_at)->format('d/m/Y') }}
                                </span>
                                <span class="text-[10px] text-amber-600 uppercase font-black tracking-wider"><i class="fa-solid fa-circle text-[6px] animate-pulse mr-1"></i>Activo</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center shadow-sm max-w-xl mx-auto">
                <div class="w-12 h-12 bg-slate-50 border border-slate-200 rounded-xl flex items-center justify-center mx-auto mb-3 text-slate-400">
                    <i class="fa-solid fa-briefcase text-lg"></i>
                </div>
                <h4 class="text-sm font-black text-slate-800 m-0">Sin mesas de trabajo registradas</h4>
                <p class="text-xs text-slate-400 font-medium mt-1 m-0">No se han reportado actas de convenios bilaterales en la presente quincena.</p>
            </div>
        @endif
    </section>

</div>