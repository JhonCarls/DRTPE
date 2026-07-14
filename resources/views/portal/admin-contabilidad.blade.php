@extends('layouts.portal')

@section('content')
<div class="bg-scene-light min-h-screen relative py-12">
    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <header data-reveal class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-lg shadow-slate-300/40">
            <div class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-amber-950 p-8 sm:p-10 text-white">
                <div class="pointer-events-none absolute -top-16 -right-12 w-72 h-72 bg-amber-500/20 rounded-full blur-3xl"></div>
                <div class="relative flex items-start gap-5">
                    <div class="icon-tile hidden sm:flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-2xl bg-amber-500/15 border border-amber-400/30 text-amber-300 text-2xl">
                        <i class="fa-solid fa-calculator"></i>
                    </div>
                    <div class="space-y-2">
                        <span class="text-amber-400 font-bold uppercase tracking-[0.3em] text-xs">Oficina de Administración</span>
                        <h1 class="text-2xl sm:text-4xl font-black uppercase tracking-tight leading-tight m-0">Área de Contabilidad</h1>
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed m-0 max-w-3xl">
                            Conduce el sistema de contabilidad gubernamental de la entidad, registrando de forma oportuna y confiable las operaciones económicas y financieras conforme al Sistema Nacional de Contabilidad.
                        </p>
                    </div>
                </div>
            </div>
        </header>

        <section class="space-y-5">
            <h2 data-reveal class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100 text-amber-600"><i class="fa-solid fa-list-check"></i></span>
                Funciones Principales
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @php
                    $funcs = [
                        ['Registro contable','fa-book','bg-amber-100 text-amber-600','Registrar y controlar las operaciones contables, presupuestales y financieras de la Dirección Regional a través del SIAF.'],
                        ['Estados financieros','fa-file-invoice','bg-blue-100 text-blue-600','Elaborar y presentar los estados financieros y presupuestarios dentro de los plazos de la Contaduría Pública.'],
                        ['Conciliaciones','fa-scale-balanced','bg-indigo-100 text-indigo-600','Efectuar las conciliaciones bancarias, de cuentas de enlace y del marco presupuestal con la Dirección Regional.'],
                        ['Control del gasto','fa-money-check-dollar','bg-emerald-100 text-emerald-600','Revisar y controlar la documentación sustentatoria del gasto, verificando su conformidad con la normativa vigente.'],
                        ['Rendiciones','fa-receipt','bg-cyan-100 text-cyan-600','Procesar las rendiciones de encargos, viáticos y caja chica, controlando su correcta sustentación.'],
                        ['Custodia documental','fa-box-archive','bg-slate-100 text-slate-600','Custodiar y archivar la documentación contable sustentatoria para efectos de control y fiscalización.'],
                    ];
                @endphp
                @foreach ($funcs as [$titulo, $icono, $color, $desc])
                <article data-reveal class="card-hover bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:border-amber-300">
                    <div class="icon-tile mb-4 flex h-12 w-12 items-center justify-center rounded-2xl {{ $color }} text-lg"><i class="fa-solid {{ $icono }}"></i></div>
                    <h3 class="text-base font-bold text-slate-900 mb-2 m-0">{{ $titulo }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed m-0">{{ $desc }}</p>
                </article>
                @endforeach
            </div>
        </section>
    </div>
</div>
@endsection
