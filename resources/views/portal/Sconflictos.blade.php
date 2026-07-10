@extends('layouts.portal')

@section('content')
<div class="bg-scene min-h-screen relative py-12">
    <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-[2px] z-0"></div>
    
    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Encabezado Principal -->
        <div class="bg-slate-900/80 border border-white/10 rounded-3xl p-6 sm:p-10 shadow-2xl">
            <div class="border-l-4 border-red-500 pl-4">
                <span class="text-red-500 font-mono text-xs font-black uppercase tracking-widest block">Administración Regional</span>
                <h1 class="text-3xl sm:text-5xl font-black text-white m-0 uppercase tracking-tight mt-2">Dirección de Prevención y Solución de Conflictos</h1>
                <p class="text-red-400 text-sm sm:text-base font-semibold mt-3 m-0">Mediación • Negociación • Defensa Legal</p>
            </div>
        </div>

        <!-- ARTÍCULO 21º: Definición y Alcance -->
        <section aria-label="Artículo 21 - Definición y Alcance" class="space-y-4">
            <h2 class="text-2xl sm:text-3xl font-black text-white uppercase tracking-tight flex items-center gap-3">
                <i class="fa-solid fa-file text-red-600"></i> Artículo 21º: Definición y Alcance
            </h2>
            
            <article class="bg-gradient-to-br from-slate-900/90 to-slate-800/90 border border-white/10 rounded-2xl p-6 sm:p-8 shadow-xl">
                <div class="space-y-4">
                    <div class="bg-red-500/10 border-l-4 border-red-500 pl-4 py-3">
                        <p class="text-slate-200 text-sm sm:text-base leading-relaxed font-semibold m-0">
                            Órgano responsable de ejecutar políticas, normas y mecanismos institutivos en materia de relaciones de trabajo, inspección laboral, seguridad y salud en el trabajo, y remuneraciones. Propicia el diálogo social, mediación y arbitraje para la prevención y solución de conflictos laborales.
                        </p>
                    </div>
                    
                    <div class="bg-white/5 border border-white/10 rounded-lg p-4 space-y-2">
                        <h3 class="text-base font-bold text-red-200 flex items-center gap-2 m-0"> 
                            Mecanismos Clave
                        </h3>
                        <ul class="space-y-2 text-slate-300 text-sm">
                            <li class="flex gap-3">
                                <span class="text-red-400 font-bold">•</span>
                                <span><strong class="text-red-200">Diálogo Social:</strong> Facilita la comunicación entre trabajadores y empleadores</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="text-red-400 font-bold">•</span>
                                <span><strong class="text-red-200">Mediación:</strong> Intervención neutral para resolución de conflictos laborales</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="text-red-400 font-bold">•</span>
                                <span><strong class="text-red-200">Arbitraje:</strong> Resolución vinculante de disputas laborales</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="text-red-400 font-bold">•</span>
                                <span><strong class="text-red-200">Inspección Laboral:</strong> Supervisión del cumplimiento normativo en seguridad y salud</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </article>
        </section>

        <!-- ARTÍCULO 22º: Estructura Orgánica y Dependencia -->
        <section aria-label="Artículo 22 - Estructura Orgánica" class="space-y-4">
            <h2 class="text-2xl sm:text-3xl font-black text-white uppercase tracking-tight flex items-center gap-3">
                <i class="fa-solid fa-landmark text-red-600"></i> Artículo 22º: Estructura Orgánica y Dependencia
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Dirección -->
                <article class="bg-gradient-to-br from-red-900/40 to-slate-900/80 border border-red-500/30 rounded-2xl p-6 hover:border-red-400/60 transition-all">
                    <div class="flex gap-3 items-start">
                        <div class="flex-1">
                            <h3 class="text-base font-bold text-red-200 mb-2 m-0">Dirección</h3>
                            <p class="text-slate-300 text-xs sm:text-sm leading-relaxed m-0">
                                Encabezada por un Director responsable de conducir la política sectorial de relaciones de trabajo, inspección y seguridad en el trabajo a nivel regional.
                            </p>
                        </div>
                    </div>
                </article>

                <!-- Dependencia Jerárquica -->
                <article class="bg-gradient-to-br from-amber-900/40 to-slate-900/80 border border-amber-500/30 rounded-2xl p-6 hover:border-amber-400/60 transition-all">
                    <div class="flex gap-3 items-start">
                        <div class="flex-1">
                            <h3 class="text-base font-bold text-amber-200 mb-2 m-0">Dependencia Administrativa</h3>
                            <p class="text-slate-300 text-xs sm:text-sm leading-relaxed m-0">
                                Depende jerárquica y administrativamente de la <strong class="text-amber-200">Dirección Nacional de Relaciones de Trabajo del MTPE</strong>, coordinando políticas nacionales a nivel regional.
                            </p>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <!-- ARTÍCULO 23º: Funciones y Atribuciones -->
        <section aria-label="Artículo 23 - Funciones y Atribuciones" class="space-y-4">
            <h2 class="text-2xl sm:text-3xl font-black text-white uppercase tracking-tight flex items-center gap-3">
                <i class="fa-solid fa-gear" style="color: rgb(229, 14, 14);"></i>Artículo 23º: Funciones y Atribuciones
            </h2>

            <div class="bg-slate-900/80 border border-white/10 rounded-2xl p-6 sm:p-8 space-y-3">
                <div class="space-y-3">
                    <!-- Función a -->
                    <div class="flex gap-4 items-start pb-3 border-b border-white/10">
                        <span class="text-red-500 font-black text-lg flex-shrink-0 min-w-[32px]">a)</span>
                        <div>
                            <p class="text-slate-200 text-sm leading-relaxed m-0">
                                <strong class="text-red-200">Elaborar el Plan Anual:</strong> Formular planes estratégicos alineados con políticas nacionales.
                            </p>
                        </div>
                    </div>

                    <!-- Función b -->
                    <div class="flex gap-4 items-start pb-3 border-b border-white/10">
                        <span class="text-red-500 font-black text-lg flex-shrink-0 min-w-[32px]">b)</span>
                        <div>
                            <p class="text-slate-200 text-sm leading-relaxed m-0">
                                <strong class="text-red-200">Implementar TUPA Sectorial:</strong> Administrar texto único de procedimientos administrativos en materia laboral.
                            </p>
                        </div>
                    </div>

                    <!-- Función c -->
                    <div class="flex gap-4 items-start pb-3 border-b border-white/10">
                        <span class="text-red-500 font-black text-lg flex-shrink-0 min-w-[32px]">c)</span>
                        <div>
                            <p class="text-slate-200 text-sm leading-relaxed m-0">
                                <strong class="text-red-200">Emitir Resoluciones:</strong> Conocer y resolver en primera instancia recursos administrativos sobre relaciones laborales.
                            </p>
                        </div>
                    </div>

                    <!-- Función d -->
                    <div class="flex gap-4 items-start pb-3 border-b border-white/10">
                        <span class="text-red-500 font-black text-lg flex-shrink-0 min-w-[32px]">d)</span>
                        <div>
                            <p class="text-slate-200 text-sm leading-relaxed m-0">
                                <strong class="text-red-200">Reportar Incidencias:</strong> Elaborar informes sobre conflictividad laboral, huelgas y paralizaciones.
                            </p>
                        </div>
                    </div>

                    <!-- Función e -->
                    <div class="flex gap-4 items-start pb-3 border-b border-white/10">
                        <span class="text-red-500 font-black text-lg flex-shrink-0 min-w-[32px]">e)</span>
                        <div>
                            <p class="text-slate-200 text-sm leading-relaxed m-0">
                                <strong class="text-red-200">Proponer Directivas:</strong> Formular directivas operativas para mejora continua de procesos.
                            </p>
                        </div>
                    </div>

                    <!-- Función f -->
                    <div class="flex gap-4 items-start pb-3 border-b border-white/10">
                        <span class="text-red-500 font-black text-lg flex-shrink-0 min-w-[32px]">f)</span>
                        <div>
                            <p class="text-slate-200 text-sm leading-relaxed m-0">
                                <strong class="text-red-200">Asesoría Técnica:</strong> Brindar orientación especializada en asuntos de relaciones laborales y normativa.
                            </p>
                        </div>
                    </div>

                    <!-- Función g -->
                    <div class="flex gap-4 items-start pb-3 border-b border-white/10">
                        <span class="text-red-500 font-black text-lg flex-shrink-0 min-w-[32px]">g)</span>
                        <div>
                            <p class="text-slate-200 text-sm leading-relaxed m-0">
                                <strong class="text-red-200">Capacitación del Personal:</strong> Desarrollar programas de formación para técnicos y profesionales.
                            </p>
                        </div>
                    </div>

                    <!-- Función h -->
                    <div class="flex gap-4 items-start pb-3 border-b border-white/10">
                        <span class="text-red-500 font-black text-lg flex-shrink-0 min-w-[32px]">h)</span>
                        <div>
                            <p class="text-slate-200 text-sm leading-relaxed m-0">
                                <strong class="text-red-200">Representación Institucional:</strong> Representar a la institución en eventos, conferencias y coordinaciones interinstitucionales.
                            </p>
                        </div>
                    </div>

                    <!-- Función i -->
                    <div class="flex gap-4 items-start">
                        <span class="text-red-500 font-black text-lg flex-shrink-0 min-w-[32px]">i)</span>
                        <div>
                            <p class="text-slate-200 text-sm leading-relaxed m-0">
                                <strong class="text-red-200">Otras Funciones:</strong> Ejecutar otras funciones asignadas por la Dirección Nacional o regulaciones específicas.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ARTÍCULO 24º: Unidades Orgánicas -->
        <section aria-label="Artículo 24 - Unidades Orgánicas" class="space-y-4 pb-8">
            <h2 class="text-2xl sm:text-3xl font-black text-white uppercase tracking-tight flex items-center gap-3">
                <i class="fa-solid fa-chart-simple" style="color: rgb(229, 14, 14);"></i> Artículo 24º: Unidades Orgánicas
            </h2>

            <p class="text-slate-300 text-sm sm:text-base leading-relaxed bg-slate-900/50 border border-white/5 rounded-xl p-4">
                La Dirección de Prevención y Solución de Conflictos está estructurada en las siguientes subdirecciones especializadas:
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Sub Dirección 1: Negociaciones Colectivas -->
                <article class="bg-gradient-to-br from-slate-900/90 to-slate-800/90 border border-white/10 rounded-2xl overflow-hidden hover:border-red-500/60 transition-all duration-300 group shadow-lg hover:shadow-red-500/20">
                    <div class="bg-gradient-to-r from-red-600 to-red-700 p-6 text-center">
                        <i class="fa-solid fa-handshake text-5xl mb-3"></i>
                        <h3 class="text-lg font-black text-white uppercase tracking-wider m-0">Negociaciones Colectivas</h3>
                        <p class="text-red-100 text-xs mt-2 m-0">y Registros Generales</p>
                    </div>

                    <div class="p-6 space-y-4">
                        <p class="text-slate-300 text-sm leading-relaxed m-0">
                            Gestiona procesos de negociación colectiva, registro de acuerdos laborales y administración de información sindical y de relaciones colectivas.
                        </p>

                        <ul class="space-y-2 text-slate-400 text-xs">
                            <li class="flex gap-2">
                                <span class="text-red-500 font-bold">▪</span>
                                Negociación de convenios colectivos
                            </li>
                            <li class="flex gap-2">
                                <span class="text-red-500 font-bold">▪</span>
                                Registro de organizaciones sindicales
                            </li>
                            <li class="flex gap-2">
                                <span class="text-red-500 font-bold">▪</span>
                                Mediación en conflictos colectivos
                            </li>
                        </ul>

                        <a href="{{ route('portal.sub-negociaciones') }}" class="mt-6 block w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg text-center transition-all duration-300 group-hover:shadow-lg">
                            Ver Más <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </article>

                <!-- Sub Dirección 2: Inspección Laboral -->
                <article class="bg-gradient-to-br from-slate-900/90 to-slate-800/90 border border-white/10 rounded-2xl overflow-hidden hover:border-blue-500/60 transition-all duration-300 group shadow-lg hover:shadow-blue-500/20">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-6 text-center">
                        <i class="fa-solid fa-magnifying-glass text-5xl mb-3"></i>
                        <h3 class="text-lg font-black text-white uppercase tracking-wider m-0">Inspección Laboral</h3>
                        <p class="text-blue-100 text-xs mt-2 m-0">Seguridad y Salud en el Trabajo</p>
                    </div>

                    <div class="p-6 space-y-4">
                        <p class="text-slate-300 text-sm leading-relaxed m-0">
                            Supervisa el cumplimiento de normas laborales, implementa estándares de seguridad y salud ocupacional, e investiga accidentes e incidentes laborales.
                        </p>

                        <ul class="space-y-2 text-slate-400 text-xs">
                            <li class="flex gap-2">
                                <span class="text-blue-500 font-bold">▪</span>
                                Inspecciones en centros de trabajo
                            </li>
                            <li class="flex gap-2">
                                <span class="text-blue-500 font-bold">▪</span>
                                Investigación de accidentes laborales
                            </li>
                            <li class="flex gap-2">
                                <span class="text-blue-500 font-bold">▪</span>
                                Fiscalización de SST (Seguridad y Salud en el Trabajo)
                            </li>
                        </ul>

                        <a href="{{ route('portal.sub-inspeccion') }}" class="mt-6 block w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg text-center transition-all duration-300 group-hover:shadow-lg">
                            Ver Más <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </article>

                <!-- Sub Dirección 3: Defensa Legal -->
                <article class="bg-gradient-to-br from-slate-900/90 to-slate-800/90 border border-white/10 rounded-2xl overflow-hidden hover:border-green-500/60 transition-all duration-300 group shadow-lg hover:shadow-green-500/20">
                    <div class="bg-gradient-to-r from-green-600 to-green-700 p-6 text-center">
                        <i class="fa-solid fa-scale-balanced text-5xl mb-3"></i>
                        <h3 class="text-lg font-black text-white uppercase tracking-wider m-0">Defensa Legal Gratuita</h3>
                        <p class="text-green-100 text-xs mt-2 m-0">y Asesoría al Trabajador</p>
                    </div>

                    <div class="p-6 space-y-4">
                        <p class="text-slate-300 text-sm leading-relaxed m-0">
                            Proporciona asesoría jurídica gratuita a trabajadores, representa intereses laborales y promueve la justicia laboral accesible.
                        </p>

                        <ul class="space-y-2 text-slate-400 text-xs">
                            <li class="flex gap-2">
                                <span class="text-green-500 font-bold">▪</span>
                                Asesoría legal gratuita a trabajadores
                            </li>
                            <li class="flex gap-2">
                                <span class="text-green-500 font-bold">▪</span>
                                Defensa en procesos laborales
                            </li>
                            <li class="flex gap-2">
                                <span class="text-green-500 font-bold">▪</span>
                                Promoción de derechos laborales
                            </li>
                        </ul>

                        <a href="{{ route('portal.sub-defensa') }}" class="mt-6 block w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg text-center transition-all duration-300 group-hover:shadow-lg">
                            Ver Más <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </article>

            </div>
        </section>

    </div>
</div>
@endsection
