@extends('layouts.portal')

@section('content')
<div class="bg-scene-light min-h-screen relative py-12">
    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <header data-reveal class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-lg shadow-slate-300/40">
            <div class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-amber-950 p-8 sm:p-10 text-white">
                <div class="pointer-events-none absolute -top-16 -right-12 w-72 h-72 bg-amber-500/20 rounded-full blur-3xl"></div>
                <div class="relative flex items-start gap-5">
                    <div class="icon-tile hidden sm:flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-2xl bg-amber-500/15 border border-amber-400/30 text-amber-300 text-2xl">
                        <i class="fa-solid fa-chart-pie"></i>
                    </div>
                    <div class="space-y-2">
                        <span class="text-amber-400 font-bold uppercase tracking-[0.3em] text-xs">Oficina de Administración</span>
                        <h1 class="text-2xl sm:text-4xl font-black uppercase tracking-tight leading-tight m-0">Área de Presupuesto</h1>
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed m-0 max-w-3xl">
                            Conduce el proceso presupuestario de la entidad en sus fases de programación, formulación, ejecución y evaluación, en el marco del Sistema Nacional de Presupuesto Público.
                        </p>
                    </div>
                </div>
            </div>
        </header>

        <section class="space-y-5">
            <h2 data-reveal class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100 text-amber-600"><i class="fa-solid fa-list-check"></i></span>
                Funciones Principales
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @php
                    $funcs = [
                        ['Programación y formulación','fa-diagram-project','bg-amber-100 text-amber-600','Conducir la programación y formulación del presupuesto institucional en coordinación con las unidades orgánicas y el pliego regional.'],
                        ['Ejecución presupuestal','fa-gauge-high','bg-blue-100 text-blue-600','Controlar y hacer seguimiento a la ejecución del presupuesto conforme a las metas y actividades programadas.'],
                        ['Certificación de crédito','fa-stamp','bg-indigo-100 text-indigo-600','Emitir la certificación de crédito presupuestario que garantice la disponibilidad de recursos para el gasto.'],
                        ['Modificaciones','fa-arrows-rotate','bg-emerald-100 text-emerald-600','Tramitar las modificaciones presupuestarias en el nivel funcional programático que resulten necesarias.'],
                        ['Evaluación','fa-magnifying-glass-chart','bg-cyan-100 text-cyan-600','Evaluar el cumplimiento de las metas presupuestales y elaborar los informes de evaluación correspondientes.'],
                        ['Coordinación regional','fa-handshake-simple','bg-rose-100 text-rose-600','Coordinar con la Dirección Regional y la Oficina de Presupuesto del Gobierno Regional la asignación de recursos.'],
                    ];
                @endphp
                @foreach ($funcs as [$titulo, $icono, $color, $desc])
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl {{ $color }} text-lg"><i class="fa-solid {{ $icono }}"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">{{ $titulo }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">{{ $desc }}</p>
                </article>
                @endforeach
            </div>
        </section>
    </div>
</div>
@endsection
