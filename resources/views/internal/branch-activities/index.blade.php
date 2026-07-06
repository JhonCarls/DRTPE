<x-branch-layout>
{{-- Preparación de datos relacionales con detección dinámica de esquema en TiDB Cloud --}}
@php
    $userSede = auth()->user()->sede;

    // Mapeo seguro de la colección de actividades operativas de la sede
    $jsonActivities = $activities->map(function($a) {
        return [
            'id' => $a->id,
            'title' => addslashes($a->title),
            'description' => addslashes(preg_replace('/\s+/', ' ', $a->description)),
            'date_string' => $a->created_at->format('d/m/Y h:i A'),
            'created_at' => $a->created_at->toIso8601String(),
            'attendees_count' => (int)($a->attendees_count ?? 0),
            'photos_count' => count($a->photos ?? []),
            'first_photo' => isset($a->photos[0]) ? asset('storage/' . $a->photos[0]) : null,
            'url_edit' => route('branch-activities.edit', $a->id),
            'url_destroy' => route('branch-activities.destroy', $a->id)
        ];
    })->values();

    // ── 🎯 DETECCIÓN DE ESQUEMA BLINDADA EN TIEMPO REAL ──────────────────
    $hasUserId = \Illuminate\Support\Facades\Schema::hasColumn('announcements', 'user_id');
    $hasSede = \Illuminate\Support\Facades\Schema::hasColumn('announcements', 'sede');
    $hasCategory = \Illuminate\Support\Facades\Schema::hasColumn('announcements', 'category');

    // Construcción de la consulta según el estado real de las columnas de la base de datos
    $query = \App\Models\Announcement::query();

    if ($hasUserId) {
        $query->whereHas('user', function($q) use ($userSede) {
            $q->where('sede', $userSede);
        });
    } elseif ($hasSede) {
        $query->where('sede', $userSede);
    } elseif ($hasCategory) {
        $query->where('category', 'Sede ' . ucfirst($userSede));
    }

    $existingAnnouncements = $query->latest()
        ->limit(5)
        ->get()
        ->map(function($an) use ($userSede) {
            return [
                'id' => $an->id,
                'title' => addslashes($an->title),
                'content' => addslashes(preg_replace('/\s+/', ' ', $an->content ?? $an->description ?? '')),
                'date' => $an->created_at->format('d/m/Y'),
                'fecha_publicacion' => $an->published_at ? \Carbon\Carbon::parse($an->published_at)->format('d/m/Y') : $an->created_at->format('d/m/Y'),
                'fecha_vencimiento' => $an->expired_at ? \Carbon\Carbon::parse($an->expired_at)->format('d/m/Y') : 'Sin Límite',
                'category' => 'Sede ' . ucfirst($userSede),
                'is_urgent' => (bool)($an->is_urgent ?? false)
            ];
        })->values();
@endphp

<style>
    .custom-table-scrollbar::-webkit-scrollbar { height: 6px; }
    .custom-table-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-table-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
</style>

