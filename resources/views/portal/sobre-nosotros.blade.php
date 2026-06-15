@extends('layouts.portal')

@section('content')
<div class="bg-slate-50 min-h-screen py-16 text-slate-800 antialiased">
    
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-20">
        
        {{-- ========================================== --}}
        {{-- ENCABEZADO E IDENTIDAD INSTITUCIONAL       --}}
        {{-- ========================================== --}}
        <div class="bg-white rounded-3xl p-8 sm:p-12 border border-slate-200/60 shadow-sm space-y-8">
            <div class="border-b border-red-600 pb-6">
                <span class="text-red-600 font-mono text-xs font-black uppercase tracking-widest block mb-2">Portal Institucional</span>
                <h1 class="text-3xl sm:text-5xl font-black text-slate-900 m-0 tracking-tight">Sobre Nosotros</h1>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                <div class="lg:col-span-2 space-y-4">
                    <h2 class="text-xl font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">
                        <i class="fa-solid fa-building-shield text-red-600"></i> Identidad Institucional
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed m-0 font-medium text-justify">
                        La Dirección Regional de Trabajo y Promoción del Empleo (DRTPE) del Gobierno Regional de Puno es el órgano público especializado encargado de conducir, ejecutar, supervisar y evaluar las políticas nacionales y regionales en materia de trabajo, promoción del empleo, formalización y capacitación laboral. Nuestro compromiso está firmemente orientado al desarrollo social y económico sostenible del altiplano peruano, garantizando un mercado laboral inclusivo, equitativo y con estricto respeto a la dignidad del trabajador.
                    </p>
                </div>
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200/50 space-y-3">
                    <h4 class="text-xs font-black uppercase text-slate-400 tracking-wider m-0">Valores Corporativos</h4>
                    <ul class="p-0 m-0 list-none space-y-2 text-xs font-bold text-slate-700">
                        <li class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-emerald-500"></i> Transparencia e Integridad de Gestión</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-emerald-500"></i> Equidad social e Inclusión Laboral activa</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-emerald-500"></i> Vocación de Servicio Integral al Ciudadano</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-emerald-500"></i> Ética Profesional en la Defensa del Trabajador</li>
                    </ul>
                </div>
            </div>

            {{-- Bloque de Dos Columnas: Misión y Visión --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                <div class="bg-slate-50 border border-slate-200/60 p-6 rounded-2xl space-y-2.5">
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">
                        <i class="fa-solid fa-bullseye text-red-600"></i> Misión Institucional
                    </h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed m-0 font-medium text-justify">
                        Promover un empleo pleno, digno, productivo y formal en la región Puno, garantizando el cumplimiento irrestricto de los derechos laborales fundamentales, la seguridad y salud en el trabajo, y fortaleciendo el diálogo social armónico entre las organizaciones de trabajadores y empleadores bajo un marco de concertación democrática y paz social.
                    </p>
                </div>
                
                <div class="bg-slate-50 border border-slate-200/60 p-6 rounded-2xl space-y-2.5">
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">
                        <i class="fa-solid fa-eye text-indigo-600"></i> Visión Institucional
                    </h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed m-0 font-medium text-justify">
                        Ser una institución regional líder, moderna, articulada y transparente, reconocida por su alta efectividad en la erradicación del trabajo forzoso y del trabajo infantil, consolidando un mercado de trabajo formalizado, altamente competitivo y con igualdad de oportunidades que impulse el progreso socioeconómico de la región.
                    </p>
                </div>
            </div>
        </div>

        {{-- SECCIÓN CENTRAL DE DIRECCIONES ORGANIZACIONALES --}}
        <div class="space-y-16">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <h2 class="text-3xl font-black text-slate-900 tracking-tight m-0">Nuestras Direcciones Regionales</h2>
                <p class="text-sm text-slate-400 font-bold uppercase tracking-wider">Estructura Orgánica y Competencias Funcionales DRTPE</p>
            </div>

            <div class="space-y-24">
                
                {{-- 1️⃣ DIRECCIÓN GENERAL (IMAGEN IZQUIERDA - TEXTO DERECHA) --}}
                <div class="reveal-on-scroll transform transition-all duration-1000 ease-out opacity-0 translate-y-12 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    <div class="lg:col-span-5 flex justify-center lg:justify-start">
                        <div class="relative inline-block group">
                            <div class="absolute inset-0 bg-gradient-to-tr from-red-600/10 to-indigo-600/10 rounded-3xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <img src="{{ asset('images/dirgeneral.png') }}" alt="Dirección General" class="w-full max-w-[340px] h-[420px] object-cover rounded-3xl shadow-xl border border-slate-200/80 relative z-10 bg-slate-100">
                            {{-- Badge inferior inspirado en image_91f681.jpg --}}
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-white/95 backdrop-blur border border-slate-200/80 rounded-2xl p-3 text-center shadow-lg z-20 w-[85%]">
                                <p class="text-xs font-black text-slate-900 m-0 leading-tight">Dirección General</p>
                                <p class="text-[10px] font-bold text-red-600 uppercase tracking-widest m-0 mt-1">Alta Dirección Regional</p>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-7 space-y-4 text-left">
                        <div class="inline-flex px-3 py-1 bg-red-50 border border-red-100 rounded-full text-[10px] font-black uppercase text-red-700 tracking-wider">Órgano de Alta Dirección</div>
                        <h3 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight m-0">Dirección Regional de Trabajo y Promoción del Empleo</h3>
                        <p class="text-slate-600 text-sm leading-relaxed font-medium m-0 text-justify">
                            Constituye el máximo órgano de línea y la autoridad político-administrativa de mayor jerarquía dentro de la institución. Tiene la responsabilidad legal de planificar, programar, dirigir, coordinar, ejecutar y evaluar las políticas nacionales, sectoriales y regionales en materia sociolaboral. Ejerce la representación oficial del sector y coordina directamente con el Ministerio de Trabajo (MTPE) y el Gobierno Regional de Puno para la correcta asignación presupuestal y el cumplimiento de las metas del Plan Operativo Institucional (POI).
                        </p>
                        <div class="pt-2">
                            <h4 class="text-xs font-black uppercase text-slate-400 tracking-wider mb-2">Líneas de Competencia y Funcionalidades:</h4>
                            <ul class="p-0 m-0 list-none grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs font-bold text-slate-700">
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-red-500"></i> Dirigir, supervisar y evaluar la gestión técnica de las direcciones de línea.</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-red-500"></i> Expedir resoluciones regionales y visar directivas de carácter normativo.</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-red-500"></i> Presidir el Consejo Regional de Trabajo y Promoción del Empleo (CRTPE).</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-red-500"></i> Suscribir convenios, alianzas estratégicas y acuerdos interinstitucionales.</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-red-500"></i> Resolver en última instancia administrativa los recursos de apelación.</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-red-500"></i> Controlar el presupuesto institucional asignado por metas presupuestales.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- 2️⃣ DIRECCIÓN DE PREVENCIÓN (TEXTO IZQUIERDA - IMAGEN DERECHA) --}}
                <div class="reveal-on-scroll transform transition-all duration-1000 ease-out opacity-0 translate-y-12 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    <div class="lg:col-span-7 lg:order-1 order-2 space-y-4 text-left lg:text-right">
                        <div class="inline-flex px-3 py-1 bg-indigo-50 border border-indigo-100 rounded-full text-[10px] font-black uppercase text-indigo-700 tracking-wider">Línea Técnica Operativa</div>
                        <h3 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight m-0">Dirección de Prevención y Solución de Conflictos</h3>
                        <p class="text-slate-600 text-sm leading-relaxed font-medium m-0 text-justify">
                            Es el área especializada encargada de mantener la paz social, la armonía laboral y el equilibrio contractual dentro del territorio regional. Su enfoque se centra en la prevención, mediación y resolución técnica de controversias colectivas e individuales de trabajo. A través del servicio de defensa gratuita y asesoría legal al trabajador, equilibra la balanza legal, promoviendo el uso de mecanismos alternativos como la conciliación extrajudicial y la negociación colectiva formal para evitar la paralización de las actividades productivas.
                        </p>
                        <div class="pt-2 flex flex-col lg:items-end">
                            <h4 class="text-xs font-black uppercase text-slate-400 tracking-wider mb-2">Líneas de Competencia y Funcionalidades:</h4>
                            <ul class="p-0 m-0 list-none grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs font-bold text-slate-700 text-left">
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-indigo-500"></i> Conducir de oficio o a pedido de parte audiencias de conciliación.</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-indigo-500"></i> Ofrecer el servicio de defensa legal y patrocinio gratuito al trabajador.</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-indigo-500"></i> Evaluar, calificar y registrar los pactos y convenios colectivos regionales.</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-indigo-500"></i> Administrar el registro de organizaciones sindicales (ROSSP) de Puno.</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-indigo-500"></i> Gestionar trámites administrativos de despidos colectivos y suspensiones.</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-indigo-500"></i> Realizar liquidaciones de beneficios sociales y cálculos de CTS.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="lg:col-span-5 lg:order-2 order-1 flex justify-center lg:justify-end">
                        <div class="relative inline-block group">
                            <div class="absolute inset-0 bg-gradient-to-tr from-indigo-600/10 to-blue-600/10 rounded-3xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <img src="{{ asset('images/dirprevencion.png') }}" alt="Dirección de Prevención" class="w-full max-w-[340px] h-[420px] object-cover rounded-3xl shadow-xl border border-slate-200/80 relative z-10 bg-slate-100">
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-white/95 backdrop-blur border border-slate-200/80 rounded-2xl p-3 text-center shadow-lg z-20 w-[85%]">
                                <p class="text-xs font-black text-slate-900 m-0 leading-tight">Dirección de Prevención</p>
                                <p class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest m-0 mt-1">Solución de Conflictos</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 3️⃣ DIRECCIÓN DE FORMALIZA (IMAGEN IZQUIERDA - TEXTO DERECHA) --}}
                <div class="reveal-on-scroll transform transition-all duration-1000 ease-out opacity-0 translate-y-12 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    <div class="lg:col-span-5 flex justify-center lg:justify-start">
                        <div class="relative inline-block group">
                            <div class="absolute inset-0 bg-gradient-to-tr from-amber-600/10 to-orange-600/10 rounded-3xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <img src="{{ asset('images/dirformaliza.png') }}" alt="Dirección de Formalización" class="w-full max-w-[340px] h-[420px] object-cover rounded-3xl shadow-xl border border-slate-200/80 relative z-10 bg-slate-100">
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-white/95 backdrop-blur border border-slate-200/80 rounded-2xl p-3 text-center shadow-lg z-20 w-[85%]">
                                <p class="text-xs font-black text-slate-900 m-0 leading-tight">Dirección de Formaliza</p>
                                <p class="text-[10px] font-bold text-amber-600 uppercase tracking-widest m-0 mt-1">Formalización Laboral</p>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-7 space-y-4 text-left">
                        <div class="inline-flex px-3 py-1 bg-amber-50 border border-amber-100 rounded-full text-[10px] font-black uppercase text-amber-700 tracking-wider">Línea Técnica Operativa</div>
                        <h3 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight m-0">Dirección de Formalización Laboral</h3>
                        <p class="text-slate-600 text-sm leading-relaxed font-medium m-0 text-justify">
                            Es el órgano técnico operativo responsable de diseñar, articular y desplegar campañas de regularización sociolaboral en la región, reduciendo de manera sostenida la brecha de informalidad. Su tarea se enfoca en concientizar tanto a empleadores como a micro y pequeños empresarios sobre los beneficios jurídicos y económicos de la formalidad. Coordina y valida las solicitudes del registro nacional de MYPEs (REMYPE), garantizando que los trabajadores puneños ingresen a planillas con acceso a seguro social de salud (EsSalud) y sistemas de pensiones vigentes.
                        </p>
                        <div class="pt-2">
                            <h4 class="text-xs font-black uppercase text-slate-400 tracking-wider mb-2">Líneas de Competencia y Funcionalidades:</h4>
                            <ul class="p-0 m-0 list-none grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs font-bold text-slate-700">
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-amber-500"></i> Calificar, aprobar y auditar los registros de empresas en el REMYPE.</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-amber-500"></i> Brindar asistencia técnica personalizada en el manejo del T-Registro.</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-amber-500"></i> Desplegar campañas de difusión informativa en alianza con SUNAFIL.</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-amber-500"></i> Organizar ferias y mesas de orientación destinadas a emprendedores.</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-amber-500"></i> Fiscalizar técnicamente los regímenes especiales de contratación.</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-amber-500"></i> Emitir reportes analíticos de los niveles de empleo formal regional.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- 4️⃣ DIRECCIÓN DE EMPLEO (TEXTO IZQUIERDA - IMAGEN DERECHA) --}}
                <div class="reveal-on-scroll transform transition-all duration-1000 ease-out opacity-0 translate-y-12 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    <div class="lg:col-span-7 lg:order-1 order-2 space-y-4 text-left lg:text-right">
                        <div class="inline-flex px-3 py-1 bg-emerald-50 border border-emerald-100 rounded-full text-[10px] font-black uppercase text-emerald-700 tracking-wider">Línea Técnica Operativa</div>
                        <h3 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight m-0">Dirección de Promoción del Empleo y Capacitación Laboral</h3>
                        <p class="text-slate-600 text-sm leading-relaxed font-medium m-0 text-justify">
                            Constituye la unidad especializada encargada de conectar la oferta y demanda de trabajo de forma óptima en el altiplano. Su rol incluye el diseño y monitoreo de la red de servicios del Centro de Empleo, priorizando la inserción laboral formal de jóvenes, mujeres y personas con discapacidad. Asimismo, impulsa la empleabilidad ciudadana mediante programas de capacitación técnico-productiva, asesoría de búsqueda de empleo (ABE), y la expedición unificada del Certificado Único Laboral, reduciendo fricciones en los procesos de reclutamiento empresarial.
                        </p>
                        <div class="pt-2 flex flex-col lg:items-end">
                            <h4 class="text-xs font-black uppercase text-slate-400 tracking-wider mb-2">Líneas de Competencia y Funcionalidades:</h4>
                            <ul class="p-0 m-0 list-none grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs font-bold text-slate-700 text-left">
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-emerald-500"></i> Administrar los servicios informáticos e internos del Centro de Empleo.</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-emerald-500"></i> Validar y expedir gratuitamente el Certificado Único Laboral (CUL).</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-emerald-500"></i> Planificar ferias de empleo masivas y maratones de vacantes.</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-emerald-500"></i> Dictar talleres del Servicio de Orientación Vocacional (SOVIO).</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-emerald-500"></i> Monitorear las cuotas de inserción legal para personas con discapacidad.</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-chevron-right text-emerald-500"></i> Promover becas de capacitación técnico-operativas con el sector privado.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="lg:col-span-5 lg:order-2 order-1 flex justify-center lg:justify-end">
                        <div class="relative inline-block group">
                            <div class="absolute inset-0 bg-gradient-to-tr from-emerald-600/10 to-teal-600/10 rounded-3xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <img src="{{ asset('images/dirempleo.png') }}" alt="Dirección de Empleo" class="w-full max-w-[340px] h-[420px] object-cover rounded-3xl shadow-xl border border-slate-200/80 relative z-10 bg-slate-100">
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-white/95 backdrop-blur border border-slate-200/80 rounded-2xl p-3 text-center shadow-lg z-20 w-[85%]">
                                <p class="text-xs font-black text-slate-900 m-0 leading-tight">Dirección de Empleo</p>
                                <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest m-0 mt-1">Promoción del Empleo</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

{{-- ════════════════════════════════════════════════════════════ --}}
{{-- MOTOR DE REVELACIÓN SCROLL-DRIVEN INTERSECTION OBSERVER      --}}
{{-- ════════════════════════════════════════════════════════════ --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sections = document.querySelectorAll('.reveal-on-scroll');
        
        const observerOptions = {
            root: null, 
            rootMargin: '0px',
            threshold: 0.12 // Optimizado para descripciones extensas
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove('opacity-0', 'translate-y-12');
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        sections.forEach(section => {
            observer.observe(section);
        });
    });
</script>
@endsection