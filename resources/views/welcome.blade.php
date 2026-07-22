<!DOCTYPE html>
<html lang="es">
<head>
    {{-- Meta, Tailwind, AlpineJS, Fuentes y Estilos CSS Globales --}}
    @include('partials.head')
</head>

<body class="antialiased selection:bg-red-700 selection:text-white">

    {{-- 1. Popups / Comunicados Emergentes Institucionales --}}
    @include('partials.popup')

    {{-- 2. Encabezado Oficial (Header) --}}
    @include('partials.header', ['showNavbar' => false])

    {{-- 3. Barra Lateral de Navegación y Accesos Rápidos (Sidebar) --}}
    @include('partials.sidebar')

    {{-- 4. Contenedor Unificado de Contenido Principal --}}
    <div id="main-content">

        {{-- ── SECCIÓN DE SLIDERS HERO (DINÁMICOS) ────────────────── --}}
        <div class="bg-scene-light relative">

            {{-- Slider A: Actividades de Difusión --}}
            @if(isset($difusiones) && $difusiones->count() > 0)
            <section class="relative w-full overflow-hidden clip-top z-30"
                     style="height: clamp(340px, 62vh, 680px); background: rgba(15, 28, 80, .40);"
                     x-data="autoSlider({{ $difusiones->toJson() }}, 5000)">
                <div class="absolute top-5 left-5 z-30 flex items-center gap-3 flex-wrap">
                    <span class="bg-blue-600/85 backdrop-blur-md text-white text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full border border-blue-400/30 shadow-lg">
                        <i class="fa-solid fa-radio mr-1.5"></i> Actividades de Difusión
                    </span>
                    <div class="flex gap-1.5">
                        <template x-for="(item, i) in items" :key="i">
                            <button @click="active = i; progress = 0" 
                                    class="border-none p-0 cursor-pointer"
                                    :class="active === i ? 'slider-dot is-active' : 'slider-dot'"></button>
                        </template>
                    </div>
                </div>
                <template x-for="(item, index) in items" :key="index">
                    <div x-show="active === index"
                         x-transition:enter="transition-opacity duration-700" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                         x-transition:leave="transition-opacity duration-700" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                         class="absolute inset-0 cursor-pointer group" @click="$dispatch('open-modal', { report: item })">
                        <img :src="'{{ asset('storage') }}/' + item.photos[0]" class="w-full h-full object-cover ken-burns" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-blue-950 via-blue-900/30 to-blue-950/10"></div>
                        <div class="absolute left-5 sm:left-12 max-w-2xl" style="bottom: calc(var(--diag) + 2.5rem);">
                            <div class="bg-blue-900/45 backdrop-blur-md border border-blue-400/20 rounded-2xl p-4 sm:p-6">
                                <h2 class="text-xl sm:text-4xl font-black text-white leading-tight m-0" x-text="item.title"></h2>
                                <p class="text-blue-300/80 mt-2 text-xs font-medium flex items-center gap-1.5 m-0"><i class="fa-solid fa-hand-pointer animate-pulse"></i> Presione para ver descripción y galería</p>
                            </div>
                        </div>
                    </div>
                </template>
                <div class="slider-progress-wrap"><div class="slider-progress-fill bg-blue-400 shadow-[0_0_7px_#60a5fa]" :style="'width:' + progress + '%'"></div></div>
            </section>
            @endif

            {{-- Slider B: Eventos Institucionales --}}
            @if(isset($institucionales) && $institucionales->count() > 0)
            <section class="relative w-full overflow-hidden clip-bottom z-20"
                     style="height: clamp(340px, 62vh, 680px); margin-top: calc(-1 * var(--diag)); background: rgba(70, 8, 8, .40);"
                     x-data="autoSlider({{ $institucionales->toJson() }}, 5000)">
                <div class="absolute z-30 flex flex-col items-end gap-2" style="top: calc(var(--diag) + 14px); right: 1.25rem;">
                    <span class="bg-red-600/85 backdrop-blur-md text-white text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full border border-red-400/30 shadow-lg">
                        <i class="fa-solid fa-calendar-star mr-1.5"></i> Eventos Institucionales
                    </span>
                    <div class="flex gap-1.5">
                        <template x-for="(item, i) in items" :key="i">
                            <button @click="active = i; progress = 0" 
                                    class="border-none p-0 cursor-pointer"
                                    :class="active === i ? 'slider-dot is-active' : 'slider-dot'"></button>
                        </template>
                    </div>
                </div>
                <template x-for="(item, index) in items" :key="index">
                    <div x-show="active === index"
                         x-transition:enter="transition-opacity duration-700" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                         x-transition:leave="transition-opacity duration-700" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                         class="absolute inset-0 cursor-pointer group" @click="$dispatch('open-modal', { report: item })">
                        <img :src="'{{ asset('storage') }}/' + item.photos[0]" class="w-full h-full object-cover ken-burns" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-red-950 via-red-900/30 to-red-950/10"></div>
                        <div class="absolute left-5 sm:left-12 max-w-2xl" style="bottom: calc(var(--diag) + 2.5rem);">
                            <div class="bg-red-900/45 backdrop-blur-md border border-red-400/20 rounded-2xl p-4 sm:p-6">
                                <h2 class="text-xl sm:text-4xl font-black text-white leading-tight m-0" x-text="item.title"></h2>
                                <p class="text-red-300/80 mt-2 text-xs font-medium flex items-center gap-1.5 m-0"><i class="fa-solid fa-hand-pointer animate-pulse"></i> Presione para ver descripción y galería</p>
                            </div>
                        </div>
                    </div>
                </template>
                <div class="slider-progress-wrap"><div class="slider-progress-fill bg-red-400 shadow-[0_0_7px_#f87171]" :style="'width:' + progress + '%'"></div></div>
            </section>
            @endif
        </div>

        {{-- ── CAPTURA: TEXTO INSTITUCIONAL FIJO (Evita que el portal quede vacío) ── --}}
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-10 py-12 space-y-8">

            {{-- Banner institucional --}}
            <div data-reveal class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-red-600 via-red-700 to-red-800 p-8 sm:p-14 text-center shadow-xl">
                <div class="pointer-events-none absolute -top-24 -right-16 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-28 -left-16 w-80 h-80 bg-black/15 rounded-full blur-3xl"></div>
                <span class="relative inline-flex items-center gap-2 text-red-100 font-bold text-[11px] sm:text-xs uppercase tracking-[0.25em] mb-3">
                    <i class="fa-solid fa-landmark"></i> Dirección Regional de Trabajo y Promoción del Empleo · Puno
                </span>
                <h1 class="relative text-3xl sm:text-5xl font-black text-white tracking-tight uppercase leading-tight m-0">
                    Portal Informativo y de Transparencia
                </h1>
                <div class="relative mx-auto h-1.5 w-24 bg-white/70 rounded-full mt-5"></div>
            </div>

            {{-- Contenido de bienvenida --}}
            <div data-reveal class="bg-white border border-slate-200 rounded-3xl p-6 sm:p-10 space-y-6 shadow-sm">
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed m-0">
                    Bienvenido al Portal Oficial de Actividades de la Dirección Regional de Trabajo y Promoción del Empleo (DRTPE) de Puno. Este espacio ha sido diseñado para consolidar de manera transparente el acceso a la información institucional, cronogramas operativos y servicios al ciudadano de nuestra región.
                </p>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed m-0">
                    A través de los menús superiores, usted podrá navegar entre las distintas direcciones operativas, revisar los reportes fotográficos de las actividades de difusión descentralizadas, así como informarse sobre los próximos talleres de capacitación orientados a la inserción laboral y el respeto de los derechos fundamentales en el trabajo.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-1">
                    <div class="card-hover flex items-center gap-3 bg-slate-50 border border-slate-200 rounded-2xl px-4 py-4">
                        <div class="icon-tile flex h-11 w-11 items-center justify-center rounded-xl bg-red-100 text-red-600"><i class="fa-solid fa-sitemap"></i></div>
                        <span class="text-slate-800 text-xs sm:text-sm font-bold">Direcciones operativas</span>
                    </div>
                    <div class="card-hover flex items-center gap-3 bg-slate-50 border border-slate-200 rounded-2xl px-4 py-4">
                        <div class="icon-tile flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-blue-600"><i class="fa-solid fa-camera-retro"></i></div>
                        <span class="text-slate-800 text-xs sm:text-sm font-bold">Reportes fotográficos</span>
                    </div>
                    <div class="card-hover flex items-center gap-3 bg-slate-50 border border-slate-200 rounded-2xl px-4 py-4">
                        <div class="icon-tile flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100 text-amber-600"><i class="fa-solid fa-chalkboard-user"></i></div>
                        <span class="text-slate-800 text-xs sm:text-sm font-bold">Talleres y capacitaciones</span>
                    </div>
                </div>
            </div>
        </section>

        {{-- ── ÚLTIMOS REGISTROS FOTOGRÁFICOS ─────────────────────── --}}
        @if(isset($ultimos3) && $ultimos3->count() > 0)
        <div class="band-white band-top-red pt-14 pb-14">
            <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-10">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-11 h-11 bg-red-600 rounded-xl flex items-center justify-center shadow-lg shadow-red-600/25 flex-shrink-0"><i class="fa-solid fa-bolt text-white"></i></div>
                    <div>
                        <span class="eyebrow text-red-600">Actividad reciente</span>
                        <h2 class="text-xl sm:text-2xl font-black text-slate-900 m-0">Últimos Registros</h2>
                        <p class="text-slate-500 text-xs font-medium m-0">Actividades recientes con evidencia fotográfica · clic para ir al registro</p>
                    </div>
                    <div class="flex-1 h-px bg-gradient-to-r from-red-300 to-transparent hidden sm:block"></div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($ultimos3 as $se)
                    <div class="record-card" onclick="scrollToSubEvent('subevent-{{ $se->id }}', {{ $se->activity_index }})">
                        <div class="relative overflow-hidden" style="height: 155px;">
                            <img src="{{ asset('storage/' . $se->cover) }}" class="w-full h-full object-cover transition-transform duration-700 hover:scale-110" loading="lazy" alt="">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent opacity-80"></div>
                            <div class="absolute top-3 left-3"><span class="bg-red-600 text-white text-[9px] font-black px-2 py-1 rounded-md uppercase tracking-wider shadow">{{ $se->category_name }}</span></div>
                            <div class="absolute bottom-3 right-3"><span class="bg-black/40 backdrop-blur-sm text-slate-200 text-[9px] font-bold px-2 py-1 rounded-md border border-white/15"><i class="fa-regular fa-calendar mr-1"></i>{{ \Carbon\Carbon::parse($se->event_date)->format('d/m/Y') }}</span></div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-black text-slate-900 leading-snug line-clamp-2 m-0">{{ $se->report_title }}</h3>
                            <div class="flex items-center justify-between mt-3">
                                <span class="text-[10px] text-slate-500 font-medium"><i class="fa-solid fa-users text-blue-500 mr-1"></i>{{ $se->attendees_count }} asistentes</span>
                                <span class="text-[10px] text-red-600 font-bold flex items-center gap-1">Ver en cronología &rarr;</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
        @endif

        {{-- ── NOTICIAS INSTITUCIONALES ───────────────────────────── --}}
        @if(isset($noticias) && $noticias->count() > 0)
        <div id="seccion-noticias" class="section-dark py-14">
            <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-10">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-10 h-10 bg-emerald-700 rounded-xl flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-newspaper text-white text-sm"></i></div>
                    <div>
                        <h2 class="text-xl font-black text-slate-900 m-0">Noticias</h2>
                        <p class="text-slate-500 text-xs font-medium m-0">Información institucional y comunicados recientes</p>
                    </div>
                    <div class="flex-1 h-px bg-gradient-to-r from-emerald-300 to-transparent hidden sm:block"></div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($noticias as $noticia)
                    @php $orient = ($noticia->orientation ?? 'landscape') === 'portrait' ? 'portrait' : 'landscape'; @endphp
                    <div class="noticia-card">
                        @if($noticia->photo)
                        <div class="noticia-img-wrap {{ $orient }} relative overflow-hidden">
                            <img src="{{ asset('storage/' . $noticia->photo) }}" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105" loading="lazy" alt="">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 to-transparent"></div>
                            <div class="absolute top-3 left-3"><span class="bg-emerald-600/90 text-white text-[9px] font-black px-2 py-1 rounded-md uppercase tracking-wider">Noticia</span></div>
                        </div>
                        @endif
                        <div class="p-5">
                            <p class="text-slate-500 text-[10px] font-bold mb-2"><i class="fa-regular fa-calendar text-emerald-500 mr-1"></i>{{ \Carbon\Carbon::parse($noticia->published_at)->format('d M. Y') }}</p>
                            <h3 class="text-base font-black text-slate-900 leading-snug mb-3 m-0">{{ $noticia->title }}</h3>
                            @if($noticia->description)<p class="text-slate-600 text-xs leading-relaxed line-clamp-4 m-0">{{ $noticia->description }}</p>@endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
        @endif

        {{-- ── SUB-MÓDULO DE TALLERES Y CAPACITACIONES (Programado/Ejecutado) ── --}}
        <div class="band-tint band-top-indigo py-8">
            @include('partials.talleres')
        </div>

        {{-- ── SUB-MÓDULO INDEPENDIENTE DE COORDINACIONES INSTITUCIONALES ── --}}
        <div class="band-white band-top-amber py-8">
            @include('partials.coordinaciones')
        </div>

        {{-- ── SUB-MÓDULO DE LA CRONOLOGÍA DE ACTIVIDADES OPERATIVAS ── --}}
        @include('partials.cronologia')

        {{-- ── TABLÓN DINÁMICO DE COMUNICADOS OFICIALES ────────────── --}}
        @if(isset($comunicadosActivos) && $comunicadosActivos->count() > 0)
        <section class="band-white band-top-amber py-14"
                 x-data="{
                     active: 0,
                     count: {{ $comunicadosActivos->count() }},
                     init() { if(this.count > 1) { setInterval(() => { this.active = (this.active + 1) % this.count; }, 5000); } }
                 }">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-6 bg-white p-4 rounded-2xl border border-slate-200 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-2.5 h-2.5 rounded-full bg-amber-500 animate-pulse flex-shrink-0"></div>
                        <h2 class="text-sm font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">
                            <i class="fa-solid fa-bullhorn text-amber-500"></i> Tablón de Comunicados Oficiales
                        </h2>
                    </div>
                    <div class="text-xs font-mono text-slate-500 font-bold bg-slate-100 px-3 py-1 rounded-md border border-slate-200">
                        <span x-text="active + 1"></span> / <span x-text="count"></span>
                    </div>
                </div>

                <div class="relative bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-lg h-[580px] sm:h-[450px] md:h-[360px]">
                    @foreach($comunicadosActivos as $index => $comunicado)
                    <div x-show="active === {{ $index }}"
                         x-transition:enter="transition-opacity duration-500 ease-in-out" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                         x-transition:leave="transition-opacity duration-400 ease-in-out" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                         class="absolute inset-0 w-full h-full flex flex-col md:flex-row items-stretch"
                         x-cloak>
                        
                        <div class="w-full md:w-[45%] flex-shrink-0 bg-slate-100 border-b md:border-b-0 md:border-r border-slate-200 flex items-center justify-center relative overflow-hidden h-48 sm:h-64 md:h-full">
                            @if($comunicado->file_type === 'image')
                                <img src="{{ asset('storage/' . $comunicado->file_path) }}" loading="lazy" decoding="async" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-slate-100">
                                    <iframe src="{{ asset('storage/' . $comunicado->file_path) }}#toolbar=0&navpanes=0&scrollbar=0" class="w-full h-full border-none" allow="autoplay"></iframe>
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 p-6 sm:p-8 flex flex-col justify-between overflow-y-auto scrollbar-thin">
                            <div>
                                <span class="bg-amber-50 text-amber-700 border border-amber-200 font-mono text-[9px] font-black uppercase px-2.5 py-1 rounded-md">Comunicado Activo</span>
                                {{-- Etiqueta de la sede de origen: institucional (rojo) vs sede desconcentrada (índigo) --}}
                                <span class="font-mono text-[9px] font-black uppercase px-2.5 py-1 rounded-md border ml-1.5 inline-flex items-center gap-1 {{ is_null($comunicado->sede) ? 'bg-red-50 text-red-600 border-red-200' : 'bg-indigo-50 text-indigo-600 border-indigo-200' }}">
                                    <i class="fa-solid fa-location-dot text-[8px]"></i>{{ $comunicado->sede_label }}
                                </span>
                                @php $nAnexos = (isset($comunicado->attachments) && is_array($comunicado->attachments)) ? count($comunicado->attachments) : 0; @endphp
                                <span class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-600 border border-slate-200 font-mono text-[9px] font-black uppercase px-2.5 py-1 rounded-md ml-1.5"><i class="fa-solid fa-paperclip text-red-500"></i> 1 Matriz{{ $nAnexos > 0 ? ' + '.$nAnexos.' '.($nAnexos === 1 ? 'Anexo' : 'Anexos') : '' }}</span>
                                <h3 class="text-slate-900 font-black text-xl sm:text-2xl leading-tight mt-3 mb-3 m-0">{{ $comunicado->title }}</h3>
                                <p class="text-slate-600 text-xs sm:text-sm font-medium leading-relaxed line-clamp-3 mb-4 m-0">{{ $comunicado->description ?? 'Comunicado oficial de la institución.' }}</p>

                                @if(isset($comunicado->attachments) && is_array($comunicado->attachments) && count($comunicado->attachments) > 0)
                                <div class="space-y-2 mb-4">
                                    <p class="text-slate-500 text-[10px] font-black uppercase tracking-wider mb-2 m-0"><i class="fa-solid fa-paperclip mr-1"></i> Documentos adjuntos</p>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        @foreach($comunicado->attachments as $indexAnexo => $adj)
                                        <a href="{{ asset('storage/' . $adj) }}" target="_blank" class="flex items-center gap-2.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 hover:border-slate-300 rounded-xl px-3 py-2 text-xs font-bold text-slate-700 hover:text-slate-900 transition group truncate decoration-none">
                                            <div class="w-7 h-7 bg-red-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <i class="fa-solid {{ str_ends_with(strtolower($adj), '.pdf') ? 'fa-file-pdf text-red-500' : 'fa-image text-blue-500' }} text-[11px]"></i>
                                            </div>
                                            <span class="truncate flex-1">Anexo N° {{ $indexAnexo + 1 }}</span>
                                            <i class="fa-solid fa-arrow-up-right-from-square text-slate-400 group-hover:text-slate-700 text-[10px]"></i>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="flex items-center justify-between pt-4 border-t border-slate-200 mt-auto">
                                <a href="{{ asset('storage/' . $comunicado->file_path) }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-500 text-white text-xs font-black uppercase tracking-wider shadow transition decoration-none"><i class="fa-solid fa-file-arrow-down"></i> Descargar Principal</a>
                                <span class="text-slate-500 text-[10px] font-bold"><i class="fa-regular fa-calendar mr-1"></i>{{ $comunicado->published_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                @if($comunicadosActivos->count() > 1)
                <div class="flex justify-center gap-1.5 mt-4">
                    @foreach($comunicadosActivos as $index => $c)
                    <button @click="active = {{ $index }}" class="h-2 rounded-full transition-all duration-300 border-none cursor-pointer" :class="active === {{ $index }} ? 'bg-amber-500 w-5 shadow-[0_0_8px_#f59e0b]' : 'bg-slate-300 w-2'"></button>
                    @endforeach
                </div>
                @endif
            </div>
        </section>
        @endif

        {{-- ── PIE DE PÁGINA (MEDIOS DE INFORMACIÓN Y REDES) ──────── --}}
        <section class="footer-light border-t border-slate-300">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-12">
                <div class="flex items-center gap-4 mb-10"><h2 class="text-2xl font-black text-slate-800 m-0">Medios e Información</h2><div class="flex-1 h-px bg-slate-300"></div></div>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    <div class="lg:col-span-4">
                        <div class="flex items-center gap-2 mb-4"><i class="fa-brands fa-facebook text-blue-600 text-lg"></i><h4 class="text-xs font-black text-slate-600 uppercase tracking-wider m-0">Facebook</h4></div>
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-slate-200" style="height: 480px;">
                            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FDRTPEPunoOFICIAL&tabs=timeline&width=340&height=480&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId"
                                    width="100%" height="480" style="border:none;overflow:hidden;" scrolling="no" frameborder="0" allowfullscreen allow="autoplay;clipboard-write;encrypted-media;picture-in-picture;web-share"></iframe>
                        </div>
                    </div>
                    <div class="lg:col-span-8 lg:pl-10 lg:border-l lg:border-slate-300 space-y-8">
                        <div>
                            <div class="flex items-center gap-2 mb-4"><i class="fa-brands fa-tiktok text-slate-900 text-lg"></i><h4 class="text-xs font-black text-slate-600 uppercase tracking-wider m-0">TikTok</h4></div>
                            <a href="#" target="_blank" class="flex items-center gap-5 bg-gradient-to-br from-slate-900 to-slate-800 rounded-2xl p-5 border border-slate-700/60 hover:border-slate-500/80 transition group shadow-lg decoration-none">
                                <div class="w-14 h-14 rounded-2xl bg-black flex items-center justify-center border border-white/10 flex-shrink-0"><i class="fa-brands fa-tiktok text-white text-2xl"></i></div>
                                <div class="flex-1 min-w-0"><p class="text-white font-black text-base group-hover:text-slate-200 transition m-0">@DTREPuno</p><p class="text-slate-400 text-xs mt-1 m-0">Síganos en TikTok para ver nuestras actividades en formato corto.</p></div>
                                <div class="w-9 h-9 rounded-xl bg-white/08 border border-white/12 flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-arrow-up-right-from-square text-white/60 text-xs"></i></div>
                            </a>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 mb-4"><i class="fa-solid fa-newspaper text-red-600 text-lg"></i><h4 class="text-xs font-black text-slate-600 uppercase tracking-wider m-0">Boletines Informativos</h4></div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @if(isset($bulletins) && $bulletins->count())
                                    @forelse($bulletins as $boletin)
                                    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-md flex flex-col" style="height: 360px;">
                                        <div class="bg-slate-50 px-4 py-2 border-b border-slate-200 flex justify-between items-center shrink-0">
                                            <span class="text-xs font-black text-slate-800 truncate max-w-[70%]"><i class="fa-solid fa-file-pdf text-red-600 mr-1.5"></i>{{ $boletin->title }}</span>
                                            <a href="{{ asset('storage/' . $boletin->file_path) }}" target="_blank" class="text-[10px] bg-red-600 text-white px-2 py-0.5 rounded font-bold uppercase hover:bg-red-700"><i class="fa-solid fa-expand"></i></a>
                                        </div>
                                        <div class="flex-1 w-full bg-slate-100"><iframe src="{{ asset('storage/' . $boletin->file_path) }}#toolbar=0&navpanes=0&scrollbar=0" width="100%" height="100%" class="border-none"></iframe></div>
                                    </div>
                                    @empty
                                    <div class="col-span-2 bg-white border border-slate-200 rounded-2xl flex flex-col items-center justify-center p-8 text-slate-400 text-xs font-bold uppercase tracking-wider"><i class="fa-solid fa-folder-open text-xl mb-2 text-slate-300"></i> No hay boletines publicados</div>
                                    @endforelse
                                @else
                                    <div class="bg-white border border-slate-200 rounded-2xl flex flex-col items-center justify-center p-8 shadow-sm hover:shadow-lg transition group cursor-pointer hover:-translate-y-1">
                                        <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center mb-3 border border-red-100"><i class="fa-solid fa-file-pdf text-2xl text-red-500"></i></div>
                                        <p class="text-slate-800 font-bold text-sm m-0">Boletín 001</p><p class="text-slate-400 text-xs mt-1 m-0">Próximamente disponible</p>
                                    </div>
                                    <div class="bg-white border border-slate-200 rounded-2xl flex flex-col items-center justify-center p-8 shadow-sm hover:shadow-lg transition group cursor-pointer hover:-translate-y-1">
                                        <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center mb-3 border border-red-100"><i class="fa-solid fa-file-pdf text-2xl text-red-500"></i></div>
                                        <p class="text-slate-800 font-bold text-sm m-0">Boletín 002</p><p class="text-slate-400 text-xs mt-1 m-0">Próximamente disponible</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="bg-slate-800 rounded-2xl p-6 shadow-lg">
                            <h5 class="text-white font-black text-xs uppercase tracking-wider mb-5 flex items-center gap-2 m-0"><i class="fa-solid fa-headset text-red-400"></i> Contáctenos</h5>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">
                                <div class="flex items-start gap-2.5">
                                    <div class="w-7 h-7 rounded-lg bg-red-600/20 border border-red-500/25 flex items-center justify-center flex-shrink-0 mt-0.5"><i class="fa-solid fa-location-dot text-red-400 text-xs"></i></div>
                                    <div><p class="text-slate-200 text-xs font-bold m-0">Sede Puno</p><p class="text-slate-500 text-xs leading-snug mt-0.5 m-0">Jr. Ayacucho N° 658, Puno</p></div>
                                </div>
                                <div class="flex items-start gap-2.5">
                                    <div class="w-7 h-7 rounded-lg bg-blue-600/20 border border-blue-500/25 flex items-center justify-center flex-shrink-0 mt-0.5"><i class="fa-solid fa-location-dot text-blue-400 text-xs"></i></div>
                                    <div><p class="text-slate-200 text-xs font-bold m-0">Sede Juliaca</p><p class="text-slate-500 text-xs leading-snug mt-0.5 m-0">Jr. Santiago Mamani N° 200, Juliaca</p></div>
                                </div>
                            </div>
                            <div class="flex gap-2 flex-wrap">
                                <a href="https://www.facebook.com/DRTPEPunoOFICIAL/?locale=es_LA" target="_blank" class="social-badge badge-fb"><i class="fa-brands fa-facebook"></i> Facebook</a>
                                <a href="#" target="_blank" class="social-badge badge-tt"><i class="fa-brands fa-tiktok"></i> TikTok</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ── FOOTER DERECHOS RESERVADOS ────────────────────────── --}}
        <footer class="bg-slate-950 text-slate-600 py-8 text-center border-t border-white/05">
            <div class="max-w-5xl mx-auto px-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-7 h-7 object-contain mx-auto mb-3 opacity-25">
                <p class="font-black uppercase tracking-widest text-slate-500 text-[10px] mb-1 m-0">Dirección Regional de Trabajo y Promoción del Empleo Puno</p>
                <p class="text-xs m-0">&copy; {{ date('Y') }} Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>

    {{-- 6. Modales y Capas de Lightbox Nativo --}}
    @include('partials.modals')

    {{-- ── SCRIPTS JAVASCRIPT GLOBAL (Control Estructural del DOM) ── --}}
    <script>
    // ── INTERFAZ DE USUARIO: SIDEBAR RESPONSIVE ─────────────────────
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    
    document.getElementById('sidebar-toggle')?.addEventListener('click', () => {
        sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
    });
    
    function openSidebar()  { sidebar.classList.add('open');    overlay.classList.add('open');    }
    function closeSidebar() { sidebar.classList.remove('open'); overlay.classList.remove('open'); }

    // ── SISTEMA INTELLIGENT SCROLLING (Navegación Anclada) ──────────
    function scrollToSection(id) {
        document.getElementById(id)?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
    function scrollToActivity(id) {
        document.getElementById(id)?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function scrollToSubEvent(seId, activityIdx) {
        const el = document.getElementById(seId);
        if (!el) return;
        if (el.dataset.isLatest === '1') {
            _ensureArticleVisible(activityIdx, () => _doScrollToEl(el));
            return;
        }
        _ensureArticleVisible(activityIdx, () => {
            if (isElHidden(el)) {
                const btn = document.getElementById('expand-toggle-' + activityIdx);
                if (btn) {
                    btn.click();
                    setTimeout(() => _doScrollToEl(el), 550);
                } else {
                    _doScrollToEl(el);
                }
            } else {
                _doScrollToEl(el);
            }
        });
    }

    function _ensureArticleVisible(aIdx, callback) {
        const article = document.getElementById('actividad-' + aIdx);
        if (!article || isElHidden(article)) {
            article?.scrollIntoView({ behavior: 'smooth', block: 'start' });
            setTimeout(callback, 300);
        } else {
            callback();
        }
    }

    function isElHidden(el) {
        let node = el;
        while (node && node !== document.body) {
            const s = window.getComputedStyle(node);
            if (s.display === 'none' || s.visibility === 'hidden') return true;
            node = node.parentElement;
        }
        return false;
    }

    function _doScrollToEl(el) {
        el.scrollIntoView({ behavior: 'smooth', block: 'center' });
        el.classList.add('highlight-target');
        setTimeout(() => el.classList.remove('highlight-target'), 2800);
    }

    // ── REPRODUCTOR DE YOUTUBE CON RENDIMIENTO OPTIMIZADO ───────────
    function playVideo(playButton, youtubeId, containerId) {
        const c = document.getElementById(containerId);
        c.querySelector('.video-thumbnail').style.display = 'none';
        playButton.style.display = 'none';
        const iframe = c.querySelector('.video-iframe');
        iframe.src = `https://www.youtube.com/embed/${youtubeId}?autoplay=1&rel=0`;
        iframe.style.display = 'block';
    }

    // ── GALERÍAS FOTOGRÁFICAS DINÁMICAS (Botón "Ver más") ────────────
    document.querySelectorAll('.btn-mostrar-mas').forEach(btn => {
        btn.addEventListener('click', function () {
            const wrap = this.closest('.rounded-2xl') || this.closest('.bg-slate-50');
            const grid = wrap?.querySelector('.galeria-fotos');
            if (!grid) return;
            const extras = grid.querySelectorAll('.foto-extra').length;
            const span   = this.querySelector('span');
            const icon   = this.querySelector('i');
            const show   = grid.classList.toggle('mostrar-todas');
            
            span.textContent = show ? 'Ocultar fotografías adicionales' : `Ver ${extras} fotografías adicionales`;
            icon.classList.toggle('fa-images', !show);
            icon.classList.toggle('fa-chevron-up', show);
        });
    });

    // ── CORE: SISTEMA DE VISOR LIGHTBOX TOTALMENTE NATIVO ───────────
    let gallery = [], lbIdx = 0;
    const lb    = document.getElementById('lightbox');
    const lbImg = document.getElementById('lb-img');
    const lbCtr = document.getElementById('lb-counter');

    document.addEventListener('click', function (e) {
        const targetImg = e.target.closest('.foto-galeria');
        if (targetImg) {
            const grid = targetImg.closest('.galeria-fotos');
            gallery = Array.from(grid.querySelectorAll('.foto-galeria'));
            lbIdx   = gallery.indexOf(targetImg);
            openLB();
        }
    });

    function updateLB() {
        lbImg.style.opacity = '.4';
        setTimeout(() => {
            lbImg.src         = gallery[lbIdx].src;
            lbCtr.textContent = `IMAGEN ${lbIdx + 1} DE ${gallery.length}`;
            lbImg.style.opacity = '1';
        }, 160);
    }
    
    function openLB()  { updateLB(); lb.classList.add('active');    document.body.style.overflow = 'hidden'; }
    function closeLB() { lb.classList.remove('active'); document.body.style.overflow = ''; }

    document.getElementById('lb-close').addEventListener('click', closeLB);
    document.getElementById('lb-next').addEventListener('click',  () => { lbIdx = (lbIdx + 1) % gallery.length; updateLB(); });
    document.getElementById('lb-prev').addEventListener('click',  () => { lbIdx = (lbIdx - 1 + gallery.length) % gallery.length; updateLB(); });
    
    lb.addEventListener('click', e => { if(e.target === lb) closeLB(); });
    
    document.addEventListener('keydown', e => {
        if(!lb.classList.contains('active')) return;
        if(e.key === 'Escape')     closeLB();
        if(e.key === 'ArrowRight') document.getElementById('lb-next').click();
        if(e.key === 'ArrowLeft')  document.getElementById('lb-prev').click();
    });

    // ── INTEGRACIÓN AUTOMÁTICA DE ALPINEJS PARA LOS HERO SLIDERS ───
    document.addEventListener('alpine:init', () => {
        Alpine.data('autoSlider', (items, totalMs) => ({
            items, active: 0, progress: 0, tick: 50,
            init() { if(this.items.length > 1) this.startTimer(); },
            startTimer() {
                const step = 100 / (totalMs / this.tick);
                setInterval(() => {
                    this.progress += step;
                    if(this.progress >= 100) {
                        this.progress = 0;
                        this.active = (this.active + 1) % this.items.length;
                    }
                }, this.tick);
            }
        }));
    });
    </script>
</body>
</html>