{{-- Rejilla Completa de 12 Columnas para Máxima Amplitud Visual --}}
<div class="space-y-6" 
     x-data="branchActivitiesDashboard({{ json_encode($jsonActivities) }}, {{ json_encode($existingAnnouncements) }})"
     x-init="initDashboard()">
    
    {{-- 📢 CARRUSEL AUTOMÁTICO DE COMUNICADOS DE LA SEDE (5 SEGUNDOS) --}}
    <div class="bg-gradient-to-r from-slate-900 to-slate-950 text-white rounded-2xl p-6 shadow-xs relative overflow-hidden min-h-[110px] flex flex-col justify-center"
         x-show="announcements.length > 0">
        <div class="absolute right-6 top-6 z-20 flex items-center gap-2">
            <span class="text-[9px] font-mono font-black bg-red-600 text-white px-2 py-0.5 rounded uppercase tracking-wider animate-pulse">Tablón en Vivo</span>
            <div class="flex gap-1" x-show="announcements.length > 1">
                <button @click="prevAnnounce()" class="w-6 h-6 bg-white/10 hover:bg-white/20 text-white border-none rounded-lg cursor-pointer flex items-center justify-center"><i class="fa-solid fa-chevron-left text-[10px]"></i></button>
                <button @click="nextAnnounce()" class="w-6 h-6 bg-white/10 hover:bg-white/20 text-white border-none rounded-lg cursor-pointer flex items-center justify-center"><i class="fa-solid fa-chevron-right text-[10px]"></i></button>
            </div>
        </div>

        <template x-for="(ann, idx) in announcements" :key="ann.id">
            <div class="space-y-1.5 pr-24" x-show="activeAnnIdx === idx" x-transition.opacity>
                <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-[11px] font-mono font-bold">
                    <span class="text-[9px] font-black uppercase tracking-widest px-2 py-0.5 rounded bg-indigo-600 text-white" x-text="ann.is_urgent ? 'Urgente' : 'Oficial Sede'"></span>
                    <span class="text-slate-400">Publicado: <span class="text-slate-200" x-text="ann.fecha_publicacion"></span></span>
                    <span class="text-amber-400">Vence: <span class="text-amber-300" x-text="ann.fecha_vencimiento"></span></span>
                </div>
                <h3 class="text-base font-black tracking-tight text-white m-0 uppercase" x-text="ann.title"></h3>
                <p class="text-xs text-slate-300 m-0 line-clamp-2 leading-relaxed text-justify font-medium" x-text="ann.content"></p>
            </div>
        </template>
    </div>

    {{-- CABECERA INSTITUCIONAL DEL PANEL --}}
    <div class="bg-white p-5 rounded-2xl border border-slate-200 flex flex-col sm:flex-row justify-between sm:items-center gap-4 shadow-xs">
        <div class="flex items-center gap-3">
            <div class="p-2.5 bg-slate-900 rounded-xl text-white flex items-center justify-center shadow-xs">
                <i class="fa-solid fa-chart-line text-sm"></i>
            </div>
            <div>
                <h2 class="font-black text-xl text-slate-800 tracking-tight m-0">Panel de Control Operativo</h2>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1.5 m-0">Evaluación de Metas Institucionales</p>
            </div>
        </div>
        <a href="{{ route('branch-activities.create') }}" class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-black text-xs uppercase tracking-wider py-2.5 px-4 rounded-xl shadow-xs transition-all border-none cursor-pointer focus-ring decoration-none">
            <i class="fa-solid fa-circle-plus"></i> Registrar Actividad
        </a>
    </div>

    {{-- TARJETAS ESTADÍSTICAS --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
            <div class="text-slate-400 text-[9px] font-black uppercase tracking-widest mb-1 flex items-center gap-1.5"><i class="fa-solid fa-folder-closed"></i> Actas Subidas</div>
            <div class="text-2xl font-black text-slate-800 tracking-tight mt-1" x-text="metrics.totalActs">0</div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 border-l-4 border-l-blue-600 shadow-xs">
            <div class="text-blue-600 text-[9px] font-black uppercase tracking-widest mb-1.5 flex items-center gap-1.5"><i class="fa-solid fa-users"></i> Atendidos (Oficial)</div>
            <div class="text-2xl font-black text-slate-800 tracking-tight" x-text="formatNumber(metrics.totalAttendees)">0</div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 border-l-4 border-l-emerald-500 shadow-xs">
            <div class="text-emerald-600 text-[9px] font-black uppercase tracking-widest mb-1 flex items-center gap-1.5"><i class="fa-solid fa-images"></i> Capturas Guardadas</div>
            <div class="text-2xl font-black text-slate-800 tracking-tight mt-1" x-text="formatNumber(metrics.totalPhotos)">0</div>
        </div>
    </div>

    {{-- FILTROS Y BUSCADOR AVANZADO --}}
    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <div class="md:col-span-8 relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400"><i class="fa-solid fa-magnifying-glass text-xs"></i></span>
                <input type="text" x-model="searchQuery" placeholder="Buscar actividad en tiempo real..."
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 pl-10 pr-4 text-xs font-semibold text-slate-800 focus:outline-none focus:border-indigo-500 shadow-inner focus-ring">
            </div>
            <div class="md:col-span-4">
                <select x-model="sortBy" class="w-full bg-white border border-slate-200 rounded-xl py-2.5 px-3 text-xs font-black text-slate-700 focus:outline-none focus:border-indigo-500 shadow-xs cursor-pointer focus-ring">
                    <option value="recent">▼ Más recientes</option>
                    <option value="attendees">▼ Mayor asistencia</option>
                </select>
            </div>
        </div>
    </div>

    {{-- TABLA OFICIAL DE DATOS --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto custom-table-scrollbar" x-show="filteredActivities.length > 0">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-400 text-[10px] uppercase font-black tracking-wider">
                    <tr>
                        <th class="px-6 py-4 w-24">Foto</th>
                        <th class="px-6 py-4">Actividad / Título</th>
                        <th class="px-6 py-4 w-44 text-center">Registro</th>
                        <th class="px-6 py-4 w-24 text-center">Asistentes</th>
                        <th class="px-6 py-4 w-24 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    <template x-for="act in filteredActivities" :key="act.id">
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-3">
                                <div class="w-12 h-10 rounded-xl bg-slate-50 border border-slate-200 overflow-hidden flex items-center justify-center shadow-inner">
                                    <img x-show="act.first_photo" :src="act.first_photo" class="w-full h-full object-cover">
                                    <i x-show="!act.first_photo" class="fa-solid fa-image text-slate-300 text-xs"></i>
                                </div>
                            </td>
                            <td class="px-6 py-3">
                                <h4 class="text-xs font-black text-slate-900 m-0 leading-snug" x-text="act.title"></h4>
                                <p class="text-[11px] text-slate-400 line-clamp-1 mt-1 m-0 font-medium" x-text="act.description"></p>
                            </td>
                            <td class="px-6 py-3 text-center text-xs font-bold text-slate-500" x-text="act.date_string"></td>
                            <td class="px-6 py-3 text-center font-black text-slate-900" x-text="formatNumber(act.attendees_count)"></td>
                            <td class="px-6 py-3 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a :href="act.url_edit" class="w-7 h-7 bg-slate-50 hover:bg-indigo-50 border border-slate-200 text-slate-500 hover:text-indigo-600 rounded-lg flex items-center justify-center decoration-none"><i class="fa-solid fa-pen-to-square text-[10px]"></i></a>
                                    <form :action="act.url_destroy" method="POST" @submit="if(!confirm('¿Eliminar actividad?')) $event.preventDefault();" class="m-0">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="w-7 h-7 bg-slate-50 hover:bg-red-50 border border-slate-200 text-slate-400 hover:text-red-600 rounded-lg flex items-center justify-center border-none cursor-pointer focus-ring"><i class="fa-solid fa-trash text-[10px]"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
        <div class="p-16 text-center text-slate-400" x-show="filteredActivities.length === 0">
            <span class="text-xs font-bold uppercase tracking-wider block">Sin registros de gestión en pantalla</span>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('branchActivitiesDashboard', (activitiesData, announcementsData) => ({
            activities: activitiesData,
            announcements: announcementsData,
            searchQuery: '',
            sortBy: 'recent',
            metrics: { totalActs: 0, totalAttendees: 0, totalPhotos: 0 },
            activeAnnIdx: 0,

            initDashboard() {
                let totalActs = this.activities.length;
                let totalAtt = this.activities.reduce((sum, current) => sum + current.attendees_count, 0);
                let totalPht = this.activities.reduce((sum, current) => sum + current.photos_count, 0);

                this.animateCounter('totalActs', totalActs, 500);
                this.animateCounter('totalAttendees', totalAtt, 800);
                this.animateCounter('totalPhotos', totalPht, 700);

                if (this.announcements.length > 1) {
                    setInterval(() => { this.nextAnnounce() }, 5000);
                }
            },

            nextAnnounce() { this.activeAnnIdx = (this.activeAnnIdx + 1) % this.announcements.length; },
            prevAnnounce() { this.activeAnnIdx = (this.activeAnnIdx - 1 + this.announcements.length) % this.announcements.length; },

            animateCounter(key, target, duration) {
                if (target === 0) return;
                let start = 0;
                let stepTime = Math.max(Math.floor(duration / target), 12);
                let increment = Math.ceil(target / (duration / stepTime));
                let timer = setInterval(() => {
                    start += increment;
                    if (start >= target) { this.metrics[key] = target; clearInterval(timer); } 
                    else { this.metrics[key] = start; }
                }, stepTime);
            },

            levenshtein(a, b) {
                if (a.length === 0) return b.length; if (b.length === 0) return a.length;
                let matrix = [];
                for (let i = 0; i <= b.length; i++) { matrix[i] = [i]; }
                for (let j = 0; j <= a.length; j++) { matrix[0][j] = j; }
                for (let i = 1; i <= b.length; i++) {
                    for (let j = 1; j <= a.length; j++) {
                        if (b.charAt(i - 1) === a.charAt(j - 1)) matrix[i][j] = matrix[i - 1][j - 1];
                        else matrix[i][j] = Math.min(matrix[i - 1][j - 1] + 1, matrix[i][j - 1] + 1, matrix[i - 1][j] + 1);
                    }
                }
                return matrix[b.length][a.length];
            },

            fuzzySearchMatch(sourceText, queryText) {
                if (!queryText) return true;
                let source = sourceText.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                let query = queryText.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                if (source.includes(query)) return true;
                let queryWords = query.split(/\s+/), sourceWords = source.split(/\s+/);
                return queryWords.every(qWord => {
                    if (qWord.length < 3) return source.includes(qWord);
                    return sourceWords.some(sWord => this.levenshtein(sWord, qWord) <= (qWord.length <= 4 ? 1 : 2));
                });
            },

            get filteredActivities() {
                let result = [...this.activities];
                if (this.searchQuery.trim() !== '') {
                    result = result.filter(a => this.fuzzySearchMatch(a.title + ' ' + a.description + ' ' + a.date_string, this.searchQuery));
                }
                if (this.sortBy === 'recent') result.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                if (this.sortBy === 'attendees') result.sort((a, b) => b.attendees_count - a.attendees_count);
                return result;
            },

            formatNumber(val) { return new Intl.NumberFormat('en-US').format(val); }
        }));
    });
</script>
</x-branch-layout>