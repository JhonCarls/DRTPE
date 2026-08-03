<x-branch-layout>
    <div class="max-w-4xl mx-auto space-y-6" x-data="activityFormGallery()">
        
        {{-- CABECERA INSTITUCIONAL --}}
        <div class="flex items-center justify-between bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 bg-gradient-to-br from-red-600 to-red-700 rounded-xl flex items-center justify-center text-white shadow-sm">
                    <i class="fa-solid fa-cloud-arrow-up text-sm"></i>
                </div>
                <div>
                    <h1 class="text-xl font-black text-slate-900 tracking-tight m-0">Publicar Nueva Actividad</h1>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mt-0.5 m-0">Formulario Operativo de Sede</p>
                </div>
            </div>
            <a href="{{ route('branch-activities.index') }}" class="bg-slate-50 hover:bg-slate-100 text-slate-700 font-bold text-xs py-2 px-4 rounded-xl border border-slate-200 transition decoration-none focus-ring">
                Cancelar
            </a>
        </div>

        {{-- CUERPO DEL FORMULARIO --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm">
            <form action="{{ route('branch-activities.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 m-0">
                @csrf

                {{-- PANEL DE ALERTAS BACKEND --}}
                @if ($errors->any())
                    <div class="p-4 bg-red-50 border border-red-200 text-red-700 text-[11px] font-bold rounded-xl space-y-1 shadow-xs">
                        <p class="font-black uppercase tracking-wider m-0"><i class="fa-solid fa-triangle-exclamation"></i> Alerta de Validación</p>
                        <ul class="list-disc pl-4 space-y-0.5 font-medium m-0 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Título --}}
                <div class="space-y-1.5">
                    <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Título de la Intervención</label>
                    <input type="text" name="title" required value="{{ old('title') }}" placeholder="Ej. Asesoría y Orientación Laboral Itinerante"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-red-500 focus:bg-white transition-all shadow-inner">
                </div>

                {{-- Descripción --}}
                <div class="space-y-1.5">
                    <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Descripción y Resumen de Logros</label>
                    <textarea name="description" required rows="4" placeholder="Escriba detalladamente las acciones realizadas, acuerdos y alcances..."
                              class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-red-500 focus:bg-white transition-all resize-none shadow-inner">{{ old('description') }}</textarea>
                </div>

                {{-- FILA MIXTA DUAL: TIPO DE ACTIVIDAD Y COBERTURA --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 items-start">
                    
                    {{-- Tipo de Intervención --}}
                    <div class="space-y-1.5">
                        <label for="intervention_type" class="text-xs font-black uppercase text-slate-500 tracking-wider">Tipo de Intervención</label>
                        <div class="relative">
                            <select id="intervention_type" name="intervention_type" required 
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-black text-slate-700 focus:outline-none focus:border-red-500 focus:bg-white transition-all cursor-pointer appearance-none shadow-inner">
                                <option value="" disabled {{ old('intervention_type') ? '' : 'selected' }}>-- Seleccione el Tipo --</option>
                                <option value="feria" {{ old('intervention_type') == 'feria' ? 'selected' : '' }}>🎪 Ferias Laborales</option>
                                <option value="capacitacion" {{ old('intervention_type') == 'capacitacion' ? 'selected' : '' }}>📚 Capacitaciones / Talleres</option>
                                <option value="asesoria" {{ old('intervention_type') == 'asesoria' ? 'selected' : '' }}>💼 Asesorías Especializadas</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400 text-xs">
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Asistentes --}}
                    <div class="space-y-1.5">
                        <label for="attendees_count" class="text-xs font-black uppercase text-slate-500 tracking-wider">N° de Personas Atendidas <span class="text-slate-400 lowercase font-medium">(Opcional)</span></label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400"><i class="fa-solid fa-users text-xs"></i></span>
                            <input type="number" id="attendees_count" name="attendees_count" min="0" value="{{ old('attendees_count') }}" placeholder="Ej. 45"
                                   class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 pl-9 pr-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-red-500 focus:bg-white transition-all shadow-inner">
                        </div>
                    </div>
                </div>

                <div class="h-px bg-slate-100 my-2"></div>

                {{-- ZONA DE CARGA Y PREVISUALIZACIÓN MULTIMEDIA --}}
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-wider">Evidencia Fotográfica Múltiple <span class="text-red-500">*</span></label>
                        <span class="text-[10px] font-mono font-black px-2 py-0.5 rounded border shadow-inner" 
                              :class="imageFiles.length > 0 ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-slate-50 text-slate-500 border-slate-200'">
                            <span x-text="imageFiles.length"></span> Archivos
                        </span>
                    </div>

                    {{-- Input Físico Oculto --}}
                    <input type="file" name="photos[]" multiple accept="image/jpeg,image/png,image/jpg,image/webp" 
                           class="hidden" x-ref="photoInput" @change="handleFileSelect($event)">

                    {{-- Botón Estilizado Dropzone --}}
                    <div @click="$refs.photoInput.click()" 
                         class="border-2 border-dashed border-slate-200 hover:border-red-400/60 rounded-xl p-6 text-center bg-slate-50/50 hover:bg-slate-50 transition-colors cursor-pointer group">
                        <div class="space-y-2">
                            <div class="w-10 h-10 bg-white border border-slate-200 rounded-lg flex items-center justify-center mx-auto text-slate-400 group-hover:text-red-500 transition-colors shadow-sm">
                                <i class="fa-solid fa-cloud-arrow-up text-base"></i>
                            </div>
                            <p class="text-xs font-black text-slate-600 m-0">Presione aquí para añadir fotografías</p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider m-0">Formatos permitidos: JPG, PNG, WEBP (Máx. 3MB c/u)</p>
                        </div>
                    </div>

                    {{-- Galería de Previsualización (Aparece al seleccionar imágenes) --}}
                    <template x-if="imageFiles.length > 0">
                        <div class="bg-slate-50 border border-slate-200/70 rounded-xl p-4 shadow-inner">
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                <template x-for="(image, index) in imageFiles" :key="index">
                                    <div class="relative group aspect-square rounded-xl overflow-hidden border border-slate-200 shadow-xs bg-white">
                                        {{-- Imagen --}}
                                        <img :src="image.url" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                        
                                        {{-- Overlay con información --}}
                                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 to-transparent p-2 pt-6">
                                            <p class="text-[9px] text-white font-mono font-bold truncate m-0 leading-tight" x-text="image.name"></p>
                                            <p class="text-[8px] text-slate-300 font-bold m-0 leading-tight" x-text="image.size"></p>
                                        </div>

                                        {{-- Botón de Eliminar --}}
                                        <button type="button" @click="removeImage(index)" 
                                                class="absolute top-2 right-2 w-7 h-7 bg-red-600/90 hover:bg-red-600 text-white rounded-lg flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-200 border-none cursor-pointer shadow-md">
                                            <i class="fa-solid fa-trash-can text-[10px]"></i>
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>

                {{-- Difusión en redes de la intervención --}}
                <div class="pt-2">
                    <x-video-input label="Videos de la Actividad"
                                   help="Opcional: enlaces de TikTok, Facebook o YouTube. También puedes agregarlos después desde la edición." />
                </div>

                {{-- Botón de Envío --}}
                <div class="pt-5 border-t border-slate-100 flex justify-end">
                    <button type="submit" :disabled="imageFiles.length === 0" class="w-full sm:w-auto bg-red-600 hover:bg-red-700 disabled:bg-slate-300 disabled:cursor-not-allowed text-white font-black text-xs uppercase tracking-wider py-3.5 px-8 rounded-xl shadow-md transition-all border-none cursor-pointer flex items-center justify-center gap-2">
                        <i class="fa-solid fa-paper-plane"></i> Publicar Actividad de Sede
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- SCRIPTS ALPINE.JS --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('activityFormGallery', () => ({
                imageFiles: [],

                handleFileSelect(event) {
                    const files = Array.from(event.target.files);
                    
                    files.forEach(file => {
                        // Evitar duplicados por nombre y peso
                        const exists = this.imageFiles.some(img => img.file.name === file.name && img.file.size === file.size);
                        
                        if (!exists) {
                            this.imageFiles.push({
                                file: file,
                                url: URL.createObjectURL(file), // Genera previsualización en el navegador
                                name: file.name,
                                size: (file.size / (1024 * 1024)).toFixed(2) + ' MB'
                            });
                        }
                    });

                    this.syncInputFiles();
                },

                removeImage(index) {
                    // Limpiar memoria del navegador
                    URL.revokeObjectURL(this.imageFiles[index].url);
                    
                    // Remover del array
                    this.imageFiles.splice(index, 1);
                    
                    // Sincronizar nuevamente con el input real
                    this.syncInputFiles();
                },

                syncInputFiles() {
                    // Creamos un nuevo objeto DataTransfer para reconstruir la lista de archivos
                    const dataTransfer = new DataTransfer();
                    
                    this.imageFiles.forEach(img => {
                        dataTransfer.items.add(img.file);
                    });

                    // Asignamos los archivos validados al input original del formulario
                    this.$refs.photoInput.files = dataTransfer.files;
                }
            }));
        });
    </script>
</x-branch-layout>