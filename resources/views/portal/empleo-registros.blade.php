@extends('layouts.portal')

@section('content')
<div class="bg-scene min-h-screen relative py-12">
    <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-[2px] z-0"></div>
    <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-slate-900/80 border border-white/10 rounded-3xl p-6 sm:p-10 shadow-2xl space-y-6">
            
            <div class="border-l-4 border-amber-500 pl-4">
                <span class="text-amber-500 font-mono text-xs font-black uppercase tracking-widest block">Estructura Orgánica Interna</span>
                <h1 class="text-2xl sm:text-4xl font-black text-white m-0 uppercase tracking-tight mt-1">Oficina Informativa</h1>
            </div>

            <p class="text-slate-300 text-sm sm:text-base leading-relaxed m-0">
                Esta es la sección informativa provisional correspondiente al área administrativa de la Dirección Regional de Trabajo de Puno. Aquí se detallarán las funciones operativas, reportes de control y planes de acción específicos asignados a esta dependencia.
            </p>

            <div class="bg-white/5 border border-white/10 p-5 rounded-2xl">
                <h3 class="text-base font-black text-white uppercase tracking-wider m-0 mb-2"><i class="fa-solid fa-circle-nodes text-amber-500"></i> Objetivos del Área</h3>
                <p class="text-slate-400 text-xs sm:text-sm leading-relaxed m-0">
                    Garantizar la correcta optimización de los procesos internos de supervisión, alineados estrictamente con las normativas de transparencia y la simplificación de trámites administrativos de cara al servidor público y ciudadano.
                </p>
            </div>
            
        </div>
    </div>
</div>
@endsection