@extends('layouts.portal')

@section('content')
<div class="bg-scene min-h-screen relative py-12">
    <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-[2px] z-0"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <div class="flex justify-start">
            <a href="{{ route('portal.empleo-general') }}" class="inline-flex items-center gap-2 bg-slate-900/80 border border-white/10 text-white px-4 py-2 rounded-2xl shadow-sm hover:bg-slate-900 transition-all duration-300">
                <i class="fa-solid fa-arrow-left text-amber-500"></i>
                Volver a la Dirección
            </a>
        </div>

        <header class="bg-slate-900/90 border border-white/10 rounded-[2rem] p-8 shadow-2xl">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-3">
                    <span class="text-amber-500 font-semibold uppercase tracking-[0.3em] text-xs">Subdirección Especializada</span>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-100 uppercase tracking-wider flex items-center gap-3">
                        <i class="fa-solid fa-briefcase text-amber-500"></i>
                        Promoción del Empleo, Formación Profesional y de la Micro y Pequeña Empresa
                    </h1>
                </div>
                <div class="rounded-3xl bg-amber-950/70 border border-amber-500/20 p-5 shadow-inner max-w-2xl">
                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                        Artículo 31º. Es la encargada de ejecutar, dirigir, supervisar, coordinar y evaluar las actividades técnico-administrativas de Promoción del Empleo, Formación Profesional y de la Micro y Pequeña Empresa.
                    </p>
                </div>
            </div>
        </header>

        <section class="grid grid-cols-1 gap-4 xl:grid-cols-2">
            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-500/10 text-amber-500">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">a) Dirección y supervisión</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Dirigir, coordinar, ejecutar, supervisar y evaluar las acciones de empleo, formación profesional y de la Micro y Pequeña Empresa en el marco de la competencia funcional asignada.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500/10 text-emerald-500">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">b) Cumplimiento normativo</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Hacer cumplir las normas generales y reglamentarias, procedimientos y directivas técnicas; vigilar el cumplimiento de las normas y directivas técnicas en materia de Promoción del Empleo y capacitación para el trabajo.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-500/10 text-blue-500">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">c) Control de programas</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Controlar y supervisar la ejecución de los Programas de Empleo, Formación Profesional y de la MYPE, promoviendo y conduciendo la prestación de servicios con criterios de seguridad, celeridad y oportunidad.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-500/10 text-violet-500">
                        <i class="fa-solid fa-handshake"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">d) Asesoría empresarial</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Proponer el perfeccionamiento de instrumentos normativos internos; brindar asesoramiento empresarial especializado a la MYPE e inscribir Empresas Especiales de Servicios y Cooperativas de Trabajadores que cumplan los requisitos del Registro Nacional de Empresas de Intermediación Laboral.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-500/10 text-red-500">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">e) Coordinación regional</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Coordinar planes, programas y actividades regionales y locales, así como los Convenios de formación laboral juvenil y prácticas pre-profesionales entre empresas y jóvenes.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-cyan-500/10 text-cyan-500">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">f) Mesas y comités</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Promover la conformación o fortalecimiento de mesas, comités o consejos que involucren a instituciones públicas y privadas vinculadas al desarrollo departamental en el sector.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-500/10 text-rose-500">
                        <i class="fa-solid fa-diagram-project"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">g) Programas y proyectos</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Diseñar, proponer y ejecutar programas y proyectos de promoción del empleo, formación profesional y nuevos emprendimientos según directivas de las Direcciones Nacionales.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-fuchsia-500/10 text-fuchsia-500">
                        <i class="fa-solid fa-handshake-angle"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">h) Convenios y alianzas</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Proponer convenios y alianzas estratégicas con instituciones públicas y privadas para el cumplimiento de las funciones de la Dirección Regional.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-500/10 text-indigo-500">
                        <i class="fa-solid fa-chart-column"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">i) Información estadística</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Producir información estadística mediante encuestas sobre oferta y demanda de mano de obra, incluyendo el entorno económico-financiero de las empresas.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-lime-500/10 text-lime-500">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">j) Estudios e investigaciones</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Promover, desarrollar y difundir estudios e investigaciones sobre el mercado de trabajo regional y local.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-500/10 text-orange-500">
                        <i class="fa-solid fa-database"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">k) Sistematización de experiencias</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Sistematizar las experiencias de los programas de empleo y formación profesional ejecutados en el ámbito regional y local.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-teal-500/10 text-teal-500">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">l) Formación profesional</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Fomentar la formación profesional del recurso humano en las empresas para mejorar los ingresos y la productividad.
                </p>
            </article>
        </section>

        <div class="flex justify-center">
            <a href="{{ route('portal.empleo-general') }}" class="inline-flex items-center gap-2 bg-slate-900/90 border border-white/10 text-white px-6 py-3 rounded-2xl shadow-lg hover:bg-slate-800 transition-all duration-300">
                <i class="fa-solid fa-arrow-left text-amber-500"></i>
                Volver a la Dirección de Empleo
            </a>
        </div>
    </div>
</div>
@endsection
