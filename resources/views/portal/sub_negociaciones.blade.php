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
                        <i class="fa-solid fa-user-shield text-red-600"></i>
                        Defensa Legal Gratuita y Asesoría al Trabajador
                    </h1>
                </div>
                <div class="rounded-3xl bg-blue-950/70 border border-blue-500/20 p-5 shadow-inner">
                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                        Artículo 27º. La subdirección de Defensa Legal Gratuita y Asesoría al Trabajador tiene las siguientes funciones y atribuciones:
                    </p>
                </div>
            </div>
        </header>

        <!-- Funciones y atribuciones en tarjetas -->
        <section class="grid grid-cols-1 gap-4 xl:grid-cols-2">

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-600/10 text-red-600">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">a) Plan anual</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Participar en la elaboración del Plan anual de Actividades de la Dirección Regional.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600/10 text-blue-600">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">b) Consultas</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Absolver consultas verbales, telefónicas u otros medios, que formulen los empleados y trabajadores del régimen de la actividad privada.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-600/10 text-red-600">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">c) Liquidaciones</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Efectuar liquidaciones de derechos sociales de los trabajadores basándose en la documentación idónea proporcionada por el solicitante.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600/10 text-blue-600">
                        <i class="fa-solid fa-handshake"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">d) Conciliación</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Promover la conciliación ante empleadores y trabajadores, velando por la solución armoniosa de conflictos.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-600/10 text-red-600">
                        <i class="fa-solid fa-gavel"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">e) Orientación Legal</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Brindar orientación legal sobre la aplicación de las normas jurídicas laborales y de seguridad social a los usuarios de la Dirección Regional.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600/10 text-blue-600">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">f) Inspecciones especiales</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Evaluar previamente solicitudes de inspecciones especiales y sancionar pecuniariamente a los empleadores por inasistencia a la diligencia de conciliación.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-600/10 text-red-600">
                        <i class="fa-solid fa-user-gear"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">g) Patrocinio Judicial</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Brindar patrocinio a los ex trabajadores ante el poder judicial referente a sus derechos laborales y de seguridad social.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600/10 text-blue-600">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">h) Otras Funciones</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Cumplir con otras funciones que le asigne el Director de Prevención y Solución de Conflictos.
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
                Esta subdirección garantiza acceso a la justicia laboral, asesoría gratuita y apoyo técnico a trabajadores, promoviendo soluciones conciliadas y el respeto de los derechos laborales en la región.
            </p>
        </section>

        <!-- Botón de retorno inferior -->
        <div class="flex justify-center">
            <a href="{{ route('portal.Sconflictos') }}" class="inline-flex items-center gap-2 bg-slate-900/90 border border-white/10 text-white px-6 py-3 rounded-2xl shadow-lg hover:bg-slate-800 transition-all duration-300">
                <i class="fa-solid fa-arrow-left text-red-600"></i>
                Volver a Dirección Principal
            </a>
        </div>

    </div>
</div>
@endsection
