<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-slate-800 tracking-tight flex items-center gap-3">
                <div class="p-2 bg-amber-100 rounded-xl text-amber-600"><i class="fa-solid fa-bullhorn"></i></div>
                Gestión de Comunicados Oficiales
            </h2>
            <a href="{{ route('announcements.create') }}" class="bg-slate-900 hover:bg-amber-600 text-white font-bold text-sm px-5 py-2.5 rounded-xl transition-all shadow flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Nuevo Comunicado
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto space-y-6"
         x-data="{ openRepo: false, repo: null, show(data) { this.repo = data; this.openRepo = true; } }">
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl flex items-center gap-2 font-bold text-sm">
                <i class="fa-solid fa-circle-check text-emerald-500"></i> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-slate-100 shadow-md overflow-hidden">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-slate-50 text-slate-500 font-bold uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Vigencia (Inicio / Fin)</th>
                        <th class="px-6 py-4">Estado</th>
                        <th class="px-6 py-4">Título</th>
                        <th class="px-6 py-4">Tipo</th>
                        <th class="px-6 py-4 text-center">Adjuntos</th>
                        <th class="px-6 py-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($announcements as $item)
                        @php
                            $today = now()->startOfDay();
                            $start = $item->published_at->startOfDay();
                            $end = $item->expired_at->startOfDay();
                            $isActive = $today->between($start, $end);
                        @endphp
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap font-semibold text-slate-600">
                                {{ $item->published_at->format('d/m/Y') }} - {{ $item->expired_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider 
                                    {{ $isActive ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : 'bg-red-100 text-red-800 border border-red-200' }}">
                                    {{ $isActive ? 'Visible' : 'Expirado/Programado' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-800">{{ $item->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-bold uppercase text-xs text-slate-500">
                                <i class="{{ $item->file_type === 'pdf' ? 'fa-solid fa-file-pdf text-red-500' : 'fa-solid fa-image text-blue-500' }} mr-1"></i>
                                {{ $item->file_type }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @php $anexos = count($item->attachments ?? []); @endphp
                                <button type="button" @click="show(@js($item->toRepositoryArray()))"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-amber-100 text-slate-700 hover:text-amber-700 text-xs font-black border border-slate-200 hover:border-amber-300 transition cursor-pointer">
                                    <i class="fa-solid fa-paperclip"></i>
                                    <span>1 Matriz</span>
                                    @if($anexos > 0)<span class="text-amber-600">+ {{ $anexos }} {{ $anexos === 1 ? 'Anexo' : 'Anexos' }}</span>@endif
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="p-2 bg-slate-50 text-slate-600 rounded-lg hover:bg-slate-100 border border-slate-200"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('announcements.edit', $item->id) }}" class="p-2 bg-amber-50 text-amber-600 rounded-lg hover:bg-amber-100 border border-amber-200"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="{{ route('announcements.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Eliminar comunicado?')">
                                        @csrf @method('delete')
                                        <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 border border-red-200"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-12 text-slate-400 font-medium">No hay comunicados registrados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div>{{ $announcements->links() }}</div>

        {{-- ══════════════════════════════════════════════════════════ --}}
        {{-- MODAL: REPOSITORIO DOCUMENTAL (Documento Matriz + Anexos)   --}}
        {{-- ══════════════════════════════════════════════════════════ --}}
        <div x-show="openRepo" x-cloak
             @keydown.escape.window="openRepo = false"
             class="fixed inset-0 z-50 flex items-center justify-center p-4"
             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            {{-- Fondo --}}
            <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="openRepo = false"></div>

            {{-- Tarjeta --}}
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto"
                 x-show="openRepo"
                 x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 translate-y-2" x-transition:enter-end="opacity-100 scale-100 translate-y-0">

                {{-- Encabezado --}}
                <div class="p-6 border-b border-slate-100 flex items-start justify-between gap-4 sticky top-0 bg-white z-10">
                    <div class="min-w-0">
                        <p class="text-[10px] font-black uppercase tracking-widest text-amber-600"><i class="fa-solid fa-folder-tree mr-1"></i> Repositorio Documental</p>
                        <h3 class="text-lg sm:text-xl font-black text-slate-800 mt-1 leading-tight" x-text="repo?.title"></h3>
                        <p class="text-xs font-bold text-slate-400 mt-1"><i class="fa-regular fa-calendar mr-1"></i> Vigencia: <span x-text="repo?.vigencia"></span></p>
                    </div>
                    <button @click="openRepo = false" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 flex items-center justify-center transition cursor-pointer shrink-0 border-none">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="p-6 space-y-6">
                    {{-- 1. Documento Matriz Principal --}}
                    <div x-show="repo?.main_url">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2"><i class="fa-solid fa-star text-amber-500 mr-1"></i> Documento Matriz Principal</p>
                        <a :href="repo?.main_url" target="_blank"
                           class="flex items-center gap-4 p-4 rounded-xl border-2 border-slate-100 hover:border-amber-300 hover:bg-amber-50/40 transition group decoration-none">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0" :class="repo?.main_is_pdf ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600'">
                                <i class="fa-solid text-xl" :class="repo?.main_is_pdf ? 'fa-file-pdf' : 'fa-image'"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-black text-slate-800 text-sm" x-text="repo?.main_is_pdf ? 'Documento PDF Oficial' : 'Imagen / Afiche'"></p>
                                <p class="text-xs text-slate-400 font-medium">Clic para leer o previsualizar en una nueva pestaña</p>
                            </div>
                            <i class="fa-solid fa-arrow-up-right-from-square text-slate-300 group-hover:text-amber-500 transition-colors"></i>
                        </a>
                    </div>

                    {{-- 2. Anexos Complementarios --}}
                    <div x-show="repo && repo.attachments.length > 0">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">
                            <i class="fa-solid fa-paperclip mr-1"></i> Anexos Complementarios / Requisitos
                            <span class="text-amber-600">(<span x-text="repo?.attachments.length"></span>)</span>
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <template x-for="a in repo.attachments" :key="a.url">
                                <a :href="a.url" target="_blank"
                                   class="flex items-center gap-3 p-3 rounded-xl border border-slate-100 hover:border-slate-300 hover:bg-slate-50 transition group decoration-none">
                                    <div class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0" :class="a.is_pdf ? 'bg-red-50 text-red-500' : 'bg-blue-50 text-blue-500'">
                                        <i class="fa-solid" :class="a.is_pdf ? 'fa-file-pdf' : 'fa-image'"></i>
                                    </div>
                                    <span class="flex-1 text-xs font-bold text-slate-700 truncate" x-text="a.label"></span>
                                    <i class="fa-solid fa-download text-slate-300 group-hover:text-slate-600 transition-colors"></i>
                                </a>
                            </template>
                        </div>
                    </div>

                    {{-- 3. Estado vacío (sin anexos) --}}
                    <div x-show="repo && repo.attachments.length === 0" class="text-center py-4 text-slate-400 text-xs font-semibold border-t border-dashed border-slate-200 pt-5">
                        <i class="fa-regular fa-folder-open mr-1"></i> Este comunicado no tiene anexos complementarios.
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

