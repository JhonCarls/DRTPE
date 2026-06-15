@extends('layouts.portal')

@section('content')
<div class="bg-slate-50 min-h-screen py-16 text-slate-800 antialiased">
    
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        {{-- ========================================== --}}
        {{-- ENCABEZADO DE TRANSPARENCIA ACTIVA         --}}
        {{-- ========================================== --}}
        <div class="bg-white rounded-3xl p-8 sm:p-12 border border-slate-200/60 shadow-sm space-y-6">
            <div class="border-b border-red-600 pb-4">
                <span class="text-red-600 font-mono text-xs font-black uppercase tracking-widest block">Portal de Transparencia Estándar</span>
                <h1 class="text-2xl sm:text-4xl font-black text-slate-900 m-0 uppercase tracking-tight mt-1">Directorio Institucional y Transparencia Activa</h1>
            </div>

            <p class="text-slate-600 text-sm sm:text-base leading-relaxed m-0 font-medium text-justify">
                En estricto cumplimiento de la **Ley N° 27806**, Ley de Transparencia y Acceso a la Información Pública, la Dirección Regional de Trabajo y Promoción del Empleo (DRTPE) de Puno pone a disposición de la ciudadanía y los órganos de control el directorio oficial de sus funcionarios de línea. Todos los cargos y estructuras funcionales presentados se encuentran ratificados y vigentes mediante Resolución Ejecutiva Regional.
            </p>
        </div>

        {{-- ========================================== --}}
        {{-- SECCIÓN 1: CUADRO DE MANDOS / CUATRO DIRECCIONES --}}
        {{-- ========================================== --}}
        <div class="space-y-6">
            <div class="flex items-center gap-3 border-b border-slate-200 pb-3">
                <div class="w-2 h-6 bg-red-600 rounded-full"></div>
                <h2 class="text-xl font-black text-slate-900 tracking-tight m-0 uppercase">Plana Directiva y Funcionarios de Línea</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- 1. Dirección General --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm flex flex-col justify-between hover:border-red-200 transition-all group">
                    <div class="space-y-4">
                        <div class="flex items-start justify-between">
                            <div class="space-y-1">
                                <span class="text-[10px] font-black uppercase tracking-wider text-red-600 bg-red-50 border border-red-100 px-2 py-0.5 rounded">Alta Dirección</span>
                                <h3 class="text-lg font-black text-slate-900 m-0 pt-1">Dirección Regional - General</h3>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 group-hover:bg-red-600 group-hover:text-white transition-colors">
                                <i class="fa-solid fa-user-tie text-base"></i>
                            </div>
                        </div>
                        <div class="border-l-2 border-slate-200 pl-3 space-y-1">
                            <p class="text-sm font-black text-slate-800 m-0">Abog. Director Regional de Trabajo</p>
                            <p class="text-[11px] font-bold text-slate-400 m-0">Resolución Ejecutiva Regional N° 014-2026-GR-GR</p>
                        </div>
                        <p class="text-slate-500 text-xs leading-relaxed font-medium m-0 text-justify">
                            Responsable supremo de la conducción político-administrativa del sector trabajo en el altiplano. Planifica y coordina los lineamientos del POI corporativo con el Gobierno Regional de Puno y el MTPE.
                        </p>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100 grid grid-cols-1 gap-2 text-xs font-bold text-slate-600">
                        <div class="flex items-center gap-2"><i class="fa-regular fa-envelope text-slate-400 w-4 text-center"></i> drtpe_puno@regionpuno.gob.pe</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-phone text-slate-400 w-4 text-center"></i> (051) 351242 <span class="text-slate-400 font-normal">· Anexo 101</span></div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-location-dot text-slate-400 w-4 text-center"></i> Sede Central - Jr. Ayacucho N° 658, Puno</div>
                    </div>
                </div>

                {{-- 2. Dirección de Prevención --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm flex flex-col justify-between hover:border-blue-200 transition-all group">
                    <div class="space-y-4">
                        <div class="flex items-start justify-between">
                            <div class="space-y-1">
                                <span class="text-[10px] font-black uppercase tracking-wider text-blue-600 bg-blue-50 border border-blue-100 px-2 py-0.5 rounded">Órgano de Línea</span>
                                <h3 class="text-lg font-black text-slate-900 m-0 pt-1">Prevención y Solución de Conflictos</h3>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                <i class="fa-solid fa-scale-balanced text-base"></i>
                            </div>
                        </div>
                        <div class="border-l-2 border-slate-200 pl-3 space-y-1">
                            <p class="text-sm font-black text-slate-800 m-0">Abog. Director de Solución de Conflictos</p>
                            <p class="text-[11px] font-bold text-slate-400 m-0">Resolución Directoral Regional N° 042-2025-DRTPE</p>
                        </div>
                        <p class="text-slate-500 text-xs leading-relaxed font-medium m-0 text-justify">
                            Encargado del mantenimiento de la paz laboral regional. Administra las audiencias de conciliación, defensas gratuitas al trabajador, liquidaciones de beneficios sociales y registros sindicales.
                        </p>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100 grid grid-cols-1 gap-2 text-xs font-bold text-slate-600">
                        <div class="flex items-center gap-2"><i class="fa-regular fa-envelope text-slate-400 w-4 text-center"></i> prevencion_conflictos@drtpepuno.gob.pe</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-phone text-slate-400 w-4 text-center"></i> (051) 351242 <span class="text-slate-400 font-normal">· Anexo 104</span></div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-location-dot text-slate-400 w-4 text-center"></i> Sede Central - Jr. Ayacucho N° 658, Puno</div>
                    </div>
                </div>

                {{-- 3. Dirección de Formaliza --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm flex flex-col justify-between hover:border-amber-200 transition-all group">
                    <div class="space-y-4">
                        <div class="flex items-start justify-between">
                            <div class="space-y-1">
                                <span class="text-[10px] font-black uppercase tracking-wider text-amber-600 bg-amber-50 border border-amber-100 px-2 py-0.5 rounded">Órgano de Línea</span>
                                <h3 class="text-lg font-black text-slate-900 m-0 pt-1">Formalización Laboral</h3>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 group-hover:bg-amber-500 group-hover:text-white transition-colors">
                                <i class="fa-solid fa-gavel text-base"></i>
                            </div>
                        </div>
                        <div class="border-l-2 border-slate-200 pl-3 space-y-1">
                            <p class="text-sm font-black text-slate-800 m-0">Lic. Director de Formalización Regional</p>
                            <p class="text-[11px] font-bold text-slate-400 m-0">Resolución Directoral Regional N° 048-2025-DRTPE</p>
                        </div>
                        <p class="text-slate-500 text-xs leading-relaxed font-medium m-0 text-justify">
                            Unidad técnica responsable del control de la informalidad laboral en Puno. Gestiona las acreditaciones y auditorías de micro y pequeñas empresas mediante la plataforma del REMYPE nacional.
                        </p>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100 grid grid-cols-1 gap-2 text-xs font-bold text-slate-600">
                        <div class="flex items-center gap-2"><i class="fa-regular fa-envelope text-slate-400 w-4 text-center"></i> formalizacion_laboral@drtpepuno.gob.pe</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-phone text-slate-400 w-4 text-center"></i> (051) 351242 <span class="text-slate-400 font-normal">· Anexo 108</span></div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-location-dot text-slate-400 w-4 text-center"></i> Sede Central - Jr. Ayacucho N° 658, Puno</div>
                    </div>
                </div>

                {{-- 4. Dirección de Empleo --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm flex flex-col justify-between hover:border-emerald-200 transition-all group">
                    <div class="space-y-4">
                        <div class="flex items-start justify-between">
                            <div class="space-y-1">
                                <span class="text-[10px] font-black uppercase tracking-wider text-emerald-600 bg-emerald-50 border border-emerald-100 px-2 py-0.5 rounded">Órgano de Línea</span>
                                <h3 class="text-lg font-black text-slate-900 m-0 pt-1">Promoción del Empleo y Capacitación</h3>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                <i class="fa-solid fa-briefcase text-base"></i>
                            </div>
                        </div>
                        <div class="border-l-2 border-slate-200 pl-3 space-y-1">
                            <p class="text-sm font-black text-slate-800 m-0">Econ. Director de Promoción del Empleo</p>
                            <p class="text-[11px] font-bold text-slate-400 m-0">Resolución Directoral Regional N° 051-2025-DRTPE</p>
                        </div>
                        <p class="text-slate-500 text-xs leading-relaxed font-medium m-0 text-justify">
                            Encargado del Centro de Empleo y la inserción productiva sostenible de la ciudadanía. Emite el Certificado Único Laboral (CUL) y conduce las bolsas de trabajo articuladas del estado.
                        </p>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100 grid grid-cols-1 gap-2 text-xs font-bold text-slate-600">
                        <div class="flex items-center gap-2"><i class="fa-regular fa-envelope text-slate-400 w-4 text-center"></i> empleo_capacitacion@drtpepuno.gob.pe</div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-phone text-slate-400 w-4 text-center"></i> (051) 322410 <span class="text-slate-400 font-normal">· Sede Juliaca</span></div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-location-dot text-slate-400 w-4 text-center"></i> Sede Juliaca - Jr. Santiago Mamani N° 200</div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ========================================== --}}
        {{-- SECCIÓN 2: TRANSPARENCIA ACTIVA / GESTIÓN   --}}
        {{-- ========================================== --}}
        <div class="space-y-4">
            <div class="flex items-center gap-3 border-b border-slate-200 pb-3">
                <div class="w-2 h-6 bg-slate-900 rounded-full"></div>
                <h2 class="text-xl font-black text-slate-900 tracking-tight m-0 uppercase">Instrumentos Normativos de Gestión Vigentes</h2>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="divide-y divide-slate-100">
                    
                    {{-- Documento 1: ROF --}}
                    <div class="p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-slate-50/50 transition-colors">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-xl bg-red-50 border border-red-100 flex items-center justify-center text-red-600 shrink-0 mt-0.5"><i class="fa-solid fa-file-pdf text-sm"></i></div>
                            <div>
                                <h4 class="text-sm font-black text-slate-900 m-0">Reglamento de Organización y Funciones (ROF) Confeccionado</h4>
                                <p class="text-[11px] font-bold text-slate-400 m-0 mt-0.5">Aprobado mediante Ordenanza Regional N° 012-2024-GRP · Peso: 4.2 MB</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 self-end sm:self-center">
                            <span class="text-[9px] bg-emerald-50 border border-emerald-200 px-2 py-0.5 rounded text-emerald-700 font-mono font-black uppercase tracking-wider">Vigente 2026</span>
                            <a href="#" class="bg-slate-900 hover:bg-indigo-600 text-white font-black text-[10px] uppercase tracking-wider py-2 px-4 rounded-lg transition-all shadow-sm flex items-center gap-1.5 decoration-none"><i class="fa-solid fa-cloud-arrow-down"></i> Descargar</a>
                        </div>
                    </div>

                    {{-- Documento 2: TUPA --}}
                    <div class="p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-slate-50/50 transition-colors">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-xl bg-red-50 border border-red-100 flex items-center justify-center text-red-600 shrink-0 mt-0.5"><i class="fa-solid fa-file-pdf text-sm"></i></div>
                            <div>
                                <h4 class="text-sm font-black text-slate-900 m-0">Texto Único de Procedimientos Administrativos (TUPA 2026)</h4>
                                <p class="text-[11px] font-bold text-slate-400 m-0 mt-0.5">Estructura de tasas, trámites, requisitos y plazos regulados · Peso: 8.1 MB</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 self-end sm:self-center">
                            <span class="text-[9px] bg-emerald-50 border border-emerald-200 px-2 py-0.5 rounded text-emerald-700 font-mono font-black uppercase tracking-wider">Vigente 2026</span>
                            <a href="#" class="bg-slate-900 hover:bg-indigo-600 text-white font-black text-[10px] uppercase tracking-wider py-2 px-4 rounded-lg transition-all shadow-sm flex items-center gap-1.5 decoration-none"><i class="fa-solid fa-cloud-arrow-down"></i> Descargar</a>
                        </div>
                    </div>

                    {{-- Documento 3: CAP-P --}}
                    <div class="p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-slate-50/50 transition-colors">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-xl bg-red-50 border border-red-100 flex items-center justify-center text-red-600 shrink-0 mt-0.5"><i class="fa-solid fa-file-pdf text-sm"></i></div>
                            <div>
                                <h4 class="text-sm font-black text-slate-900 m-0">Cuadro para Asignación de Personal Provisional (CAP-P) Compilado</h4>
                                <p class="text-[11px] font-bold text-slate-400 m-0 mt-0.5">Organigrama de plazas y presupuesto de cargos analíticos · Peso: 3.1 MB</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 self-end sm:self-center">
                            <span class="text-[9px] bg-amber-50 border border-amber-200 px-2 py-0.5 rounded text-amber-700 font-mono font-black uppercase tracking-wider">Modificado</span>
                            <a href="#" class="bg-slate-900 hover:bg-indigo-600 text-white font-black text-[10px] uppercase tracking-wider py-2 px-4 rounded-lg transition-all shadow-sm flex items-center gap-1.5 decoration-none"><i class="fa-solid fa-cloud-arrow-down"></i> Descargar</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection