@extends('layouts.portal')

@section('content')
{{--
    Página pública de una sede desconcentrada.

    Sigue el mismo lenguaje visual que la portada: bandas de color, tarjetas
    blancas redondeadas y la cronología con riel y nodos. Reutiliza las clases
    que ya define partials/head.blade.php (band-*, eyebrow, sketch-underline,
    card-hover, timeline-rail, subevent-card, galeria-fotos…), de modo que no
    hace falta CSS propio ni cargar fuentes adicionales.

    Las actividades se renderizan EN SERVIDOR, igual que partials/cronologia.
    Alpine solo decide cuáles se ven y en qué orden: así las galerías y los
    reproductores de video son HTML real y funcionan con el visor compartido
    (partials/galeria-js) y con public/js/video-player.js.
--}}

@php
    // Colores y rótulos por tipo de intervención (mismos que usa la intranet).
    $tipos = [
        'feria' => ['label' => 'Feria Laboral',  'icon' => 'fa-store',            'strip' => 'from-red-600 to-red-700',        'chip' => 'bg-red-50 text-red-700 border-red-200'],
        'capacitacion' => ['label' => 'Capacitación', 'icon' => 'fa-chalkboard-user', 'strip' => 'from-indigo-600 to-indigo-700', 'chip' => 'bg-indigo-50 text-indigo-700 border-indigo-200'],
        'asesoria' => ['label' => 'Asesoría',    'icon' => 'fa-handshake-angle',  'strip' => 'from-emerald-600 to-emerald-700', 'chip' => 'bg-emerald-50 text-emerald-700 border-emerald-200'],
    ];
@endphp

