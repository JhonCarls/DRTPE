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
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <div class="space-y-2">
                        <span class="text-amber-400 font-bold uppercase tracking-[0.3em] text-xs">Dirección Especializada</span>
                        <h1 class="text-2xl sm:text-4xl font-black uppercase tracking-tight leading-tight m-0">
                            Promoción del Empleo, Formación Profesional y de la Micro y Pequeña Empresa
                        </h1>
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed m-0 max-w-3xl">
                            Órgano encargado de ejecutar las acciones de política sectorial en materia de empleo y formación profesional, así como de promover el desarrollo y la formalización de la Micro y Pequeña Empresa y los nuevos emprendimientos.
                        </p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dependencia y funciones -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-5">
            <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-600 text-lg"><i class="fa-solid fa-sitemap"></i></div>
                <h2 class="text-lg font-black text-slate-900 uppercase tracking-wide m-0 mb-2">Dependencia y Cargo</h2>
                <p class="text-slate-600 leading-relaxed text-sm m-0">
                    Está a cargo de un Director y depende jerárquica y administrativamente de la Dirección Regional. En el aspecto técnico-normativo, depende de la Dirección Nacional de Promoción del Empleo y Formación Profesional y de la Dirección Nacional de la Micro y Pequeña Empresa del MTPE.
                </p>
            </article>
            <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-600 text-lg"><i class="fa-solid fa-list-check"></i></div>
                <h2 class="text-lg font-black text-slate-900 uppercase tracking-wide m-0 mb-2">Funciones y Atribuciones</h2>
                <p class="text-slate-600 leading-relaxed text-sm m-0">
                    Dirige, coordina, ejecuta, supervisa y evalúa las acciones de empleo y formación profesional; vela por el cumplimiento de normas, programas y directivas técnicas; propone mejoras normativas y promueve la coordinación regional y local con instituciones públicas y privadas.
                </p>
            </article>
        </section>

        <!-- SERVICIOS AL CIUDADANO (contenido del flyer institucional) -->
        <section aria-label="Servicios al ciudadano" class="space-y-5">
            <div data-reveal class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3">
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3 m-0">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-100 text-red-600"><i class="fa-solid fa-handshake-angle"></i></span>
                    ¿Buscas Trabajo? Estamos para Ayudarte
                </h2>
                <span class="inline-flex items-center gap-2 self-start sm:self-auto rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold uppercase tracking-wide px-3 py-1.5">
                    <i class="fa-solid fa-circle-check"></i> Servicios gratuitos
                </span>
            </div>
            <p data-reveal class="text-slate-600 text-sm sm:text-base leading-relaxed bg-white border border-slate-200 rounded-xl p-4 shadow-sm m-0">
                La DRTPE Puno te ofrece servicios gratuitos para mejorar tus oportunidades laborales a través del Centro de Empleo:
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-blue-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-600 text-lg"><i class="fa-solid fa-briefcase"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Bolsa de Trabajo</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Intermediación entre postulantes y empresas, vinculando la oferta de vacantes con las personas en búsqueda de empleo.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-blue-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600 text-lg"><i class="fa-solid fa-compass"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Orientación para la Búsqueda de Empleo</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Asesoría personalizada para definir tu perfil, identificar oportunidades y planificar una búsqueda de empleo efectiva.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-blue-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-600 text-lg"><i class="fa-solid fa-file-lines"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Elaboración de CV</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Apoyo para construir un currículum vitae claro y competitivo que resalte tus competencias y experiencia.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-blue-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-100 text-purple-600 text-lg"><i class="fa-solid fa-comments"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Preparación para Entrevistas</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Simulaciones y técnicas para afrontar con seguridad los procesos de evaluación y entrevistas laborales.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-blue-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-cyan-100 text-cyan-600 text-lg"><i class="fa-solid fa-people-arrows"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Intermediación Laboral</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Articulación directa entre la demanda de las empresas y el talento disponible en la región para facilitar la colocación.</p>
                </article>
                <article data-reveal class="card-hover flex flex-col justify-center bg-gradient-to-br from-red-600 to-red-700 border border-red-500 rounded-2xl p-6 shadow-md text-white">
                    <div class="icon-tile mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-white/15 text-white text-lg"><i class="fa-solid fa-location-dot"></i></div>
                    <h3 class="text-base font-black uppercase tracking-wide m-0 mb-1">Acércate a Nuestras Oficinas</h3>
                    <p class="text-red-50 text-sm leading-relaxed m-0">Recibe asesoría gratuita en la sede de la DRTPE Puno y en el Centro de Empleo de Juliaca.</p>
                </article>
            </div>
        </section>

        <!-- Subdirección especializada -->
        <section data-reveal class="bg-white border border-slate-200 rounded-3xl p-6 sm:p-8 shadow-sm">
            <div class="flex items-center gap-3 mb-5">
                <div class="icon-tile flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-600 text-lg"><i class="fa-solid fa-diagram-project"></i></div>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight m-0">Subdirección Especializada</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="rounded-2xl bg-slate-50 border border-slate-200 p-5">
                    <h3 class="text-base font-black text-slate-900 mb-2 flex items-center gap-2"><i class="fa-solid fa-circle-info text-amber-600"></i> Definición</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Encargada de ejecutar, dirigir, supervisar, coordinar y evaluar las actividades técnico-administrativas de Promoción del Empleo, Formación Profesional y de la Micro y Pequeña Empresa.</p>
                </div>
                <div class="rounded-2xl bg-slate-50 border border-slate-200 p-5">
                    <h3 class="text-base font-black text-slate-900 mb-2 flex items-center gap-2"><i class="fa-solid fa-list text-amber-600"></i> Acceso a Funciones</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Incluye dirección, cumplimiento normativo, supervisión de programas, asesoría empresarial, coordinación regional y promoción de emprendimientos y formación laboral.</p>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('portal.empleo-subdireccion') }}" class="inline-flex items-center gap-2 bg-amber-600 hover:bg-amber-700 text-white font-semibold py-3 px-5 rounded-xl transition-all duration-300 shadow-lg hover:shadow-amber-500/30 hover:-translate-y-0.5">
                    <i class="fa-solid fa-arrow-right"></i>
                    Ver funciones de la subdirección
                </a>
            </div>
        </section>
    </div>
</div>
@endsection
