@extends('layouts.portal')

@section('content')
<div class="bg-scene-light min-h-screen relative py-12">
    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- Encabezado -->
        <header data-reveal class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-lg shadow-slate-300/40">
            <div class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-amber-950 p-8 sm:p-10 text-white">
                <div class="pointer-events-none absolute -top-16 -right-12 w-72 h-72 bg-amber-500/20 rounded-full blur-3xl"></div>
                <div class="relative flex items-start gap-5">
                    <div class="icon-tile hidden sm:flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-2xl bg-amber-500/15 border border-amber-400/30 text-amber-300 text-2xl">
                        <i class="fa-solid fa-folder-tree"></i>
                    </div>
                    <div class="space-y-2">
                        <span class="text-amber-400 font-bold uppercase tracking-[0.3em] text-xs">Registros Administrativos</span>
                        <h1 class="text-2xl sm:text-4xl font-black uppercase tracking-tight leading-tight m-0">
                            Registros y Procedimientos de Empleo
                        </h1>
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed m-0 max-w-3xl">
                            Registros administrativos a cargo de la Dirección de Promoción del Empleo, Formación Profesional y de la Micro y Pequeña Empresa, que dan soporte a los servicios de empleo, capacitación y desarrollo empresarial de la región.
                        </p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Registros a cargo -->
        <section class="space-y-5">
            <h2 data-reveal class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100 text-amber-600"><i class="fa-solid fa-clipboard-list"></i></span>
                Registros a Cargo
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-600 text-lg"><i class="fa-solid fa-people-arrows"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Intermediación Laboral (RENEEIL)</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Inscripción de Empresas Especiales de Servicios y Cooperativas de Trabajadores en el Registro Nacional de Empresas y Entidades que realizan Intermediación Laboral.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600 text-lg"><i class="fa-solid fa-briefcase"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Agencias Privadas de Empleo</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Registro y supervisión de las agencias privadas de empleo que realizan labores de colocación de trabajadores en el ámbito regional.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-100 text-purple-600 text-lg"><i class="fa-solid fa-user-graduate"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Modalidades Formativas</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Registro de convenios de prácticas pre-profesionales y profesionales, aprendizaje, capacitación laboral juvenil y pasantías (Ley N.° 28518).</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-cyan-100 text-cyan-600 text-lg"><i class="fa-solid fa-address-book"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Bolsa de Trabajo</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Registro de personas en búsqueda de empleo y de vacantes de empresas para la intermediación laboral (SILNET / Empleos Perú).</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-600 text-lg"><i class="fa-solid fa-certificate"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Certificación de Competencias</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Registro de personas evaluadas y certificadas en sus competencias laborales por los centros certificadores autorizados.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-100 text-rose-600 text-lg"><i class="fa-solid fa-chart-column"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Estadística del Empleo</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Producción de información mediante la Encuesta de Variación Mensual del Empleo y estudios sobre oferta y demanda de mano de obra regional.</p>
                </article>
            </div>
        </section>

        <!-- Finalidad -->
        <section data-reveal class="bg-white border border-slate-200 rounded-3xl p-6 sm:p-8 shadow-sm">
            <div class="flex items-center gap-3 mb-5">
                <div class="icon-tile flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-600 text-lg"><i class="fa-solid fa-screwdriver-wrench"></i></div>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight m-0">Finalidad de la Gestión</h2>
            </div>
            <ul class="space-y-3 text-slate-700 text-sm sm:text-base">
                <li class="flex gap-3 items-start"><i class="fa-solid fa-circle-check text-amber-600 mt-1"></i> <span>Ordenar y dar seguridad jurídica a los procedimientos de empleo, formación y desarrollo de la MYPE.</span></li>
                <li class="flex gap-3 items-start"><i class="fa-solid fa-circle-check text-amber-600 mt-1"></i> <span>Facilitar la atención a usuarios, empresas y personas en búsqueda de empleo con información confiable.</span></li>
                <li class="flex gap-3 items-start"><i class="fa-solid fa-circle-check text-amber-600 mt-1"></i> <span>Servir de base para el seguimiento, control y evaluación de las acciones de empleo y capacitación.</span></li>
            </ul>
        </section>
    </div>
</div>
@endsection
