@extends('layouts.portal')

@section('content')
<div class="bg-scene-light min-h-screen relative py-12">
    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Volver -->
        <div data-reveal class="flex justify-start">
            <a href="{{ route('portal.Sconflictos') }}" class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-700 px-4 py-2 rounded-2xl shadow-sm hover:bg-slate-50 hover:-translate-y-0.5 transition-all duration-300">
                <i class="fa-solid fa-arrow-left text-green-600"></i>
                Volver a Dirección Principal
            </a>
        </div>

        <!-- Encabezado -->
        <header data-reveal class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-lg shadow-slate-300/40">
            <div class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-green-950 p-8 sm:p-10 text-white">
                <div class="pointer-events-none absolute -top-16 -right-12 w-72 h-72 bg-green-500/25 rounded-full blur-3xl"></div>
                <div class="relative flex items-start gap-5">
                    <div class="icon-tile hidden sm:flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-2xl bg-green-500/15 border border-green-400/30 text-green-300 text-2xl">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <div class="space-y-2">
                        <span class="text-green-400 font-bold uppercase tracking-[0.3em] text-xs">Sub Dirección Especializada</span>
                        <h1 class="text-2xl sm:text-4xl font-black uppercase tracking-tight leading-tight m-0">
                            Defensa Legal Gratuita y Asesoría al Trabajador
                        </h1>
                        <p class="text-green-300 text-sm sm:text-base font-semibold m-0">Asesoría jurídica • Defensa laboral • Promoción de derechos</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Funciones y Atribuciones (Art. 27º) -->
        <section class="space-y-5">
            <h2 data-reveal class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-100 text-green-600"><i class="fa-solid fa-gavel"></i></span>
                Funciones y Atribuciones
            </h2>
            <p data-reveal class="text-slate-600 text-sm sm:text-base leading-relaxed bg-white border border-slate-200 rounded-xl p-4 shadow-sm m-0">
                <strong class="text-slate-900">Artículo 27º.</strong> La subdirección de Defensa Legal Gratuita y Asesoría al Trabajador tiene las siguientes funciones y atribuciones:
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @php
                    $funcs = [
                        ['a','Plan Anual','fa-calendar-check','bg-green-100 text-green-600','Participar en la elaboración del Plan Anual de Actividades de la Dirección Regional.'],
                        ['b','Consultas','fa-headset','bg-emerald-100 text-emerald-600','Absolver consultas verbales, telefónicas u otros medios que formulen los trabajadores del régimen de la actividad privada.'],
                        ['c','Liquidaciones','fa-calculator','bg-teal-100 text-teal-600','Efectuar liquidaciones de derechos sociales con base en la documentación idónea proporcionada por el solicitante.'],
                        ['d','Conciliación','fa-handshake','bg-lime-100 text-lime-600','Promover la conciliación ante empleadores y trabajadores, velando por la solución armoniosa de los conflictos.'],
                        ['e','Orientación Legal','fa-scale-balanced','bg-cyan-100 text-cyan-600','Brindar orientación legal sobre la aplicación de las normas laborales y de seguridad social a los usuarios.'],
                        ['f','Inspecciones Especiales','fa-file-circle-exclamation','bg-amber-100 text-amber-600','Evaluar solicitudes de inspecciones especiales y sancionar la inasistencia del empleador a la conciliación.'],
                        ['g','Patrocinio Judicial','fa-gavel','bg-green-100 text-green-600','Brindar patrocinio a los ex trabajadores ante el Poder Judicial en materia de derechos laborales y de seguridad social.'],
                        ['h','Otras Funciones','fa-ellipsis','bg-slate-100 text-slate-600','Cumplir con otras funciones que le asigne el Director de Prevención y Solución de Conflictos.'],
                    ];
                @endphp
                @foreach ($funcs as [$letra, $titulo, $icono, $color, $desc])
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-green-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl {{ $color }}"><i class="fa-solid {{ $icono }}"></i></div>
                        <span class="text-green-600 font-black text-sm">{{ $letra }})</span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">{{ $titulo }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">{{ $desc }}</p>
                </article>
                @endforeach
            </div>
        </section>

        <!-- Servicios Ofertados -->
        <section class="space-y-5">
            <h2 data-reveal class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-100 text-green-600"><i class="fa-solid fa-hand-holding-heart"></i></span>
                Servicios Ofertados
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <article data-reveal class="card-hover flex gap-4 bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-green-300">
                    <div class="icon-tile flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl bg-green-100 text-green-600 text-lg"><i class="fa-solid fa-book-open"></i></div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900 mb-1 m-0">Asesoría y Orientación Jurídica Gratuita</h3>
                        <p class="text-slate-600 text-sm leading-relaxed m-0">Consultas verbales, telefónicas y presenciales sobre normas laborales y de seguridad social, sin costo alguno.</p>
                    </div>
                </article>
                <article data-reveal class="card-hover flex gap-4 bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-green-300">
                    <div class="icon-tile flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl bg-teal-100 text-teal-600 text-lg"><i class="fa-solid fa-building-columns"></i></div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900 mb-1 m-0">Patrocinio y Defensa en Procesos Laborales</h3>
                        <p class="text-slate-600 text-sm leading-relaxed m-0">Representación del ex trabajador ante el Poder Judicial en la reclamación de beneficios sociales y derechos adeudados.</p>
                    </div>
                </article>
                <article data-reveal class="card-hover flex gap-4 bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-green-300">
                    <div class="icon-tile flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600 text-lg"><i class="fa-solid fa-calculator"></i></div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900 mb-1 m-0">Liquidación de Beneficios Sociales</h3>
                        <p class="text-slate-600 text-sm leading-relaxed m-0">Cálculo de CTS, gratificaciones, vacaciones y remuneraciones adeudadas con base en la documentación del solicitante.</p>
                    </div>
                </article>
                <article data-reveal class="card-hover flex gap-4 bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-green-300">
                    <div class="icon-tile flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl bg-lime-100 text-lime-600 text-lg"><i class="fa-solid fa-handshake"></i></div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900 mb-1 m-0">Promoción de la Conciliación Laboral</h3>
                        <p class="text-slate-600 text-sm leading-relaxed m-0">Impulso de acuerdos entre empleadores y trabajadores para una solución armoniosa que evite procesos judiciales prolongados.</p>
                    </div>
                </article>
            </div>
        </section>

        <!-- Derechos Laborales Promovidos -->
        <section data-reveal class="bg-gradient-to-br from-green-50 to-white border border-green-200 rounded-3xl p-6 sm:p-8 shadow-sm space-y-4">
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3 m-0">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-100 text-green-600"><i class="fa-solid fa-user-shield"></i></span>
                Derechos Laborales Promovidos
            </h2>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed m-0">
                La Subdirección promueve el respeto irrestricto de los <strong class="text-slate-900">derechos fundamentales en el trabajo</strong>, en concordancia con la Constitución y los Convenios de la OIT ratificados por el Perú: libertad sindical, negociación colectiva, erradicación del trabajo forzoso e infantil, e igualdad de oportunidades sin discriminación.
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <span class="flex items-center gap-2 rounded-xl bg-white border border-slate-200 px-4 py-3 text-slate-700 text-sm"><i class="fa-solid fa-circle-check text-green-600"></i> Remuneración mínima vital</span>
                <span class="flex items-center gap-2 rounded-xl bg-white border border-slate-200 px-4 py-3 text-slate-700 text-sm"><i class="fa-solid fa-circle-check text-green-600"></i> Jornada máxima y descanso semanal</span>
                <span class="flex items-center gap-2 rounded-xl bg-white border border-slate-200 px-4 py-3 text-slate-700 text-sm"><i class="fa-solid fa-circle-check text-green-600"></i> Gratificaciones y CTS</span>
                <span class="flex items-center gap-2 rounded-xl bg-white border border-slate-200 px-4 py-3 text-slate-700 text-sm"><i class="fa-solid fa-circle-check text-green-600"></i> Vacaciones y descansos remunerados</span>
                <span class="flex items-center gap-2 rounded-xl bg-white border border-slate-200 px-4 py-3 text-slate-700 text-sm"><i class="fa-solid fa-circle-check text-green-600"></i> Seguridad y salud en el trabajo</span>
                <span class="flex items-center gap-2 rounded-xl bg-white border border-slate-200 px-4 py-3 text-slate-700 text-sm"><i class="fa-solid fa-circle-check text-green-600"></i> Protección contra el despido arbitrario</span>
            </div>
        </section>

        <!-- Cómo Acceder -->
        <section class="space-y-5 pb-6">
            <h2 data-reveal class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-100 text-green-600"><i class="fa-solid fa-circle-question"></i></span>
                Cómo Acceder
            </h2>
            <p data-reveal class="text-slate-600 text-sm sm:text-base leading-relaxed bg-white border border-slate-200 rounded-xl p-4 shadow-sm m-0">
                El servicio es <strong class="text-slate-900">totalmente gratuito</strong> y está dirigido a trabajadores y ex trabajadores del régimen laboral de la actividad privada.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-green-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-green-100 text-green-600 text-lg"><i class="fa-solid fa-id-card"></i></div>
                    <h3 class="text-base font-bold text-slate-900 m-0 mb-1">Requisitos</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">DNI y la documentación laboral que disponga: boletas de pago, contratos, cartas o liquidaciones.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-green-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600 text-lg"><i class="fa-regular fa-clock"></i></div>
                    <h3 class="text-base font-bold text-slate-900 m-0 mb-1">Horario de Atención</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Lunes a viernes, de 8:00 a. m. a 4:00 p. m., en la sede de la DRTPE Puno.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-green-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-teal-100 text-teal-600 text-lg"><i class="fa-solid fa-location-dot"></i></div>
                    <h3 class="text-base font-bold text-slate-900 m-0 mb-1">Dónde Acudir</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Mesa de Partes de la Dirección Regional o los canales oficiales de la institución.</p>
                </article>
            </div>
        </section>
    </div>
</div>
@endsection
