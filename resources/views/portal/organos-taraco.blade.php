@extends('layouts.portal')

@section('content')
<div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl space-y-8">

        <header class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="bg-gradient-to-br from-blue-950 via-slate-900 to-slate-800 p-8 text-white lg:p-10">
                <div class="space-y-4">
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-blue-100">
                        <i class="fa-solid fa-graduation-cap"></i>
                        Centro de Formación Profesional
                    </div>
                    <h1 class="text-3xl font-black uppercase tracking-tight sm:text-4xl">
                        Centro de Formación Profesional de Taraco
                    </h1>
                    <p class="max-w-3xl text-sm leading-7 text-slate-300 sm:text-base">
                        Órgano técnico-formativo dependiente de la Dirección Regional, orientado a la capacitación, calificación ocupacional y fortalecimiento de capacidades productivas en el territorio.
                    </p>
                </div>
            </div>
        </header>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <div class="mb-6 flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">
                    <i class="fa-solid fa-bullseye text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.25em] text-blue-700">Objetivos y funciones</p>
                    <h2 class="text-2xl font-black text-slate-900">Ámbito de acción institucional</h2>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <article class="rounded-2xl border border-slate-200 bg-slate-50 p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] hover:shadow-md">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-700">
                        <i class="fa-solid fa-certificate text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">a) Calificación de mano de obra y certificación ocupacional</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-600">Desarrolla procesos de formación y certificación que fortalecen la empleabilidad y la competitividad laboral de los participantes.</p>
                </article>

                <article class="rounded-2xl border border-slate-200 bg-slate-50 p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] hover:shadow-md">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">
                        <i class="fa-solid fa-chalkboard-teacher text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">b) Capacitación y asesoramiento a trabajadores</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-600">Ofrece capacitación técnica y orientación especializada para mejorar las capacidades productivas y de inserción laboral.</p>
                </article>

                <article class="rounded-2xl border border-slate-200 bg-slate-50 p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] hover:shadow-md">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-100 text-violet-700">
                        <i class="fa-solid fa-laptop-code text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">c) Validación de tecnología educativa y material didáctico</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-600">Coordina con la Dirección Nacional la validación de contenidos pedagógicos y recursos tecnológicos para la capacitación.</p>
                </article>

                <article class="rounded-2xl border border-slate-200 bg-slate-50 p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] hover:shadow-md">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-cyan-100 text-cyan-700">
                        <i class="fa-solid fa-industry text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">d) Proyectos específicos de producción de bienes</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-600">Impulsa iniciativas productivas orientadas a la generación de bienes y servicios con enfoque técnico y empresarial.</p>
                </article>

                <article class="rounded-2xl border border-slate-200 bg-slate-50 p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] hover:shadow-md md:col-span-2">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-100 text-rose-700">
                        <i class="fa-solid fa-flask text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">e) Investigación y validación de nuevos métodos productivos</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-600">Promueve la experimentación y evaluación de nuevas prácticas productivas, técnicas y pedagógicas en beneficio de los actores del sector.</p>
                </article>
            </div>
        </section>
    </div>
</div>
@endsection
