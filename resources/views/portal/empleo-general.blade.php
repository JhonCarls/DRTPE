@extends('layouts.portal')

@section('content')
<div class="bg-scene min-h-screen relative py-12">
    <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-[2px] z-0"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <header class="bg-slate-900/90 border border-white/10 rounded-[2rem] p-8 shadow-2xl">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-3">
                    <span class="text-amber-500 font-semibold uppercase tracking-[0.3em] text-xs">Dirección Especializada</span>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-100 uppercase tracking-wider flex items-center gap-3">
                        <i class="fa-solid fa-briefcase text-amber-500"></i>
                        Dirección de Promoción del Empleo, Formación Profesional y de la Micro y Pequeña Empresa
                    </h1>
                </div>
                <div class="rounded-3xl bg-amber-950/70 border border-amber-500/20 p-5 shadow-inner max-w-2xl">
                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                        Es el órgano encargado de ejecutar las acciones de política sectorial en materia de empleo y formación profesional, así como de promover el desarrollo y formalización de la Micro y Pequeña Empresa y los nuevos emprendimientos.
                    </p>
                </div>
            </div>
        </header>

        <section class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-500/10 text-amber-500">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">Dependencia y cargo</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Está a cargo de un Director. Depende jerárquica y administrativamente de la Dirección Regional. En el aspecto técnico-normativo, depende de la Dirección Nacional de Promoción del Empleo y Formación Profesional, así como de la Dirección Nacional de la Micro y Pequeña Empresa del Ministerio de Trabajo y Promoción del Empleo.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500/10 text-emerald-500">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">Funciones y atribuciones</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Dirige, coordina, ejecuta, supervisa y evalúa las acciones de empleo y formación profesional; vela por el cumplimiento de normas, programas y directivas técnicas; propone mejoras normativas y promueve la coordinación regional y local con instituciones públicas y privadas.
                </p>
            </article>
        </section>

        <section class="bg-slate-900/80 border border-white/10 rounded-3xl p-6 sm:p-8 shadow-xl">
            <div class="flex items-center gap-3 mb-5">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-500/10 text-amber-500">
                    <i class="fa-solid fa-sitemap"></i>
                </div>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-100 uppercase tracking-wider">Subdirección especializada</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white/5 border border-white/10 rounded-2xl p-5">
                    <h3 class="text-base font-black text-white mb-2">Definición</h3>
                    <p class="text-slate-300 text-sm leading-relaxed">
                        Es la encargada de ejecutar, dirigir, supervisar, coordinar y evaluar las actividades técnico-administrativas de Promoción del Empleo, Formación Profesional y de la Micro y Pequeña Empresa.
                    </p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-2xl p-5">
                    <h3 class="text-base font-black text-white mb-2">Acceso a funciones</h3>
                    <p class="text-slate-300 text-sm leading-relaxed">
                        Incluye funciones de dirección, cumplimiento normativo, supervisión de programas, asesoría empresarial, coordinación regional y promoción de emprendimientos y formación laboral.
                    </p>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('portal.empleo-subdireccion') }}" class="inline-flex items-center gap-2 bg-amber-600 hover:bg-amber-700 text-white font-semibold py-3 px-5 rounded-xl transition-all duration-300 shadow-lg hover:shadow-amber-500/30">
                    <i class="fa-solid fa-arrow-right"></i>
                    Ver funciones de la subdirección
                </a>
            </div>
        </section>
    </div>
</div>
@endsection