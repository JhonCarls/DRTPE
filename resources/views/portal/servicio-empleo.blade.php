@extends('layouts.portal')

@section('content')
<div class="bg-scene min-h-screen relative py-12">
    <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-[2px] z-0"></div>
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <!-- Sección 1: Presentación del Centro de Empleo Puno -->
        <section class="mb-10 overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
            <div class="grid gap-8 p-8 lg:grid-cols-[1.2fr_0.8fr] lg:p-10">
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-3 rounded-2xl bg-slate-900/5 px-4 py-2 text-sm font-semibold text-slate-700">
                        <i class="fa-solid fa-building text-blue-700"></i>
                        Centro de Empleo Puno
                    </div>
                    <div class="space-y-4">
                        <h1 class="text-xl font-black text-slate-900 uppercase tracking-wider flex items-center gap-2">
                            <span>Centro de Empleo Puno</span>
                        </h1>
                        <p class="max-w-3xl text-base leading-8 text-slate-600">
                            El Centro de Empleo Puno es un mecanismo gratuito que articula los servicios de promoción del empleo, empleabilidad y emprendimiento para las 13 provincias de la región Puno, con prioridad en grupos vulnerables y poblaciones en situación de mayor necesidad.
                        </p>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <article class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                            <h2 class="text-lg font-black text-slate-900 uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-handshake-simple text-red-600"></i>
                                Módulo de Atención y Triaje
                            </h2>
                            <p class="mt-3 text-sm leading-7 text-slate-600">
                                Evaluación del perfil del ciudadano mediante la ficha única para derivación a los servicios adecuados de empleo, capacitación o certificación.
                            </p>
                        </article>
                        <article class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                            <h2 class="text-lg font-black text-slate-900 uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-briefcase text-blue-700"></i>
                                Acercamiento Empresarial
                            </h2>
                            <p class="mt-3 text-sm leading-7 text-slate-600">
                                Registro de empresas altiplánicas y canalización de sus requerimientos hacia Bolsa de Trabajo, Capacitación o Certificación de Competencias.
                            </p>
                        </article>
                    </div>
                </div>
                <div class="rounded-[1.75rem] border border-slate-200 bg-slate-900/5 p-8 shadow-sm">
                    <div class="rounded-3xl bg-slate-900 px-5 py-6 text-slate-50 shadow-sm">
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-300">Atención estratégica</p>
                        <h2 class="mt-4 text-3xl font-black text-white">Articulando empleos, competencias y emprendimientos</h2>
                    </div>
                    <div class="mt-8 space-y-5">
                        <div class="rounded-3xl bg-white p-5 shadow-sm border border-slate-200">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-900">Cobertura regional</p>
                            <p class="mt-3 text-sm leading-7 text-slate-600">Acción territorial en las 13 provincias de Puno, con énfasis en servicios inclusivos y sostenibles.</p>
                        </div>
                        <div class="rounded-3xl bg-white p-5 shadow-sm border border-slate-200">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-900">Grupos vulnerables</p>
                            <p class="mt-3 text-sm leading-7 text-slate-600">Atención prioritaria a jóvenes, mujeres rurales, adultos mayores y personas con discapacidad.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección 2: Bolsa de Trabajo -->
        <section class="mb-10">
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <article class="w-full bg-black border border-gray-800 rounded-2xl p-8 group hover:shadow-lg hover:shadow-black/50 transition-all">
                <h2 class="text-2xl font-bold text-white uppercase tracking-wider flex items-center gap-3">
                    <i class="fa-solid fa-briefcase text-blue-400"></i>
                    Bolsa de Trabajo
                </h2>

                <p class="mt-4 text-base leading-8 text-gray-200">
                    Intermediación laboral transparente para postulantes y empresas, con acceso presencial y virtual a servicios de colocación y seguimiento en todo el país.
                </p>
                </article>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-wider">Modalidad Presencial</h3>
                    <p class="mt-4 text-sm leading-7 text-slate-600">
                        Uso del sistema SILNET para atención directa a buscadores de empleo y empresas, asegurando vinculación y seguimiento efectivo.
                    </p>
                    <ul class="mt-5 list-disc space-y-3 pl-5 text-sm leading-7 text-slate-600">
                        <li>Atención a personas en búsqueda de empleo con perfilamiento personalizado.</li>
                        <li>Registro de empresas y verificación de vacantes.</li>
                        <li>Vinculación operacional entre oferta y demanda.</li>
                        <li>Seguimiento con criterios de matching y trazabilidad.</li>
                    </ul>
                </article>
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-wider">Modalidad Virtual</h3>
                    <p class="mt-4 text-sm leading-7 text-slate-600">
                        Conexión con el portal nacional Empleos Perú para validación de ofertas, registro de CV y acceso a espacios juveniles e inclusivos.</p>
                    <ul class="mt-5 list-disc space-y-3 pl-5 text-sm leading-7 text-slate-600">
                        <li>Validación de ofertas mediante RUC y razón social.</li>
                        <li>Registro digital de competencias y CV.</li>
                        <li>Acceso al Portal Empleo Joven (18-29 años).</li>
                        <li>Módulo Inclusivo para atención a personas en situación de vulnerabilidad.</li>
                    </ul>
                </article>
            </div>
        </section>

        <!-- Sección 3: Asesoría en la Búsqueda de Empleo - ABE -->
        <section class="mb-10">
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <article class="w-full bg-black border border-gray-800 rounded-2xl p-8 group hover:shadow-lg hover:shadow-black/50 transition-all">
                <h2 class="text-2xl font-bold text-white uppercase tracking-wider flex items-center gap-3">
                    <i class="fa-solid fa-user-graduate text-red-600"></i>
                    Asesoría en la Búsqueda de Empleo - ABE
                </h2>
                <p class="mt-4 text-base leading-8 text-gray-200">
                    Capacitación autónoma basada en el cuestionario CINUTA para reforzar habilidades laborales, CV y desempeño en procesos de evaluación.
                </p>
                </article>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="h-1 w-16 rounded-full bg-blue-700"></div>
                    <h3 class="mt-5 text-lg font-black text-slate-900">Descubriendo nuestras capacidades para el empleo</h3>
                    <p class="mt-4 text-sm leading-7 text-slate-600">Autoconocimiento local, autoestima competitiva, competencias laborales y fuentes de empleo altiplánicas.</p>
                </article>
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="h-1 w-16 rounded-full bg-blue-700"></div>
                    <h3 class="mt-5 text-lg font-black text-slate-900">Herramientas básicas para un Currículum Vitae</h3>
                    <p class="mt-4 text-sm leading-7 text-slate-600">Formatos claros, marketeando nuestro CV y construcción de un perfil exitoso y vendible.</p>
                </article>
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="h-1 w-16 rounded-full bg-blue-700"></div>
                    <h3 class="mt-5 text-lg font-black text-slate-900">Cómo afrontar el proceso de evaluación</h3>
                    <p class="mt-4 text-sm leading-7 text-slate-600">Pruebas psicológicas recurrentes y simulaciones de entrevista vía role-playing.</p>
                </article>
            </div>
        </section>

        <!-- Sección 4: Servicios Especializados y Alianzas -->
        <section class="mb-10">
            <div class="mb-6 mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <article class="w-full bg-black border border-gray-800 rounded-2xl p-8 group hover:shadow-lg hover:shadow-black/50 transition-all">
                <h2 class="text-2xl font-bold text-white uppercase tracking-wider flex items-center gap-3">
                    <i class="fa-solid fa-star text-blue-700"></i>
                    Servicios Especializados y Alianzas
                </h2>
                <p class="mt-4 text-base leading-8 text-gray-200">
                    Soluciones complementarias para vinculación empresarial, empleo temporal y orientación a migrantes desde una perspectiva institucional.
                </p>
                </article>
            </div>
            <div class="grid gap-6 lg:grid-cols-3">
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-black text-slate-900">Alianza con el Sector Empresarial</h3>
                    <p class="mt-4 text-sm leading-7 text-slate-600">Vinculación con Empleos Perú y articulación de formación de mano de obra calificada a medida cuando no hay perfiles inmediatos.</p>
                </article>
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-black text-slate-900">Empleo Temporal</h3>
                    <p class="mt-4 text-sm leading-7 text-slate-600">Articulación con programas nacionales como Llamkasun Perú para obras de infraestructura básica en zonas urbanas y rurales de Puno.</p>
                </article>
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-black text-slate-900">Orientación al Migrante</h3>
                    <p class="mt-4 text-sm leading-7 text-slate-600">Orientación legal en migración laboral, retorno a Puno y talleres de aprovechamiento de remesas.</p>
                </article>
            </div>
        </section>

    </div>
</div>
@endsection