@extends('layouts.portal')

@section('content')
<div class="bg-scene-light min-h-screen relative py-12">
    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Volver -->
        <div data-reveal class="flex justify-start">
            <a href="{{ route('portal.Sconflictos') }}" class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-700 px-4 py-2 rounded-2xl shadow-sm hover:bg-slate-50 hover:-translate-y-0.5 transition-all duration-300">
                <i class="fa-solid fa-arrow-left text-blue-600"></i>
                Volver a Dirección Principal
            </a>
        </div>

        <!-- Encabezado -->
        <header data-reveal class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-lg shadow-slate-300/40">
            <div class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-blue-950 p-8 sm:p-10 text-white">
                <div class="pointer-events-none absolute -top-16 -right-12 w-72 h-72 bg-blue-500/25 rounded-full blur-3xl"></div>
                <div class="relative flex items-start gap-5">
                    <div class="icon-tile hidden sm:flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-2xl bg-blue-500/15 border border-blue-400/30 text-blue-300 text-2xl">
                        <i class="fa-solid fa-helmet-safety"></i>
                    </div>
                    <div class="space-y-2">
                        <span class="text-blue-400 font-bold uppercase tracking-[0.3em] text-xs">Sub Dirección Especializada</span>
                        <h1 class="text-2xl sm:text-4xl font-black uppercase tracking-tight leading-tight m-0">
                            Inspección Laboral, Seguridad y Salud en el Trabajo
                        </h1>
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed m-0 max-w-3xl">
                            <strong class="text-white">Artículo 26º.</strong> Esta subdirección cuenta con las siguientes funciones y atribuciones en materia de fiscalización y protección de los trabajadores.
                        </p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Funciones -->
        <section class="space-y-5">
            <h2 data-reveal class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-blue-600"><i class="fa-solid fa-list-check"></i></span>
                Funciones y Atribuciones
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @php
                    $funcs = [
                        ['a','Planificación','fa-calendar-check','bg-blue-100 text-blue-600','Participar en la elaboración del plan anual de actividades de la dirección.'],
                        ['b','Gestión TUPA','fa-file-lines','bg-indigo-100 text-indigo-600','Ejecutar y evaluar los procedimientos de su competencia contenidos en el TUPA sectorial.'],
                        ['c','Seguridad e Higiene','fa-helmet-safety','bg-orange-100 text-orange-600','Aprobar los reglamentos internos de higiene y seguridad industrial y autorizar el trabajo de adolescentes.'],
                        ['d','Fiscalización de Cierres','fa-store-slash','bg-red-100 text-red-600','Verificar el cierre de centros de trabajo sin autorización de la autoridad de trabajo, según el Plan Anual de Inspecciones.'],
                        ['e','Inspecciones Específicas','fa-magnifying-glass-location','bg-cyan-100 text-cyan-600','Efectuar inspecciones específicas y verificar, a solicitud de parte, despidos arbitrarios o disminución del rendimiento.'],
                        ['f','CTS','fa-money-check-dollar','bg-emerald-100 text-emerald-600','Resolver la observación del trabajador a la liquidación de compensación por tiempo de servicios (CTS).'],
                        ['g','Constancias de Cese','fa-file-circle-check','bg-teal-100 text-teal-600','Otorgar constancias de cese ante abandono, imposibilidad o negativa injustificada del empleador por más de 48 horas.'],
                        ['h','Autorización de Locales','fa-building-circle-check','bg-sky-100 text-sky-600','Autorizar el funcionamiento de centros de trabajo por cambio de domicilio, actividad, razón social o pérdida de documentos.'],
                        ['i','Asuntos Sindicales','fa-people-group','bg-purple-100 text-purple-600','Determinar la organización sindical representativa para convenios colectivos y verificar paralizaciones o huelgas.'],
                        ['j','Actos Administrativos','fa-stamp','bg-fuchsia-100 text-fuchsia-600','Emitir autos y resoluciones subdirectorales, y conocer y tramitar los procedimientos de su competencia.'],
                        ['k','Supervisión Técnica','fa-clipboard-check','bg-blue-100 text-blue-600','Programar, supervisar y evaluar las inspecciones de trabajo y la inspección técnica especializada de SST.'],
                        ['l','Otras Funciones','fa-ellipsis','bg-slate-100 text-slate-600','Cumplir otras funciones que le asigne el Director de Prevención y Solución de Conflictos.'],
                    ];
                @endphp
                @foreach ($funcs as [$letra, $titulo, $icono, $color, $desc])
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-blue-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl {{ $color }}"><i class="fa-solid {{ $icono }}"></i></div>
                        <span class="text-blue-600 font-black text-sm">{{ $letra }})</span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">{{ $titulo }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">{{ $desc }}</p>
                </article>
                @endforeach
            </div>
        </section>

        <!-- Nota de cierre -->
        <section data-reveal class="bg-white border border-slate-200 rounded-3xl p-6 sm:p-8 shadow-sm">
            <div class="flex items-start gap-4">
                <div class="icon-tile flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl bg-blue-100 text-blue-600 text-lg"><i class="fa-solid fa-shield-halved"></i></div>
                <div>
                    <h3 class="text-lg font-black text-slate-900 m-0 mb-2">Observación</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Esta subdirección actúa como garante de la seguridad y salud en el trabajo, asegurando el cumplimiento normativo y la protección efectiva de los derechos de los trabajadores en la región.</p>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
