@extends('layouts.portal')

@section('content')
<div class="bg-scene-light min-h-screen relative py-12">
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="space-y-10">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-300 bg-white/90 px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm transition hover:bg-slate-50">
                    <i class="fa-solid fa-arrow-left text-slate-900"></i>
                    Volver al inicio
                </a>
            </div>

            <section class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
                <div class="grid gap-8 p-8 lg:grid-cols-[1.2fr_0.8fr] lg:p-10">
                    <div class="space-y-6">
                        <div class="inline-flex items-center gap-3 rounded-2xl bg-slate-900/5 px-4 py-2 text-sm font-semibold text-slate-700">
                            <i class="fa-solid fa-id-card text-red-600"></i>
                            Formaliza Perú Puno
                        </div>
                        <div class="space-y-4">
                            <h1 class="text-xl font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">
                                <i class="fa-solid fa-briefcase text-red-600"></i>
                                <span>Formaliza Perú Puno</span>
                            </h1>
                            <p class="max-w-3xl text-base leading-8 text-slate-600">
                                Dirección Regional de Trabajo y Promoción del Empleo Puno - Gobierno Regional Puno / MTPE.
                            </p>
                        </div>
                    </div>
                    <div class="rounded-[1.75rem] border border-slate-200 bg-slate-900/5 p-8 shadow-sm">
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Servicio institucional</p>
                        <h2 class="mt-4 text-3xl font-black text-slate-900">Acompañamiento para la formalización laboral y empresarial</h2>
                        <p class="mt-4 text-sm leading-7 text-slate-600">
                            El Centro Integrado Formaliza Perú impulsa la formalización, el cumplimiento normativo y la mejora de condiciones para emprendedores y trabajadores.
                        </p>
                    </div>
                </div>
            </section>

            <section class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                <div class="space-y-6">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-users text-red-600"></i>
                        <h2 class="text-xl font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">¿Quiénes Somos?</h2>
                    </div>
                    <p class="max-w-4xl text-base leading-8 text-slate-600">
                        El centro integrado Formaliza Perú es un servicio del MTPE, que tiene como objetivo promover y facilitar el ingreso y permanencia en la formalización laboral, impulsando el cumplimiento de obligaciones y el acceso a derechos para emprendedores, trabajadores y empresas.
                    </p>

                    <div class="grid gap-4 md:grid-cols-3">
                        <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 p-6 shadow-sm">
                            <p class="text-sm font-black uppercase tracking-[0.3em] text-slate-900">Orientación</p>
                            <p class="mt-3 text-sm leading-7 text-slate-600">Asesoría inicial para identificar rutas de formalización y requisitos según el tipo de actividad.</p>
                        </div>
                        <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 p-6 shadow-sm">
                            <p class="text-sm font-black uppercase tracking-[0.3em] text-slate-900">Capacitación</p>
                            <p class="mt-3 text-sm leading-7 text-slate-600">Talleres y orientación práctica sobre trámites, tributos, seguridad y formalización empresarial.</p>
                        </div>
                        <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 p-6 shadow-sm">
                            <p class="text-sm font-black uppercase tracking-[0.3em] text-slate-900">Asistencia técnica</p>
                            <p class="mt-3 text-sm leading-7 text-slate-600">Acompañamiento continuo para resolver dudas y avanzar en los procesos de manera confiable.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="rounded-[2rem] border border-slate-200 bg-slate-50 p-8 shadow-sm">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-file-contract text-red-600"></i>
                    <h2 class="text-xl font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">Nuestros Servicios</h2>
                </div>
                <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                    <article class="rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-file-circle-check text-red-600"></i>
                            <h3 class="text-base font-black text-slate-900 uppercase tracking-wider">Trámites de Formalización</h3>
                        </div>
                        <p class="mt-3 text-sm leading-7 text-slate-600">Proceso y/o trámites de formalización para personas y negocios que inician o fortalecen su actividad.</p>
                    </article>

                    <article class="rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-building-columns text-red-600"></i>
                            <h3 class="text-base font-black text-slate-900 uppercase tracking-wider">Personería Jurídica</h3>
                        </div>
                        <p class="mt-3 text-sm leading-7 text-slate-600">Orientación para elegir el tipo de personería, ya sea persona natural con negocio o persona jurídica.</p>
                    </article>

                    <article class="rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-receipt text-red-600"></i>
                            <h3 class="text-base font-black text-slate-900 uppercase tracking-wider">Gestión Tributaria y SUNAT</h3>
                        </div>
                        <p class="mt-3 text-sm leading-7 text-slate-600">Apoyo para obtener la Clave SOL, crear el RUC, elegir el régimen tributario y emitir comprobantes de pago.</p>
                    </article>

                    <article class="rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-file-signature text-red-600"></i>
                            <h3 class="text-base font-black text-slate-900 uppercase tracking-wider">Licencias</h3>
                        </div>
                        <p class="mt-3 text-sm leading-7 text-slate-600">Gestión y orientación para obtener la licencia de funcionamiento requerida por la actividad.</p>
                    </article>

                    <article class="rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-clipboard-list text-red-600"></i>
                            <h3 class="text-base font-black text-slate-900 uppercase tracking-wider">Registro REMYPE</h3>
                        </div>
                        <p class="mt-3 text-sm leading-7 text-slate-600">Orientación para realizar el registro correspondiente en el REMYPE y fortalecer la formalidad empresarial.</p>
                    </article>

                    <article class="rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-money-check-dollar text-red-600"></i>
                            <h3 class="text-base font-black text-slate-900 uppercase tracking-wider">Planillas</h3>
                        </div>
                        <p class="mt-3 text-sm leading-7 text-slate-600">Orientación para gestionar planillas electrónicas y cumplir con las obligaciones laborales y tributarias.</p>
                    </article>

                    <article class="rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm md:col-span-2 xl:col-span-1">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-shield-halved text-red-600"></i>
                            <h3 class="text-base font-black text-slate-900 uppercase tracking-wider">Seguridad en el Trabajo</h3>
                        </div>
                        <p class="mt-3 text-sm leading-7 text-slate-600">Apoyo para gestionar un plan de riesgos laborales y fortalecer la protección de los trabajadores.</p>
                    </article>
                </div>
            </section>

            <section class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-award text-red-600"></i>
                    <h2 class="text-xl font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">Registro de la Micro y Pequeña Empresa (REMYPE)</h2>
                </div>

                <div class="mt-6 grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
                    <article class="rounded-[1.75rem] border border-slate-200 bg-slate-50 p-6 shadow-sm">
                        <p class="text-sm leading-8 text-slate-600">
                            Se denomina a la acreditación de las micro y pequeñas empresas que cumplen con determinadas características, además de autorizar el acogimiento a sus beneficios y registrarla mediante el registro de la MYPE.
                        </p>
                        <div class="mt-6 rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm">
                            <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider m-0">Requisitos para el registro</h3>
                            <ul class="mt-4 list-disc space-y-3 pl-5 text-sm leading-7 text-slate-700">
                                <li>Nº RUC.</li>
                                <li>Usuario.</li>
                                <li>Clave SOL.</li>
                                <li>01 trabajador en planilla.</li>
                            </ul>
                        </div>
                    </article>

                    <article class="rounded-[1.75rem] border border-slate-200 bg-slate-900/5 p-6 shadow-sm">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider m-0">Ventajas de ser una MYPE</h3>
                        <div class="mt-5 space-y-3 text-sm leading-7 text-slate-700">
                            <div class="rounded-2xl border border-slate-200 bg-white p-4">
                                <p class="font-semibold text-slate-900">Crédito Financiero</p>
                                <p class="mt-1">Acceso a crédito de instituciones financieras.</p>
                            </div>
                            <div class="rounded-2xl border border-slate-200 bg-white p-4">
                                <p class="font-semibold text-slate-900">Compras Estatales (COMPRAS MYPErú)</p>
                                <p class="mt-1">El Estado adquiere bienes y servicios mediante la página COMPRAS MYPERU, solo para MYPES.</p>
                            </div>
                            <div class="rounded-2xl border border-slate-200 bg-white p-4">
                                <p class="font-semibold text-slate-900">Apoyo Financiero (Impulso MYPErú)</p>
                                <p class="mt-1">Apoyo del Estado a préstamos solo para MYPES.</p>
                            </div>
                            <div class="rounded-2xl border border-slate-200 bg-white p-4">
                                <p class="font-semibold text-slate-900">Bonificación en Licitaciones</p>
                                <p class="mt-1">Bonificación del 5% en contrataciones con el Estado siendo MYPE.</p>
                            </div>
                            <div class="rounded-2xl border border-slate-200 bg-white p-4">
                                <p class="font-semibold text-slate-900">Régimen Laboral</p>
                                <p class="mt-1">Pertenecer al régimen laboral especial.</p>
                            </div>
                            <div class="rounded-2xl border border-slate-200 bg-white p-4">
                                <p class="font-semibold text-slate-900">Registro de Marca</p>
                                <p class="mt-1">Descuento del 25% registrando mi marca.</p>
                            </div>
                            <div class="rounded-2xl border border-slate-200 bg-white p-4">
                                <p class="font-semibold text-slate-900">Cuota Estatal de Compras</p>
                                <p class="mt-1">El Estado debe programar no menos del 40% de sus contrataciones de bienes y servicios para las MYPES.</p>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
