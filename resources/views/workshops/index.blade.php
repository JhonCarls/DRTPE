<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-3">
                <div class="p-2.5 bg-gradient-to-br from-slate-800 to-slate-950 rounded-xl text-white shadow-md">
                    <i class="fa-solid fa-chalkboard-user text-lg"></i>
                </div>
                <div>
                    <h2 class="font-black text-2xl text-slate-800 tracking-tight leading-none">Talleres y Capacitaciones</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Ciclo de vida: Programado &rarr; Ejecutado</p>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                <a href="{{ route('workshops.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-black text-xs uppercase tracking-wider py-3 px-5 rounded-xl transition-all shadow-md hover:-translate-y-0.5 flex items-center gap-2 justify-center decoration-none">
                    <i class="fa-solid fa-calendar-plus"></i> Programar Evento
                </a>
                <a href="{{ route('workshops.create-executed') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs uppercase tracking-wider py-3 px-5 rounded-xl transition-all shadow-md hover:-translate-y-0.5 flex items-center gap-2 justify-center decoration-none">
                    <i class="fa-solid fa-camera-retro"></i> Registrar Ejecutado
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3500)" x-transition:leave="transition ease-in duration-500 opacity-0" class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl shadow-sm flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-lg"></i>
                    <p class="font-bold text-sm m-0">{{ session('success') }}</p>
                </div>
            @endif

            {{-- ══ PROGRAMADOS / POR HACER ══ --}}
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-sm"><i class="fa-solid fa-calendar-plus text-sm"></i></div>
                    <div>
                        <h3 class="text-lg font-black text-slate-800 m-0">Programados / Por Hacer</h3>
                        <p class="text-xs text-slate-400 font-bold m-0">{{ $programados->count() }} evento(s) en convocatoria</p>
                    </div>
                </div>

                @if($programados->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                        @foreach($programados as $w)
                            <div class="bg-white rounded-2xl border border-slate-200 border-l-4 border-l-indigo-600 shadow-xs overflow-hidden flex flex-col">
                                <div class="h-32 bg-slate-100 relative overflow-hidden">
                                    @if($w->flyer_type === 'image' && $w->flyer_path)
                                        <img src="{{ asset('storage/'.$w->flyer_path) }}" loading="lazy" decoding="async" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300"><i class="fa-solid fa-file-pdf text-3xl"></i></div>
                                    @endif
                                    <span class="absolute top-2 left-2 text-[9px] font-black uppercase tracking-wider px-2 py-0.5 rounded {{ $w->type === 'taller' ? 'bg-indigo-600 text-white' : 'bg-slate-900 text-white' }}">{{ $w->type_label }}</span>
                                    @if($w->publish_as_announcement)
                                        <span class="absolute top-2 right-2 text-[9px] font-black uppercase tracking-wider px-2 py-0.5 rounded bg-red-600 text-white"><i class="fa-solid fa-bullhorn mr-1"></i>En Comunicados</span>
                                    @endif
                                </div>
                                <div class="p-4 flex-1 flex flex-col">
                                    <h4 class="text-sm font-black text-slate-900 leading-snug line-clamp-2 m-0">{{ $w->title }}</h4>
                                    <div class="mt-2 text-[11px] font-bold text-slate-500 space-y-1">
                                        <div><i class="fa-regular fa-calendar text-indigo-500 w-4"></i> {{ optional($w->scheduled_date)->format('d/m/Y') }} @if($w->horario())· <i class="fa-regular fa-clock"></i> {{ $w->horario() }}@endif</div>
                                        @if($w->location)<div class="truncate"><i class="fa-solid fa-location-dot text-indigo-500 w-4"></i> {{ $w->location }}</div>@endif
                                        <div><i class="fa-solid fa-paperclip text-indigo-500 w-4"></i> {{ count($w->attachments ?? []) }} base(s) adjunta(s)</div>
                                    </div>
                                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center gap-2">
                                        <a href="{{ route('workshops.edit', $w->id) }}" class="flex-1 text-center bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-black text-[11px] uppercase tracking-wider py-2 rounded-lg transition decoration-none"><i class="fa-solid fa-pen-to-square mr-1"></i> Gestionar</a>
                                        <form action="{{ route('workshops.destroy', $w->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este evento y sus archivos?');" class="m-0">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="w-9 h-9 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg border-none cursor-pointer flex items-center justify-center"><i class="fa-solid fa-trash-can text-xs"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white border border-dashed border-slate-200 rounded-2xl p-8 text-center text-slate-400">
                        <i class="fa-regular fa-calendar text-2xl mb-2 block"></i>
                        <p class="text-xs font-bold m-0">No hay eventos programados. Usa "Programar Evento" para lanzar una convocatoria.</p>
                    </div>
                @endif
            </section>

            {{-- ══ EJECUTADOS / HECHOS ══ --}}
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 bg-emerald-600 rounded-xl flex items-center justify-center text-white shadow-sm"><i class="fa-solid fa-circle-check text-sm"></i></div>
                    <div>
                        <h3 class="text-lg font-black text-slate-800 m-0">Ejecutados / Hechos</h3>
                        <p class="text-xs text-slate-400 font-bold m-0">{{ $ejecutados->count() }} evento(s) con evidencias</p>
                    </div>
                </div>

                @if($ejecutados->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                        @foreach($ejecutados as $w)
                            <div class="bg-white rounded-2xl border border-slate-200 border-l-4 border-l-emerald-500 shadow-xs overflow-hidden flex flex-col">
                                <div class="h-32 bg-slate-100 relative overflow-hidden">
                                    @if(!empty($w->photos))
                                        <img src="{{ asset('storage/'.$w->photos[0]) }}" loading="lazy" decoding="async" class="w-full h-full object-cover">
                                        <span class="absolute bottom-2 right-2 text-[9px] font-black bg-slate-900/80 text-white px-2 py-0.5 rounded"><i class="fa-solid fa-images mr-1"></i>{{ count($w->photos) }}</span>
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300"><i class="fa-solid fa-image text-3xl"></i></div>
                                    @endif
                                    <span class="absolute top-2 left-2 text-[9px] font-black uppercase tracking-wider px-2 py-0.5 rounded {{ $w->type === 'taller' ? 'bg-indigo-600 text-white' : 'bg-slate-900 text-white' }}">{{ $w->type_label }}</span>
                                </div>
                                <div class="p-4 flex-1 flex flex-col">
                                    <h4 class="text-sm font-black text-slate-900 leading-snug line-clamp-2 m-0">{{ $w->title }}</h4>
                                    <div class="mt-2 text-[11px] font-bold text-slate-500 space-y-1">
                                        <div><i class="fa-regular fa-calendar-check text-emerald-500 w-4"></i> {{ optional($w->executed_date)->format('d/m/Y') }}</div>
                                        <div><i class="fa-solid fa-users text-emerald-500 w-4"></i> {{ number_format($w->attendees_count ?? 0) }} asistentes</div>
                                        @if($w->flyer_path)<div><i class="fa-solid fa-file-lines text-emerald-500 w-4"></i> Con insumos de convocatoria</div>@endif
                                    </div>
                                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center gap-2">
                                        <a href="{{ route('workshops.edit', $w->id) }}" class="flex-1 text-center bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-black text-[11px] uppercase tracking-wider py-2 rounded-lg transition decoration-none"><i class="fa-solid fa-images mr-1"></i> Gestionar</a>
                                        <form action="{{ route('workshops.destroy', $w->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este evento y sus fotos?');" class="m-0">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="w-9 h-9 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg border-none cursor-pointer flex items-center justify-center"><i class="fa-solid fa-trash-can text-xs"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white border border-dashed border-slate-200 rounded-2xl p-8 text-center text-slate-400">
                        <i class="fa-regular fa-folder-open text-2xl mb-2 block"></i>
                        <p class="text-xs font-bold m-0">Aún no hay eventos ejecutados. Regístralos directamente o marca un programado como ejecutado al editarlo.</p>
                    </div>
                @endif
            </section>

        </div>
    </div>
</x-app-layout>
