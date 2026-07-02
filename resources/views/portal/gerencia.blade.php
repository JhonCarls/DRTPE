@extends('layouts.portal')

@section('content')
<div class="bg-scene min-h-screen relative py-12">
    <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-[2px] z-0"></div>
    
    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Encabezado Principal -->
        <div class="bg-slate-900/80 border border-white/10 rounded-3xl p-6 sm:p-10 shadow-2xl">
            <div class="border-l-4 border-amber-500 pl-4">
                <span class="text-amber-500 font-mono text-xs font-black uppercase tracking-widest block">Administración Regional</span>
                <h1 class="text-3xl sm:text-5xl font-black text-white m-0 uppercase tracking-tight mt-2">Gerencia Regional</h1>
                <p class="text-amber-400 text-sm sm:text-base font-semibold mt-3 m-0">Región de Puno</p>
            </div>
        </div>

        <!-- SECCIÓN 1: Definición y Jurisdicción -->
        <section aria-label="Definición y Jurisdicción" class="space-y-4">
            <h2 class="text-2xl sm:text-3xl font-black text-white uppercase tracking-tight flex items-center gap-3">
                <span class="text-amber-500">📋</span> Definición y Jurisdicción
            </h2>
            
            <article class="bg-gradient-to-br from-slate-900/90 to-slate-800/90 border border-white/10 rounded-2xl p-6 sm:p-8 shadow-xl">
                <div class="space-y-4">
                    <div class="bg-amber-500/10 border-l-4 border-amber-500 pl-4 py-3">
                        <p class="text-slate-200 text-sm sm:text-base leading-relaxed font-semibold m-0">
                            Órgano encargado de ejecutar las acciones de política, leyes y normatividad general dictadas por los organismos centrales y regionales en materia de trabajo, empleo y fomento de la Micro y Pequeña Empresa.
                        </p>
                    </div>
                    
                    <div class="pt-3">
                        <h3 class="text-base font-bold text-white mb-3 flex items-center gap-2">
                            <span class="text-lg">🗺️</span> Jurisdicción
                        </h3>
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed m-0">
                            Su competencia comprende todo el ámbito territorial del 
                            <span class="text-amber-400 font-bold">Departamento de Puno</span>, 
                            ejerciendo autoridad en todas las provincias y distritos que conforman la región.
                        </p>
                    </div>
                </div>
            </article>
        </section>

        <!-- SECCIÓN 2: Finalidad y Objetivos -->
        <section aria-label="Finalidad y Objetivos" class="space-y-4">
            <h2 class="text-2xl sm:text-3xl font-black text-white uppercase tracking-tight flex items-center gap-3">
                <span class="text-amber-500">🎯</span> Finalidad y Objetivos
            </h2>
            
            <p class="text-slate-300 text-sm sm:text-base leading-relaxed bg-slate-900/50 border border-white/5 rounded-xl p-4">
                El objetivo principal es mejorar las condiciones de vida y trabajo del ciudadano puneño a través de:
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Objetivo 1 -->
                <article class="bg-slate-900/80 border border-white/10 rounded-2xl p-6 hover:border-amber-500/50 transition-all duration-300 group">
                    <div class="flex gap-3 items-start">
                        <div class="text-2xl flex-shrink-0 group-hover:scale-110 transition-transform">💼</div>
                        <div class="flex-1">
                            <h3 class="text-base font-bold text-white mb-2 m-0">Promoción del Empleo Productivo</h3>
                            <p class="text-slate-400 text-xs sm:text-sm leading-relaxed m-0">
                                Fortalecimiento del mercado laboral mediante la generación de oportunidades de empleo de calidad.
                            </p>
                        </div>
                    </div>
                </article>

                <!-- Objetivo 2 -->
                <article class="bg-slate-900/80 border border-white/10 rounded-2xl p-6 hover:border-amber-500/50 transition-all duration-300 group">
                    <div class="flex gap-3 items-start">
                        <div class="text-2xl flex-shrink-0 group-hover:scale-110 transition-transform">🎓</div>
                        <div class="flex-1">
                            <h3 class="text-base font-bold text-white mb-2 m-0">Capacitación Técnica</h3>
                            <p class="text-slate-400 text-xs sm:text-sm leading-relaxed m-0">
                                Formación profesional para incrementar la productividad y competitividad laboral.
                            </p>
                        </div>
                    </div>
                </article>

                <!-- Objetivo 3 -->
                <article class="bg-slate-900/80 border border-white/10 rounded-2xl p-6 hover:border-amber-500/50 transition-all duration-300 group">
                    <div class="flex gap-3 items-start">
                        <div class="text-2xl flex-shrink-0 group-hover:scale-110 transition-transform">🤝</div>
                        <div class="flex-1">
                            <h3 class="text-base font-bold text-white mb-2 m-0">Diálogo Social</h3>
                            <p class="text-slate-400 text-xs sm:text-sm leading-relaxed m-0">
                                Concertación entre trabajadores, empleadores y organizaciones sociales para paz laboral.
                            </p>
                        </div>
                    </div>
                </article>

                <!-- Objetivo 4 -->
                <article class="bg-slate-900/80 border border-white/10 rounded-2xl p-6 hover:border-amber-500/50 transition-all duration-300 group">
                    <div class="flex gap-3 items-start">
                        <div class="text-2xl flex-shrink-0 group-hover:scale-110 transition-transform">⚖️</div>
                        <div class="flex-1">
                            <h3 class="text-base font-bold text-white mb-2 m-0">Normativas OIT</h3>
                            <p class="text-slate-400 text-xs sm:text-sm leading-relaxed m-0">
                                Adecuación de normas laborales a principios internacionales de la OIT.
                            </p>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <!-- SECCIÓN 3: Funciones Generales -->
        <section aria-label="Funciones Generales" class="space-y-4">
            <h2 class="text-2xl sm:text-3xl font-black text-white uppercase tracking-tight flex items-center gap-3">
                <span class="text-amber-500">⚙️</span> Funciones Generales del Director Regional
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Función 1 -->
                <article class="bg-gradient-to-br from-amber-600/20 to-transparent border border-amber-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-amber-500/20 transition-all">
                    <div class="flex gap-3 mb-3">
                        <div class="text-3xl">🎯</div>
                    </div>
                    <h3 class="text-base font-bold text-amber-200 mb-2 m-0">Dirección Estratégica</h3>
                    <p class="text-slate-300 text-xs sm:text-sm leading-relaxed m-0">
                        Dirigir, coordinar, supervisar y evaluar la política socio-laboral en estrecha coordinación con organismos regionales y nacionales.
                    </p>
                </article>

                <!-- Función 2 -->
                <article class="bg-gradient-to-br from-blue-600/20 to-transparent border border-blue-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-blue-500/20 transition-all">
                    <div class="flex gap-3 mb-3">
                        <div class="text-3xl">📈</div>
                    </div>
                    <h3 class="text-base font-bold text-blue-200 mb-2 m-0">Promoción del Empleo</h3>
                    <p class="text-slate-300 text-xs sm:text-sm leading-relaxed m-0">
                        Ejecutar programas y proyectos con énfasis en grupos vulnerables de la población.
                    </p>
                </article>

                <!-- Función 3 -->
                <article class="bg-gradient-to-br from-green-600/20 to-transparent border border-green-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-green-500/20 transition-all">
                    <div class="flex gap-3 mb-3">
                        <div class="text-3xl">🛡️</div>
                    </div>
                    <h3 class="text-base font-bold text-green-200 mb-2 m-0">Seguridad y Salud</h3>
                    <p class="text-slate-300 text-xs sm:text-sm leading-relaxed m-0">
                        Conducir acciones de seguridad y salud en el trabajo, bienestar y seguridad social concertando con instituciones.
                    </p>
                </article>

                <!-- Función 4 -->
                <article class="bg-gradient-to-br from-purple-600/20 to-transparent border border-purple-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-purple-500/20 transition-all">
                    <div class="flex gap-3 mb-3">
                        <div class="text-3xl">⚖️</div>
                    </div>
                    <h3 class="text-base font-bold text-purple-200 mb-2 m-0">Resolución de Conflictos</h3>
                    <p class="text-slate-300 text-xs sm:text-sm leading-relaxed m-0">
                        Conocer y resolver en la instancia que corresponda recursos administrativos según la ley.
                    </p>
                </article>

                <!-- Función 5 -->
                <article class="bg-gradient-to-br from-red-600/20 to-transparent border border-red-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-red-500/20 transition-all">
                    <div class="flex gap-3 mb-3">
                        <div class="text-3xl">🤲</div>
                    </div>
                    <h3 class="text-base font-bold text-red-200 mb-2 m-0">Alianzas Estratégicas</h3>
                    <p class="text-slate-300 text-xs sm:text-sm leading-relaxed m-0">
                        Proponer convenios y alianzas estratégicas con instituciones para cumplimiento de funciones.
                    </p>
                </article>

                <!-- Función 6 -->
                <article class="bg-gradient-to-br from-cyan-600/20 to-transparent border border-cyan-500/30 rounded-2xl p-6 group hover:shadow-lg hover:shadow-cyan-500/20 transition-all">
                    <div class="flex gap-3 mb-3">
                        <div class="text-3xl">📊</div>
                    </div>
                    <h3 class="text-base font-bold text-cyan-200 mb-2 m-0">Información Laboral</h3>
                    <p class="text-slate-300 text-xs sm:text-sm leading-relaxed m-0">
                        Producir información estadística mediante encuestas sobre oferta y demanda de mano de obra regional.
                    </p>
                </article>
            </div>
        </section>

        <!-- SECCIÓN 4: Competencias Principales -->
        <section aria-label="Competencias Principales" class="space-y-4">
            <h2 class="text-2xl sm:text-3xl font-black text-white uppercase tracking-tight flex items-center gap-3">
                <span class="text-amber-500">🔑</span> Competencias Principales
            </h2>

            <div class="bg-slate-900/80 border border-white/10 rounded-2xl p-6 sm:p-8">
                <ul class="space-y-4">
                    <li class="flex gap-4 items-start">
                        <span class="text-amber-500 text-xl font-bold flex-shrink-0">✓</span>
                        <div class="flex-1">
                            <h3 class="text-base font-bold text-white mb-1 m-0">Fomento del Desarrollo Socio-Laboral Regional</h3>
                            <p class="text-slate-400 text-xs sm:text-sm m-0">
                                Impulsar políticas y acciones que mejoren el desarrollo económico y laboral de la región.
                            </p>
                        </div>
                    </li>

                    <li class="flex gap-4 items-start">
                        <span class="text-amber-500 text-xl font-bold flex-shrink-0">✓</span>
                        <div class="flex-1">
                            <h3 class="text-base font-bold text-white mb-1 m-0">Supervisión de Sistemas de Intermediación Laboral</h3>
                            <p class="text-slate-400 text-xs sm:text-sm m-0">
                                Supervisar sistemas públicos y privados que vinculan oferta y demanda de empleo.
                            </p>
                        </div>
                    </li>

                    <li class="flex gap-4 items-start">
                        <span class="text-amber-500 text-xl font-bold flex-shrink-0">✓</span>
                        <div class="flex-1">
                            <h3 class="text-base font-bold text-white mb-1 m-0">Diálogo y Participación Social</h3>
                            <p class="text-slate-400 text-xs sm:text-sm m-0">
                                Establecer mecanismos de diálogo con trabajadores, empleadores y organizaciones sociales vinculadas al ámbito laboral.
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <!-- SECCIÓN 5: Relaciones Interinstitucionales -->
        <section aria-label="Relaciones Interinstitucionales" class="space-y-4 pb-8">
            <h2 class="text-2xl sm:text-3xl font-black text-white uppercase tracking-tight flex items-center gap-3">
                <span class="text-amber-500">🌐</span> Relaciones Interinstitucionales
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Nivel Nacional -->
                <article class="bg-gradient-to-br from-blue-900/60 to-blue-800/40 border border-blue-500/30 rounded-2xl p-6 sm:p-7 hover:border-blue-400/60 transition-all">
                    <div class="text-center mb-4">
                        <div class="text-4xl mb-3">🏛️</div>
                        <h3 class="text-lg font-black text-blue-100 uppercase tracking-wider m-0">Nivel Nacional</h3>
                    </div>
                    <p class="text-slate-300 text-sm leading-relaxed text-center m-0">
                        Mantiene relación técnico-normativa directa con el 
                        <span class="font-bold text-blue-200">Ministerio de Trabajo y Promoción del Empleo</span>.
                    </p>
                </article>

                <!-- Nivel Regional -->
                <article class="bg-gradient-to-br from-amber-900/60 to-amber-800/40 border border-amber-500/30 rounded-2xl p-6 sm:p-7 hover:border-amber-400/60 transition-all">
                    <div class="text-center mb-4">
                        <div class="text-4xl mb-3">📍</div>
                        <h3 class="text-lg font-black text-amber-100 uppercase tracking-wider m-0">Nivel Regional</h3>
                    </div>
                    <p class="text-slate-300 text-sm leading-relaxed text-center m-0">
                        Coordina con el <span class="font-bold text-amber-200">CTAR Puno</span>, Poder Judicial, Universidades y fuerzas policiales regionales.
                    </p>
                </article>

                <!-- Sector Privado -->
                <article class="bg-gradient-to-br from-green-900/60 to-green-800/40 border border-green-500/30 rounded-2xl p-6 sm:p-7 hover:border-green-400/60 transition-all">
                    <div class="text-center mb-4">
                        <div class="text-4xl mb-3">💼</div>
                        <h3 class="text-lg font-black text-green-100 uppercase tracking-wider m-0">Sector Privado</h3>
                    </div>
                    <p class="text-slate-300 text-sm leading-relaxed text-center m-0">
                        Colabora con <span class="font-bold text-green-200">entidades financieras</span> y organizaciones sociales, económicas y culturales.
                    </p>
                </article>
            </div>
        </section>

    </div>
</div>
@endsection