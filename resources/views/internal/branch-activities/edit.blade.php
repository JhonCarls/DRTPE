<x-branch-layout>
    <div class="max-w-3xl mx-auto space-y-6">
        
        <div class="flex items-center justify-between bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-xl flex items-center justify-center text-white shadow-sm">
                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                </div>
                <div>
                    <h1 class="text-xl font-black text-slate-900 tracking-tight m-0">Modificar Actividad Operativa</h1>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mt-0.5">Editando Registro de Sede</p>
                </div>
            </div>
            <a href="{{ route('branch-activities.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs py-2.5 px-4 rounded-xl border border-slate-250 transition decoration-none">
                Cancelar
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm">
            <form action="{{ route('branch-activities.update', $activity->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="space-y-1.5">
                    <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Título de la Actividad</label>
                    <input type="text" name="title" required value="{{ old('title', $activity->title) }}"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Descripción y Resumen de Logros</label>
                    <textarea name="description" required rows="5"
                              class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all resize-none">{{ old('description', $activity->description) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 items-start">
                    <div class="space-y-1.5">
                        <label class="text-xs font-black uppercase text-slate-500 tracking-wider">N° de Personas</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400"><i class="fa-solid fa-users text-xs"></i></span>
                            <input type="number" name="attendees_count" min="0" value="{{ old('attendees_count', $activity->attendees_count) }}"
                                   class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 pl-9 pr-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                        </div>
                    </div>

                    <div class="md:col-span-2 space-y-1.5">
                        <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Subir Nuevas Fotos <span class="text-slate-400 lowercase font-medium">(Reemplazará las actuales)</span></label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400"><i class="fa-solid fa-images text-xs"></i></span>
                            <input type="file" name="photos[]" multiple accept="image/*"
                                   class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 pl-10 pr-4 text-sm font-semibold text-slate-500 file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-[11px] file:font-black file:uppercase file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                        </div>
                    </div>
                </div>

                <div class="space-y-2 pt-2">
                    <p class="text-[10px] font-black uppercase text-slate-400 tracking-wider m-0 px-1">Imágenes Almacenadas Activas:</p>
                    <div class="grid grid-cols-4 sm:grid-cols-6 gap-3 bg-slate-50 p-3 rounded-xl border border-slate-200">
                        @foreach($activity->photos as $path)
                            <div class="aspect-square bg-white rounded-lg overflow-hidden border border-slate-200 shadow-xs">
                                <img src="{{ asset('storage/' . $path) }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end">
                    <button type="submit" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-black text-xs uppercase tracking-wider py-3 px-6 rounded-xl shadow-md transition-all border-none cursor-pointer">
                        <i class="fa-solid fa-floppy-disk mr-1.5"></i> Actualizar Cambios
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-branch-layout>