@extends('layouts.portal')

@section('content')
<div class="bg-scene-light min-h-screen relative py-12">
    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Volver -->
        <div data-reveal class="flex justify-start">
            <a href="{{ route('portal.Sconflictos') }}" class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-700 px-4 py-2 rounded-2xl shadow-sm hover:bg-slate-50 hover:-translate-y-0.5 transition-all duration-300">
                <i class="fa-solid fa-arrow-left text-red-600"></i>
                Volver a Dirección Principal
            </a>
        </div>

        <!-- Encabezado -->
        <header data-reveal class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-lg shadow-slate-300/40">
            <div class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-red-950 p-8 sm:p-10 text-white">
                <div class="pointer-events-none absolute -top-16 -right-12 w-72 h-72 bg-red-500/25 rounded-full blur-3xl"></div>
                <div class="relative flex items-start gap-5">
                    <div class="icon-tile hidden sm:flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-2xl bg-red-500/15 border border-red-400/30 text-red-300 text-2xl">
                        <i class="fa-solid fa-handshake"></i>
                    </div>
                    <div class="space-y-2">
                        <span class="text-red-400 font-bold uppercase tracking-[0.3em] text-xs">Sub Dirección Especializada</span>
                        <h1 class="text-2xl sm:text-4xl font-black uppercase tracking-tight leading-tight m-0">
                            Negociaciones Colectivas y Registros Generales
                        </h1>
                        <p class="text-red-300 text-sm sm:text-base font-semibold m-0">Negociación colectiva • Registro sindical • Registros laborales</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Definición -->
        <section data-reveal class="bg-gradient-to-br from-red-50 to-white border border-red-200 rounded-2xl p-6 sm:p-8 shadow-sm">
            <div class="flex items-start gap-4">
                <div class="icon-tile hidden sm:flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl bg-red-100 text-red-600 text-lg"><i class="fa-solid fa-handshake"></i></div>
                <p class="text-slate-700 text-sm sm:text-base leading-relaxed m-0">
                    Según el <strong class="text-slate-900">Artículo 25º</strong>, es la unidad encargada de <strong class="text-slate-900">tramitar y resolver en primera instancia los procedimientos de negociación colectiva</strong> y de <strong class="text-slate-900">llevar los registros oficiales</strong> de organizaciones sindicales, convenios colectivos, contratos de trabajo y planillas, promoviendo el diálogo social y la formalización de las relaciones laborales colectivas.
                </p>
            </div>
        </section>

        <!-- Funciones -->
        <section class="space-y-5">
            <h2 data-reveal class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-100 text-red-600"><i class="fa-solid fa-gears"></i></span>
                Funciones y Atribuciones
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @php
                    $funcs = [
                        ['a','Plan Anual','fa-calendar-check','bg-red-100 text-red-600','Participar en la elaboración del Plan Anual de Actividades de la Dirección Regional.'],
                        ['b','Gestión TUPA','fa-file-lines','bg-orange-100 text-orange-600','Ejecutar y evaluar los procedimientos administrativos de su competencia contenidos en el TUPA sectorial.'],
                        ['c','Negociación Colectiva','fa-handshake','bg-rose-100 text-rose-600','Conducir, tramitar y resolver en primera instancia los pliegos de reclamos y las negociaciones colectivas.'],
                        ['d','Registro Sindical','fa-people-group','bg-purple-100 text-purple-600','Registrar las organizaciones sindicales, juntas directivas, estatutos, modificaciones y disolución.'],
                        ['e','Convenios y Laudos','fa-file-signature','bg-pink-100 text-pink-600','Registrar los convenios colectivos, laudos arbitrales, actas de conciliación y de trato directo.'],
                        ['f','Registro de Contratos','fa-file-contract','bg-amber-100 text-amber-600','Registrar contratos modales, de trabajadores extranjeros, a domicilio y convenios de modalidades formativas.'],
                        ['g','Planillas de Pago','fa-book','bg-teal-100 text-teal-600','Autorizar y registrar los libros de planillas de pago de remuneraciones y las hojas sueltas.'],
                        ['h','Ceses Colectivos','fa-user-slash','bg-red-100 text-red-600','Registrar la terminación colectiva de contratos y la suspensión temporal perfecta de labores.'],
                        ['i','Actos Administrativos','fa-stamp','bg-fuchsia-100 text-fuchsia-600','Emitir autos y resoluciones subdirectorales, y conocer y tramitar los procedimientos de su competencia.'],
                        ['j','Otras Funciones','fa-ellipsis','bg-slate-100 text-slate-600','Cumplir con las demás funciones que le asigne el Director de Prevención y Solución de Conflictos.'],
                    ];
                @endphp
                @foreach ($funcs as [$letra, $titulo, $icono, $color, $desc])
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-red-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="icon-tile flex h-11 w-11 items-center justify-center rounded-2xl {{ $color }}"><i class="fa-solid {{ $icono }}"></i></div>
                        <span class="text-red-600 font-black text-sm">{{ $letra }})</span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">{{ $titulo }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">{{ $desc }}</p>
                </article>
                @endforeach
            </div>
        </section>

        <!-- Registros a su cargo -->
        <section class="space-y-5">
            <h2 data-reveal class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-100 text-red-600"><i class="fa-solid fa-folder-tree"></i></span>
                Registros a su Cargo
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-red-300 text-center">
                    <div class="icon-tile mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-red-100 text-red-600 text-2xl"><i class="fa-solid fa-people-group"></i></div>
                    <h3 class="text-sm font-bold text-slate-900 m-0 mb-1">Organizaciones Sindicales</h3>
                    <p class="text-slate-500 text-xs leading-relaxed m-0">Juntas directivas, estatutos y reglamentos.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-red-300 text-center">
                    <div class="icon-tile mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-rose-100 text-rose-600 text-2xl"><i class="fa-solid fa-file-signature"></i></div>
                    <h3 class="text-sm font-bold text-slate-900 m-0 mb-1">Convenios Colectivos</h3>
                    <p class="text-slate-500 text-xs leading-relaxed m-0">Laudos arbitrales y actas de conciliación.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-red-300 text-center">
                    <div class="icon-tile mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-100 text-amber-600 text-2xl"><i class="fa-solid fa-file-contract"></i></div>
                    <h3 class="text-sm font-bold text-slate-900 m-0 mb-1">Contratos y Modalidades</h3>
                    <p class="text-slate-500 text-xs leading-relaxed m-0">Contratos modales, extranjeros y formativos.</p>
                </article>
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-red-300 text-center">
                    <div class="icon-tile mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-teal-100 text-teal-600 text-2xl"><i class="fa-solid fa-book"></i></div>
                    <h3 class="text-sm font-bold text-slate-900 m-0 mb-1">Planillas de Pago</h3>
                    <p class="text-slate-500 text-xs leading-relaxed m-0">Autorización de libros y hojas sueltas.</p>
                </article>
            </div>
        </section>

        <!-- Nota de cierre -->
        <section data-reveal class="bg-white border border-slate-200 rounded-3xl p-6 sm:p-8 shadow-sm">
            <div class="flex items-start gap-4">
                <div class="icon-tile flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl bg-red-100 text-red-600 text-lg"><i class="fa-solid fa-circle-info"></i></div>
                <div>
                    <h3 class="text-lg font-black text-slate-900 m-0 mb-2">Marco de Actuación</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">Esta subdirección fortalece el diálogo social y la seguridad jurídica de las relaciones colectivas de trabajo. La promoción del empleo, la intermediación laboral (bolsa de trabajo) y la formación profesional <strong class="text-slate-900">no forman parte de sus competencias</strong>: corresponden a la Dirección de Promoción del Empleo, Formación Profesional y de la Micro y Pequeña Empresa.</p>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
