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
                            <h3 class="text-base font-bold text-white mb-2 m-0">Asesoría y Orientación Jurídica Gratuita</h3>
                            <p class="text-slate-400 text-xs sm:text-sm leading-relaxed m-0">
                                Consultas verbales, telefónicas y presenciales sobre la aplicación de las normas laborales y de seguridad social, dirigidas a trabajadores y ex trabajadores del régimen de la actividad privada, sin costo alguno.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Servicio 2 -->
                <div class="bg-slate-900/80 border border-white/10 rounded-2xl p-6 hover:border-green-500/50 transition-all">
                    <div class="flex gap-3 items-start">
                        <i class="fa-solid fa-building-columns" style="color: rgb(229, 14, 14);"></i>
                        <div class="flex-1">
                            <h3 class="text-base font-bold text-white mb-2 m-0">Patrocinio y Defensa en Procesos Laborales</h3>
                            <p class="text-slate-400 text-xs sm:text-sm leading-relaxed m-0">
                                Representación y patrocinio del ex trabajador ante el Poder Judicial y en procedimientos administrativos, en la reclamación de beneficios sociales y derechos laborales adeudados.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Servicio 3 -->
                <div class="bg-slate-900/80 border border-white/10 rounded-2xl p-6 hover:border-green-500/50 transition-all">
                    <div class="flex gap-3 items-start">
                        <i class="fa-solid fa-calculator" style="color: rgb(229, 14, 14);"></i>
                        <div class="flex-1">
                            <h3 class="text-base font-bold text-white mb-2 m-0">Liquidación de Beneficios Sociales</h3>
                            <p class="text-slate-400 text-xs sm:text-sm leading-relaxed m-0">
                                Cálculo de derechos y beneficios sociales (CTS, gratificaciones, vacaciones y remuneraciones adeudadas) con base en la documentación idónea proporcionada por el solicitante.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Servicio 4 -->
                <div class="bg-slate-900/80 border border-white/10 rounded-2xl p-6 hover:border-green-500/50 transition-all">
                    <div class="flex gap-3 items-start">
                        <i class="fa-solid fa-handshake" style="color: rgb(229, 14, 14);"></i>
                        <div class="flex-1">
                            <h3 class="text-base font-bold text-white mb-2 m-0">Promoción de la Conciliación Laboral</h3>
                            <p class="text-slate-400 text-xs sm:text-sm leading-relaxed m-0">
                                Impulso de acuerdos conciliatorios entre empleadores y trabajadores, velando por la solución armoniosa de los conflictos y evitando procesos judiciales prolongados.
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
            
            <article class="bg-gradient-to-br from-green-900/30 to-slate-900/80 border border-green-500/30 rounded-2xl p-6 sm:p-8 space-y-4">
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed m-0">
                    La Subdirección promueve el respeto irrestricto de los <strong class="text-white">derechos fundamentales en el trabajo</strong>, en concordancia con la Constitución Política del Estado y los Convenios de la Organización Internacional del Trabajo (OIT) ratificados por el Perú: la libertad sindical y la negociación colectiva, la erradicación del trabajo forzoso y del trabajo infantil, y la igualdad de oportunidades y de trato sin discriminación.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-slate-300 text-sm">
                    <span class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> Remuneración mínima vital</span>
                    <span class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> Jornada máxima y descanso semanal</span>
                    <span class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> Gratificaciones y CTS</span>
                    <span class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> Vacaciones y descansos remunerados</span>
                    <span class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> Seguridad y salud en el trabajo</span>
                    <span class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> Protección contra el despido arbitrario</span>
                </div>
            </article>
        </section>

        <!-- Sección de Contacto/Información -->
        <section class="space-y-4">
            <h2 class="text-2xl sm:text-3xl font-black text-white uppercase tracking-tight flex items-center gap-3">
                <span class="text-green-500">📞</span> Cómo Acceder
            </h2>
            
            <div class="bg-gradient-to-br from-green-900/40 to-slate-900/80 border border-green-500/30 rounded-2xl p-6 sm:p-8">
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed m-0">
                    El servicio es <strong class="text-white">totalmente gratuito</strong> y está dirigido a trabajadores y ex trabajadores del régimen laboral de la actividad privada.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div class="bg-slate-900/60 border border-white/10 rounded-xl p-5">
                        <div class="text-green-500 mb-2"><i class="fa-solid fa-id-card text-xl"></i></div>
                        <h4 class="text-white font-bold text-sm m-0 mb-1.5">Requisitos</h4>
                        <p class="text-slate-400 text-xs leading-relaxed m-0">Documento Nacional de Identidad (DNI) y la documentación laboral que disponga: boletas de pago, contratos, cartas o liquidaciones.</p>
                    </div>
                    <div class="bg-slate-900/60 border border-white/10 rounded-xl p-5">
                        <div class="text-green-500 mb-2"><i class="fa-regular fa-clock text-xl"></i></div>
                        <h4 class="text-white font-bold text-sm m-0 mb-1.5">Horario de Atención</h4>
                        <p class="text-slate-400 text-xs leading-relaxed m-0">De lunes a viernes, de 8:00 a.m. a 4:00 p.m., en la sede de la Dirección Regional de Trabajo y Promoción del Empleo de Puno.</p>
                    </div>
                    <div class="bg-slate-900/60 border border-white/10 rounded-xl p-5">
                        <div class="text-green-500 mb-2"><i class="fa-solid fa-location-dot text-xl"></i></div>
                        <h4 class="text-white font-bold text-sm m-0 mb-1.5">Dónde Acudir</h4>
                        <p class="text-slate-400 text-xs leading-relaxed m-0">Acérquese a Mesa de Partes de la Dirección Regional o solicite orientación a través de los canales oficiales de la institución.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
