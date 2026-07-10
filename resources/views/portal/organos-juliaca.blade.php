@extends('layouts.portal')

@section('content')
<div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl space-y-8">

        <header class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="grid gap-8 bg-gradient-to-br from-slate-900 via-slate-800 to-blue-950 p-8 text-white lg:grid-cols-[1.4fr_0.8fr] lg:p-10">
                <div class="space-y-4">
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-blue-100">
                        Órgano Desconcentrado
                    </div>
                    <div class="space-y-3">
                        <h1 class="text-3xl font-black uppercase tracking-tight sm:text-4xl">
                            Zona de Trabajo y Promoción del Empleo de Juliaca
                        </h1>
                        <p class="max-w-3xl text-sm leading-7 text-slate-300 sm:text-base">
                            Depende jerárquica y administrativamente de la DRTPE Puno, y su gestión está orientada a la ejecución territorial de las competencias en empleo, formación profesional, inspección laboral y defensa legal gratuita.
                        </p>
                    </div>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/10 p-6 backdrop-blur-sm">
                    <div class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-300">Responsable</p>
                            <h2 class="text-lg font-bold text-white">Jefe de Zona / Director de Programa Sectorial I (F-2)</h2>
                        </div>
                    </div>
                    <div class="mt-5 rounded-xl border border-white/10 bg-slate-950/30 p-4 text-sm text-slate-300">
                        <p class="font-medium">Artículo 33 y 36</p>
                        <p class="mt-1 text-slate-400">Cargo de dirección y dependencia jerárquica de la DRTPE Puno.</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Funciones Clave -->
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <div class="mb-6 flex items-center gap-3">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.25em] text-blue-700">Funciones clave</p>
                    <h2 class="text-2xl font-black text-slate-900">Competencias delegadas</h2>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                <article class="group rounded-2xl border border-slate-200 bg-slate-50 p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] hover:shadow-md">
                    <h3 class="text-lg font-bold text-slate-900">Negociaciones Colectivas</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-600">Promueve la interlocución institucional y la solución coordinada de conflictos laborales en el ámbito territorial.</p>
                </article>

                <article class="group rounded-2xl border border-slate-200 bg-slate-50 p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] hover:shadow-md">
                    <h3 class="text-lg font-bold text-slate-900">Inspección Laboral</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-600">Ejecuta el seguimiento y control de las obligaciones laborales en el territorio, con enfoque preventivo y de cumplimiento normativo.</p>
                </article>

                <article class="group rounded-2xl border border-slate-200 bg-slate-50 p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] hover:shadow-md">
                    <h3 class="text-lg font-bold text-slate-900">Seguridad y Salud en el Trabajo</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-600">Fortalece la prevención de riesgos y la protección de los trabajadores en el ejercicio de sus actividades.</p>
                </article>

                <article class="group rounded-2xl border border-slate-200 bg-slate-50 p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] hover:shadow-md">
                    <h3 class="text-lg font-bold text-slate-900">Registros Generales</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-600">Administra la información y documentación de los procedimientos y servicios que se brindan en la zona de trabajo.</p>
                </article>

                <article class="group rounded-2xl border border-slate-200 bg-slate-50 p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] hover:shadow-md">
                    <h3 class="text-lg font-bold text-slate-900">Defensa Legal Gratuita y Asesoría del Trabajador</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-600">Brinda orientación, soporte técnico y atención especializada a los trabajadores y empleadores en materia laboral.</p>
                </article>

                <article class="group rounded-2xl border border-slate-200 bg-slate-50 p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] hover:shadow-md">
                    <h3 class="text-lg font-bold text-slate-900">Promoción del Empleo, Formación Profesional y MYPE</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-600">Impulsa acciones de empleo, capacitación y fortalecimiento de la micro y pequeña empresa en el contexto regional.</p>
                </article>
            </div>
        </section>
    </div>
</div>
@endsection
