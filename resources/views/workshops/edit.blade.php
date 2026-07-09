<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2.5 bg-gradient-to-br from-slate-700 to-slate-900 rounded-xl text-white shadow-md"><i class="fa-solid fa-pen-to-square text-lg"></i></div>
            <div>
                <h2 class="font-black text-2xl text-slate-800 tracking-tight leading-none">Gestionar Evento</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">
                    Estado actual:
                    @if($workshop->status === 'programado')
                        <span class="text-indigo-600">Programado</span>
                    @else
                        <span class="text-emerald-600">Ejecutado</span>
                    @endif
                </p>
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

                <form action="{{ route('workshops.update', $workshop->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5"
                      x-data="{ markExecuted: {{ $workshop->status === 'ejecutado' ? 'true' : 'false' }} }">
                    @csrf @method('PUT')

                    <div class="space-y-1.5">
                        <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Título</label>
                        <input type="text" name="title" required value="{{ old('title', $workshop->title) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Tipo</label>
                            <select name="type" required class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-black text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all cursor-pointer">
                                <option value="capacitacion" {{ old('type', $workshop->type) === 'capacitacion' ? 'selected' : '' }}>📚 Capacitación</option>
                                <option value="taller" {{ old('type', $workshop->type) === 'taller' ? 'selected' : '' }}>🛠️ Taller</option>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Fecha Programada</label>
                            <input type="date" name="scheduled_date" value="{{ old('scheduled_date', optional($workshop->scheduled_date)->format('Y-m-d')) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Hora Inicio</label>
                            <input type="time" name="start_time" value="{{ old('start_time', substr((string)$workshop->start_time,0,5)) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Hora Fin</label>
                            <input type="time" name="end_time" value="{{ old('end_time', substr((string)$workshop->end_time,0,5)) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Lugar</label>
                            <input type="text" name="location" value="{{ old('location', $workshop->location) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Descripción</label>
                        <textarea name="description" required rows="4" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all resize-none">{{ old('description', $workshop->description) }}</textarea>
                    </div>

                    {{-- INSUMOS DE CONVOCATORIA --}}
                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 space-y-4">
                        <p class="text-[11px] font-black uppercase text-slate-400 tracking-widest m-0"><i class="fa-solid fa-bullhorn mr-1"></i> Insumos de Convocatoria</p>

                        @if($workshop->flyer_path)
                            <div class="flex items-center gap-2 text-[11px] font-bold text-slate-600"><i class="fa-solid {{ $workshop->flyer_type === 'pdf' ? 'fa-file-pdf text-red-500' : 'fa-image text-blue-500' }}"></i> Flyer actual cargado · <a href="{{ asset('storage/'.$workshop->flyer_path) }}" target="_blank" class="text-indigo-600 font-black decoration-none">Ver</a></div>
                        @endif
                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-slate-500">Reemplazar Flyer (opcional)</label>
                            <input type="file" name="flyer" accept=".pdf,image/*" class="w-full bg-white border border-slate-200 rounded-xl py-2 px-3 text-xs font-semibold text-slate-500 file:mr-3 file:py-1 file:px-2 file:rounded file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-indigo-50 file:text-indigo-700 cursor-pointer">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-slate-500">Añadir Bases / Documentos ({{ count($workshop->attachments ?? []) }} actuales)</label>
                            <input type="file" name="attachments[]" multiple accept=".pdf,image/*" class="w-full bg-white border border-slate-200 rounded-xl py-2 px-3 text-xs font-semibold text-slate-500 file:mr-3 file:py-1 file:px-2 file:rounded file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-slate-100 file:text-slate-700 cursor-pointer">
                        </div>
                        <label class="flex items-center gap-2 text-xs font-bold text-slate-600 cursor-pointer">
                            <input type="checkbox" name="publish_as_announcement" value="1" {{ old('publish_as_announcement', $workshop->publish_as_announcement) ? 'checked' : '' }} class="w-4 h-4 accent-red-600">
                            <span><i class="fa-solid fa-bullhorn text-red-500 mr-1"></i>Mantener publicado como Comunicado Oficial</span>
                        </label>
                    </div>

                    {{-- CIERRE / EJECUCIÓN --}}
                    <div class="bg-emerald-50/50 border border-emerald-100 rounded-xl p-4 space-y-4">
                        <label class="flex items-center gap-2 text-sm font-black text-emerald-800 cursor-pointer">
                            <input type="checkbox" name="mark_executed" value="1" x-model="markExecuted" {{ $workshop->status === 'ejecutado' ? 'checked' : '' }} class="w-4 h-4 accent-emerald-600">
                            <span><i class="fa-solid fa-circle-check mr-1"></i>Marcar como Ejecutado / Hecho</span>
                        </label>

                        <div x-show="markExecuted" x-transition class="space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-[11px] font-bold text-slate-500">Fecha de Ejecución</label>
                                    <input type="date" name="executed_date" value="{{ old('executed_date', optional($workshop->executed_date)->format('Y-m-d')) }}" class="w-full bg-white border border-slate-200 rounded-xl py-2.5 px-3 text-sm font-semibold text-slate-800 focus:outline-none focus:border-emerald-500 transition-all">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-[11px] font-bold text-slate-500">N° Asistentes</label>
                                    <input type="number" name="attendees_count" min="0" value="{{ old('attendees_count', $workshop->attendees_count) }}" class="w-full bg-white border border-slate-200 rounded-xl py-2.5 px-3 text-sm font-semibold text-slate-800 focus:outline-none focus:border-emerald-500 transition-all">
                                </div>
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-[11px] font-bold text-slate-500">Añadir Fotos de Evidencia</label>
                                <input type="file" name="photos[]" multiple accept="image/*" class="w-full bg-white border border-slate-200 rounded-xl py-2 px-3 text-xs font-semibold text-slate-500 file:mr-3 file:py-1 file:px-2 file:rounded file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-emerald-50 file:text-emerald-700 cursor-pointer">
                            </div>
                        </div>

                        @if(!empty($workshop->photos))
                            <div>
                                <p class="text-[10px] font-black uppercase text-slate-400 tracking-wider m-0 mb-2">Evidencias actuales ({{ count($workshop->photos) }})</p>
                                <div class="grid grid-cols-4 sm:grid-cols-6 gap-2">
                                    @foreach($workshop->photos as $p)
                                        <div class="aspect-square rounded-lg overflow-hidden border border-slate-200 bg-white"><img src="{{ asset('storage/'.$p) }}" loading="lazy" class="w-full h-full object-cover"></div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex justify-end gap-2">
                        <a href="{{ route('workshops.index') }}" class="px-5 py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 font-black text-xs uppercase tracking-wider transition decoration-none">Cancelar</a>
                        <button type="submit" class="px-6 py-3 rounded-xl bg-slate-900 hover:bg-indigo-600 text-white font-black text-xs uppercase tracking-wider shadow-md transition border-none cursor-pointer"><i class="fa-solid fa-floppy-disk mr-1"></i> Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
