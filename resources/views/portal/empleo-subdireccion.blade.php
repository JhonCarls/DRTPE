@extends('layouts.portal')

@section('content')
<div class="bg-scene-light min-h-screen relative py-12">
    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Volver -->
        <div data-reveal class="flex justify-start">
            <a href="{{ route('portal.empleo-general') }}" class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-700 px-4 py-2 rounded-2xl shadow-sm hover:bg-slate-50 hover:-translate-y-0.5 transition-all duration-300">
                <i class="fa-solid fa-arrow-left text-amber-600"></i>
                Volver a la Dirección
            </a>
        </div>

        <!-- Encabezado -->
        <header data-reveal class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-lg shadow-slate-300/40">
            <div class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-amber-950 p-8 sm:p-10 text-white">
                <div class="pointer-events-none absolute -top-16 -right-12 w-72 h-72 bg-amber-500/20 rounded-full blur-3xl"></div>
                <div class="relative flex items-start gap-5">
                    <div class="icon-tile hidden sm:flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-2xl bg-amber-500/15 border border-amber-400/30 text-amber-300 text-2xl">
                        <i class="fa-solid fa-diagram-project"></i>
                    </div>
                    <div class="space-y-2">
                        <span class="text-amber-400 font-bold uppercase tracking-[0.3em] text-xs">Subdirección Especializada</span>
                        <h1 class="text-2xl sm:text-4xl font-black uppercase tracking-tight leading-tight m-0">
                            Promoción del Empleo, Formación Profesional y de la Micro y Pequeña Empresa
                        </h1>
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed m-0 max-w-3xl">
                            <strong class="text-white">Artículo 31º.</strong> Encargada de ejecutar, dirigir, supervisar, coordinar y evaluar las actividades técnico-administrativas de Promoción del Empleo, Formación Profesional y de la Micro y Pequeña Empresa.
                        </p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Funciones -->
        <section class="space-y-5">
            <h2 data-reveal class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100 text-amber-600"><i class="fa-solid fa-list-check"></i></span>
                Funciones y Atribuciones
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl bg-amber-100 text-amber-600"><i class="fa-solid fa-compass"></i></div>
                        <span class="text-amber-600 font-black text-sm">a)</span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Dirección y supervisión</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Dirigir, coordinar, ejecutar, supervisar y evaluar las acciones de empleo, formación profesional y de la MYPE en el marco de su competencia.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600"><i class="fa-solid fa-scale-balanced"></i></div>
                        <span class="text-amber-600 font-black text-sm">b)</span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Cumplimiento normativo</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Hacer cumplir las normas, procedimientos y directivas técnicas en materia de Promoción del Empleo y capacitación para el trabajo.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-100 text-blue-600"><i class="fa-solid fa-clipboard-check"></i></div>
                        <span class="text-amber-600 font-black text-sm">c)</span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Control de programas</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Controlar y supervisar la ejecución de los Programas de Empleo, Formación Profesional y de la MYPE con seguridad, celeridad y oportunidad.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600"><i class="fa-solid fa-building-user"></i></div>
                        <span class="text-amber-600 font-black text-sm">d)</span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Asesoría empresarial</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Brindar asesoramiento a la MYPE e inscribir Empresas Especiales de Servicios y Cooperativas de Trabajadores en el registro de intermediación laboral.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl bg-teal-100 text-teal-600"><i class="fa-solid fa-people-group"></i></div>
                        <span class="text-amber-600 font-black text-sm">e)</span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Coordinación regional</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Coordinar planes, programas y convenios de formación laboral juvenil y prácticas pre-profesionales entre empresas y jóvenes.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl bg-purple-100 text-purple-600"><i class="fa-solid fa-users-rectangle"></i></div>
                        <span class="text-amber-600 font-black text-sm">f)</span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Mesas y comités</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Promover mesas, comités o consejos que involucren a instituciones públicas y privadas vinculadas al desarrollo del sector.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl bg-orange-100 text-orange-600"><i class="fa-solid fa-lightbulb"></i></div>
                        <span class="text-amber-600 font-black text-sm">g)</span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Programas y proyectos</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Diseñar, proponer y ejecutar programas y proyectos de promoción del empleo, formación profesional y nuevos emprendimientos.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl bg-rose-100 text-rose-600"><i class="fa-solid fa-file-signature"></i></div>
                        <span class="text-amber-600 font-black text-sm">h)</span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Convenios y alianzas</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Proponer convenios y alianzas estratégicas con instituciones públicas y privadas para el cumplimiento de las funciones.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl bg-cyan-100 text-cyan-600"><i class="fa-solid fa-chart-column"></i></div>
                        <span class="text-amber-600 font-black text-sm">i)</span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Información estadística</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Producir información estadística mediante encuestas sobre la oferta y demanda de mano de obra y el entorno de las empresas.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl bg-sky-100 text-sky-600"><i class="fa-solid fa-magnifying-glass-chart"></i></div>
                        <span class="text-amber-600 font-black text-sm">j)</span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Estudios e investigaciones</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Promover, desarrollar y difundir estudios e investigaciones sobre el mercado de trabajo regional y local.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl bg-fuchsia-100 text-fuchsia-600"><i class="fa-solid fa-folder-tree"></i></div>
                        <span class="text-amber-600 font-black text-sm">k)</span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Sistematización de experiencias</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Sistematizar las experiencias de los programas de empleo y formación profesional ejecutados en el ámbito regional y local.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl bg-green-100 text-green-600"><i class="fa-solid fa-graduation-cap"></i></div>
                        <span class="text-amber-600 font-black text-sm">l)</span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Formación profesional</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Fomentar la formación profesional del recurso humano en las empresas para mejorar los ingresos y la productividad.</p>
                </article>
            </div>
        </section>

        <div data-reveal class="flex justify-center pt-2">
            <a href="{{ route('portal.empleo-general') }}" class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-700 px-6 py-3 rounded-2xl shadow-sm hover:bg-slate-50 hover:-translate-y-0.5 transition-all duration-300">
                <i class="fa-solid fa-arrow-left text-amber-600"></i>
                Volver a la Dirección de Empleo
            </a>
        </div>
    </div>
</div>
@endsection
