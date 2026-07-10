<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-3">
                <div class="p-2.5 bg-gradient-to-br from-amber-500 to-amber-700 rounded-xl text-white shadow-md"><i class="fa-solid fa-handshake-angle text-lg"></i></div>
                <div>
                    <h2 class="font-black text-2xl text-slate-800 tracking-tight leading-none">Coordinaciones Institucionales</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Módulo independiente de mesas de trabajo</p>
                </div>
            </div>
            <a href="{{ route('coordinations.create') }}" class="bg-amber-600 hover:bg-amber-700 text-white font-black text-xs uppercase tracking-wider py-3 px-5 rounded-xl transition-all shadow-md hover:-translate-y-0.5 flex items-center gap-2 justify-center decoration-none">
                <i class="fa-solid fa-circle-plus"></i> Nueva Coordinación
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3500)" x-transition:leave="transition ease-in duration-500 opacity-0" class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl shadow-sm flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-lg"></i>
                    <p class="font-bold text-sm m-0">{{ session('success') }}</p>
                </div>
            @endif

            @if($coordinations->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($coordinations as $c)
                        <div class="bg-white rounded-2xl border border-slate-200 border-l-4 border-l-amber-500 shadow-xs overflow-hidden flex flex-col">
                            <div class="h-32 bg-slate-100 relative overflow-hidden">
                                @if(!empty($c->photos))
                                    <img src="{{ asset('storage/'.$c->photos[0]) }}" loading="lazy" decoding="async" class="w-full h-full object-cover">
                                    <span class="absolute bottom-2 right-2 text-[9px] font-black bg-slate-900/80 text-white px-2 py-0.5 rounded"><i class="fa-solid fa-images mr-1"></i>{{ count($c->photos) }}</span>
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300"><i class="fa-solid fa-handshake text-3xl"></i></div>
                                @endif
                            </div>
                            <div class="p-4 flex-1 flex flex-col">
                                <h4 class="text-sm font-black text-slate-900 leading-snug line-clamp-2 m-0">{{ $c->title }}</h4>
                                <p class="text-[11px] text-slate-400 font-medium line-clamp-2 mt-1 m-0">{{ $c->description }}</p>
                                <div class="mt-2 text-[11px] font-bold text-slate-500"><i class="fa-regular fa-calendar-check text-amber-500 w-4"></i> {{ optional($c->coordination_date)->format('d/m/Y') }}</div>
                                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center gap-2">
                                    <a href="{{ route('coordinations.edit', $c->id) }}" class="flex-1 text-center bg-amber-50 hover:bg-amber-100 text-amber-700 font-black text-[11px] uppercase tracking-wider py-2 rounded-lg transition decoration-none"><i class="fa-solid fa-pen-to-square mr-1"></i> Editar</a>
                                    <form action="{{ route('coordinations.destroy', $c->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta coordinación y sus fotos?');" class="m-0">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-9 h-9 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg border-none cursor-pointer flex items-center justify-center"><i class="fa-solid fa-trash-can text-xs"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white border border-dashed border-slate-200 rounded-2xl p-12 text-center text-slate-400">
                    <i class="fa-solid fa-handshake-angle text-3xl mb-3 block"></i>
                    <p class="text-sm font-black text-slate-600 m-0">No hay coordinaciones registradas</p>
                    <p class="text-xs font-medium mt-1 m-0">Usa "Nueva Coordinación" para registrar una mesa de trabajo con sus evidencias.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
