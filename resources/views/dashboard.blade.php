<x-app-layout>
    {{-- MODIFICADO: Centralización absoluta del estado de filtrado y arrays analíticos para actualización de gráficos en vivo --}}
    <div class="py-8" x-data="{ 
         currentFilter: 'all',
         deptFilter: 'all',
         
         // Inyección segura del set de datos estructurado para recálculos en caliente
         eventsDataset: [
             @foreach($eventos as $ev)
             {
                 code: '{{ $ev->event_code }}',
                 funding: '{{ $ev->funding_source }}',
                 department: '{{ strtolower(trim($ev->category->department ?? 'prevencion')) }}',
                 category: '{{ addslashes($ev->category->name ?? 'General') }}',
                 meta: {{ $ev->goal_people ?? 0 }},
                 avance: {{ $ev->total_attendees ?? 0 }}
             },
             @endforeach
         ],

         // Propiedades de estado dinámicas para las tarjetas de resumen
         metaGlobal: 0,
         avanceCapped: 0,
         eficaciaGlobal: 0,
         excedenteGlobal: 0,

         init() {
             this.calculateMetrics();
         },

         calculateMetrics() {
             let metaSum = 0;
             let cappedSum = 0;
             let excessSum = 0;

             let filteredLabels = [];
             let filteredMeta = [];
             let filteredCapped = [];
             let filteredExcess = [];
             let filteredCatMap = {};

             this.eventsDataset.forEach(ev => {
                 const matchFunding = this.currentFilter === 'all' || ev.funding === this.currentFilter;
                 const matchDept = this.deptFilter === 'all' || ev.department === this.deptFilter;

                 if (matchFunding && matchDept) {
                     metaSum += ev.meta;
                     cappedSum += Math.min(ev.avance, ev.meta);
                     if (ev.avance > ev.meta) {
                         excessSum += (ev.avance - ev.meta);
                     }

                     // Recopilación de arreglos para actualización de gráficos
                     filteredLabels.push(ev.code);
                     filteredMeta.push(ev.meta);
                     filteredCapped.push(Math.min(ev.avance, ev.meta));
                     filteredExcess.push(Math.max(0, ev.avance - ev.meta));

                     // Agrupación por ejes estratégicos
                     filteredCatMap[ev.category] = (filteredCatMap[ev.category] || 0) + ev.avance;
                 }
             });

             this.metaGlobal = metaSum;
             this.avanceCapped = cappedSum;
             this.excedenteGlobal = excessSum;
             this.eficaciaGlobal = metaSum > 0 ? parseFloat(((cappedSum / metaSum) * 100).toFixed(1)) : 0;

             // Sincronización forzada en vivo de instancias de Chart.js si se encuentran listas
             if (window.myProgressChart) {
                 window.myProgressChart.data.labels = filteredLabels;
                 window.myProgressChart.data.datasets[0].data = filteredCapped;
                 window.myProgressChart.data.datasets[1].data = filteredExcess;
                 window.myProgressChart.data.datasets[2].data = filteredMeta;
                 window.myProgressChart.update();
             }

             if (window.myCategoryChart) {
                 window.myCategoryChart.data.labels = Object.keys(filteredCatMap);
                 window.myCategoryChart.data.datasets[0].data = Object.values(filteredCatMap);
                 window.myCategoryChart.update();
             }

             if (window.myGaugeChart) {
                 window.myGaugeChart.data.datasets[0].data = [this.eficaciaGlobal, Math.max(0, 100 - this.eficaciaGlobal)];
                 window.myGaugeChart.data.datasets[0].backgroundColor = [this.eficaciaGlobal >= 100 ? '#10b981' : '#f59e0b', '#e2e8f0'];
                 window.myGaugeChart.update();
             }
         },
         formatNumber(val) {
             return new Intl.NumberFormat('en-US').format(val);
         }
    }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-slot name="header">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 bg-gradient-to-br from-slate-800 to-slate-950 rounded-xl text-white shadow-md">
                            <i class="fa-solid fa-chart-pie text-lg"></i>
                        </div>
                        <div>
                            <h2 class="font-black text-2xl text-slate-800 leading-none">
                                Panel de Control Operativo
                            </h2>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Evaluación de Metas Institucionales</p>
                        </div>
                    </div>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('trash.index') }}" class="group bg-white hover:bg-red-50 text-slate-600 hover:text-red-600 border border-slate-200 hover:border-red-200 font-bold py-2.5 px-5 rounded-xl flex items-center gap-2 transition-all shadow-sm hover:shadow-md text-sm">
                            <i class="fa-solid fa-trash-arrow-up group-hover:-translate-y-0.5 transition-transform text-slate-400 group-hover:text-red-500"></i>
                            <span>Papelera de Reciclaje</span>
                        </a>
                    @endif
                </div>
            </x-slot>
           
            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-2xl shadow-sm flex items-center gap-3 animate-pulse">
                    <i class="fa-solid fa-circle-exclamation text-red-500 text-xl"></i>
                    <p class="text-red-700 font-bold text-sm">{{ session('error') }}</p>
                </div>
            @endif

            {{-- 🎯 NUEVO: CONTROL CENTRAL DE DOBLE LÍNEA DE FILTRADO CRUZADO REACTIVO --}}
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                {{-- Filtro A: Origen de Fondos --}}
                <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 w-full border-b border-slate-50 pb-2">
                    <div class="flex items-center gap-2 text-slate-700">
                        <i class="fa-solid fa-wallet text-xs text-slate-400 w-4 text-center"></i>
                        <span class="text-xs font-black uppercase tracking-wider">Origen de Fondos:</span>
                    </div>
                    <div class="inline-flex p-1 bg-slate-100 rounded-xl w-full sm:w-auto">
                        <button @click="currentFilter = 'all'; calculateMetrics()" :class="currentFilter === 'all' ? 'bg-white text-slate-900 shadow-sm font-black' : 'text-slate-500 font-bold hover:text-slate-800'" class="px-4 py-1.5 rounded-lg text-[11px] uppercase tracking-wider transition-all">
                            Todos
                        </button>
                        <button @click="currentFilter = 'gobierno_regional'; calculateMetrics()" :class="currentFilter === 'gobierno_regional' ? 'bg-white text-slate-900 shadow-sm font-black' : 'text-slate-500 font-bold hover:text-slate-800'" class="px-4 py-1.5 rounded-lg text-[11px] uppercase tracking-wider transition-all">
                            Regional
                        </button>
                        <button @click="currentFilter = 'gobierno_central'; calculateMetrics()" :class="currentFilter === 'gobierno_central' ? 'bg-white text-slate-900 shadow-sm font-black' : 'text-slate-500 font-bold hover:text-slate-800'" class="px-4 py-1.5 rounded-lg text-[11px] uppercase tracking-wider transition-all">
                            SUNAFIL
                        </button>
                    </div>
                </div>

                {{-- Filtro B: Departamento Responsable --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 w-full">
                    <div class="flex items-center gap-2 text-slate-700">
                        <i class="fa-solid fa-sitemap text-xs text-slate-400 w-4 text-center"></i>
                        <span class="text-xs font-black uppercase tracking-wider">Departamento:</span>
                    </div>
                    <div class="inline-flex p-1 bg-slate-100 rounded-xl w-full sm:w-auto">
                        <button @click="deptFilter = 'all'; calculateMetrics()" :class="deptFilter === 'all' ? 'bg-white text-slate-900 shadow-sm font-black' : 'text-slate-500 font-bold'" class="px-3 py-1.5 rounded-lg text-[10px] uppercase tracking-wider transition-all">
                            Todos
                        </button>
                        <button @click="deptFilter = 'prevencion'; calculateMetrics()" :class="deptFilter === 'prevencion' ? 'bg-white text-blue-600 shadow-sm font-black' : 'text-slate-500 font-bold hover:text-blue-500'" class="px-3 py-1.5 rounded-lg text-[10px] uppercase tracking-wider transition-all">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 inline-block mr-1"></span> Prevención
                        </button>
                        <button @click="deptFilter = 'formaliza'; calculateMetrics()" :class="deptFilter === 'formaliza' ? 'bg-white text-amber-600 shadow-sm font-black' : 'text-slate-500 font-bold hover:text-amber-500'" class="px-3 py-1.5 rounded-lg text-[10px] uppercase tracking-wider transition-all">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 inline-block mr-1"></span> Formaliza
                        </button>
                        <button @click="deptFilter = 'empleo'; calculateMetrics()" :class="deptFilter === 'empleo' ? 'bg-white text-emerald-600 shadow-sm font-black' : 'text-slate-500 font-bold hover:text-emerald-500'" class="px-3 py-1.5 rounded-lg text-[10px] uppercase tracking-wider transition-all">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block mr-1"></span> Empleo
                        </button>
                    </div>
                </div>
            </div>

            {{-- TARJETAS DE RESUMEN CONTROLADAS DINÁMICAMENTE POR ALPINE --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white shadow-sm rounded-2xl p-6 border border-slate-100 relative overflow-hidden group">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-slate-50 rounded-full"></div>
                    <div class="relative z-10 flex flex-col justify-between h-full">
                        <div class="text-slate-400 text-[10px] font-black mb-2 uppercase tracking-widest flex items-center gap-1.5"><i class="fa-solid fa-bullseye text-slate-500"></i> Meta Programada</div>
                        <div class="text-3xl font-black text-slate-800 tracking-tight" x-text="formatNumber(metaGlobal)"></div>
                        <div class="text-[11px] text-slate-400 mt-2 font-medium">Beneficiarios planificados en el POI</div>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-2xl p-6 border border-slate-100 relative overflow-hidden group border-l-4 border-l-blue-600">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-50 rounded-full"></div>
                    <div class="relative z-10 flex flex-col justify-between h-full">
                        <div class="text-blue-600 text-[10px] font-black mb-2 uppercase tracking-widest flex items-center gap-1.5"><i class="fa-solid fa-shield-check"></i> Avance Capped (Oficial)</div>
                        <div class="text-3xl font-black text-slate-800 tracking-tight" x-text="formatNumber(avanceCapped)"></div>
                        <div class="text-[11px] text-slate-500 mt-2 font-medium">Suma regulada sin distorsión externa</div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-slate-900 to-slate-950 shadow-md rounded-2xl p-6 text-white relative overflow-hidden">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>
                    <div class="relative z-10 flex flex-col justify-between h-full">
                        <div class="text-amber-400 text-[10px] font-black mb-1 uppercase tracking-widest flex items-center gap-1.5"><i class="fa-solid fa-gauge-high"></i> Eficacia Global POI</div>
                        <div class="text-3xl font-black flex items-baseline gap-0.5 tracking-tight text-white">
                            <span x-text="eficaciaGlobal"></span><span class="text-lg text-slate-400">%</span>
                        </div>
                        <div class="w-full bg-white/10 rounded-full h-2 mt-3 overflow-hidden p-0.5 border border-white/5">
                            <div class="bg-gradient-to-r from-amber-500 to-orange-500 h-full rounded-full transition-all duration-500" :style="'width: ' + Math.min(eficaciaGlobal, 100) + '%'"></div>
                        </div>
                        <div class="text-[9px] text-slate-400 mt-2 font-bold uppercase tracking-wider">* Excedentes excluidos del progreso global</div>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-2xl p-6 border border-slate-100 relative overflow-hidden group border-l-4 border-l-emerald-500">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-emerald-50 rounded-full"></div>
                    <div class="relative z-10 flex flex-col justify-between h-full">
                        <div class="text-emerald-600 text-[10px] font-black mb-2 uppercase tracking-widest flex items-center gap-1.5"><i class="fa-solid fa-arrow-trend-up"></i> Sobrecumplimiento</div>
                        <div class="text-3xl font-black text-emerald-600 tracking-tight" x-text="'+' + formatNumber(excedenteGlobal)"></div>
                        <div class="text-[11px] text-slate-400 mt-2 font-medium">Usuarios extra fuera de la meta base</div>
                    </div>
                </div>
            </div>

            {{-- FILA 1 DE GRÁFICOS INTERACTIVOS --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white shadow-sm rounded-2xl p-6 border border-slate-100 flex flex-col">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="text-base font-black text-slate-800">Carga Operativa vs Cumplimiento Real</h3>
                            <p class="text-xs text-slate-400 mt-0.5 font-medium">Comparativo directo por código operativo</p>
                        </div>
                        <span class="bg-slate-100 text-slate-600 text-[9px] font-black px-2.5 py-1 rounded-md uppercase tracking-wider border border-slate-200">POI Estructurado</span>
                    </div>
                    <div class="h-[300px] w-full relative flex-1">
                        <canvas id="progressChart"></canvas>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-2xl p-6 border border-slate-100 flex flex-col">
                    <div>
                        <h3 class="text-base font-black text-slate-800">Distribución de Impacto por Eje / Categoría</h3>
                        <p class="text-xs text-slate-400 mt-0.5 font-medium">Volumen total de asistentes segmentados</p>
                    </div>
                    <div class="h-[300px] w-full relative flex-1 mt-4">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- FILA 2 DE GRÁFICOS --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white shadow-sm rounded-2xl p-6 border border-slate-100 flex flex-col">
                    <div>
                        <h3 class="text-base font-black text-slate-800">Evolución Cronológica de Cobertura</h3>
                        <p class="text-xs text-slate-400 mt-0.5 font-medium">Historial mensual consolidado año fiscal 2026</p>
                    </div>
                    <div class="h-[280px] w-full relative flex-1 mt-4">
                        <canvas id="evolutionChart"></canvas>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-2xl p-6 border border-slate-100 flex flex-col justify-between">
                    <div class="text-center">
                        <h3 class="text-base font-black text-slate-800">Medidor de Eficacia Global</h3>
                        <p class="text-xs text-slate-400 mt-0.5 font-medium">Porcentaje neto de metas cubiertas</p>
                    </div>
                    <div class="h-[200px] w-full relative mt-4 flex items-center justify-center">
                        <canvas id="gaugeChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- TABLA DETALLADA CON FILTROS EN CADENA Y DISTINTIVOS COLORIMÉTRICOS --}}
            <div class="bg-white shadow-sm rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                    <div>
                        <h3 class="text-base font-black text-slate-800">Detalle Desglosado del Cumplimiento Operativo</h3>
                        <p class="text-xs text-slate-400 mt-0.5 font-medium">Auditoría visual de metas asignadas y su comportamiento analítico.</p>
                    </div>
                    <div class="flex items-center gap-4 text-xs font-bold text-slate-500 bg-white border border-slate-200 px-3 py-1.5 rounded-lg">
                        <div class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 bg-indigo-600 rounded-full"></span> Base</div>
                        <div class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 bg-amber-400 rounded-full"></span> Excedente</div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-slate-100/75 text-slate-500 text-[10px] uppercase font-black tracking-wider border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-4">Código</th>
                                <th class="px-6 py-4">Descripción de Actividad</th>
                                <th class="px-6 py-4">Eje Estratégico</th>
                                <th class="px-6 py-4">Métrica Analítica</th>
                                <th class="px-6 py-4 w-52">Rendimiento Operativo</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($eventos as $evento)
                                @php
                                    $avance = $evento->total_attendees ?? 0;
                                    $meta = $evento->goal_people > 0 ? $evento->goal_people : 1;
                                   
                                    $maxVal = max($meta, $avance);
                                    $w_base = $avance >= $meta ? ($meta / $maxVal * 100) : ($avance / $meta * 100);
                                    $w_exceso = $avance > $meta ? (($avance - $meta) / $maxVal * 100) : 0;
                                   
                                    $pct_real = round(($avance / $meta) * 100, 1);
                                    $deptClean = strtolower(trim($evento->category->department ?? 'prevencion'));
                                @endphp
                                {{-- MODIFICADO: Mapeo de la directiva x-show para responder estrictamente a la matriz de filtros cruzados --}}
                                <tr x-show="(currentFilter === 'all' || currentFilter === '{{ $evento->funding_source }}') && (deptFilter === 'all' || deptFilter === '{{ $deptClean }}')"
                                    x-transition.opacity.duration.300ms
                                    class="hover:bg-slate-50/60 transition-colors">
                                    <td class="px-6 py-4 font-bold text-slate-900 whitespace-nowrap">
                                        <span class="bg-slate-100 border border-slate-200 text-slate-700 px-2 py-1 rounded-md text-xs font-mono font-black shadow-inner">
                                            {{ $evento->event_code }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-700 font-bold text-xs max-w-xs leading-relaxed">
                                        {{ Str::limit($evento->description, 80) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-col gap-1 items-start">
                                            <span class="bg-slate-100 text-slate-700 px-2 py-0.5 rounded text-[11px] font-medium max-w-[150px] truncate" title="{{ $evento->category->name ?? '' }}">
                                                {{ $evento->category->name ?? 'General' }}
                                            </span>
                                            <div class="flex gap-1">
                                                {{-- Insignia de Financiamiento --}}
                                                @if(($evento->funding_source ?? 'gobierno_regional') === 'gobierno_regional')
                                                    <span class="text-[8px] font-black text-indigo-600 bg-indigo-50 border border-indigo-100/60 px-1 py-0.2 rounded uppercase tracking-wider">Regional</span>
                                                @else
                                                    <span class="text-[8px] font-black text-amber-700 bg-amber-50 border border-amber-100/60 px-1 py-0.2 rounded uppercase tracking-wider">SUNAFIL</span>
                                                @endif

                                                {{-- Badge del Departamento Responsable --}}
                                                @if($deptClean === 'prevencion')
                                                    <span class="text-[8px] font-black text-blue-600 bg-blue-50 border border-blue-100 px-1 py-0.2 rounded uppercase tracking-wider">Prevención</span>
                                                @elseif($deptClean === 'formaliza')
                                                    <span class="text-[8px] font-black text-amber-600 bg-amber-50 border border-amber-200 px-1 py-0.2 rounded uppercase tracking-wider">Formaliza</span>
                                                @elseif($deptClean === 'empleo')
                                                    <span class="text-[8px] font-black text-emerald-600 bg-emerald-50 border border-emerald-100 px-1 py-0.2 rounded uppercase tracking-wider">Empleo</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-1.5 text-xs">
                                            <span class="font-black text-slate-900">{{ number_format($avance) }}</span>
                                            <span class="text-slate-300 font-normal">/</span>
                                            <span class="text-slate-500 font-bold">{{ number_format($meta) }}</span>
                                            
                                            @if($avance > $meta)
                                                <span class="ml-1 text-[9px] font-black text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded border border-emerald-200">
                                                    +{{ number_format($avance - $meta) }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="w-full bg-slate-100 rounded-full h-2.5 flex overflow-hidden border border-slate-200/40 shadow-inner">
                                            <div class="h-full transition-all duration-500 {{ $pct_real >= 100 ? 'bg-indigo-600' : 'bg-slate-500' }}" style="width: {{ $w_base }}%"></div>
                                            @if($w_exceso > 0)
                                                <div class="bg-amber-400 h-full transition-all duration-500 border-l border-white/20" style="width: {{ $w_exceso }}%"></div>
                                            @endif
                                        </div>
                                        <div class="flex justify-between items-center mt-1.5 text-[10px]">
                                            <span class="font-black {{ $pct_real >= 100 ? 'text-emerald-600 bg-emerald-50 border border-emerald-100 px-1 rounded' : 'text-slate-500' }}">
                                                {{ $pct_real }}% Eficacia
                                            </span>
                                            @if($pct_real >= 100)
                                                <span class="font-black text-amber-500"><i class="fa-solid fa-circle-up animate-pulse"></i> Superado</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {{-- CHART.JS: CONFIGURACIONES ASIGNADAS A VARIABLES GLOBALES WINDOW --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            Chart.defaults.font.family = "'DM Sans', 'Inter', sans-serif";
            Chart.defaults.color = '#94a3b8';

            const chartBar = @json($chartBar);
            const catData = @json($catData);
            const monthly = @json($monthly);

            // 1. GRAFICO DE BARRAS APILADAS (Asignado a window para mutabilidad)
            const labelsBar = chartBar.map(i => i.code);
            const dataMetaLine = chartBar.map(i => i.meta);
            const dataBaseCapped = chartBar.map(i => Math.min(i.avance, i.meta));
            const dataExcedentePure = chartBar.map(i => Math.max(0, i.avance - i.meta));

            const ctx1 = document.getElementById('progressChart').getContext('2d');
            window.myProgressChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: labelsBar,
                    datasets: [
                        {
                            label: 'Logro Base Programado',
                            data: dataBaseCapped,
                            backgroundColor: '#4f46e5',
                            stack: 'GroupPOI',
                        },
                        {
                            label: 'Sobre-cumplimiento (Excedente)',
                            data: dataExcedentePure,
                            backgroundColor: '#f59e0b',
                            borderRadius: {topLeft: 4, topRight: 4, bottomLeft: 0, bottomRight: 0},
                            stack: 'GroupPOI',
                        },
                        {
                            label: 'Línea Limite de Meta',
                            data: dataMetaLine,
                            backgroundColor: 'transparent',
                            borderColor: '#ef4444',
                            borderWidth: 2,
                            borderDash: [6, 4],
                            type: 'line',
                            pointBackgroundColor: '#ef4444',
                            pointRadius: 3,
                            fill: false,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: { stacked: true, grid: { display: false }, ticks: { font: { weight: 'bold' } } },
                        y: { stacked: true, beginAtZero: true, border: { dash: [4, 4] } }
                    },
                    plugins: {
                        legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 6, font: { size: 11, weight: 'bold' } } }
                    }
                }
            });

            // 2. DONA DE DISTRIBUCIÓN POR CATEGORÍAS (Asignado a window)
            const ctx2 = document.getElementById('categoryChart').getContext('2d');
            window.myCategoryChart = new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(catData),
                    datasets: [{
                        data: Object.values(catData),
                        backgroundColor: ['#4f46e5', '#0284c7', '#10b981', '#f59e0b', '#ef4444', '#6366f1'],
                        borderWidth: 4,
                        borderColor: '#ffffff',
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true, 
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { position: 'right', labels: { usePointStyle: true, boxWidth: 6, font: { size: 11, weight: 'bold' } } } 
                    },
                    cutout: '70%'
                }
            });

            // 3. EVOLUCIÓN MENSUAL ESTATAL ESTABLE
            const ctx3 = document.getElementById('evolutionChart').getContext('2d');
            let fillGrad = ctx3.createLinearGradient(0, 0, 0, 260);
            fillGrad.addColorStop(0, 'rgba(79, 70, 229, 0.25)');
            fillGrad.addColorStop(1, 'rgba(79, 70, 229, 0.0)');

            const monthlyLabels = monthly.map(m => {
                const [y, mo] = m.mes.split('-');
                return new Date(y, mo - 1, 1).toLocaleDateString('es', { month: 'short' }).toUpperCase();
            });
           
            new Chart(ctx3, {
                type: 'line',
                data: {
                    labels: monthlyLabels,
                    datasets: [{
                        data: monthly.map(m => m.total),
                        fill: true,
                        backgroundColor: fillGrad,
                        borderColor: '#4f46e5',
                        borderWidth: 3,
                        tension: 0.35,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#4f46e5',
                        pointBorderWidth: 2.5,
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    scales: {
                        y: { beginAtZero: true, border: { dash: [4, 4] } },
                        x: { grid: { display: false } }
                    },
                    plugins: { legend: { display: false } }
                }
            });

            // 4. MEDIDOR GAUGE DINÁMICO REACONDICIONADO (Asignado a window)
            const ctx4 = document.getElementById('gaugeChart').getContext('2d');
            window.myGaugeChart = new Chart(ctx4, {
                type: 'doughnut',
                data: {
                    labels: ['Eficacia Cubierta', 'Déficit Pendiente'],
                    datasets: [{
                        data: [0, 100],
                        backgroundColor: ['#f59e0b', '#e2e8f0'],
                        borderWidth: 0,
                        cutout: '80%'
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false }, tooltip: { enabled: false } }
                },
                plugins: [{
                    id: 'centerTextPOI',
                    beforeDraw: function(chart) {
                        const { width, height, ctx } = chart;
                        ctx.restore();
                        
                        // 🎯 MODIFICADO: Lee directamente de los datos reales inyectados por Alpine
                        const currentScore = chart.data.datasets[0].data[0] || 0;
                       
                        ctx.font = '900 32px Sora, sans-serif';
                        ctx.fillStyle = '#0f172a';
                        ctx.textBaseline = 'middle';
                        const text = currentScore + "%";
                        const textX = Math.round((width - ctx.measureText(text).width) / 2);
                        ctx.fillText(text, textX, (height / 2) - 4);
                       
                        ctx.font = '800 10px DM Sans, sans-serif';
                        ctx.fillStyle = '#94a3b8';
                        const labelText = "POI REAL";
                        const labelTextX = Math.round((width - ctx.measureText(labelText).width) / 2);
                        ctx.fillText(labelText, labelTextX, (height / 2) + 18);
                        ctx.save();
                    }
                }]
            });

            // Forzar actualización inicial de gráficos al cargar la página
            if(window.Alpine) {
                Alpine.store('dashboardInit', true);
            }
        });
    </script>
</x-app-layout>