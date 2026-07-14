@extends('layouts.portal')

@section('content')
<div class="bg-scene-light min-h-screen relative py-12">
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="space-y-10">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <a href="{{ route('portal.Sconflictos') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-300 bg-white/90 px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm transition hover:bg-slate-50">
                    <i class="fa-solid fa-arrow-left text-slate-900"></i>
                    Volver a prevención de conflictos
                </a>
            </div>

            <section class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="space-y-4">
                        <div class="inline-flex items-center gap-3 rounded-2xl bg-slate-900/5 px-4 py-2 text-sm font-semibold text-slate-700">
                            <i class="fa-solid fa-scale-balanced text-blue-700"></i>
                            Defensa y Asesoría Laboral
                        </div>
                        <h1 class="text-xl font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">
                            Servicios Gratuitos de Defensa y Asesoría Laboral
                        </h1>
                        <p class="max-w-3xl text-sm leading-7 text-slate-600">
                            Asesoría especializada para trabajadores del régimen privado, con servicios gratuitos de patrocinio jurídico, conciliación administrativa y apoyo en procesos laborales.
                        </p>
                    </div>
                    <div class="rounded-[1.75rem] border border-slate-200 bg-slate-900/5 p-6 shadow-sm">
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Atención gratuita</p>
                        <p class="mt-3 text-sm leading-7 text-slate-600">Servicios diseñados para la defensa laboral de personas con ingresos limitados, con enfoque en la prevención y la resolución técnica de conflictos.</p>
                    </div>
                </div>
            </section>

            <section class="grid gap-6 lg:grid-cols-3">
                <article class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-3">
                        <h2 class="text-lg font-black text-slate-900 uppercase tracking-wider m-0">Patrocinio Jurídico Gratuito</h2>
                        <span class="rounded-full bg-red-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-red-700">GRATUITO</span>
                    </div>
                    <p class="mt-4 text-sm leading-7 text-slate-600">
                        Asesoría y representación legal sin costo desde la demanda hasta la sentencia para trabajadores de escasos recursos.
                    </p>
                    <div class="mt-6 rounded-2xl bg-white p-4 border border-slate-200">
                        <p class="text-sm font-semibold text-slate-900 uppercase tracking-[0.2em]">Requisitos</p>
                        <ul class="mt-3 space-y-2 text-sm leading-7 text-slate-700 list-disc pl-5">
                            <li>DNI vigente del trabajador.</li>
                            <li>Pase de abogado o identificación del patrocinador.</li>
                            <li>Tope de ingresos de 2 RMV.</li>
                            <li>Cuantía máxima de 70 URP.</li>
                            <li>Pruebas de la relación laboral.</li>
                            <li>Firma del Convenio de patrocinio.</li>
                        </ul>
                    </div>
                    <div class="mt-6 rounded-2xl bg-white p-4 border border-slate-200">
                        <p class="text-sm font-semibold text-slate-900 uppercase tracking-[0.2em]">Medios Probatorios Recomendados</p>
                        <div class="mt-3 grid gap-2 text-sm leading-6 text-slate-700 sm:grid-cols-2">
                            <p class="list-disc pl-5">• Contratos de trabajo</p>
                            <p class="list-disc pl-5">• Boletas de pago</p>
                            <p class="list-disc pl-5">• Reportes AFP/ONP</p>
                            <p class="list-disc pl-5">• Planillas y recibos</p>
                            <p class="list-disc pl-5">• Actas de inspección SUNAFIL</p>
                            <p class="list-disc pl-5">• Actas policiales</p>
                            <p class="list-disc pl-5">• Comunicaciones de despido</p>
                            <p class="list-disc pl-5">• Compensaciones o bonos</p>
                            <p class="list-disc pl-5">• Testimonios de compañeros</p>
                            <p class="list-disc pl-5">• Fotografías de jornada laboral</p>
                        </div>
                    </div>
                </article>

                <article class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-black text-slate-900 uppercase tracking-wider m-0">Asesoría Legal Gratuita</h2>
                    <p class="mt-4 text-sm leading-7 text-slate-600">
                        Orientación técnica en legislación laboral, seguridad social, salud ocupacional y prevención de conflictos laborales.
                    </p>
                    <ul class="mt-5 space-y-3 text-sm leading-7 text-slate-700 list-disc pl-5">
                        <li>Interpretación de normas laborales y derechos.</li>
                        <li>Análisis de condiciones de trabajo y seguridad social.</li>
                        <li>Asesoría en prevención de conflictos laborales.</li>
                        <li>Revisión de contratos y cláusulas.</li>
                        <li>Asistencia en denuncias administrativas.</li>
                        <li>Orientación en procedimientos de conciliación.</li>
                    </ul>
                    <div class="mt-6 rounded-2xl bg-slate-50 p-4 border border-slate-200">
                        <p class="text-sm font-semibold text-slate-900 uppercase tracking-[0.2em]">Documentos recomendados</p>
                        <p class="mt-3 text-sm leading-7 text-slate-700">Contratos, boletas, planillas, cartas de despido, certificados de trabajo o cualquier documento que describa las condiciones de empleo.</p>
                    </div>
                </article>

                <article class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6 shadow-sm">
                    <h2 class="text-lg font-black text-slate-900 uppercase tracking-wider m-0">Liquidación de Beneficios Sociales</h2>
                    <p class="mt-4 text-sm leading-7 text-slate-600">
                        Cálculo referencial para el régimen privado, con requisitos diferenciados según el motivo del cese laboral.
                    </p>
                    <div class="mt-6 space-y-4">
                        <div class="rounded-2xl border border-slate-200 bg-white p-4">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-900">Renuncia voluntaria</p>
                            <p class="mt-3 text-sm leading-7 text-slate-700">Documentos que acrediten la renuncia, liquidaciones de sueldo y finiquito si corresponde.</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-white p-4">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-900">Término de contrato</p>
                            <p class="mt-3 text-sm leading-7 text-slate-700">Contrato terminado, finiquitos, boletas, planillas y comprobantes de pagos.</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-white p-4">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-900">Despido</p>
                            <p class="mt-3 text-sm leading-7 text-slate-700">Carta de despido, boletas, planillas, reportes de afiliación y documentación de indemnización.</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-white p-4">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-900">Insolvencia empresarial</p>
                            <p class="mt-3 text-sm leading-7 text-slate-700">Documentos de la empresa, balances, actas de insolvencia y certificados de deuda.</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-white p-4">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-900">Cierre del centro de trabajo</p>
                            <p class="mt-3 text-sm leading-7 text-slate-700">Notificaciones de cierre, contratos, boletas y registro de trabajadores afectados.</p>
                        </div>
                    </div>
                </article>
            </section>

            <section class="rounded-[2rem] border border-slate-200 bg-slate-50 p-8 shadow-sm">
                <div class="grid gap-8 lg:grid-cols-[1.4fr_1fr]">
                    <div class="space-y-5">
                        <h2 class="text-xl font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">Conciliación Administrativa Laboral</h2>
                        <p class="text-sm leading-7 text-slate-600">
                            Mecanismo gratuito con intervención de un conciliador para intentar resolver conflictos laborales antes de la vía judicial.
                        </p>
                        <div class="grid gap-4 md:grid-cols-2">
                            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                                <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider m-0">¿Quién puede solicitarla?</h3>
                                <ul class="mt-4 list-disc pl-5 text-sm leading-7 text-slate-700 space-y-2">
                                    <li>Trabajadores del régimen privado.</li>
                                    <li>Representantes legales autorizados.</li>
                                    <li>Personal del sindicato o comité.</li>
                                </ul>
                            </div>
                            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                                <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider m-0">Requisitos</h3>
                                <ul class="mt-4 list-disc pl-5 text-sm leading-7 text-slate-700 space-y-2">
                                    <li>DNI vigente del solicitante.</li>
                                    <li>Documentación laboral básica.</li>
                                    <li>Pruebas del reclamo.</li>
                                    <li>Autorización de representación si aplica.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-white p-5">
                            <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider m-0">Temas Conciliables</h3>
                            <ul class="mt-4 list-disc pl-5 text-sm leading-7 text-slate-700 space-y-2">
                                <li>Beneficios sociales</li>
                                <li>Remuneraciones</li>
                                <li>Indemnizaciones</li>
                                <li>Vacaciones y gratificaciones</li>
                                <li>Otros derechos laborales</li>
                            </ul>
                        </div>
                        <div class="rounded-2xl border-l-4 border-blue-700 bg-blue-50 p-5 text-sm leading-7 text-slate-900">
                            <p class="font-semibold">El Acta de Conciliación constituye título ejecutivo cuando contiene una obligación cierta, expresa y exigible.</p>
                        </div>
                    </div>
                    <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-black text-slate-900 uppercase tracking-wider m-0">Resultado del Procedimiento</h3>
                        <ul class="mt-4 list-disc pl-5 text-sm leading-7 text-slate-700 space-y-3">
                            <li>Acuerdo total entre las partes.</li>
                            <li>Acuerdo parcial con reconocimiento de obligaciones.</li>
                            <li>Acta de no avenencia.</li>
                            <li>Desistimiento o archivo del procedimiento.</li>
                        </ul>
                    </div>
                </div>
            </section>

            <section class="grid gap-6 lg:grid-cols-2">
                <article class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">Flujo ante Despido Arbitrario</h2>
                    <ol class="mt-6 space-y-4 text-sm leading-7 text-slate-700">
                        <li class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-blue-700 text-sm font-black text-white">1</span>
                            Solicitar constatación policial del despido arbitrario.
                        </li>
                        <li class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-blue-700 text-sm font-black text-white">2</span>
                            Acudir a consultas para evaluación gratuita del caso.
                        </li>
                        <li class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-blue-700 text-sm font-black text-white">3</span>
                            Derivación según la evaluación a:
                            <ul class="mt-3 list-disc pl-5 text-slate-700">
                                <li>Liquidación de beneficios</li>
                                <li>Conciliación administrativa</li>
                                <li>Patrocinio jurídico</li>
                            </ul>
                        </li>
                    </ol>
                </article>
                <article class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6 shadow-sm">
                    <h2 class="text-xl font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">Procesos Judiciales Laborales</h2>
                    <div class="mt-6 space-y-4">
                        <div class="rounded-2xl border border-slate-200 bg-white p-4">
                            <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider m-0">Proceso Abreviado</h3>
                            <p class="mt-3 text-sm leading-7 text-slate-700">Pretensiones menores a 50 URP con vínculo acreditado, como pago de beneficios y obligaciones laborales de rápida resolución.</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-white p-4">
                            <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider m-0">Proceso Ordinario</h3>
                            <p class="mt-3 text-sm leading-7 text-slate-700">Discusión de vínculo, reposición, desnaturalización de contrato o cuantías entre 50 y 70 URP.</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-white p-4">
                            <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider m-0">Proceso de Ejecución</h3>
                            <p class="mt-3 text-sm leading-7 text-slate-700">Acción frente al incumplimiento de Actas de Conciliación Administrativa que ya son título ejecutivo.</p>
                        </div>
                    </div>
                </article>
            </section>

            <section class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                <div class="grid gap-6 lg:grid-cols-[1.7fr_1fr]">
                    <div class="space-y-6">
                        <h2 class="text-xl font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">Direcciones de Atención</h2>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">
                            <div class="flex items-start gap-4">
                                <div class="mt-1 text-blue-700"><i class="fa-solid fa-location-dot text-xl"></i></div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900 uppercase tracking-[0.2em]">Sede Puno</p>
                                    <p class="mt-2 text-sm text-slate-700">Jr. Ayacucho N.° 658</p>
                                    <p class="mt-4 text-sm font-semibold text-slate-900 uppercase tracking-[0.2em]">Sede Juliaca</p>
                                    <p class="mt-2 text-sm text-slate-700">Jr. Santiago Mamani N.° 200</p>
                                    <p class="mt-4 text-sm text-slate-700">Horario: Lunes a viernes de 8:00 a. m. a 1:00 p. m. y de 2:00 p. m. a 4:00 p. m.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6 shadow-sm">
                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-900">Aspectos Importantes</p>
                        <div class="mt-4 space-y-4 text-sm leading-7 text-slate-700">
                            <p class="text-slate-900 font-semibold">Servicios gratuitos con atención prioritaria para trabajadores del régimen privado.</p>
                            <p>Los servicios son absolutamente gratuitos para quienes cumplen los requisitos de ingresos y cuantía.</p>
                            <p>Límites de ingresos: 2 RMV y cuantía máxima de 70 URP para patrocinio jurídico.</p>
                            <p>Se promueve la conciliación administrativa como opción prioritaria antes de la vía judicial.</p>
                        </div>
                        <blockquote class="mt-6 rounded-2xl border-l-4 border-blue-700 bg-blue-50 p-5 text-sm leading-7 text-slate-900">
                            Recuerde: la conciliación es un mecanismo eficaz que protege derechos laborales y evita el desgaste de un proceso judicial.
                        </blockquote>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection