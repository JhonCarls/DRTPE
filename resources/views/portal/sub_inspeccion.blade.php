@extends('layouts.portal')

@section('content')
<div class="bg-scene min-h-screen relative py-12">
    <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-[2px] z-0"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- Botón de retorno superior -->
        <div class="flex justify-start">
            <a href="{{ route('portal.Sconflictos') }}" class="inline-flex items-center gap-2 bg-slate-900/80 border border-white/10 text-white px-4 py-2 rounded-2xl shadow-sm hover:bg-slate-900 transition-all duration-300">
                <i class="fa-solid fa-arrow-left text-red-500"></i>
                Volver a Dirección Principal
            </a>
        </div>

        <!-- Encabezado principal -->
        <header class="bg-slate-900/90 border border-white/10 rounded-[2rem] p-8 shadow-2xl">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-3">
                    <span class="text-red-600 font-semibold uppercase tracking-[0.3em] text-xs">Sub Dirección Especializada</span>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-100 uppercase tracking-wider flex items-center gap-3">
                        <i class="fa-solid fa-shield-halved text-red-600"></i>
                        Sub Dirección de Inspección Laboral, Seguridad y Salud en el Trabajo
                    </h1>
                </div>
                <div class="rounded-3xl bg-blue-950/70 border border-blue-500/20 p-5 shadow-inner">
                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                        De acuerdo al <strong class="text-white">Artículo 26º</strong>, esta subdirección cuenta con las siguientes funciones y atribuciones:
                    </p>
                </div>
            </div>
        </header>

        <!-- Lista de funciones en tarjetas -->
        <section class="grid grid-cols-1 gap-4 xl:grid-cols-2">
            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-600/10 text-red-600">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">a) Planificación</h2>
                    </div>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Participar en la elaboración del plan anual de actividades de la dirección.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600/10 text-blue-600">
                        <i class="fa-solid fa-file-invoice"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">b) Gestión TUPA</h2>
                    </div>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Ejecutar y evaluar los procedimientos que son de su competencia y están contenidos en el TUPA sectorial.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-600/10 text-red-600">
                        <i class="fa-solid fa-hard-hat"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">c) Seguridad e Higiene</h2>
                    </div>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Aprobar los reglamentos internos de higiene y seguridad industrial y autorizar el trabajo a los adolescentes.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600/10 text-blue-600">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">d) Fiscalización de Cierres</h2>
                    </div>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Verificar el cierre de centros de trabajo sin la autorización de la autoridad de trabajo, conforme el Plan Anual de Inspecciones.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-600/10 text-red-600">
                        <i class="fa-solid fa-search"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">e) Inspecciones Específicas</h2>
                    </div>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Efectuar inspecciones específicas en centros de trabajo y verificar, a solicitud de parte, despidos arbitrarios o disminución deliberada en el rendimiento laboral.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600/10 text-blue-600">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">f) CTS</h2>
                    </div>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Resolver la observación del trabajador a la liquidación de compensación por tiempo de servicio (CTS).
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-600/10 text-red-600">
                        <i class="fa-solid fa-file-circle-check"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">g) Constancias de Cese</h2>
                    </div>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Otorgar constancias de cese en caso de abandono, imposibilidad de otorgamiento o negativa injustificada del empleador por más de 48 horas.
                </p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600/10 text-blue-600">
                        <i class="fa-solid fa-building"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">h) Autorización de Locales</h2>
                    </div>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Autorizar el funcionamiento de centros de trabajo en casos de cambio de domicilio, actividad, razón social o pérdida de documentos.</p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-600/10 text-red-600">
                        <i class="fa-solid fa-users-rectangle"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">i) Asuntos Sindicales</h2>
                    </div>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Verificar y determinar la organización sindical representativa para convenios colectivos y verificar paralizaciones de labores o huelgas.</p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600/10 text-blue-600">
                        <i class="fa-solid fa-file-signature"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">j) Actos Administrativos</h2>
                    </div>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Emitir autos y resoluciones subdirectorales, y conocer y tramitar los procedimientos de su competencia.</p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-600/10 text-red-600">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">k) Supervisión Técnica</h2>
                    </div>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Programar, supervisar y evaluar inspecciones de trabajo e inspección técnica especializada de SST.</p>
            </article>

            <article class="bg-white/5 border border-white/10 rounded-3xl p-6 shadow-lg shadow-slate-950/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600/10 text-blue-600">
                        <i class="fa-solid fa-ellipsis"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-slate-100 uppercase tracking-wider">l) Otras Funciones</h2>
                    </div>
                </div>
                <p class="text-slate-300 leading-relaxed text-sm">
                    Cumplir otras funciones que le asigne el Director de Prevención y Solución de Conflictos.</p>
            </article>
        </section>

        <!-- Nota de cierre -->
        <section class="bg-slate-900/80 border border-white/10 rounded-3xl p-6 sm:p-8 shadow-xl">
            <h3 class="text-xl font-black text-slate-100 uppercase tracking-wider flex items-center gap-2">
                <i class="fa-solid fa-info-circle text-red-600"></i>
                Observación
            </h3>
            <p class="text-slate-300 text-sm leading-relaxed mt-3">
                Esta subdirección actúa como garante de la preservación de la seguridad y salud en el trabajo, asegurando el cumplimiento normativo y la protección efectiva de los derechos de los trabajadores en la región.
            </p>
        </section>

        <!-- Botón de retorno inferior -->
        <div class="flex justify-center">
            <a href="{{ route('portal.Sconflictos') }}" class="inline-flex items-center gap-2 bg-slate-900/90 border border-white/10 text-white px-6 py-3 rounded-2xl shadow-lg hover:bg-slate-800 transition-all duration-300">
                <i class="fa-solid fa-arrow-left text-red-600"></i>
                Volver a Dirección Principal
            </a>
        </div>

    </div>
</div>
@endsection
