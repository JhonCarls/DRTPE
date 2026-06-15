@extends('layouts.portal')

@section('content')
<div class="bg-slate-50 min-h-screen py-16 text-slate-800 antialiased">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        {{-- ENCABEZADO DE LA SECCIÓN --}}
        <div class="bg-white rounded-3xl p-8 sm:p-12 border border-slate-200/60 shadow-sm space-y-6">
            <div class="border-b border-red-600 pb-4">
                <span class="text-red-600 font-mono text-xs font-black uppercase tracking-widest block">Arquitectura Estructural</span>
                <h1 class="text-2xl sm:text-4xl font-black text-slate-900 m-0 uppercase tracking-tight mt-1">Estructura Orgánica Funcional</h1>
            </div>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed m-0 font-medium text-justify">
                Examine de manera desglosada la distribución lineal y funcional de los órganos que componen la Dirección Regional de Trabajo y Promoción del Empleo de Puno, aprobada de acuerdo a las directrices de nuestro Reglamento de Organización y Funciones (ROF) vigente.
            </p>
        </div>

        {{-- VISUALIZACIÓN EN FLUJO JERÁRQUICO RESPONSIVO --}}
        <div class="space-y-8">
            <div class="flex items-center gap-3 border-b border-slate-200 pb-3">
                <div class="w-2 h-6 bg-slate-900 rounded-full"></div>
                <h2 class="text-xl font-black text-slate-900 tracking-tight m-0 uppercase">Niveles de Dependencia Administrativa</h2>
            </div>

            {{-- NIVEL 1: ALTA DIRECCIÓN --}}
            <div class="flex flex-col items-center text-center">
                <div class="bg-slate-900 text-white rounded-2xl p-6 shadow-md border border-slate-800 max-w-md w-full space-y-2">
                    <span class="text-[9px] font-black uppercase tracking-widest bg-white/10 px-2 py-0.5 rounded text-red-400">Primer Nivel</span>
                    <h3 class="text-base font-black m-0 tracking-wide uppercase">Dirección Regional (Dirección General)</h3>
                    <p class="text-slate-400 text-xs m-0 font-medium">Órgano de Alta Dirección y Representación Legal del Sector</p>
                </div>
                <div class="w-0.5 h-8 bg-slate-300"></div>
            </div>

            {{-- NIVEL 2: ASESORÍA Y CONTROL (PARALELOS) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 max-w-4xl mx-auto items-start relative">
                {{-- Órgano de Control --}}
                <div class="bg-white border-2 border-dashed border-red-200 rounded-xl p-4 text-center space-y-1">
                    <span class="text-[9px] font-bold text-red-600 uppercase tracking-wider">Órgano de Control</span>
                    <h4 class="text-xs font-black text-slate-900 m-0">Órgano de Control Institucional (OCI)</h4>
                    <p class="text-[10px] text-slate-400 m-0 font-medium">Auditoría y control gubernamental de la gestión</p>
                </div>
                {{-- Asesoría Técnica A --}}
                <div class="bg-white border border-slate-200 rounded-xl p-4 text-center space-y-1">
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Asesoramiento</span>
                    <h4 class="text-xs font-black text-slate-900 m-0">Oficina de Asesoría Jurídica</h4>
                    <p class="text-[10px] text-slate-400 m-0 font-medium">Dictámenes legales e interpretación reglamentaria</p>
                </div>
                {{-- Asesoría Técnica B --}}
                <div class="bg-white border border-slate-200 rounded-xl p-4 text-center space-y-1">
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Asesoramiento</span>
                    <h4 class="text-xs font-black text-slate-900 m-0">Oficina de Planificación y Presupuesto</h4>
                    <p class="text-[10px] text-slate-400 m-0 font-medium">Formulación de Metas Presupuestales y POI</p>
                </div>
            </div>

            <div class="flex flex-col items-center text-center">
                <div class="w-0.5 h-8 bg-slate-300"></div>
                {{-- ÓRGANO DE APOYO --}}
                <div class="bg-white border border-slate-300 rounded-xl p-5 text-center space-y-1 max-w-xs w-full shadow-sm">
                    <span class="text-[9px] font-black text-indigo-600 uppercase tracking-wider bg-indigo-50 px-2 py-0.5 rounded">Órgano de Apoyo</span>
                    <h4 class="text-xs font-black text-slate-900 m-0 pt-1">Oficina de Administración</h4>
                    <p class="text-[10px] text-slate-400 m-0 font-medium">Gestión de Recursos Humanos, Contabilidad y Abastecimiento</p>
                </div>
                <div class="w-0.5 h-8 bg-slate-300"></div>
            </div>

            {{-- NIVEL 3: ÓRGANOS DE LÍNEA (LOS TRES EJES TÉCNICOS) --}}
            <div class="space-y-3">
                <p class="text-center text-[10px] font-black text-slate-400 uppercase tracking-widest m-0">Órganos de Ejecución de Línea Técnica</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 max-w-5xl mx-auto">
                    
                    {{-- Eje Conflictos --}}
                    <div class="bg-white border-t-4 border-t-blue-500 rounded-xl p-5 border-x border-b border-slate-200 shadow-sm space-y-2">
                        <h4 class="text-sm font-black text-slate-900 m-0">Dirección de Prevención y Solución de Conflictos</h4>
                        <p class="text-[11px] text-slate-500 font-medium leading-relaxed m-0 text-justify">
                            Encargada de conducir los procesos de conciliación, arbitraje, patrocinio de defensa legal gratuita y control de los registros sindicales de la región.
                        </p>
                    </div>

                    {{-- Eje Formaliza --}}
                    <div class="bg-white border-t-4 border-t-amber-500 rounded-xl p-5 border-x border-b border-slate-200 shadow-sm space-y-2">
                        <h4 class="text-sm font-black text-slate-900 m-0">Dirección de Formalización Laboral</h4>
                        <p class="text-[11px] text-slate-500 font-medium leading-relaxed m-0 text-justify">
                            Unidad técnica responsable del fomento del empleo formal, difusión preventiva de derechos y la calificación e inscripción de MYPEs en el REMYPE.
                        </p>
                    </div>

                    {{-- Eje Empleo --}}
                    <div class="bg-white border-t-4 border-t-emerald-500 rounded-xl p-5 border-x border-b border-slate-200 shadow-sm space-y-2">
                        <h4 class="text-sm font-black text-slate-900 m-0">Dirección de Promoción del Empleo y Capacitación</h4>
                        <p class="text-[11px] text-slate-500 font-medium leading-relaxed m-0 text-justify">
                            Responsable de operar las bolsas de empleo estatales, emitir el Certificado Único Laboral (CUL) y desplegar talleres técnico-operativos de empleabilidad.
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection