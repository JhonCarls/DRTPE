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
                            <i class="fa-solid fa-file-invoice-dollar text-red-600"></i>
                            Fraccionamiento de Multas Administrativas
                        </div>
                        <div class="space-y-4">
                            <h1 class="text-xl font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">
                                Fraccionamiento y Pago de Multas Laborales
                            </h1>
                            <p class="max-w-3xl text-base leading-8 text-slate-600 m-0">
                                Es la facilidad que otorga la DRTPE Puno para que los empleadores sancionados con una multa administrativa puedan pagar su deuda en cuotas, evitando el inicio o la continuación del procedimiento de cobranza coactiva y regularizando su situación con la autoridad de trabajo.
                            </p>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <article class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                                <h2 class="text-lg font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">
                                    <i class="fa-solid fa-hand-holding-dollar text-red-600"></i>
                                    Pago en Cuotas
                                </h2>
                                <p class="mt-3 text-sm leading-7 text-slate-600 m-0">
                                    Permite dividir el monto de la multa en armadas mensuales accesibles, de acuerdo con la capacidad de pago del administrado.
                                </p>
                            </article>
                            <article class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                                <h2 class="text-lg font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">
                                    <i class="fa-solid fa-shield-halved text-blue-700"></i>
                                    Evita la Coactiva
                                </h2>
                                <p class="mt-3 text-sm leading-7 text-slate-600 m-0">
                                    Acogerse al beneficio suspende las acciones de cobranza coactiva mientras se cumplan puntualmente las cuotas pactadas.
                                </p>
                            </article>
                        </div>
                    </div>
                    <div class="rounded-[1.75rem] border border-slate-200 bg-slate-900/5 p-8 shadow-sm">
                        <div class="rounded-3xl bg-slate-900 px-5 py-6 text-slate-50 shadow-sm">
                            <p class="text-xs uppercase tracking-[0.35em] text-slate-300">Beneficio al administrado</p>
                            <h2 class="mt-4 text-2xl font-black text-white m-0">Regulariza tu deuda de forma ordenada</h2>
                        </div>
                        <div class="mt-8 space-y-5">
                            <div class="rounded-3xl bg-white p-5 shadow-sm border border-slate-200">
                                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-900">Formalidad</p>
                                <p class="mt-3 text-sm leading-7 text-slate-600 m-0">Se formaliza mediante una solicitud y la aprobación de un cronograma de pagos por la autoridad competente.</p>
                            </div>
                            <div class="rounded-3xl bg-white p-5 shadow-sm border border-slate-200">
                                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-900">Vigencia</p>
                                <p class="mt-3 text-sm leading-7 text-slate-600 m-0">El beneficio se mantiene vigente mientras las cuotas se cancelen dentro de los plazos establecidos.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Requisitos -->
            <section class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                <h2 class="text-xl font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">
                    <i class="fa-solid fa-clipboard-check text-red-600"></i>
                    Requisitos para Solicitar el Fraccionamiento
                </h2>
                <div class="mt-6 grid gap-4 md:grid-cols-2">
                    <div class="flex gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <i class="fa-solid fa-file-lines text-blue-700 mt-1"></i>
                        <p class="text-sm leading-7 text-slate-700 m-0">Solicitud dirigida a la autoridad de trabajo, indicando el número de la resolución de multa.</p>
                    </div>
                    <div class="flex gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <i class="fa-solid fa-id-card text-blue-700 mt-1"></i>
                        <p class="text-sm leading-7 text-slate-700 m-0">DNI del administrado o del representante legal, y vigencia de poder para personas jurídicas.</p>
                    </div>
                    <div class="flex gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <i class="fa-solid fa-coins text-blue-700 mt-1"></i>
                        <p class="text-sm leading-7 text-slate-700 m-0">Pago de la cuota inicial establecida sobre el monto total de la deuda.</p>
                    </div>
                    <div class="flex gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <i class="fa-solid fa-handshake-angle text-blue-700 mt-1"></i>
                        <p class="text-sm leading-7 text-slate-700 m-0">Reconocimiento de la deuda y compromiso de pago del saldo en las cuotas aprobadas.</p>
                    </div>
                </div>
            </section>

            <!-- Procedimiento paso a paso -->
            <section>
                <div class="mb-6">
                    <h2 class="text-2xl font-black text-white uppercase tracking-wider flex items-center gap-3">
                        <i class="fa-solid fa-diagram-project text-red-500"></i>
                        Procedimiento
                    </h2>
                </div>
                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                    <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-red-600 text-sm font-black text-white">1</span>
                        <h3 class="mt-4 text-base font-black text-slate-900 m-0">Presentar la solicitud</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600 m-0">Ingresa tu pedido de fraccionamiento por Mesa de Partes, adjuntando los requisitos.</p>
                    </article>
                    <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-red-600 text-sm font-black text-white">2</span>
                        <h3 class="mt-4 text-base font-black text-slate-900 m-0">Evaluación</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600 m-0">La autoridad revisa la deuda, verifica los requisitos y define el cronograma de cuotas.</p>
                    </article>
                    <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-red-600 text-sm font-black text-white">3</span>
                        <h3 class="mt-4 text-base font-black text-slate-900 m-0">Aprobación</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600 m-0">Se emite la resolución que aprueba el fraccionamiento y el plan de pagos acordado.</p>
                    </article>
                    <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-red-600 text-sm font-black text-white">4</span>
                        <h3 class="mt-4 text-base font-black text-slate-900 m-0">Cumplimiento</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600 m-0">Cancela puntualmente cada cuota para mantener el beneficio y evitar la cobranza coactiva.</p>
                    </article>
                </div>
            </section>

            <!-- Cobranza coactiva + contacto -->
            <section class="grid gap-6 lg:grid-cols-2">
                <article class="rounded-[2rem] border border-slate-200 bg-slate-50 p-8 shadow-sm">
                    <h2 class="text-xl font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">
                        <i class="fa-solid fa-gavel text-red-600"></i>
                        Cobranza Coactiva
                    </h2>
                    <p class="mt-4 text-sm leading-7 text-slate-600 m-0">
                        Cuando una multa firme no es pagada ni fraccionada, la institución inicia el procedimiento de ejecución coactiva para el cobro forzoso de la deuda.
                    </p>
                    <ul class="mt-5 list-disc space-y-3 pl-5 text-sm leading-7 text-slate-700">
                        <li>Notificación de la resolución de ejecución coactiva.</li>
                        <li>Posibilidad de medidas cautelares sobre bienes o cuentas.</li>
                        <li>El fraccionamiento oportuno suspende estas acciones.</li>
                    </ul>
                    <div class="mt-6 rounded-2xl border-l-4 border-red-600 bg-red-50 p-5 text-sm leading-7 text-slate-900">
                        <p class="font-semibold m-0">Recomendación: acógete al fraccionamiento antes de que la deuda ingrese a cobranza coactiva para evitar mayores costos y medidas de ejecución.</p>
                    </div>
                </article>
                <article class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
                    <h2 class="text-xl font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">
                        <i class="fa-solid fa-circle-info text-blue-700"></i>
                        Información y Atención
                    </h2>
                    <div class="mt-6 space-y-4 text-sm leading-7 text-slate-700">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-900 m-0">Dónde acudir</p>
                            <p class="mt-2 m-0">Mesa de Partes de la Dirección Regional de Trabajo y Promoción del Empleo de Puno.</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-900 m-0">Horario</p>
                            <p class="mt-2 m-0">Lunes a viernes de 8:00 a. m. a 4:00 p. m.</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-900 m-0">Base legal</p>
                            <p class="mt-2 m-0">Ley General de Inspección del Trabajo y normas del procedimiento de ejecución coactiva (Ley N.° 26979 y modificatorias).</p>
                        </div>
                    </div>
                </article>
            </section>
        </div>
    </div>
</div>
@endsection