<div class="bg-[#f8fafc]">

    {{-- ══════════════ PORTADA DE LA SEDE ══════════════ --}}
    <section class="relative isolate max-w-6xl mx-auto px-4 sm:px-6 lg:px-10 py-12 space-y-8">

        {{-- Adornos pastel, como en la portada --}}
        <div class="orn-layer" style="z-index:-10" aria-hidden="true">
            <span class="orn-blob rose orn-drift" style="top:-2.5rem; left:-4rem;"></span>
            <span class="orn-blob sky orn-drift" style="top:5rem; right:-4.5rem; animation-delay:-5s;"></span>
            <span class="orn-blob mint orn-drift" style="bottom:3rem; left:6%; animation-delay:-9s;"></span>
        </div>

        {{-- Banner institucional de la sede --}}
        <div data-reveal class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-red-600 via-red-700 to-red-800 p-8 sm:p-14 text-center shadow-xl">
            <div class="pointer-events-none absolute -top-24 -right-16 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-28 -left-16 w-80 h-80 bg-black/15 rounded-full blur-3xl"></div>
            <i class="fa-solid fa-star orn-spark" style="top:20px; left:26px; font-size:9px; color:rgba(255,255,255,.5)"></i>
            <i class="fa-solid fa-plus orn-spark" style="top:38px; right:34px; font-size:12px; color:rgba(255,255,255,.35)"></i>

            <span class="relative inline-flex items-center gap-2 text-red-100 font-bold text-[11px] sm:text-xs uppercase tracking-[0.25em] mb-3">
                <i class="fa-solid fa-map-location-dot"></i> Zona Desconcentrada · DRTPE Puno
            </span>
            <h1 class="relative text-3xl sm:text-5xl font-black text-white tracking-tight uppercase leading-tight m-0">
                {{ $sedeName }}
            </h1>
            <p class="relative text-red-100/90 text-sm sm:text-base font-medium max-w-2xl mx-auto mt-4 m-0">
                Actividades operativas, evidencia fotográfica y comunicados oficiales de la
                jurisdicción de {{ ucfirst($slug) }}.
            </p>
            <div class="relative mx-auto mt-5 flex items-center justify-center gap-2">
                <span class="h-1.5 w-10 rounded-full bg-white/50"></span>
                <span class="h-2 w-2 rounded-full" style="background:#f8d3e0"></span>
                <span class="h-2 w-2 rounded-full" style="background:#d3e8ff"></span>
                <span class="h-2 w-2 rounded-full" style="background:#c8ecdc"></span>
                <span class="h-1.5 w-10 rounded-full bg-white/50"></span>
            </div>
        </div>

    </section>

    {{-- ══════════════ COMUNICADOS DE LA SEDE ══════════════ --}}
    {{-- Franja completa a lo ancho con el visor grande del documento: el afiche
         o el PDF se leen dentro de la propia página, sin descargar nada. Solo
         aparecen los comunicados de ESTA sede (los institucionales tienen su
         propio apartado en la portada). --}}
    @if($mappedAnnouncements->count() > 0)
    <div class="band-top-amber bg-gradient-to-br from-slate-900 via-slate-900 to-slate-950 py-14"
         x-data="{
             i: 0,
             n: {{ $mappedAnnouncements->count() }},
             reloj: null,
             init() { this.arrancar(); },
             arrancar() {
                 if (this.n <= 1) return;
                 clearInterval(this.reloj);
                 this.reloj = setInterval(() => { this.i = (this.i + 1) % this.n; }, 6000);
             },
             sig()  { this.i = (this.i + 1) % this.n; this.arrancar(); },
             ant()  { this.i = (this.i - 1 + this.n) % this.n; this.arrancar(); },
             parar() { clearInterval(this.reloj); }
         }"
         @mouseenter="parar()" @mouseleave="arrancar()">

        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-10">

            {{-- Encabezado del tablón --}}
            <div class="flex items-center justify-between gap-3 mb-6">
                <div class="flex items-center gap-3">
                    <span class="w-2.5 h-2.5 rounded-full bg-red-500 animate-pulse shrink-0"></span>
                    <h2 class="text-sm font-black text-white uppercase tracking-widest m-0 flex items-center gap-2">
                        <i class="fa-solid fa-bullhorn text-red-500"></i> Comunicados Oficiales de {{ $sedeName }}
                    </h2>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-[11px] font-mono font-black text-slate-200 bg-black/40 px-3 py-1 rounded-lg border border-white/10">
                        <span x-text="i + 1"></span> / {{ $mappedAnnouncements->count() }}
                    </span>
                    @if($mappedAnnouncements->count() > 1)
                        <div class="flex gap-1.5">
                            <button type="button" @click="ant()" class="w-7 h-7 bg-white/10 hover:bg-white/20 text-white border-none rounded-lg cursor-pointer flex items-center justify-center transition"><i class="fa-solid fa-chevron-left text-[11px]"></i></button>
                            <button type="button" @click="sig()" class="w-7 h-7 bg-white/10 hover:bg-white/20 text-white border-none rounded-lg cursor-pointer flex items-center justify-center transition"><i class="fa-solid fa-chevron-right text-[11px]"></i></button>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Carril de ALTURA FIJA (anti-CLS): los slides van en posición absoluta
                 y hacen fundido cruzado, así el cambio no empuja ni salta la página. --}}
            <div class="relative h-[620px] sm:h-[460px] md:h-[400px]">
                @foreach($mappedAnnouncements as $idx => $ann)
                    <div class="absolute inset-0 flex flex-col md:flex-row items-stretch gap-6"
                         x-show="i === {{ $idx }}"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                         style="display: {{ $idx === 0 ? 'flex' : 'none' }}">

                        {{-- Visor grande: la imagen o el PDF se ven aquí mismo --}}
                        @if($ann['file_url'])
                            <div class="w-full md:w-[45%] shrink-0 h-52 sm:h-64 md:h-full rounded-2xl overflow-hidden bg-slate-950 border border-white/10 relative">
                                @if($ann['is_image'])
                                    <img src="{{ $ann['file_url'] }}" loading="lazy" decoding="async"
                                         class="w-full h-full object-contain bg-slate-950"
                                         alt="Comunicado: {{ $ann['title'] }}">
                                @else
                                    <iframe src="{{ $ann['file_url'] }}#toolbar=0&navpanes=0&scrollbar=0"
                                            class="w-full h-full border-none bg-white" loading="lazy"
                                            title="Documento del comunicado"></iframe>
                                @endif
                                <a href="{{ $ann['file_url'] }}" target="_blank" rel="noopener"
                                   class="absolute bottom-3 right-3 z-10 inline-flex items-center gap-1.5 bg-black/70 hover:bg-black text-white text-[10px] font-black uppercase tracking-wider px-3 py-1.5 rounded-lg backdrop-blur-sm border border-white/10 transition decoration-none">
                                    <i class="fa-solid fa-expand"></i> Ampliar
                                </a>
                            </div>
                        @endif

                        {{-- Texto y adjuntos (se desplaza dentro de la altura fija) --}}
                        <div class="flex-1 min-w-0 flex flex-col justify-between gap-4 overflow-y-auto custom-scrollbar pr-1">
                            <div class="space-y-3">
                                <div class="flex flex-wrap items-center gap-x-3 gap-y-1.5 text-[11px] font-mono font-bold">
                                    <span class="text-[9px] font-black uppercase tracking-widest px-2.5 py-1 rounded-md {{ $ann['is_urgent'] ? 'bg-red-600 text-white animate-pulse' : 'bg-red-500/15 text-red-300 border border-red-500/25' }}">
                                        {{ $ann['is_urgent'] ? 'Alerta Urgente' : 'Comunicado Oficial' }}
                                    </span>
                                    <span class="text-slate-400">Vigencia:
                                        <span class="text-slate-200">{{ $ann['fecha_publicacion'] }}</span> —
                                        <span class="text-amber-400">{{ $ann['fecha_vencimiento'] }}</span>
                                    </span>
                                    @if($ann['file_url'])
                                        <span class="inline-flex items-center gap-1.5 text-[9px] font-black uppercase tracking-wider bg-white/10 border border-white/15 text-slate-200 px-2.5 py-1 rounded-md">
                                            <i class="fa-solid fa-paperclip text-red-400"></i> 1 Matriz
                                            @if($ann['attachments']->count() > 0)
                                                <span class="text-amber-300">+ {{ $ann['attachments']->count() }} {{ $ann['attachments']->count() === 1 ? 'Anexo' : 'Anexos' }}</span>
                                            @endif
                                        </span>
                                    @endif
                                </div>

                                <h3 class="text-lg sm:text-2xl font-black tracking-tight text-white m-0 leading-tight">{{ $ann['title'] }}</h3>

                                @if($ann['content'])
                                    <p class="text-sm text-slate-200 m-0 leading-relaxed text-justify font-medium">{{ $ann['content'] }}</p>
                                @endif

                                @if($ann['attachments']->count() > 0)
                                    <div class="space-y-2.5 pt-3 mt-1 border-t border-white/10">
                                        <p class="text-red-300 text-[11px] font-black uppercase tracking-widest m-0 flex items-center gap-2">
                                            <i class="fa-solid fa-paperclip"></i> Archivos adjuntos / Requisitos
                                            <span class="text-slate-400 font-mono text-[10px] normal-case tracking-normal">({{ $ann['attachments']->count() }})</span>
                                        </p>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                            @foreach($ann['attachments'] as $adj)
                                                <a href="{{ $adj['url'] }}" target="_blank" rel="noopener"
                                                   class="flex items-center gap-2.5 bg-slate-800/60 hover:bg-slate-800 border border-white/10 hover:border-red-500/40 rounded-xl px-3 py-2.5 text-xs font-bold text-slate-200 hover:text-white transition truncate decoration-none">
                                                    <span class="w-8 h-8 bg-red-600/15 rounded-lg flex items-center justify-center shrink-0">
                                                        <i class="fa-solid {{ $adj['is_pdf'] ? 'fa-file-pdf text-red-400' : 'fa-image text-sky-400' }} text-sm"></i>
                                                    </span>
                                                    <span class="truncate flex-1">{{ $adj['label'] }}</span>
                                                    <i class="fa-solid fa-download text-slate-500 text-[11px]"></i>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if($ann['file_url'])
                                <div class="flex items-center justify-between gap-3 pt-3 border-t border-white/10">
                                    <a href="{{ $ann['file_url'] }}" target="_blank" rel="noopener"
                                       class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-500 text-white font-black text-[11px] uppercase tracking-wider py-2.5 px-5 rounded-xl shadow-lg transition decoration-none">
                                        <i class="fa-solid fa-file-arrow-down"></i> Ver / Descargar comunicado
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Paginación por puntos --}}
            @if($mappedAnnouncements->count() > 1)
                <div class="flex justify-center gap-1.5 mt-5">
                    @foreach($mappedAnnouncements as $idx => $c)
                        <button type="button" @click="i = {{ $idx }}; arrancar()"
                                class="h-2 rounded-full transition-all duration-300 border-none cursor-pointer"
                                :class="i === {{ $idx }} ? 'bg-amber-400 w-5 shadow-[0_0_8px_#f59e0b]' : 'bg-white/25 w-2'"></button>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
    @endif

    {{-- ══════════════ CRONOLOGÍA DE ACTIVIDADES ══════════════ --}}
    <div class="band-slate band-top-red relative">
        <section class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 py-16"
                 x-data="sedeCronologia({{ Js::from($mappedActivities) }})">

            {{-- Encabezado de la sección --}}
            <div class="mb-8">
                <div class="inline-flex items-center gap-3 bg-white border border-slate-200 shadow-sm rounded-2xl px-6 py-4">
                    <div class="w-9 h-9 bg-red-600 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-timeline text-white text-sm"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-slate-900 m-0">Cronología Operativa</h2>
                        <p class="text-slate-500 text-[11px] mt-0.5 font-medium m-0">Historial de intervenciones de {{ $sedeName }}</p>
                    </div>
                </div>
            </div>

            @if($activities->count() > 0)
                {{-- ── Buscador y filtros ── --}}
                <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm space-y-4 mb-10">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                        <div class="md:col-span-8 relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400"><i class="fa-solid fa-magnifying-glass text-sm"></i></span>
                            <input type="text" x-model="q"
                                   placeholder="Buscar por título o descripción (tolera errores de tecleo)…"
                                   class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 pl-11 text-sm font-semibold text-slate-800 focus:outline-none focus:border-red-500 transition">
                        </div>
                        <div class="md:col-span-4">
                            <select x-model="orden"
                                    class="w-full bg-white border border-slate-200 rounded-xl py-3 px-3 text-sm font-black text-slate-700 focus:outline-none focus:border-red-500 cursor-pointer">
                                <option value="recent">Más recientes primero</option>
                                <option value="oldest">Más antiguas primero</option>
                                <option value="attendees">Mayor asistencia</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 sm:items-center">
                        <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest w-24 shrink-0"><i class="fa-solid fa-layer-group mr-1"></i> Tipo:</span>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="opt in tipos" :key="opt.value">
                                <button type="button" @click="tipo = opt.value; limite = 10"
                                        :class="tipo === opt.value ? 'bg-red-600 text-white border-red-600' : 'bg-slate-50 hover:bg-slate-100 text-slate-600 border-slate-200'"
                                        class="px-3.5 py-1.5 rounded-xl text-[11px] font-black uppercase tracking-wider border transition cursor-pointer"
                                        x-text="opt.label"></button>
                            </template>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 sm:items-center pt-3 border-t border-slate-100">
                        <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest w-24 shrink-0"><i class="fa-regular fa-calendar-days mr-1"></i> Periodo:</span>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="opt in periodos" :key="opt.value">
                                <button type="button" @click="periodo = opt.value; limite = 10"
                                        :class="periodo === opt.value ? 'bg-slate-900 text-white border-slate-900' : 'bg-slate-50 hover:bg-slate-100 text-slate-600 border-slate-200'"
                                        class="px-3.5 py-1.5 rounded-xl text-[11px] font-black uppercase tracking-wider border transition cursor-pointer"
                                        x-text="opt.label"></button>
                            </template>
                        </div>
                    </div>

                    <p class="text-[11px] font-bold text-slate-400 m-0 pt-1">
                        <span x-text="total"></span> de {{ $activities->count() }} intervención(es)
                    </p>
                </div>

                {{-- ── Riel de la línea de tiempo ── --}}
                <div class="relative timeline-rail ml-5 sm:ml-8 pl-6 sm:pl-10 pt-2 pb-3 flex flex-col gap-8">
                    @foreach($activities as $i => $act)
                        @php
                            $meta = $tipos[$act->type] ?? ['label' => 'Actividad', 'icon' => 'fa-circle-dot', 'strip' => 'from-slate-600 to-slate-700', 'chip' => 'bg-slate-100 text-slate-700 border-slate-200'];
                            $fotos = $act->photos ?? [];
                            $videos = $act->videoEmbeds();
                        @endphp

                        <article class="relative reporte-wrapper group"
                                 x-show="posicion({{ $i }}) !== -1"
                                 :style="{ order: posicion({{ $i }}) }"
                                 style="display: {{ $i < 10 ? 'block' : 'none' }}">

                            <div class="timeline-node"></div>

                            <div class="subevent-card">
                                {{-- Franja de color según el tipo de intervención --}}
                                <div class="bg-gradient-to-r {{ $meta['strip'] }} px-5 py-2 flex items-center gap-2">
                                    <i class="fa-solid {{ $meta['icon'] }} text-white/80 text-xs"></i>
                                    <span class="text-white text-[10px] font-black uppercase tracking-widest">{{ $meta['label'] }}</span>
                                    <span class="ml-auto text-white/60 text-[10px] font-medium">{{ $act->created_at->format('d M. Y') }}</span>
                                </div>

                                <div class="p-5 sm:p-7">
                                    {{-- Distintivos --}}
                                    <div class="flex flex-wrap items-center gap-2.5 mb-4">
                                        <span class="text-xs font-bold text-slate-600 bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200">
                                            <i class="fa-regular fa-calendar text-red-600 mr-1"></i>{{ $act->created_at->format('d M. Y') }}
                                        </span>
                                        {{-- El número de atendidos es opcional en el formulario:
                                             si no se registró, no se muestra "0 atendidos". --}}
                                        @if((int) $act->attendees_count > 0)
                                            <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-200">
                                                <i class="fa-solid fa-users mr-1"></i>{{ number_format((int) $act->attendees_count) }} atendidos
                                            </span>
                                        @endif
                                        @if(count($fotos) > 0)
                                            <span class="text-xs font-bold text-slate-600 bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200">
                                                <i class="fa-solid fa-camera text-slate-500 mr-1"></i>{{ count($fotos) }}
                                            </span>
                                        @endif
                                        @if(count($videos) > 0)
                                            <span class="text-xs font-bold text-red-700 bg-red-50 px-3 py-1.5 rounded-lg border border-red-200">
                                                <i class="fa-solid fa-clapperboard mr-1"></i>{{ count($videos) }} video{{ count($videos) === 1 ? '' : 's' }}
                                            </span>
                                        @endif
                                    </div>

                                    <h3 class="text-xl sm:text-2xl font-black text-slate-900 mb-4 leading-tight m-0">{{ $act->title }}</h3>

                                    @if($act->description)
                                        <div class="bg-slate-50 border-l-4 border-slate-300 rounded-r-xl p-4 mb-5">
                                            <p class="text-slate-700 text-sm leading-relaxed font-medium m-0 whitespace-pre-line">{{ $act->description }}</p>
                                        </div>
                                    @endif

                                    {{-- Galería fotográfica: mismo marcado que la portada, así
                                         el visor compartido de partials/galeria-js la reconoce. --}}
                                    @if(count($fotos) > 0)
                                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200">
                                            <div class="grid grid-cols-2 gap-2 sm:gap-3 galeria-fotos">
                                                @foreach($fotos as $pi => $foto)
                                                    <div class="foto-item relative overflow-hidden bg-slate-200 rounded-xl {{ $pi >= 4 ? 'foto-extra' : '' }} border-2 border-white shadow-sm">
                                                        <img src="{{ asset('storage/'.$foto) }}"
                                                             class="foto-galeria w-full h-36 sm:h-52 object-cover"
                                                             loading="lazy" decoding="async"
                                                             alt="Evidencia de {{ $act->title }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                            @if(count($fotos) > 4)
                                                @php $extras = count($fotos) - 4; @endphp
                                                <button type="button" class="btn-mostrar-mas mt-3 w-full py-3 bg-white border border-slate-200 text-slate-600 text-xs font-bold uppercase rounded-xl flex items-center justify-center gap-2 shadow-sm hover:bg-slate-50 transition cursor-pointer">
                                                    <i class="fa-solid fa-images text-red-500"></i><span>Ver {{ $extras }} {{ $extras === 1 ? 'fotografía adicional' : 'fotografías adicionales' }}</span>
                                                </button>
                                            @endif
                                        </div>
                                    @endif

                                    {{-- Difusión en redes: YouTube, Facebook y TikTok.
                                         Server-side, con data-embed, igual que en la portada. --}}
                                    <x-video-gallery :videos="$videos" heading="Difusión de la actividad" />
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- Sin resultados tras filtrar --}}
                <div class="text-center py-14" x-show="total === 0" x-cloak>
                    <i class="fa-regular fa-folder-open text-4xl text-slate-300 mb-3 block"></i>
                    <p class="text-slate-500 text-sm font-bold m-0">Ninguna intervención coincide con los filtros.</p>
                    <button type="button" @click="limpiar()"
                            class="mt-4 bg-white hover:bg-slate-50 text-slate-700 font-black text-xs uppercase tracking-wider py-2.5 px-6 rounded-xl border border-slate-200 shadow-sm transition cursor-pointer">
                        Quitar filtros
                    </button>
                </div>

                {{-- Cargar más --}}
                <div class="text-center mt-14" x-show="total > limite" x-cloak>
                    <button type="button" @click="limite += 10"
                            class="bg-red-600 hover:bg-red-700 text-white font-black text-xs uppercase tracking-widest px-10 py-4 rounded-full border border-red-500/30 shadow-lg hover:-translate-y-0.5 transition-all cursor-pointer">
                        <i class="fa-solid fa-plus mr-2"></i> Cargar 10 actividades más
                    </button>
                </div>
            @else
                {{-- Sede sin registros todavía --}}
                <div class="bg-white border border-slate-200 rounded-3xl p-12 text-center shadow-sm">
                    <i class="fa-regular fa-folder-open text-5xl text-slate-300 mb-4 block"></i>
                    <h3 class="text-lg font-black text-slate-800 m-0">Aún no hay actividades publicadas</h3>
                    <p class="text-slate-500 text-sm font-medium mt-2 m-0">
                        {{ $sedeName }} no ha registrado intervenciones todavía. Vuelva a consultar más adelante.
                    </p>
                </div>
            @endif
        </section>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        /**
         * Filtra y ordena la cronología de la sede.
         *
         * Los artículos ya están en el DOM (renderizados por Blade); este
         * componente solo calcula, para cada índice, si debe verse y en qué
         * posición. El orden se aplica con la propiedad CSS 'order' del
         * contenedor flex, de modo que no hace falta mover nodos.
         */
        Alpine.data('sedeCronologia', (items) => ({
            items: items,
            q: '',
            tipo: 'all',
            periodo: 'all',
            orden: 'recent',
            limite: 10,

            tipos: [
                { label: 'Todas', value: 'all' },
                { label: 'Ferias', value: 'feria' },
                { label: 'Capacitaciones', value: 'capacitacion' },
                { label: 'Asesorías', value: 'asesoria' },
            ],
            periodos: [
                { label: 'Todo', value: 'all' },
                { label: 'Últimos 7 días', value: '7days' },
                { label: 'Este mes', value: 'month' },
                { label: 'Este año', value: 'year' },
            ],

            limpiar() {
                this.q = '';
                this.tipo = 'all';
                this.periodo = 'all';
                this.limite = 10;
            },

            // ── Búsqueda tolerante a errores de tecleo ──
            levenshtein(a, b) {
                if (a.length === 0) return b.length;
                if (b.length === 0) return a.length;
                const m = [];
                for (let i = 0; i <= b.length; i++) m[i] = [i];
                for (let j = 0; j <= a.length; j++) m[0][j] = j;
                for (let i = 1; i <= b.length; i++) {
                    for (let j = 1; j <= a.length; j++) {
                        m[i][j] = (b.charAt(i - 1) === a.charAt(j - 1))
                            ? m[i - 1][j - 1]
                            : Math.min(m[i - 1][j - 1] + 1, m[i][j - 1] + 1, m[i - 1][j] + 1);
                    }
                }
                return m[b.length][a.length];
            },
            coincide(texto, consulta) {
                if (!consulta) return true;
                const norm = (s) => s.toLowerCase().normalize('NFD').replace(/[̀-ͯ]/g, '');
                const s = norm(texto), c = norm(consulta);
                if (s.includes(c)) return true;
                const palabras = s.split(/\s+/);
                return c.split(/\s+/).every(w =>
                    w.length < 3 ? s.includes(w)
                                 : palabras.some(sw => this.levenshtein(sw, w) <= (w.length <= 4 ? 1 : 2))
                );
            },

            enPeriodo(a) {
                if (this.periodo === 'all') return true;
                const ahora = new Date();
                const f = new Date(a.created_at);
                if (this.periodo === '7days') return (ahora - f) / 86400000 <= 7;
                if (this.periodo === 'month') return f.getMonth() === ahora.getMonth() && f.getFullYear() === ahora.getFullYear();
                if (this.periodo === 'year') return f.getFullYear() === ahora.getFullYear();
                return true;
            },

            get lista() {
                let r = this.items.map((a, i) => ({ a: a, i: i }));

                if (this.q.trim() !== '') {
                    r = r.filter(x => this.coincide(x.a.title + ' ' + x.a.description, this.q));
                }
                if (this.tipo !== 'all') {
                    r = r.filter(x => x.a.intervention_type === this.tipo);
                }
                r = r.filter(x => this.enPeriodo(x.a));

                if (this.orden === 'oldest') {
                    r.sort((x, y) => new Date(x.a.created_at) - new Date(y.a.created_at));
                } else if (this.orden === 'attendees') {
                    r.sort((x, y) => y.a.attendees_count - x.a.attendees_count);
                } else {
                    r.sort((x, y) => new Date(y.a.created_at) - new Date(x.a.created_at));
                }
                return r;
            },

            get total() { return this.lista.length; },

            /** Posición visible del artículo, o -1 si está filtrado o fuera del límite. */
            posicion(i) {
                const k = this.lista.findIndex(x => x.i === i);
                return (k === -1 || k >= this.limite) ? -1 : k;
            },
        }));
    });
</script>
@endpush
@endsection
