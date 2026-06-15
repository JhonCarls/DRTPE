@extends('layouts.portal')

@section('content')
<div class="bg-slate-50 min-h-screen py-16 text-slate-800 antialiased">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        {{-- ENCABEZADO DE LA SECCIÓN --}}
        <div class="bg-white rounded-3xl p-8 sm:p-12 border border-slate-200/60 shadow-sm space-y-6">
            <div class="border-b border-red-600 pb-4">
                <span class="text-red-600 font-mono text-xs font-black uppercase tracking-widest block">Base Normativa Sectorial</span>
                <h1 class="text-2xl sm:text-4xl font-black text-slate-900 m-0 uppercase tracking-tight mt-1">Marco Legal Regulatorio</h1>
            </div>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed m-0 font-medium text-justify">
                Conozca el compendio de leyes, decretos supremos, convenios internacionales y ordenanzas regionales que delimitan, facultan y regulan las competencias administrativas de la Dirección Regional de Trabajo y Promoción del Empleo de Puno. Este marco normativo garantiza la legalidad, seguridad jurídica y transparencia de cada una de nuestras intervenciones operativas.
            </p>
        </div>

        {{-- MATRIZ DE CUERPOS NORMATIVOS --}}
        <div class="space-y-8">
            
            {{-- CATEGORÍA A: NORMAS CONSTITUCIONALES E INTERNACIONALES --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-200 pb-2">
                    <i class="fa-solid fa-scale-balanced text-red-600 text-sm"></i>
                    <h3 class="text-xs font-black uppercase text-slate-500 tracking-wider m-0">1. Normativa Constitucional y Tratados Internacionales</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm space-y-2">
                        <div class="flex justify-between items-start">
                            <h4 class="text-sm font-black text-slate-900 m-0">Constitución Política del Perú de 1993</h4>
                            <span class="text-[9px] bg-red-50 border border-red-100 px-1.5 py-0.5 rounded text-red-700 font-mono font-bold">SUPREMA</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium leading-relaxed text-justify">
                            Capítulo II (Del Trabajo). Garantiza el derecho irrestricto al trabajo, la libertad de trabajo, la igualdad de oportunidades sin discriminación, y la protección legal frente al despido arbitrario.
                        </p>
                    </div>
                    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm space-y-2">
                        <div class="flex justify-between items-start">
                            <h4 class="text-sm font-black text-slate-900 m-0">Convenios Fundamentales de la OIT</h4>
                            <span class="text-[9px] bg-indigo-50 border border-indigo-100 px-1.5 py-0.5 rounded text-indigo-700 font-mono font-bold">INTERNACIONAL</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium leading-relaxed text-justify">
                            Tratados ratificados por el Estado Peruano relativos a la libertad sindical, negociación colectiva, erradicación del trabajo forzoso y eliminación del trabajo infantil (Convenios 87, 98, 29, 138 y 182).
                        </p>
                    </div>
                </div>
            </div>

            {{-- CATEGORÍA B: LEYES NACIONALES OPERATIVAS --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-200 pb-2">
                    <i class="fa-solid fa-gavel text-slate-700 text-sm"></i>
                    <h3 class="text-xs font-black uppercase text-slate-500 tracking-wider m-0">2. Leyes Orgánicas y Decretos Legislativos de Línea</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Ley Orgánica de Gob. Regionales --}}
                    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm space-y-2">
                        <div class="flex justify-between items-start">
                            <h4 class="text-sm font-black text-slate-900 m-0">Ley N° 27867 - Ley Orgánica de Gobiernos Regionales</h4>
                            <span class="text-[9px] bg-slate-100 border border-slate-200 px-1.5 py-0.5 rounded text-slate-700 font-mono font-bold">LEY NATIVA</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium leading-relaxed text-justify">
                            Artículo 48. Define las competencias específicas en materia de trabajo, promoción del empleo y fomento de la pequeña y microempresa dentro de la jurisdicción regional.
                        </p>
                    </div>
                    {{-- Ley de Inspección del Trabajo --}}
                    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm space-y-2">
                        <div class="flex justify-between items-start">
                            <h4 class="text-sm font-black text-slate-900 m-0">Ley N° 28806 - Ley General de Inspección del Trabajo</h4>
                            <span class="text-[9px] bg-slate-100 border border-slate-200 px-1.5 py-0.5 rounded text-slate-700 font-mono font-bold">INSPECCIÓN</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium leading-relaxed text-justify">
                            Establece las normas de ordenación, facultades y competencias del cuerpo inspectivo para vigilar el cumplimiento de las normas sociolaborales, de seguridad y de salud ocupacional.
                        </p>
                    </div>
                    {{-- Ley REMYPE --}}
                    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm space-y-2">
                        <div class="flex justify-between items-start">
                            <h4 class="text-sm font-black text-slate-900 m-0">D.S. N° 013-2013-PRODUCE - Ley MYPE y REMYPE</h4>
                            <span class="text-[9px] bg-amber-50 border border-amber-100 px-1.5 py-0.5 rounded text-amber-700 font-mono font-bold">FORMALIZACIÓN</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium leading-relaxed text-justify">
                            Texto Único Ordenado que regula la competitividad, formalización y desarrollo de la Micro y Pequeña Empresa, rigiendo las acreditaciones procesadas en el área de Formaliza.
                        </p>
                    </div>
                    {{-- Ley de Productividad Laboral --}}
                    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm space-y-2">
                        <div class="flex justify-between items-start">
                            <h4 class="text-sm font-black text-slate-900 m-0">D.S. N° 003-97-TR - Ley de Productividad y Competitividad</h4>
                            <span class="text-[9px] bg-blue-50 border border-blue-100 px-1.5 py-0.5 rounded text-blue-700 font-mono font-bold">PREVENCIÓN</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium leading-relaxed text-justify">
                            Marco legal del régimen laboral de la actividad privada (D.Leg 728). Eje normativo esencial para las liquidaciones y audiencias de conciliación en Solución de Conflictos.
                        </p>
                    </div>
                </div>
            </div>

            {{-- CATEGORÍA C: TRANSPARENCIA Y ADMINISTRACIÓN GENERAL --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-200 pb-2">
                    <i class="fa-solid fa-folder-tree text-slate-700 text-sm"></i>
                    <h3 class="text-xs font-black uppercase text-slate-500 tracking-wider m-0">3. Leyes del Procedimiento Administrativo y Transparencia</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm space-y-2">
                        <div class="flex justify-between items-start">
                            <h4 class="text-sm font-black text-slate-900 m-0">Ley N° 27444 - Ley del Procedimiento Administrativo General</h4>
                            <span class="text-[9px] bg-emerald-50 border border-emerald-200 px-1.5 py-0.5 rounded text-emerald-700 font-mono font-black">LPAG</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium leading-relaxed text-justify">
                            Regula las actuaciones, plazos, silencios administrativos y derechos de los administrados en todos los expedientes procesados ante las mesas de partes de la dirección regional.
                        </p>
                    </div>
                    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm space-y-2">
                        <div class="flex justify-between items-start">
                            <h4 class="text-sm font-black text-slate-900 m-0">Ley N° 27806 - Transparencia y Acceso a la Información</h4>
                            <span class="text-[9px] bg-emerald-50 border border-emerald-200 px-1.5 py-0.5 rounded text-emerald-700 font-mono font-black">ACCESO</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium leading-relaxed text-justify">
                            Asegura el derecho fundamental de los ciudadanos a solicitar y recibir información verídica de la DRTPE, obligando a mantener la actualización de este portal oficial.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection