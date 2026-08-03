<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2.5 bg-gradient-to-br from-indigo-600 to-indigo-800 rounded-xl text-white shadow-md"><i class="fa-solid fa-calendar-plus text-lg"></i></div>
            <div>
                <h2 class="font-black text-2xl text-slate-800 tracking-tight leading-none">Programar Taller / Capacitación</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Fase de Convocatoria (Por Hacer)</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-md p-6 sm:p-8">

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 text-xs font-bold rounded-xl">
                        <p class="font-black uppercase tracking-wider m-0 mb-1"><i class="fa-solid fa-triangle-exclamation"></i> Revise los siguientes campos</p>
                        <ul class="list-disc pl-4 space-y-0.5 m-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif

                <form action="{{ route('workshops.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5" x-data="{ flyer: '', attachments: 0 }">
                    @csrf

                    <div class="space-y-1.5">
                        <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Título del Evento</label>
                        <input type="text" name="title" required value="{{ old('title') }}" placeholder="Ej. Taller de Derechos Laborales Fundamentales"
                               class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Tipo</label>
                            <select name="type" required class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-black text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all cursor-pointer">
                                <option value="capacitacion" {{ old('type') === 'capacitacion' ? 'selected' : '' }}>📚 Capacitación</option>
                                <option value="taller" {{ old('type') === 'taller' ? 'selected' : '' }}>🛠️ Taller</option>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Fecha Programada</label>
                            <input type="date" name="scheduled_date" required value="{{ old('scheduled_date') }}"
                                   class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Hora Inicio</label>
                            <input type="time" name="start_time" value="{{ old('start_time') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Hora Fin</label>
                            <input type="time" name="end_time" value="{{ old('end_time') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Lugar <span class="text-slate-400 lowercase font-medium">(opcional)</span></label>
                            <input type="text" name="location" value="{{ old('location') }}" placeholder="Auditorio DRTPE" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Descripción / Resumen</label>
                        <textarea name="description" required rows="4" placeholder="Objetivos, público dirigido, temario..." class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all resize-none">{{ old('description') }}</textarea>
                    </div>

                    {{-- Flyer promocional --}}
                    <div class="space-y-1.5">
                        <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Flyer Promocional <span class="text-red-500">*</span> <span class="text-slate-400 lowercase font-medium">(JPG, PNG, WEBP o PDF)</span></label>
                        <input type="file" name="flyer" required accept=".pdf,image/*" @change="flyer = $event.target.files[0]?.name || ''"
                               class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-4 text-xs font-semibold text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-black file:uppercase file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                        <p class="text-[11px] text-indigo-600 font-bold m-0" x-show="flyer" x-text="'Seleccionado: ' + flyer"></p>
                    </div>

                    {{-- Bases / documentos adjuntos --}}
                    <div class="space-y-1.5">
                        <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Bases / Documentos Adjuntos <span class="text-slate-400 lowercase font-medium">(opcional, máx. 6)</span></label>
                        <input type="file" name="attachments[]" multiple accept=".pdf,image/*" @change="attachments = $event.target.files.length"
                               class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-4 text-xs font-semibold text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-black file:uppercase file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer">
                        <p class="text-[11px] text-slate-500 font-bold m-0" x-show="attachments > 0" x-text="attachments + ' archivo(s) adjunto(s)'"></p>
                    </div>

                    {{-- Spot promocional de la convocatoria en redes sociales --}}
                    <x-video-input label="Video Promocional de la Convocatoria"
                                   help="Reel de TikTok, video de Facebook o spot de YouTube que anuncia el evento. Puedes agregarlo después." />

                    {{-- Sincronización automática con comunicados --}}
                    <label class="flex items-start gap-3 p-4 bg-red-50/50 border border-red-100 rounded-xl cursor-pointer">
                        <input type="checkbox" name="publish_as_announcement" value="1" {{ old('publish_as_announcement') ? 'checked' : '' }} class="mt-0.5 w-4 h-4 accent-red-600">
                        <span class="text-xs font-bold text-slate-700 leading-relaxed">
                            <span class="text-red-700 font-black"><i class="fa-solid fa-bullhorn mr-1"></i>Publicar automáticamente como Comunicado Oficial.</span>
                            Se creará un comunicado institucional con el flyer y las bases, vigente hasta la fecha del evento.
                        </span>
                    </label>

                    <div class="pt-4 border-t border-slate-100 flex justify-end gap-2">
                        <a href="{{ route('workshops.index') }}" class="px-5 py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 font-black text-xs uppercase tracking-wider transition decoration-none">Cancelar</a>
                        <button type="submit" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-black text-xs uppercase tracking-wider shadow-md transition border-none cursor-pointer"><i class="fa-solid fa-paper-plane mr-1"></i> Programar y Publicar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
