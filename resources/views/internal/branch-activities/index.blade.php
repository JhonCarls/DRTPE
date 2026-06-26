<x-branch-layout>
    <div class="space-y-6">
        
        {{-- CABECERA INTERNA --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
            <div>
                <span class="text-[10px] font-black text-red-600 uppercase tracking-widest block mb-1">Módulo de Transparencia</span>
                <h1 class="font-black text-2xl text-slate-900 leading-none">Registro Histórico de Actividades</h1>
                <p class="text-xs font-medium text-slate-400 mt-1">Evidencias físicas cargadas para la Sede {{ ucfirst(auth()->user()->sede) }}</p>
            </div>
            <a href="{{ route('branch-activities.create') }}" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-black text-xs uppercase tracking-wider py-3 px-5 rounded-xl shadow-md hover:shadow-red-600/20 transition-all decoration-none border-none cursor-pointer">
                <i class="fa-solid fa-circle-plus"></i> Nueva Actividad
            </a>
        </div>

        {{-- ALERTAS DE ÉXITO --}}
        @if(session('success'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-2xl shadow-xs flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-emerald-500 text-lg"></i>
                <p class="text-emerald-800 font-bold text-xs m-0">{{ session('success') }}</p>
            </div>
        @endif

        {{-- TABLA DE DATOS CRUDS --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
            @if($activities->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm font-medium">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-slate-400 text-[10px] font-black uppercase tracking-wider">
                                <th class="py-3.5 px-4 w-24">Miniatura</th>
                                <th class="py-3.5 px-4">Actividad / Título</th>
                                <th class="py-3.5 px-4 w-32 text-center">Fecha de Registro</th>
                                <th class="py-3.5 px-4 w-28 text-center">Beneficiarios</th>
                                <th class="py-3.5 px-4 w-28 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @foreach($activities as $act)
                                <tr class="hover:bg-slate-50/40 transition-colors">
                                    <td class="py-3 px-4">
                                        <div class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-200 overflow-hidden flex items-center justify-center shadow-xs">
                                            @if(isset($act->photos[0]))
                                                <img src="{{ asset('storage/' . $act->photos[0]) }}" class="w-full h-full object-cover">
                                            @else
                                                <i class="fa-solid fa-image text-slate-300 text-sm"></i>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">
                                        <h4 class="text-sm font-black text-slate-900 m-0 leading-snug">{{ $act->title }}</h4>
                                        <p class="text-xs text-slate-400 line-clamp-1 mt-0.5 m-0 font-medium">{{ $act->description }}</p>
                                    </td>
                                    <td class="py-3 px-4 text-center text-xs font-bold text-slate-500 whitespace-nowrap">
                                        {{ $act->created_at->format('d/m/Y h:i A') }}
                                    </td>
                                    <td class="py-3 px-4 text-center font-black text-slate-900">
                                        {{ $act->attendees_count ?? '—' }}
                                    </td>
                                    <td class="py-3 px-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('branch-activities.edit', $act->id) }}" class="w-8 h-8 bg-slate-50 hover:bg-indigo-50 border border-slate-200 text-slate-500 hover:text-indigo-600 rounded-lg flex items-center justify-center transition-colors decoration-none" title="Editar Registro">
                                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                                            </a>
                                            <form action="{{ route('branch-activities.destroy', $act->id) }}" method="POST" onsubmit="return confirm('¿Eliminar actividad de forma permanente?');" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-8 h-8 bg-slate-50 hover:bg-red-50 border border-slate-200 text-slate-400 hover:text-red-600 rounded-lg flex items-center justify-center transition-colors border-none cursor-pointer">
                                                    <i class="fa-solid fa-trash text-xs"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-16 text-center text-slate-400 space-y-2">
                    <div class="w-12 h-12 bg-slate-50 border border-slate-200 rounded-xl flex items-center justify-center mx-auto text-slate-400"><i class="fa-solid fa-folder-open text-base"></i></div>
                    <h4 class="text-sm font-black text-slate-800 m-0">No se encontraron actividades registradas</h4>
                    <p class="text-xs text-slate-400 font-semibold m-0">Presione el botón "Nueva Actividad" superior para comenzar a subir evidencias.</p>
                </div>
            @endif
        </div>
        
    </div>
</x-branch-layout>