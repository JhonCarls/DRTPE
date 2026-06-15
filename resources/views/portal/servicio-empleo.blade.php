@extends('layouts.portal')

@section('content')
<div class="bg-scene min-h-screen relative py-12">
    <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-[2px] z-0"></div>
    <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-slate-900/80 border border-white/10 rounded-3xl p-6 sm:p-10 shadow-2xl space-y-6">
            
            <div class="border-l-4 border-red-600 pl-4">
                <span class="text-red-500 font-mono text-xs font-black uppercase tracking-widest block">Servicios de Atención Regional</span>
                <h1 class="text-2xl sm:text-4xl font-black text-white m-0 uppercase tracking-tight mt-1">Plataforma de Atención</h1>
            </div>

            <p class="text-slate-300 text-sm sm:text-base leading-relaxed m-0">
                Bienvenido al canal digital provisional de trámites y orientación legal de la DRTPE Puno. Próximamente se habilitarán los formularios de radicación web, la descarga de requisitos de admisibilidad y el agendamiento de citas en línea.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-slate-950/50 p-4 rounded-xl border border-white/5 flex items-start gap-3">
                    <div class="text-red-500 mt-1"><i class="fa-solid fa-file-circle-check text-base"></i></div>
                    <div><h4 class="text-white font-bold text-xs uppercase m-0">Requisitos</h4><p class="text-slate-400 text-xs mt-1 m-0">Documentación base requerida según TUPA regional.</p></div>
                </div>
                <div class="bg-slate-950/50 p-4 rounded-xl border border-white/5 flex items-start gap-3">
                    <div class="text-blue-400 mt-1"><i class="fa-solid fa-headset text-base"></i></div>
                    <div><h4 class="text-white font-bold text-xs uppercase m-0">Canal Directo</h4><p class="text-slate-400 text-xs mt-1 m-0">Atención personalizada y consultas telefónicas asistidas.</p></div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection