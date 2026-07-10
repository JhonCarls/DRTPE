<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2.5 bg-gradient-to-br from-emerald-600 to-emerald-800 rounded-xl text-white shadow-md"><i class="fa-solid fa-camera-retro text-lg"></i></div>
            <div>
                <h2 class="font-black text-2xl text-slate-800 tracking-tight leading-none">Registrar Evento Ejecutado</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Registro directo con evidencias (sin convocatoria previa)</p>
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

                <form action="{{ route('workshops.executed') }}" method="POST" enctype="multipart/form-data" class="space-y-5" x-data="workshopEvidenceGallery()">
                    @csrf

                    <div class="space-y-1.5">
                        <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Título del Evento</label>
                        <input type="text" name="title" required value="{{ old('title') }}" placeholder="Ej. Capacitación en Formalización Laboral - Juliaca"
                               class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-emerald-500 focus:bg-white transition-all">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Tipo</label>
                            <select name="type" required class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-black text-slate-700 focus:outline-none focus:border-emerald-500 focus:bg-white transition-all cursor-pointer">
                                <option value="capacitacion" {{ old('type') === 'capacitacion' ? 'selected' : '' }}>📚 Capacitación</option>
                                <option value="taller" {{ old('type') === 'taller' ? 'selected' : '' }}>🛠️ Taller</option>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Fecha de Ejecución</label>
                            <input type="date" name="executed_date" required value="{{ old('executed_date') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-emerald-500 focus:bg-white transition-all">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-black uppercase text-slate-500 tracking-wider">N° Asistentes</label>
                            <input type="number" name="attendees_count" min="0" value="{{ old('attendees_count') }}" placeholder="Ej. 60" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-emerald-500 focus:bg-white transition-all">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Descripción y Logros</label>
                        <textarea name="description" required rows="4" placeholder="Temas tratados, resultados, impacto..." class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-emerald-500 focus:bg-white transition-all resize-none">{{ old('description') }}</textarea>
                    </div>

                    {{-- Galería de evidencias --}}
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Galería de Evidencias <span class="text-red-500">*</span></label>
                            <span class="text-[10px] font-mono font-black px-2 py-0.5 rounded border" :class="images.length ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-slate-50 text-slate-500 border-slate-200'"><span x-text="images.length"></span> fotos</span>
                        </div>
                        <input type="file" name="photos[]" multiple accept="image/jpeg,image/png,image/jpg,image/webp" class="hidden" x-ref="input" @change="add($event)">
                        <div @click="$refs.input.click()" class="border-2 border-dashed border-slate-200 hover:border-emerald-400 rounded-xl p-6 text-center bg-slate-50/50 hover:bg-slate-50 transition-colors cursor-pointer">
                            <i class="fa-solid fa-cloud-arrow-up text-emerald-500 text-xl mb-1"></i>
                            <p class="text-xs font-black text-slate-600 m-0">Presione para añadir fotografías del evento</p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider m-0">JPG, PNG, WEBP (máx. 5MB c/u)</p>
                        </div>
                        <template x-if="images.length">
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                <template x-for="(img, i) in images" :key="i">
                                    <div class="relative group aspect-square rounded-xl overflow-hidden border border-slate-200 bg-white">
                                        <img :src="img.url" class="w-full h-full object-cover">
                                        <button type="button" @click="remove(i)" class="absolute top-1.5 right-1.5 w-6 h-6 bg-red-600/90 text-white rounded-lg opacity-0 group-hover:opacity-100 transition border-none cursor-pointer flex items-center justify-center"><i class="fa-solid fa-trash-can text-[9px]"></i></button>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex justify-end gap-2">
                        <a href="{{ route('workshops.index') }}" class="px-5 py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 font-black text-xs uppercase tracking-wider transition decoration-none">Cancelar</a>
                        <button type="submit" :disabled="images.length === 0" class="px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 disabled:bg-slate-300 disabled:cursor-not-allowed text-white font-black text-xs uppercase tracking-wider shadow-md transition border-none cursor-pointer"><i class="fa-solid fa-floppy-disk mr-1"></i> Guardar Ejecutado</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('workshopEvidenceGallery', () => ({
                images: [],
                add(e) {
                    Array.from(e.target.files).forEach(file => {
                        if (!this.images.some(i => i.file.name === file.name && i.file.size === file.size)) {
                            this.images.push({ file, url: URL.createObjectURL(file) });
                        }
                    });
                    this.sync();
                },
                remove(i) {
                    URL.revokeObjectURL(this.images[i].url);
                    this.images.splice(i, 1);
                    this.sync();
                },
                sync() {
                    const dt = new DataTransfer();
                    this.images.forEach(i => dt.items.add(i.file));
                    this.$refs.input.files = dt.files;
                }
            }));
        });
    </script>
</x-app-layout>
