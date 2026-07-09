@extends('layouts.portal')

@section('content')
    <div class="section-deep py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-10">
            <span class="inline-block text-[10px] font-black uppercase tracking-[0.2em] bg-amber-500/20 border border-amber-500/30 text-amber-300 px-3 py-1 rounded-md">Cooperación Interinstitucional</span>
            <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight mt-3 m-0" style="font-family: 'Sora', sans-serif;">Coordinaciones Institucionales</h1>
            <p class="text-slate-400 text-sm font-medium mt-2 max-w-2xl">Registro de mesas de trabajo, acuerdos y alianzas de cooperación con entidades públicas y privadas de la región.</p>
        </div>
    </div>

    @include('partials.coordinaciones')
@endsection
