<x-branch-layout>
    <div class="max-w-3xl mx-auto space-y-6">
        
        {{-- CABECERA --}}
        <div class="flex items-center justify-between bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 bg-gradient-to-br from-red-600 to-red-700 rounded-xl flex items-center justify-center text-white shadow-sm">
                    <i class="fa-solid fa-cloud-arrow-up text-sm"></i>
                </div>
                <div>
                    <h1 class="text-xl font-black text-slate-900 tracking-tight m-0">Publicar Nueva Actividad</h1>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mt-0.5">Formulario Simplificado de Sede</p>
                </div>
            </div>
            <a href="{{ route('branch-activities.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs py-2 px-3.5 rounded-xl border border-slate-250 transition decoration-none">
                Cancelar
            </a>
        </div>

        {{-- FORMULARIO --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm">
            <form action="{{ route('branch-activities.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div class="space-y-1.5">
                    <label for="title" class="text-xs font-black uppercase text-slate-500 tracking-wider">Título de la Intervención</label>
                    <input type="text" id="title" name="title" required value="{{ old('title') }}" placeholder="Ej. Asesoría y Orientación Laboral Itinerante"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                    @error('title') <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1.5">
                    <label for="description" class="text-xs font-black uppercase text-slate-500 tracking-wider">Descripción y Resumen de Logros</label>
                    <textarea id="description" name="description" required rows="5" placeholder="Escriba los detalles de las acciones realizadas..."
                              class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-red-500 focus:bg-white transition-all resize-none"></textarea>
                    @error('description') <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 items-start">
                    <div class="space-y-1.5">
                        <label for="attendees_count" class="text-xs font-black uppercase text-slate-500 tracking-wider">N° de Personas <span class="text-slate-400 lowercase font-medium">(Opcional)</span></label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400"><i class="fa-solid fa-users text-xs"></i></span>
                            <input type="number" id="attendees_count" name="attendees_count" min="0" value="{{ old('attendees_count') }}" placeholder="Ej. 45"
                                   class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 pl-9 pr-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                        </div>
                    </div>

                    <div class="md:col-span-2 space-y-1.5">
                        <label for="photos" class="text-xs font-black uppercase text-slate-500 tracking-wider">Evidencia Fotográfica Múltiple</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400"><i class="fa-solid fa-images text-xs"></i></span>
                            <input type="file" id="photos" name="photos[]" required multiple accept="image/*"
                                   class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 pl-10 pr-4 text-sm font-semibold text-slate-500 file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-[11px] file:font-black file:uppercase file:bg-red-50 file:text-red-700 hover:file:bg-red-100 cursor-pointer">
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-end">
                    <button type="submit" class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-black text-xs uppercase tracking-wider py-3 px-6 rounded-xl shadow-md hover:shadow-red-600/20 transition-all border-none cursor-pointer">
                        <i class="fa-solid fa-paper-plane mr-1.5"></i> Publicar Actividad de Sede
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-branch-layout>