@extends('layouts.portal')

@section('content')
<div class="bg-scene-light min-h-screen relative py-12">
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <!-- Sección 1: Presentación del Centro de Empleo Puno -->
        <section class="mb-10 overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
            <div class="grid gap-8 p-8 lg:grid-cols-[1.2fr_0.8fr] lg:p-10">
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-3 rounded-2xl bg-slate-900/5 px-4 py-2 text-sm font-semibold text-slate-700">
                        <i class="fa-solid fa-building text-blue-700"></i>
                        Centro de Empleo Puno
                    </div>
                    <div class="space-y-4">
                        <h1 class="text-xl font-black text-slate-900 uppercase tracking-wider flex items-center gap-2">
                            <span>Centro de Empleo Puno</span>
                        </h1>
                        <p class="max-w-3xl text-base leading-8 text-slate-600">
                            El Centro de Empleo Puno es un mecanismo gratuito que articula los servicios de promoción del empleo, empleabilidad y emprendimiento para las 13 provincias de la región Puno, con prioridad en grupos vulnerables y poblaciones en situación de mayor necesidad.
                        </p>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <article class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                            <h2 class="text-lg font-black text-slate-900 uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-handshake-simple text-red-600"></i>
                                Módulo de Atención y Triaje
                            </h2>
                            <p class="mt-3 text-sm leading-7 text-slate-600">
                                Evaluación del perfil del ciudadano mediante la ficha única para derivación a los servicios adecuados de empleo, capacitación o certificación.
                            </p>
                        </article>
                        <article class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                            <h2 class="text-lg font-black text-slate-900 uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-briefcase text-blue-700"></i>
                                Acercamiento Empresarial
                            </h2>
                            <p class="mt-3 text-sm leading-7 text-slate-600">
                                Registro de empresas altiplánicas y canalización de sus requerimientos hacia Bolsa de Trabajo, Capacitación o Certificación de Competencias.
                            </p>
                        </article>
                    </div>
                </div>
                <div class="rounded-[1.75rem] border border-slate-200 bg-slate-900/5 p-8 shadow-sm">
                    <div class="rounded-3xl bg-slate-900 px-5 py-6 text-slate-50 shadow-sm">
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-300">Atención estratégica</p>
                        <h2 class="mt-4 text-3xl font-black text-white">Articulando empleos, competencias y emprendimientos</h2>
                    </div>
                    <div class="mt-8 space-y-5">
                        <div class="rounded-3xl bg-white p-5 shadow-sm border border-slate-200">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-900">Cobertura regional</p>
                            <p class="mt-3 text-sm leading-7 text-slate-600">Acción territorial en las 13 provincias de Puno, con énfasis en servicios inclusivos y sostenibles.</p>
                        </div>
                        <div class="rounded-3xl bg-white p-5 shadow-sm border border-slate-200">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-900">Grupos vulnerables</p>
                            <p class="mt-3 text-sm leading-7 text-slate-600">Atención prioritaria a jóvenes, mujeres rurales, adultos mayores y personas con discapacidad.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección 2: Bolsa de Trabajo -->
        <section class="mb-10">
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <article class="w-full bg-black border border-gray-800 rounded-2xl p-8 group hover:shadow-lg hover:shadow-black/50 transition-all">
                <h2 class="text-2xl font-bold text-white uppercase tracking-wider flex items-center gap-3">
                    <i class="fa-solid fa-briefcase text-blue-400"></i>
                    Bolsa de Trabajo
                </h2>

                <p class="mt-4 text-base leading-8 text-gray-200">
                    Intermediación laboral transparente para postulantes y empresas, con acceso presencial y virtual a servicios de colocación y seguimiento en todo el país.
                </p>
                </article>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-wider">Modalidad Presencial</h3>
                    <p class="mt-4 text-sm leading-7 text-slate-600">
                        Uso del sistema SILNET para atención directa a buscadores de empleo y empresas, asegurando vinculación y seguimiento efectivo.
                    </p>
                    <ul class="mt-5 list-disc space-y-3 pl-5 text-sm leading-7 text-slate-600">
                        <li>Atención a personas en búsqueda de empleo con perfilamiento personalizado.</li>
                        <li>Registro de empresas y verificación de vacantes.</li>
                        <li>Vinculación operacional entre oferta y demanda.</li>
                        <li>Seguimiento con criterios de matching y trazabilidad.</li>
                    </ul>
                </article>
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-wider">Modalidad Virtual</h3>
                    <p class="mt-4 text-sm leading-7 text-slate-600">
                        Conexión con el portal nacional Empleos Perú para validación de ofertas, registro de CV y acceso a espacios juveniles e inclusivos.</p>
                    <ul class="mt-5 list-disc space-y-3 pl-5 text-sm leading-7 text-slate-600">
                        <li>Validación de ofertas mediante RUC y razón social.</li>
                        <li>Registro digital de competencias y CV.</li>
                        <li>Acceso al Portal Empleo Joven (18-29 años).</li>
                        <li>Módulo Inclusivo para atención a personas en situación de vulnerabilidad.</li>
                    </ul>
                </article>
            </div>
        </section>

        <!-- Sección 3: Asesoría en la Búsqueda de Empleo - ABE -->
        <section class="mb-10">
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <article class="w-full bg-black border border-gray-800 rounded-2xl p-8 group hover:shadow-lg hover:shadow-black/50 transition-all">
                <h2 class="text-2xl font-bold text-white uppercase tracking-wider flex items-center gap-3">
                    <i class="fa-solid fa-user-graduate text-red-600"></i>
                    Asesoría en la Búsqueda de Empleo - ABE
                </h2>
                <p class="mt-4 text-base leading-8 text-gray-200">
                    Capacitación autónoma basada en el cuestionario CINUTA para reforzar habilidades laborales, CV y desempeño en procesos de evaluación.
                </p>
                </article>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="h-1 w-16 rounded-full bg-blue-700"></div>
                    <h3 class="mt-5 text-lg font-black text-slate-900">Descubriendo nuestras capacidades para el empleo</h3>
                    <p class="mt-4 text-sm leading-7 text-slate-600">Autoconocimiento local, autoestima competitiva, competencias laborales y fuentes de empleo altiplánicas.</p>
                </article>
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="h-1 w-16 rounded-full bg-blue-700"></div>
                    <h3 class="mt-5 text-lg font-black text-slate-900">Herramientas básicas para un Currículum Vitae</h3>
                    <p class="mt-4 text-sm leading-7 text-slate-600">Formatos claros, marketeando nuestro CV y construcción de un perfil exitoso y vendible.</p>
                </article>
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="h-1 w-16 rounded-full bg-blue-700"></div>
                    <h3 class="mt-5 text-lg font-black text-slate-900">Cómo afrontar el proceso de evaluación</h3>
                    <p class="mt-4 text-sm leading-7 text-slate-600">Pruebas psicológicas recurrentes y simulaciones de entrevista vía role-playing.</p>
                </article>
            </div>
        </section>

        <!-- Sección 4: Servicios Especializados y Alianzas -->
        <section class="mb-10">
            <div class="mb-6 mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <article class="w-full bg-black border border-gray-800 rounded-2xl p-8 group hover:shadow-lg hover:shadow-black/50 transition-all">
                <h2 class="text-2xl font-bold text-white uppercase tracking-wider flex items-center gap-3">
                    <i class="fa-solid fa-star text-blue-700"></i>
                    Servicios Especializados y Alianzas
                </h2>
                <p class="mt-4 text-base leading-8 text-gray-200">
                    Soluciones complementarias para vinculación empresarial, empleo temporal y orientación a migrantes desde una perspectiva institucional.
                </p>
                </article>
            </div>
            <div class="grid gap-6 lg:grid-cols-3">
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-black text-slate-900">Alianza con el Sector Empresarial</h3>
                    <p class="mt-4 text-sm leading-7 text-slate-600">Vinculación con Empleos Perú y articulación de formación de mano de obra calificada a medida cuando no hay perfiles inmediatos.</p>
                </article>
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-black text-slate-900">Empleo Temporal</h3>
                    <p class="mt-4 text-sm leading-7 text-slate-600">Articulación con programas nacionales como Llamkasun Perú para obras de infraestructura básica en zonas urbanas y rurales de Puno.</p>
                </article>
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-black text-slate-900">Orientación al Migrante</h3>
                    <p class="mt-4 text-sm leading-7 text-slate-600">Orientación legal en migración laboral, retorno a Puno y talleres de aprovechamiento de remesas.</p>
                </article>
            </div>
        </section>

        <!-- Sección 5: Servicio SOVIO -->
        <section class="mb-10 overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
            <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr] p-8 lg:p-10">
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-3 rounded-2xl bg-slate-900/5 px-4 py-2 text-sm font-semibold text-slate-700">
                        <i class="fa-solid fa-graduation-cap text-blue-700"></i>
                        SOVIO
                    </div>
                    <div class="space-y-4">
                        <h2 class="text-xl font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">
                            Servicio de Orientación Vocacional e Información Ocupacional (SOVIO)
                        </h2>
                        <p class="max-w-3xl text-base leading-8 text-slate-600">
                            SOVIO brinda orientación vocacional e información ocupacional a jóvenes de academias preuniversitarias y centros de formación de Puno y Juliaca, apoyando la construcción responsable de su proyecto de vida formativo y laboral.
                        </p>
                    </div>
                </div>
                <article class="rounded-[1.75rem] border border-slate-200 bg-slate-900/5 p-8 shadow-sm">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Servicio institucional</p>
                    <h3 class="mt-4 text-3xl font-black text-slate-900">Apoyo estratégico para decisiones formativas</h3>
                    <p class="mt-4 text-sm leading-7 text-slate-600">Fortalecemos el autoconocimiento, la identificación de intereses y capacidades, y la toma de decisiones responsables en el contexto académico y laboral regional.</p>
                </article>
            </div>

            <!-- Objetivos del Servicio -->
            <section class="mb-10 grid gap-6 lg:grid-cols-2 px-8 pb-8">
                <article class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6 shadow-sm">
                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-wider m-0">Objetivo General</h3>
                    <p class="mt-4 text-sm leading-7 text-slate-600">
                        Brindar orientación vocacional e información ocupacional a jóvenes de academias preuniversitarias y centros de formación de Puno y Juliaca, promoviendo el autoconocimiento, la identificación de intereses y capacidades, y la toma de decisiones responsables respecto a su proyecto de vida formativo y laboral.
                    </p>
                </article>
                <article class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-wider m-0">Objetivos Específicos</h3>
                    <ul class="mt-4 list-disc space-y-3 pl-5 text-sm leading-7 text-slate-600">
                        <li>Difundir o impulsar el servicio SOVIO en academias preuniversitarias y centros de formación de Puno y Juliaca.</li>
                        <li>Sensibilizar a la población sobre la importancia del servicio SOVIO para la elección de una carrera profesional u ocupacional.</li>
                        <li>Promover el autoconocimiento mediante herramientas como el análisis FODA personal.</li>
                        <li>Generar espacios de interacción entre los jóvenes y centros de formación profesional para conocer la oferta educativa disponible.</li>
                    </ul>
                </article>
            </section>

            <!-- Intervención Principal -->
            <section class="mb-10 rounded-[2rem] border-t border-slate-200 bg-slate-50 p-8 shadow-sm">
                <div class="mb-6">
                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-wider m-0">Intervención Principal del Servicio SOVIO</h3>
                    <p class="mt-4 text-sm leading-7 text-slate-600">
                        La intervención es un proceso integral, sistemático y especializado basado en una directiva que exige un mínimo de tres etapas secuenciales y coordinadas.
                    </p>
                </div>
                <div class="grid gap-6 lg:grid-cols-3">
                    <article class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                        <span class="inline-flex rounded-full bg-blue-700 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-white">a</span>
                        <h4 class="mt-4 text-base font-black text-slate-900 uppercase tracking-wider m-0">Orientación e Información</h4>
                        <p class="mt-4 text-sm leading-7 text-slate-600">
                            Información sobre el mercado laboral regional y nacional; asesoramiento para la construcción del proyecto de vida; investigación y análisis de carreras profesionales; identificación de oportunidades de empleo y capacitación.
                        </p>
                    </article>
                    <article class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                        <span class="inline-flex rounded-full bg-blue-700 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-white">b</span>
                        <h4 class="mt-4 text-base font-black text-slate-900 uppercase tracking-wider m-0">Exploración y Características Personales</h4>
                        <p class="mt-4 text-sm leading-7 text-slate-600">
                            Aplicación de pruebas psicológicas vocacionales para medir habilidades básicas, estilos personales, intereses profesionales y potencial emprendedor; evaluación de habilidades e intereses; entrevista inicial para identificar objetivos personales.
                        </p>
                    </article>
                    <article class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                        <span class="inline-flex rounded-full bg-blue-700 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-white">c</span>
                        <h4 class="mt-4 text-base font-black text-slate-900 uppercase tracking-wider m-0">Retroalimentación y Asesoría</h4>
                        <p class="mt-4 text-sm leading-7 text-slate-600">
                            Interpretación de resultados y elaboración del informe vocacional; información sobre instituciones educativas, becas y programas formativos; técnicas de reflexión y autoevaluación para la toma de decisiones informadas.
                        </p>
                    </article>
                </div>
            </section>

            <!-- Ferias Vocacionales -->
            <section class="mb-10 rounded-[2rem] border-t border-slate-200 bg-white p-8 shadow-sm">
                <h3 class="text-xl font-black text-slate-900 uppercase tracking-wider m-0">Ferias Vocacionales</h3>
                <div class="mt-8 grid gap-6 lg:grid-cols-[1.4fr_1fr]">
                    <div class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6 shadow-sm">
                        <h4 class="text-lg font-black text-slate-900 uppercase tracking-wider m-0">Objetivos de la Feria</h4>
                        <ul class="mt-4 list-disc space-y-3 pl-5 text-sm leading-7 text-slate-600">
                            <li>Difundir el servicio SOVIO.</li>
                            <li>Sensibilizar a la población e instituciones sobre su importancia.</li>
                            <li>Facilitar experiencias de reflexión en aptitudes.</li>
                            <li>Generar espacios informativos de la oferta formativa regional.</li>
                        </ul>
                    </div>
                    <div class="space-y-6">
                        <article class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6 shadow-sm">
                            <h4 class="text-lg font-black text-slate-900 uppercase tracking-wider m-0">Población Beneficiaria</h4>
                            <p class="mt-4 text-sm leading-7 text-slate-600">
                                Jóvenes de 16 a 24 años de 4to y 5to de secundaria. Evento gratuito y abierto al público en general.
                            </p>
                        </article>
                        <article class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6 shadow-sm">
                            <h4 class="text-lg font-black text-slate-900 uppercase tracking-wider m-0">Utilidad</h4>
                            <p class="mt-4 text-sm leading-7 text-slate-600">
                                Herramienta masiva para la difusión rápida de SOVIO y el acercamiento de jóvenes a opciones educativas y ocupacionales en corto tiempo.
                            </p>
                        </article>
                    </div>
                </div>
            </section>

            <!-- Estrategias Complementarias -->
            <section class="mb-10 grid gap-6 lg:grid-cols-2 px-8 pb-8">
                <article class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6 shadow-sm">
                    <h4 class="text-lg font-black text-slate-900 uppercase tracking-wider m-0">Visitas Guiadas a Empresas</h4>
                    <p class="mt-4 text-sm leading-7 text-slate-600">
                        Estrategia para conocer de manera directa los entornos laborales y estandarizar la información práctica del mundo del trabajo.
                    </p>
                    <div class="mt-5 rounded-2xl bg-white p-5 border border-slate-200">
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-900">Tipos de Visitas</p>
                        <ul class="mt-4 list-disc space-y-2 pl-5 text-sm leading-7 text-slate-600">
                            <li>Por población beneficiaria: personas naturales/usuarios e instituciones como colegios, academias e iglesias.</li>
                            <li>Por empresa a visitar: empresas representativas de la región o vinculadas a las ocupaciones de mayor interés.</li>
                        </ul>
                    </div>
                </article>
                <article class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6 shadow-sm">
                    <h4 class="text-lg font-black text-slate-900 uppercase tracking-wider m-0">Paneles Ocupacionales</h4>
                    <p class="mt-4 text-sm leading-7 text-slate-600">
                        Espacio para brindar información testimonial de profesionales y trabajadores con el fin de fortalecer el conocimiento laboral.
                    </p>
                    <div class="mt-5 rounded-2xl bg-white p-5 border border-slate-200">
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-900">Lineamientos</p>
                        <ul class="mt-4 list-disc space-y-2 pl-5 text-sm leading-7 text-slate-600">
                            <li>Selección temática por edad.</li>
                            <li>Priorizar actividades económicas regionales.</li>
                            <li>Participación de especialistas con habilidades comunicativas.</li>
                            <li>Uso de espacios diferenciados de otras actividades.</li>
                        </ul>
                    </div>
                </article>
            </section>

            <!-- Charlas Especializadas -->
            <section class="grid gap-6 md:grid-cols-2 px-8 pb-8">
                <article class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6 shadow-sm">
                    <h4 class="text-lg font-black text-slate-900 uppercase tracking-wider m-0">Charlas Informativas</h4>
                    <p class="mt-4 text-sm leading-7 text-slate-600">
                        Dirigidas a estudiantes de academias y centros de formación sobre oferta educativa universitaria/técnica, requisitos de ingreso, tendencias del mercado laboral y estrategias de búsqueda de empleo.
                    </p>
                </article>
                <article class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6 shadow-sm">
                    <h4 class="text-lg font-black text-slate-900 uppercase tracking-wider m-0">Charlas para Padres de Familia</h4>
                    <p class="mt-4 text-sm leading-7 text-slate-600">
                        Sesiones para fortalecer el acompañamiento familiar, abordando la importancia de la orientación vocacional, estrategias de apoyo en la toma de decisiones e información de oportunidades.
                    </p>
                </article>
            </section>
        </section>

    </div>
</div>
@endsection