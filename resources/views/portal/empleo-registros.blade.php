@extends('layouts.portal')

@section('content')
<div class="bg-scene min-h-screen relative py-12">
    <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-[2px] z-0"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <header class="bg-slate-900/90 border border-white/10 rounded-[2rem] p-8 shadow-2xl">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-3">
                    <span class="text-amber-500 font-semibold uppercase tracking-[0.3em] text-xs">Registros Administrativos</span>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-100 uppercase tracking-wider flex items-center gap-3">
                        <i class="fa-solid fa-file-lines text-amber-500"></i>
                        Información de registros y procedimientos
                    </h1>
                </div>
                <div class="rounded-3xl bg-amber-950/70 border border-amber-500/20 p-5 shadow-inner max-w-2xl">
                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                        Aquí se orienta el acceso a los registros administrativos vinculados a la gestión de empleo, formación profesional y desarrollo de la micro y pequeña empresa.
                    </p>
                </div>
            </div>
        </header>

        <section class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-500/10 text-amber-500">
                        <i class="fa-solid fa-folder-open"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">Documentación</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Se mantiene la organización documental de los trámites, reportes y registros relacionados con los programas de empleo y formación profesional.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500/10 text-emerald-500">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                    <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">Seguimiento</h2>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Los registros se utilizan para el seguimiento, control y evaluación de las acciones emprendidas en materia de empleo y capacitación.
                </p>
            </article>
        </section>

        <section class="bg-slate-900/80 border border-white/10 rounded-3xl p-6 sm:p-8 shadow-xl">
            <div class="flex items-center gap-3 mb-5">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-500/10 text-amber-500">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                </div>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-100 uppercase tracking-wider">Acceso a la gestión</h2>
            </div>

            <ul class="space-y-3 text-slate-300 text-sm sm:text-base">
                <li class="flex gap-3 items-start">
                    <i class="fa-solid fa-circle-check text-amber-500 mt-1"></i>
                    <span>Control de registros administrativos relacionados con los programas regionales.</span>
                </li>
                <li class="flex gap-3 items-start">
                    <i class="fa-solid fa-circle-check text-amber-500 mt-1"></i>
                    <span>Organización de información para la atención a usuarios, empresas y personas en búsqueda de empleo.</span>
                </li>
                <li class="flex gap-3 items-start">
                    <i class="fa-solid fa-circle-check text-amber-500 mt-1"></i>
                    <span>Apoyo técnico en la ejecución y seguimiento de acciones de formación y emprendimiento.</span>
                </li>
            </ul>
        </section>
    </div>
</div>
@endsection