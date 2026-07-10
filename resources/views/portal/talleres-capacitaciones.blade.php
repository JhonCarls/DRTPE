@extends('layouts.portal')

@section('content')
    <div class="section-deep py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-10">
            <span class="inline-block text-[10px] font-black uppercase tracking-[0.2em] bg-indigo-600/20 border border-indigo-500/30 text-indigo-300 px-3 py-1 rounded-md">Formación y Empleo</span>
            <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight mt-3 m-0" style="font-family: 'Sora', sans-serif;">Talleres y Capacitaciones</h1>
            <p class="text-slate-400 text-sm font-medium mt-2 max-w-2xl">Convocatorias abiertas y galería de eventos ejecutados por la Dirección Regional de Trabajo y Promoción del Empleo de Puno.</p>
        </div>
    </div>

    @include('partials.talleres')
@endsection
