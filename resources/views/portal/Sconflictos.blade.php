@extends('layouts.portal')

@section('content')
<div class="bg-scene-light min-h-screen relative py-12">
    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- Encabezado Principal -->
        <header data-reveal class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-lg shadow-slate-300/40">
            <div class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-red-950 p-8 sm:p-10 text-white">
                <div class="pointer-events-none absolute -top-16 -right-12 w-72 h-72 bg-red-500/25 rounded-full blur-3xl"></div>
                <div class="relative flex items-start gap-5">
                    <div class="icon-tile hidden sm:flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-2xl bg-red-500/15 border border-red-400/30 text-red-300 text-2xl">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <div class="space-y-2">
                        <span class="text-red-400 font-bold uppercase tracking-[0.3em] text-xs">Administración Regional</span>
                        <h1 class="text-3xl sm:text-5xl font-black uppercase tracking-tight leading-tight m-0">Dirección de Prevención y Solución de Conflictos</h1>
                        <p class="text-slate-300 text-sm sm:text-base font-medium m-0">Mediación • Negociación • Defensa Legal</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- ARTÍCULO 21º -->
        <section class="space-y-5">
            <h2 data-reveal class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-100 text-red-600"><i class="fa-solid fa-file-lines"></i></span>
                Artículo 21º: Definición y Alcance
            </h2>

            <article data-reveal class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm space-y-5">
                <div class="rounded-2xl bg-red-50 border-l-4 border-red-500 p-5">
                    <p class="text-slate-700 text-sm sm:text-base leading-relaxed font-semibold m-0">
                        Órgano responsable de ejecutar políticas, normas y mecanismos en materia de relaciones de trabajo, inspección laboral, seguridad y salud en el trabajo y remuneraciones. Propicia el diálogo social, la mediación y el arbitraje para la prevención y solución de conflictos laborales.
                    </p>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-900 mb-3 flex items-center gap-2 m-0"><i class="fa-solid fa-diagram-project text-red-600"></i> Mecanismos Clave</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="flex items-start gap-3 rounded-xl bg-slate-50 border border-slate-200 p-4">
                            <i class="fa-solid fa-comments text-red-600 mt-1"></i>
                            <span class="text-slate-600 text-sm"><strong class="text-slate-900">Diálogo Social:</strong> comunicación entre trabajadores y empleadores.</span>
                        </div>
                        <div class="flex items-start gap-3 rounded-xl bg-slate-50 border border-slate-200 p-4">
                            <i class="fa-solid fa-handshake text-red-600 mt-1"></i>
                            <span class="text-slate-600 text-sm"><strong class="text-slate-900">Mediación:</strong> intervención neutral para resolver conflictos.</span>
                        </div>
                        <div class="flex items-start gap-3 rounded-xl bg-slate-50 border border-slate-200 p-4">
                            <i class="fa-solid fa-gavel text-red-600 mt-1"></i>
                            <span class="text-slate-600 text-sm"><strong class="text-slate-900">Arbitraje:</strong> resolución vinculante de disputas laborales.</span>
                        </div>
                        <div class="flex items-start gap-3 rounded-xl bg-slate-50 border border-slate-200 p-4">
                            <i class="fa-solid fa-magnifying-glass text-red-600 mt-1"></i>
                            <span class="text-slate-600 text-sm"><strong class="text-slate-900">Inspección Laboral:</strong> supervisión del cumplimiento en SST.</span>
                        </div>
                    </div>
                </div>
            </article>
        </section>

        <!-- ARTÍCULO 22º -->
        <section class="space-y-5">
            <h2 data-reveal class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-100 text-red-600"><i class="fa-solid fa-landmark"></i></span>
                Artículo 22º: Estructura Orgánica y Dependencia
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-red-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-red-100 text-red-600 text-lg"><i class="fa-solid fa-user-tie"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Dirección</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Encabezada por un Director responsable de conducir la política sectorial de relaciones de trabajo, inspección y seguridad en el trabajo a nivel regional.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-600 text-lg"><i class="fa-solid fa-diagram-successor"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Dependencia Administrativa</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Depende jerárquica y administrativamente de la <strong class="text-slate-900">Dirección Nacional de Relaciones de Trabajo del MTPE</strong>, coordinando políticas nacionales a nivel regional.</p>
                </article>
            </div>
        </section>

        <!-- ARTÍCULO 23º -->
        <section class="space-y-5">
            <h2 data-reveal class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-100 text-red-600"><i class="fa-solid fa-gears"></i></span>
                Artículo 23º: Funciones y Atribuciones
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-red-300">
                    <div class="flex items-center gap-3 mb-3"><div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl bg-red-100 text-red-600"><i class="fa-solid fa-calendar-check"></i></div><span class="text-red-600 font-black text-sm">a)</span></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Elaborar el Plan Anual</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Formular planes estratégicos alineados con las políticas nacionales.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-red-300">
                    <div class="flex items-center gap-3 mb-3"><div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-100 text-blue-600"><i class="fa-solid fa-file-lines"></i></div><span class="text-red-600 font-black text-sm">b)</span></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Implementar TUPA Sectorial</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Administrar el texto único de procedimientos administrativos en materia laboral.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-red-300">
                    <div class="flex items-center gap-3 mb-3"><div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl bg-purple-100 text-purple-600"><i class="fa-solid fa-gavel"></i></div><span class="text-red-600 font-black text-sm">c)</span></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Emitir Resoluciones</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Conocer y resolver en primera instancia los recursos administrativos sobre relaciones laborales.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-red-300">
                    <div class="flex items-center gap-3 mb-3"><div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl bg-orange-100 text-orange-600"><i class="fa-solid fa-triangle-exclamation"></i></div><span class="text-red-600 font-black text-sm">d)</span></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Reportar Incidencias</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Elaborar informes sobre conflictividad laboral, huelgas y paralizaciones.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-red-300">
                    <div class="flex items-center gap-3 mb-3"><div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl bg-teal-100 text-teal-600"><i class="fa-solid fa-clipboard-list"></i></div><span class="text-red-600 font-black text-sm">e)</span></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Proponer Directivas</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Formular directivas operativas para la mejora continua de los procesos.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-red-300">
                    <div class="flex items-center gap-3 mb-3"><div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl bg-cyan-100 text-cyan-600"><i class="fa-solid fa-headset"></i></div><span class="text-red-600 font-black text-sm">f)</span></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Asesoría Técnica</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Brindar orientación especializada en asuntos de relaciones laborales y normativa.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-red-300">
                    <div class="flex items-center gap-3 mb-3"><div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl bg-green-100 text-green-600"><i class="fa-solid fa-chalkboard-user"></i></div><span class="text-red-600 font-black text-sm">g)</span></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Capacitación del Personal</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Desarrollar programas de formación para técnicos y profesionales.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-red-300">
                    <div class="flex items-center gap-3 mb-3"><div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600"><i class="fa-solid fa-people-group"></i></div><span class="text-red-600 font-black text-sm">h)</span></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Representación Institucional</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Representar a la institución en eventos, conferencias y coordinaciones interinstitucionales.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-red-300">
                    <div class="flex items-center gap-3 mb-3"><div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-100 text-slate-600"><i class="fa-solid fa-ellipsis"></i></div><span class="text-red-600 font-black text-sm">i)</span></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">Otras Funciones</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Ejecutar otras funciones asignadas por la Dirección Nacional o regulaciones específicas.</p>
                </article>
            </div>
        </section>

        <!-- ARTÍCULO 24º: Unidades Orgánicas -->
        <section class="space-y-5 pb-6">
            <h2 data-reveal class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-100 text-red-600"><i class="fa-solid fa-sitemap"></i></span>
                Artículo 24º: Unidades Orgánicas
            </h2>
            <p data-reveal class="text-slate-600 text-sm sm:text-base leading-relaxed bg-white border border-slate-200 rounded-xl p-4 shadow-sm m-0">
                La Dirección está estructurada en las siguientes subdirecciones especializadas:
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Negociaciones Colectivas -->
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:border-red-300 flex flex-col">
                    <div class="bg-gradient-to-r from-red-600 to-red-700 p-6 text-center text-white">
                        <div class="icon-tile mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-white/15 text-2xl"><i class="fa-solid fa-handshake"></i></div>
                        <h3 class="text-lg font-black uppercase tracking-wider m-0">Negociaciones Colectivas</h3>
                        <p class="text-red-100 text-xs mt-1 m-0">y Registros Generales</p>
                    </div>
                    <div class="p-6 flex flex-col flex-1">
                        <p class="text-slate-600 text-sm leading-relaxed m-0">Gestiona la negociación colectiva, el registro de acuerdos laborales y la información sindical y de relaciones colectivas.</p>
                        <ul class="mt-4 space-y-2 text-slate-500 text-xs">
                            <li class="flex gap-2"><i class="fa-solid fa-check text-red-500 mt-0.5"></i> Negociación de convenios colectivos</li>
                            <li class="flex gap-2"><i class="fa-solid fa-check text-red-500 mt-0.5"></i> Registro de organizaciones sindicales</li>
                            <li class="flex gap-2"><i class="fa-solid fa-check text-red-500 mt-0.5"></i> Mediación en conflictos colectivos</li>
                        </ul>
                        <a href="{{ route('portal.sub-negociaciones') }}" class="mt-6 block w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-xl text-center transition-all duration-300 hover:-translate-y-0.5">
                            Ver más <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </article>

                <!-- Inspección Laboral -->
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:border-blue-300 flex flex-col">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-6 text-center text-white">
                        <div class="icon-tile mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-white/15 text-2xl"><i class="fa-solid fa-magnifying-glass"></i></div>
                        <h3 class="text-lg font-black uppercase tracking-wider m-0">Inspección Laboral</h3>
                        <p class="text-blue-100 text-xs mt-1 m-0">Seguridad y Salud en el Trabajo</p>
                    </div>
                    <div class="p-6 flex flex-col flex-1">
                        <p class="text-slate-600 text-sm leading-relaxed m-0">Supervisa el cumplimiento de normas laborales, implementa estándares de seguridad y salud e investiga accidentes laborales.</p>
                        <ul class="mt-4 space-y-2 text-slate-500 text-xs">
                            <li class="flex gap-2"><i class="fa-solid fa-check text-blue-500 mt-0.5"></i> Inspecciones en centros de trabajo</li>
                            <li class="flex gap-2"><i class="fa-solid fa-check text-blue-500 mt-0.5"></i> Investigación de accidentes laborales</li>
                            <li class="flex gap-2"><i class="fa-solid fa-check text-blue-500 mt-0.5"></i> Fiscalización de SST</li>
                        </ul>
                        <a href="{{ route('portal.sub-inspeccion') }}" class="mt-6 block w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl text-center transition-all duration-300 hover:-translate-y-0.5">
                            Ver más <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </article>

                <!-- Defensa Legal -->
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:border-green-300 flex flex-col">
                    <div class="bg-gradient-to-r from-green-600 to-green-700 p-6 text-center text-white">
                        <div class="icon-tile mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-white/15 text-2xl"><i class="fa-solid fa-scale-balanced"></i></div>
                        <h3 class="text-lg font-black uppercase tracking-wider m-0">Defensa Legal Gratuita</h3>
                        <p class="text-green-100 text-xs mt-1 m-0">y Asesoría al Trabajador</p>
                    </div>
                    <div class="p-6 flex flex-col flex-1">
                        <p class="text-slate-600 text-sm leading-relaxed m-0">Proporciona asesoría jurídica gratuita a trabajadores, representa intereses laborales y promueve la justicia laboral accesible.</p>
                        <ul class="mt-4 space-y-2 text-slate-500 text-xs">
                            <li class="flex gap-2"><i class="fa-solid fa-check text-green-500 mt-0.5"></i> Asesoría legal gratuita</li>
                            <li class="flex gap-2"><i class="fa-solid fa-check text-green-500 mt-0.5"></i> Defensa en procesos laborales</li>
                            <li class="flex gap-2"><i class="fa-solid fa-check text-green-500 mt-0.5"></i> Promoción de derechos laborales</li>
                        </ul>
                        <a href="{{ route('portal.sub-defensa') }}" class="mt-6 block w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-xl text-center transition-all duration-300 hover:-translate-y-0.5">
                            Ver más <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </article>
            </div>
        </section>

    </div>
</div>
@endsection
