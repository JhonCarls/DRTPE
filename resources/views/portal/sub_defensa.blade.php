@extends('layouts.portal')

@section('content')
<div class="bg-scene min-h-screen relative py-12">
    <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-[2px] z-0"></div>
    
    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Encabezado Principal -->
        <div class="bg-slate-900/80 border border-white/10 rounded-3xl p-6 sm:p-10 shadow-2xl">
            <div class="border-l-4 border-green-500 pl-4">
                <span class="text-green-500 font-mono text-xs font-black uppercase tracking-widest block">Sub Dirección Especializada</span>
                <h1 class="text-3xl sm:text-4xl font-black text-white m-0 uppercase tracking-tight mt-2">Defensa Legal Gratuita y Asesoría al Trabajador</h1>
                <p class="text-green-400 text-sm sm:text-base font-semibold mt-3 m-0">Asesoría jurídica • Defensa laboral • Promoción de derechos</p>
            </div>
        </div>

        <!-- Sección de Contenido Principal -->
        <section class="space-y-4">
            <h2 class="text-2xl sm:text-3xl font-black text-white uppercase tracking-tight flex items-center gap-3">
                <span class="text-green-500"><i class="fa-solid fa-gavel"></i></span> Funciones y Atribuciones
            </h2>
            
            <article class="bg-gradient-to-br from-slate-900/90 to-slate-800/90 border border-white/10 rounded-2xl p-6 sm:p-8 shadow-xl">
                <div class="space-y-4 text-slate-300 text-sm sm:text-base leading-relaxed">
                    <p class="text-slate-300">
                        Artículo 27º.- La subdirección de Defensa Legal Gratuita y Asesoría al Trabajador, tiene las siguientes funciones y atribuciones:
                    </p>
                    <ul class="space-y-3 list-none">
                        <li class="flex gap-3">
                            <span class="text-green-500 mt-1"><i class="fa-solid fa-circle"></i></span>
                            <span>Participar en la elaboración del Plan anual de Actividades de la Dirección Regional.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="text-green-500 mt-1"><i class="fa-solid fa-circle"></i></span>
                            <span>Absolver consultas verbales, telefónicas u otros medios, que formulen los empleados y trabajadores del régimen de la actividad privada.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="text-green-500 mt-1"><i class="fa-solid fa-circle"></i></span>
                            <span>Efectuar liquidaciones de derechos sociales de los trabajadores basándose en la documentación idónea proporcionada por el solicitante.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="text-green-500 mt-1"><i class="fa-solid fa-circle"></i></span>
                            <span>Promover la conciliación ante empleadores y trabajadores, velando por la solución armoniosa de conflictos.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="text-green-500 mt-1"><i class="fa-solid fa-circle"></i></span>
                            <span>Brindar orientación legal sobre la aplicación de las normas jurídicas laborales y de seguridad social a los usuarios de la Dirección Regional.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="text-green-500 mt-1"><i class="fa-solid fa-circle"></i></span>
                            <span>Evaluar previamente solicitudes de inspecciones especiales y sancionar pecuniariamente a los empleadores por la inasistencia a la diligencia de conciliación.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="text-green-500 mt-1"><i class="fa-solid fa-circle"></i></span>
                            <span>Brindar patrocinio a los ex trabajadores ante el poder judicial referente a sus derechos laborales y de seguridad social.</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="text-green-500 mt-1"><i class="fa-solid fa-circle"></i></span>
                            <span>Cumplir con otras funciones que le asigne el director de Prevención y Solución de Conflictos.</span>
                        </li>
                    </ul>
                </div>
            </article>
        </section>

        <!-- Sección de Servicios -->
        <section class="space-y-4">
            <h2 class="text-2xl sm:text-3xl font-black text-white uppercase tracking-tight flex items-center gap-3">
                <i class="fa-solid fa-bullseye" style="color: rgb(229, 14, 14);"></i> Servicios Ofertados
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Servicio 1 -->
                <div class="bg-slate-900/80 border border-white/10 rounded-2xl p-6 hover:border-green-500/50 transition-all">
                    <div class="flex gap-3 items-start">
                        <i class="fa-solid fa-book-open" style="color: rgb(229, 14, 14);"></i>
                        <div class="flex-1">
                            <h3 class="text-base font-bold text-white mb-2 m-0">[PLACEHOLDER] Asesoría Legal Gratuita</h3>
                            <p class="text-slate-400 text-xs sm:text-sm leading-relaxed m-0">
                                Descripción de servicio de asesoría jurídica a trabajadores.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Servicio 2 -->
                <div class="bg-slate-900/80 border border-white/10 rounded-2xl p-6 hover:border-green-500/50 transition-all">
                    <div class="flex gap-3 items-start">
                        <i class="fa-solid fa-building-columns" style="color: rgb(229, 14, 14);"></i>
                        <div class="flex-1">
                            <h3 class="text-base font-bold text-white mb-2 m-0">[PLACEHOLDER] Defensa en Procesos Laborales</h3>
                            <p class="text-slate-400 text-xs sm:text-sm leading-relaxed m-0">
                                Descripción de defensa legal en procedimientos administrativos y judiciales.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección de Derechos Fundamentales -->
        <section class="space-y-4">
            <h2 class="text-2xl sm:text-3xl font-black text-white uppercase tracking-tight flex items-center gap-3">
                <span class="text-green-500">💼</span> Derechos Laborales Promovidos
            </h2>
            
            <article class="bg-gradient-to-br from-green-900/30 to-slate-900/80 border border-green-500/30 rounded-2xl p-6 sm:p-8">
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed m-0 italic">
                    [PLACEHOLDER] Información sobre derechos fundamentales del trabajador, convenios internacionales (OIT), y protección de derechos laborales básicos.
                </p>
            </article>
        </section>

        <!-- Sección de Contacto/Información -->
        <section class="space-y-4">
            <h2 class="text-2xl sm:text-3xl font-black text-white uppercase tracking-tight flex items-center gap-3">
                <span class="text-green-500">📞</span> Cómo Acceder
            </h2>
            
            <div class="bg-gradient-to-br from-green-900/40 to-slate-900/80 border border-green-500/30 rounded-2xl p-6 sm:p-8">
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed m-0 italic">
                    [PLACEHOLDER] Información sobre cómo acceder a los servicios de defensa legal gratuita, requisitos, horarios de atención y canales de contacto.
                </p>
            </div>
        </section>

        <!-- Botón de Retorno -->
        <div class="flex justify-center pt-8 border-t border-white/10">
            <a href="{{ route('portal.Sconflictos') }}" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-green-500/40">
                <i class="fa-solid fa-arrow-left"></i> Volver a Dirección Principal
            </a>
        </div>

    </div>
</div>
@endsection
