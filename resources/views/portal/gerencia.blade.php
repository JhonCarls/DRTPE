@extends('layouts.portal')

@section('content')
<div class="bg-scene-light min-h-screen relative py-12">
    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- Encabezado Principal -->
        <header data-reveal class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-lg shadow-slate-300/40">
            <div class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-amber-950 p-8 sm:p-10 text-white">
                <div class="pointer-events-none absolute -top-16 -right-12 w-72 h-72 bg-amber-500/20 rounded-full blur-3xl"></div>
                <div class="relative flex items-start gap-5">
                    <div class="icon-tile hidden sm:flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-2xl bg-amber-500/15 border border-amber-400/30 text-amber-300 text-2xl">
                        <i class="fa-solid fa-landmark-dome"></i>
                    </div>
                    <div class="space-y-2">
                        <span class="text-amber-400 font-bold uppercase tracking-[0.3em] text-xs">Administración Regional</span>
                        <h1 class="text-3xl sm:text-5xl font-black uppercase tracking-tight m-0">Gerencia Regional</h1>
                        <p class="text-slate-300 text-sm sm:text-base font-medium m-0">Región de Puno</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- SECCIÓN 1: Definición y Jurisdicción -->
        <section aria-label="Definición y Jurisdicción" class="space-y-5">
            <h2 data-reveal class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100 text-amber-600"><i class="fa-regular fa-clipboard"></i></span>
                Definición y Jurisdicción
            </h2>

            <article data-reveal class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm space-y-5">
                <div class="rounded-2xl bg-amber-50 border-l-4 border-amber-500 p-5">
                    <p class="text-slate-700 text-sm sm:text-base leading-relaxed font-semibold m-0">
                        Órgano encargado de ejecutar las acciones de política, leyes y normatividad general dictadas por los organismos centrales y regionales en materia de trabajo, empleo y fomento de la Micro y Pequeña Empresa.
                    </p>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 flex items-center gap-2 m-0">
                        <i class="fa-solid fa-map-location-dot text-amber-600"></i> Jurisdicción
                    </h3>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed m-0">
                        Su competencia comprende todo el ámbito territorial del
                        <span class="text-amber-700 font-bold">Departamento de Puno</span>,
                        ejerciendo autoridad en todas las provincias y distritos que conforman la región.
                    </p>
                </div>
            </article>
        </section>

        <!-- SECCIÓN 2: Finalidad y Objetivos -->
        <section aria-label="Finalidad y Objetivos" class="space-y-5">
            <h2 data-reveal class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100 text-amber-600"><i class="fa-solid fa-bullseye"></i></span>
                Finalidad y Objetivos
            </h2>
            <p data-reveal class="text-slate-600 text-sm sm:text-base leading-relaxed bg-white border border-slate-200 rounded-xl p-4 shadow-sm m-0">
                El objetivo principal es mejorar las condiciones de vida y trabajo del ciudadano puneño a través de:
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-600 text-lg"><i class="fa-solid fa-briefcase"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Promoción del Empleo Productivo</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Fortalecimiento del mercado laboral mediante la generación de oportunidades de empleo de calidad.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-600 text-lg"><i class="fa-solid fa-graduation-cap"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Capacitación Técnica</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Formación profesional para incrementar la productividad y competitividad laboral.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600 text-lg"><i class="fa-solid fa-comments"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Diálogo Social</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Concertación entre trabajadores, empleadores y organizaciones sociales para la paz laboral.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600 text-lg"><i class="fa-solid fa-scale-balanced"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Normativas OIT</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Adecuación de normas laborales a los principios internacionales de la OIT.</p>
                </article>
            </div>
        </section>

        <!-- SECCIÓN 3: Funciones Generales -->
        <section aria-label="Funciones Generales" class="space-y-5">
            <h2 data-reveal class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-100 text-red-600"><i class="fa-solid fa-gears"></i></span>
                Funciones Generales del Director Regional
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-red-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-red-100 text-red-600 text-lg"><i class="fa-solid fa-compass"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Dirección Estratégica</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Dirigir, coordinar, supervisar y evaluar la política socio-laboral en coordinación con organismos regionales y nacionales.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-red-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-600 text-lg"><i class="fa-solid fa-user-tie"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Promoción del Empleo</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Ejecutar programas y proyectos con énfasis en los grupos vulnerables de la población.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-red-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-100 text-orange-600 text-lg"><i class="fa-solid fa-helmet-safety"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Seguridad y Salud</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Conducir acciones de seguridad y salud en el trabajo, bienestar y seguridad social concertando con instituciones.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-red-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-100 text-purple-600 text-lg"><i class="fa-solid fa-gavel"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Resolución de Conflictos</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Conocer y resolver, en la instancia que corresponda, los recursos administrativos según la ley.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-red-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-teal-100 text-teal-600 text-lg"><i class="fa-solid fa-handshake"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Alianzas Estratégicas</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Proponer convenios y alianzas estratégicas con instituciones para el cumplimiento de sus funciones.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-red-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-cyan-100 text-cyan-600 text-lg"><i class="fa-solid fa-chart-line"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Información Laboral</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Producir información estadística mediante encuestas sobre oferta y demanda de mano de obra regional.</p>
                </article>
            </div>
        </section>

        <!-- SECCIÓN 4: Competencias Principales -->
        <section aria-label="Competencias Principales" class="space-y-5">
            <h2 data-reveal class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100 text-amber-600"><i class="fa-solid fa-key"></i></span>
                Competencias Principales
            </h2>

            <div class="grid grid-cols-1 gap-4">
                <article data-reveal class="card-hover flex items-start gap-4 bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-lg hover:border-amber-300">
                    <div class="icon-tile flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-600"><i class="fa-solid fa-arrow-trend-up"></i></div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900 mb-1 m-0">Fomento del Desarrollo Socio-Laboral Regional</h3>
                        <p class="text-slate-600 text-sm m-0">Impulsar políticas y acciones que mejoren el desarrollo económico y laboral de la región.</p>
                    </div>
                </article>
                <article data-reveal class="card-hover flex items-start gap-4 bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-lg hover:border-amber-300">
                    <div class="icon-tile flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-600"><i class="fa-solid fa-people-arrows"></i></div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900 mb-1 m-0">Supervisión de Sistemas de Intermediación Laboral</h3>
                        <p class="text-slate-600 text-sm m-0">Supervisar los sistemas públicos y privados que vinculan la oferta y la demanda de empleo.</p>
                    </div>
                </article>
                <article data-reveal class="card-hover flex items-start gap-4 bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-lg hover:border-amber-300">
                    <div class="icon-tile flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600"><i class="fa-solid fa-comments"></i></div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900 mb-1 m-0">Diálogo y Participación Social</h3>
                        <p class="text-slate-600 text-sm m-0">Establecer mecanismos de diálogo con trabajadores, empleadores y organizaciones sociales vinculadas al ámbito laboral.</p>
                    </div>
                </article>
            </div>
        </section>

        <!-- SECCIÓN 5: Relaciones Interinstitucionales -->
        <section aria-label="Relaciones Interinstitucionales" class="space-y-5 pb-6">
            <h2 data-reveal class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-blue-600"><i class="fa-solid fa-globe"></i></span>
                Relaciones Interinstitucionales
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-7 shadow-sm hover:shadow-xl hover:border-blue-300 text-center">
                    <div class="icon-tile mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 text-blue-600 text-2xl"><i class="fa-solid fa-landmark"></i></div>
                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-wide m-0 mb-2">Nivel Nacional</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Mantiene relación técnico-normativa directa con el <span class="font-bold text-blue-700">Ministerio de Trabajo y Promoción del Empleo</span>.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-7 shadow-sm hover:shadow-xl hover:border-amber-300 text-center">
                    <div class="icon-tile mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-100 text-amber-600 text-2xl"><i class="fa-solid fa-map-location-dot"></i></div>
                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-wide m-0 mb-2">Nivel Regional</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Coordina con el <span class="font-bold text-amber-700">Gobierno Regional de Puno</span>, Poder Judicial, universidades y fuerzas policiales regionales.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-7 shadow-sm hover:shadow-xl hover:border-emerald-300 text-center">
                    <div class="icon-tile mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600 text-2xl"><i class="fa-solid fa-briefcase"></i></div>
                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-wide m-0 mb-2">Sector Privado</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Colabora con <span class="font-bold text-emerald-700">entidades financieras</span> y organizaciones sociales, económicas y culturales.</p>
                </article>
            </div>
        </section>

    </div>
</div>
@endsection
