@extends('layouts.portal')

@section('content')
<div class="bg-scene min-h-screen relative py-12">
    <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-[2px] z-0"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- Botón de retorno superior -->
        <div class="flex justify-start">
            <a href="{{ route('portal.Sconflictos') }}" class="inline-flex items-center gap-2 bg-slate-900/80 border border-white/10 text-white px-4 py-2 rounded-2xl shadow-sm hover:bg-slate-900 transition-all duration-300">
                <i class="fa-solid fa-arrow-left text-red-600"></i>
                Volver a Dirección Principal
            </a>
        </div>

        <!-- Encabezado principal -->
        <header class="bg-slate-900/90 border border-white/10 rounded-[2rem] p-8 shadow-2xl">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-3">
                    <span class="text-red-600 font-semibold uppercase tracking-[0.3em] text-xs">Sub Dirección Especializada</span>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-100 uppercase tracking-wider flex items-center gap-3">
                        Sub Dirección de Negociaciones Colectivas y Registros Generales
                    </h1>
                </div>
                <div class="rounded-3xl bg-blue-950/70 border border-blue-500/20 p-5 shadow-inner">
                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                        La subdirección de Negociaciones Colectivas y Registros Generales tiene las siguientes funciones y atribuciones:
                    </p>
                </div>
            </div>
        </header>

        <!-- Funciones y atribuciones en tarjetas -->
        <section class="grid grid-cols-1 gap-4 xl:grid-cols-2">
            <article class="bg-gradient-to-br from-gray-900/60 to-transparent border border-cyan-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-cyan-500/20 transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">a) Plan anual</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Participar en la elaboración del Plan Anual de Actividades de la Dirección Regional.
                </p>
            </article>

            <article class="bg-gradient-to-br from-gray-900/60 to-transparent border border-cyan-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-cyan-500/20 transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">b) Procedimientos TUPA</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Ejecutar y evaluar los procedimientos que son de su competencia y están contenidos en el texto único de Procedimientos – TUPA Sectorial.
                </p>
            </article>

            <article class="bg-gradient-to-br from-gray-900/60 to-transparent border border-cyan-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-cyan-500/20 transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">c) Designación de representantes</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Formalizar designaciones de representantes de los trabajadores, en los casos de empresas declaradas en insolvencia.
                </p>
            </article>

            <article class="bg-gradient-to-br from-gray-900/60 to-transparent border border-cyan-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-cyan-500/20 transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">d) Expedientes</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Atender solicitudes de entrega de expedientes sobre proyectos de convención colectiva, árbitro unipersonal o presidentes del tribunal arbitral.
                </p>
            </article>

            <article class="bg-gradient-to-br from-gray-900/60 to-transparent border border-cyan-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-cyan-500/20 transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">e) Improcedencias e ilegalidades</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Declarar improcedencias de comunicaciones de plazos e ilegalidades de huelga o paralizaciones, si el motivo es la negociación colectiva y otros vinculados a su competencia.
                </p>
            </article>

            <article class="bg-gradient-to-br from-gray-900/60 to-transparent border border-cyan-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-cyan-500/20 transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">f) Convenios y horarios</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Registrar convenios individuales y/o colectivos de trabajo y declarar la procedencia o improcedencia de solicitudes sobre modificaciones colectivas de horario de trabajo.
                </p>
            </article>

            <article class="bg-gradient-to-br from-gray-900/60 to-transparent border border-cyan-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-cyan-500/20 transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">g) Procedimientos de convenio colectivo</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Admitir, sustanciar y pronunciarse sobre las incidencias en los procedimientos de proyectos de convención colectiva y en las solicitudes de suspensión temporal perfecta de labores por caso fortuito o fuerza mayor.
                </p>
            </article>

            <article class="bg-gradient-to-br from-gray-900/60 to-transparent border border-cyan-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-cyan-500/20 transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">h) Disoluciones, liquidaciones y quiebras</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Comunicar las disoluciones, liquidaciones y quiebras de las empresas que cumplan con los requisitos solicitados.
                </p>
            </article>

            <article class="bg-gradient-to-br from-gray-900/60 to-transparent border border-cyan-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-cyan-500/20 transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">i) Reglamentos y formatos</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Aprobar, autorizar y/o modificar reglamentos, libros de planillas, formatos y otros.
                </p>
            </article>

            <article class="bg-gradient-to-br from-gray-900/60 to-transparent border border-cyan-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-cyan-500/20 transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">j) Registros de planillas</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Registrar comunicaciones sobre cierre de planillas de remuneraciones y aquellos establecidos por norma legal expresa.
                </p>
            </article>

            <article class="bg-gradient-to-br from-gray-900/60 to-transparent border border-cyan-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-cyan-500/20 transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">k) Entidades empleadoras de alto riesgo</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Registrar a las entidades empleadoras que desarrollan actividades de alto riesgo.
                </p>
            </article>

            <article class="bg-gradient-to-br from-gray-900/60 to-transparent border border-cyan-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-cyan-500/20 transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">l) Contratos de trabajo</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Registrar, refrendar y aprobar los contratos de trabajo presentados y que estén contenidos en el TUPA Institucional.
                </p>
            </article>

            <article class="bg-gradient-to-br from-gray-900/60 to-transparent border border-cyan-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-cyan-500/20 transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">m) Sindicatos y actas</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Sellar libros de actas, afiliación y contabilidad de las organizaciones sindicales, así como registrar comunicaciones de reforma de estatutos de las mismas.
                </p>
            </article>

            <article class="bg-gradient-to-br from-gray-900/60 to-transparent border border-cyan-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-cyan-500/20 transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">n) Juntas directivas y fuero sindical</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Registrar comunicaciones y/o modificaciones de juntas directivas de las organizaciones sindicales, así como registrar comunicaciones de trabajadores amparados por el fuero sindical, designación de delegados de trabajadores e inscripción de organizaciones sindicales.
                </p>
            </article>

            <article class="bg-gradient-to-br from-gray-900/60 to-transparent border border-cyan-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-cyan-500/20 transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">o) Cancelación de registros sindicales</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Admitir, tramitar y resolver los procedimientos de cancelación de registros sindicales y las solicitudes de proyectos de convención colectiva.
                </p>
            </article>

            <article class="bg-gradient-to-br from-gray-900/60 to-transparent border border-cyan-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-cyan-500/20 transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">p) Otras funciones</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Cumplir otras funciones que le asigne el Director de Prevención y Solución de Conflictos.
                </p>
            </article>
        </section>

        <!-- Nota institucional -->
        <section class="bg-slate-900/80 border border-white/10 rounded-3xl p-6 sm:p-8 shadow-xl">
            <h3 class="text-xl font-black text-slate-100 uppercase tracking-wider flex items-center gap-2">
                <i class="fa-solid fa-info-circle text-red-600"></i>
                Marco de actuación
            </h3>
            <p class="text-slate-300 text-sm leading-relaxed mt-3">
                Esta subdirección fortalece la gestión de los derechos colectivos, la formalización de registros y la estabilidad institucional en el ámbito laboral regional.
            </p>
        </section>
    </div>
</div>
@endsection
