@extends('layouts.portal')

@section('content')
<div class="bg-scene-light min-h-screen relative py-12">
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="space-y-10">

            <!-- Encabezado -->
            <section class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
                <div class="grid gap-8 p-8 lg:grid-cols-[1.2fr_0.8fr] lg:p-10">
                    <div class="space-y-6">
                        <div class="inline-flex items-center gap-3 rounded-2xl bg-slate-900/5 px-4 py-2 text-sm font-semibold text-slate-700">
                            <i class="fa-solid fa-graduation-cap text-blue-700"></i>
                            Capacitación y Formación para el Trabajo
                        </div>
                        <div class="space-y-4">
                            <h1 class="text-xl font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">
                                Capacitación Laboral y Certificación de Competencias
                            </h1>
                            <p class="max-w-3xl text-base leading-8 text-slate-600 m-0">
                                La DRTPE Puno promueve la empleabilidad de la población a través de la capacitación para el trabajo, la certificación de competencias laborales y las modalidades formativas, mejorando las oportunidades de inserción y desarrollo profesional en las 13 provincias de la región.
                            </p>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <article class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                                <h2 class="text-lg font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">
                                    <i class="fa-solid fa-user-check text-red-600"></i>
                                    Servicio Gratuito
                                </h2>
                                <p class="mt-3 text-sm leading-7 text-slate-600 m-0">
                                    Todos los servicios de orientación, capacitación y certificación son gratuitos y están dirigidos a la ciudadanía en búsqueda de mejores oportunidades laborales.
                                </p>
                            </article>
                            <article class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                                <h2 class="text-lg font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">
                                    <i class="fa-solid fa-people-roof text-blue-700"></i>
                                    Enfoque Inclusivo
                                </h2>
                                <p class="mt-3 text-sm leading-7 text-slate-600 m-0">
                                    Atención prioritaria a jóvenes, mujeres, personas con discapacidad y trabajadores del sector informal que buscan formalizar sus competencias.
                                </p>
                            </article>
                        </div>
                    </div>
                    <div class="rounded-[1.75rem] border border-slate-200 bg-slate-900/5 p-8 shadow-sm">
                        <div class="rounded-3xl bg-slate-900 px-5 py-6 text-slate-50 shadow-sm">
                            <p class="text-xs uppercase tracking-[0.35em] text-slate-300">Objetivo del servicio</p>
                            <h2 class="mt-4 text-2xl font-black text-white m-0">Formar, certificar e insertar talento regional</h2>
                        </div>
                        <div class="mt-8 space-y-5">
                            <div class="rounded-3xl bg-white p-5 shadow-sm border border-slate-200">
                                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-900">Empleabilidad</p>
                                <p class="mt-3 text-sm leading-7 text-slate-600 m-0">Cierre de brechas de competencias para responder a la demanda del mercado laboral altiplánico.</p>
                            </div>
                            <div class="rounded-3xl bg-white p-5 shadow-sm border border-slate-200">
                                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-900">Formalización</p>
                                <p class="mt-3 text-sm leading-7 text-slate-600 m-0">Reconocimiento oficial de la experiencia laboral adquirida de manera empírica.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Líneas de servicio -->
            <section>
                <div class="mb-6">
                    <h2 class="text-2xl font-black text-white uppercase tracking-wider flex items-center gap-3">
                        <i class="fa-solid fa-layer-group text-red-500"></i>
                        Líneas de Servicio
                    </h2>
                </div>
                <div class="grid gap-6 lg:grid-cols-3">
                    <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">
                            <i class="fa-solid fa-certificate text-xl"></i>
                        </div>
                        <h3 class="mt-5 text-lg font-black text-slate-900 uppercase tracking-wider m-0">Certificación de Competencias Laborales</h3>
                        <p class="mt-4 text-sm leading-7 text-slate-600 m-0">
                            Reconoce y acredita formalmente las competencias adquiridas por la experiencia laboral, sin importar cómo o dónde se aprendieron, mediante la evaluación de un centro certificador autorizado.
                        </p>
                        <ul class="mt-5 list-disc space-y-2 pl-5 text-sm leading-7 text-slate-600">
                            <li>Evaluación de conocimientos y desempeño.</li>
                            <li>Certificado con validez nacional.</li>
                            <li>Ocupaciones de construcción, gastronomía, textil, agropecuaria y más.</li>
                        </ul>
                    </article>

                    <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-100 text-red-600">
                            <i class="fa-solid fa-chalkboard-user text-xl"></i>
                        </div>
                        <h3 class="mt-5 text-lg font-black text-slate-900 uppercase tracking-wider m-0">Capacitación Laboral</h3>
                        <p class="mt-4 text-sm leading-7 text-slate-600 m-0">
                            Cursos y talleres de corta duración orientados a desarrollar competencias técnicas y ocupacionales con alta demanda en el mercado de trabajo regional.
                        </p>
                        <ul class="mt-5 list-disc space-y-2 pl-5 text-sm leading-7 text-slate-600">
                            <li>Talleres presenciales y descentralizados.</li>
                            <li>Contenidos alineados a la demanda empresarial.</li>
                            <li>Constancia de participación.</li>
                        </ul>
                    </article>

                    <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                            <i class="fa-solid fa-briefcase text-xl"></i>
                        </div>
                        <h3 class="mt-5 text-lg font-black text-slate-900 uppercase tracking-wider m-0">Modalidades Formativas Laborales</h3>
                        <p class="mt-4 text-sm leading-7 text-slate-600 m-0">
                            Orientación y registro de convenios que articulan la formación con la experiencia práctica en centros de trabajo, en el marco de la Ley N.° 28518.
                        </p>
                        <ul class="mt-5 list-disc space-y-2 pl-5 text-sm leading-7 text-slate-600">
                            <li>Prácticas pre-profesionales y profesionales.</li>
                            <li>Aprendizaje y capacitación laboral juvenil.</li>
                            <li>Pasantías y actualización para la reinserción laboral.</li>
                        </ul>
                    </article>
                </div>
            </section>

            <!-- Proceso de Certificación -->
            <section class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                <h2 class="text-xl font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">
                    <i class="fa-solid fa-list-check text-blue-700"></i>
                    ¿Cómo Certificar mis Competencias?
                </h2>
                <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                    <article class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-blue-700 text-sm font-black text-white">1</span>
                        <h3 class="mt-4 text-base font-black text-slate-900 m-0">Inscripción</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600 m-0">Acércate al Centro de Empleo con tu DNI y solicita orientación sobre la ocupación a certificar.</p>
                    </article>
                    <article class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-blue-700 text-sm font-black text-white">2</span>
                        <h3 class="mt-4 text-base font-black text-slate-900 m-0">Evaluación Teórica</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600 m-0">Rendición de una prueba de conocimientos aplicada por el evaluador del centro certificador.</p>
                    </article>
                    <article class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-blue-700 text-sm font-black text-white">3</span>
                        <h3 class="mt-4 text-base font-black text-slate-900 m-0">Evaluación de Desempeño</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600 m-0">Demostración práctica de las competencias en un escenario real o simulado de trabajo.</p>
                    </article>
                    <article class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-blue-700 text-sm font-black text-white">4</span>
                        <h3 class="mt-4 text-base font-black text-slate-900 m-0">Certificación</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600 m-0">Emisión del certificado oficial de competencia laboral con reconocimiento a nivel nacional.</p>
                    </article>
                </div>
            </section>

            <!-- Requisitos y acceso -->
            <section class="grid gap-6 lg:grid-cols-2">
                <article class="rounded-[2rem] border border-slate-200 bg-slate-50 p-8 shadow-sm">
                    <h2 class="text-xl font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">
                        <i class="fa-solid fa-clipboard-list text-red-600"></i>
                        Requisitos de Acceso
                    </h2>
                    <ul class="mt-6 space-y-3 text-sm leading-7 text-slate-700">
                        <li class="flex gap-3"><i class="fa-solid fa-circle-check text-blue-700 mt-1"></i> Documento Nacional de Identidad (DNI) vigente.</li>
                        <li class="flex gap-3"><i class="fa-solid fa-circle-check text-blue-700 mt-1"></i> Experiencia laboral o interés en la ocupación a capacitar.</li>
                        <li class="flex gap-3"><i class="fa-solid fa-circle-check text-blue-700 mt-1"></i> Ser mayor de edad (o contar con autorización según el caso).</li>
                        <li class="flex gap-3"><i class="fa-solid fa-circle-check text-blue-700 mt-1"></i> Registro en la ficha única del Centro de Empleo.</li>
                    </ul>
                </article>
                <article class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                    <h2 class="text-xl font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">
                        <i class="fa-solid fa-location-dot text-blue-700"></i>
                        Dónde y Cuándo
                    </h2>
                    <div class="mt-6 space-y-4 text-sm leading-7 text-slate-700">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-900 m-0">Centro de Empleo Puno</p>
                            <p class="mt-2 m-0">Atención en la sede central de la DRTPE Puno y en la Zona Desconcentrada de Juliaca.</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-900 m-0">Horario</p>
                            <p class="mt-2 m-0">Lunes a viernes de 8:00 a. m. a 4:00 p. m. Consulta el cronograma de talleres en los canales oficiales de la institución.</p>
                        </div>
                    </div>
                </article>
            </section>
        </div>
    </div>
</div>
@endsection
