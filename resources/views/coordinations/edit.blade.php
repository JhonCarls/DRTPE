<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2.5 bg-gradient-to-br from-amber-500 to-amber-700 rounded-xl text-white shadow-md"><i class="fa-solid fa-pen-to-square text-lg"></i></div>
            <div>
                <h2 class="font-black text-2xl text-slate-800 tracking-tight leading-none">Editar Coordinación</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Actualizar datos y evidencias</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-md p-6 sm:p-8">

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 text-xs font-bold rounded-xl">
                        <ul class="list-disc pl-4 space-y-0.5 m-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif

                <form action="{{ route('coordinations.update', $coordination->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf @method('PUT')

                    <div class="space-y-1.5">
                        <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Título de la Coordinación</label>
                        <input type="text" name="title" required value="{{ old('title', $coordination->title) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Fecha de Coordinación <span class="text-slate-400 lowercase font-medium">(sin hora)</span></label>
                        <input type="date" name="coordination_date" required value="{{ old('coordination_date', optional($coordination->coordination_date)->format('Y-m-d')) }}" class="w-full sm:w-64 bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Descripción y Acuerdos</label>
                        <textarea name="description" required rows="4" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-amber-500 focus:bg-white transition-all resize-none">{{ old('description', $coordination->description) }}</textarea>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Añadir Fotos <span class="text-slate-400 lowercase font-medium">(se acumulan a las existentes)</span></label>
                        <input type="file" name="photos[]" multiple accept="image/*" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-4 text-xs font-semibold text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-black file:uppercase file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 cursor-pointer">
                    </div>

                    @if(!empty($coordination->photos))
                        <div>
                            <p class="text-[10px] font-black uppercase text-slate-400 tracking-wider m-0 mb-2">Evidencias actuales ({{ count($coordination->photos) }})</p>
                            <div class="grid grid-cols-4 sm:grid-cols-6 gap-2">
                                @foreach($coordination->photos as $p)
                                    <div class="aspect-square rounded-lg overflow-hidden border border-slate-200 bg-white"><img src="{{ asset('storage/'.$p) }}" loading="lazy" class="w-full h-full object-cover"></div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="pt-4 border-t border-slate-100 flex justify-end gap-2">
                        <a href="{{ route('coordinations.index') }}" class="px-5 py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 font-black text-xs uppercase tracking-wider transition decoration-none">Cancelar</a>
                        <button type="submit" class="px-6 py-3 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-black text-xs uppercase tracking-wider shadow-md transition border-none cursor-pointer"><i class="fa-solid fa-floppy-disk mr-1"></i> Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
