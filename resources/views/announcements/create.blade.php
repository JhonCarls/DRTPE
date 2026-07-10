<x-dynamic-component :component="$layout ?? 'branch-layout'">
    <div class="max-w-3xl mx-auto space-y-6 py-2">

        {{-- 1. ENCABEZADO (adaptado al rol: Central o Sede Desconcentrada) --}}
        <div class="flex items-center gap-3 bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
            <div class="p-2.5 bg-gradient-to-br from-slate-800 to-slate-950 rounded-xl text-white shadow-md">
                <i class="fa-solid fa-bullhorn text-lg"></i>
            </div>
            <div>
                <h2 class="font-black text-xl text-slate-800 tracking-tight leading-none">
                    Publicar Nuevo Comunicado
                </h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1.5">
                    {{ ($isCentral ?? false) ? 'Difusión Institucional General (Sede Principal)' : 'Difusión Oficial de Documentos y Acuerdos de Sede' }}
                </p>
            </div>
            <a href="{{ $backUrl ?? route('branch-activities.index') }}" class="ml-auto w-9 h-9 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-400 hover:text-slate-700 flex items-center justify-center transition-colors decoration-none">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
        </div>

        {{-- 2. TU FORMULARIO ORIGINAL CON TODA TU LÓGICA INTEGRAL DE ALPINE.JS --}}
        <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data"
              class="bg-white border border-slate-200 shadow-xs rounded-2xl p-6 sm:p-10 space-y-6"
              x-data="{
                  attachedFiles: [],
                  mainPreviewUrl: null,
                  mainFileType: null,
                  mainFileName: '',
                  mainFileSize: '',
                 
                  handleMainFile(e) {
                      const file = e.target.files[0];
                      if (!file) return;
                      this.mainFileName = file.name;
                      this.mainFileSize = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                      this.mainFileType = file.type.includes('image') ? 'image' : 'pdf';
                      if (this.mainPreviewUrl) URL.revokeObjectURL(this.mainPreviewUrl);
                      this.mainPreviewUrl = URL.createObjectURL(file);
                  },

                  addAttachments(e) {
                      const selectedFiles = Array.from(e.target.files);
                      selectedFiles.forEach(file => {
                          const isDuplicate = this.attachedFiles.some(f => f.name === file.name && f.size === file.size);
                          if (!isDuplicate && this.attachedFiles.length < 6) {
                              this.attachedFiles.push(file);
                          }
                      });
                      this.syncInputFiles();
                  },

                  removeAttachment(index) {
                      this.attachedFiles.splice(index, 1);
                      this.syncInputFiles();
                  },

                  syncInputFiles() {
                      const dt = new DataTransfer();
                      this.attachedFiles.forEach(file => dt.items.add(file));
                      this.$refs.attachmentsInputRaw.files = dt.files;
                      this.$refs.attachmentsInputRaw.value = '';
                  }
              }">
            @csrf
            
            {{-- Alcance del comunicado --}}
            @if($isCentral ?? false)
                {{-- Sede Central: Difusión Oficial Institucional (sin selectores) --}}
                <div class="flex items-center gap-3 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <div class="w-9 h-9 rounded-lg bg-red-600 text-white flex items-center justify-center shrink-0"><i class="fa-solid fa-landmark"></i></div>
                    <div>
                        <p class="text-xs font-black text-red-700 uppercase tracking-wider m-0">Difusión Oficial Institucional</p>
                        <p class="text-[11px] text-red-500/80 font-medium m-0">Este comunicado será visible en todas las sedes del sistema.</p>
                    </div>
                </div>
            @else
                {{-- Operador de sede: la sede se hereda forzada de la sesión (no editable) --}}
                <input type="hidden" name="sede" value="{{ auth()->user()->sede }}">
            @endif

            {{-- Panel de Control de Errores de Validación Backend --}}
            @if ($errors->any())
                <div class="p-4 bg-red-50 border border-red-200 text-red-700 text-xs font-bold rounded-xl space-y-1">
                    <p class="font-black uppercase tracking-wider"><i class="fa-solid fa-triangle-exclamation"></i> Atención: Revisa los campos</p>
                    <ul class="list-disc pl-4 space-y-0.5 font-medium m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="space-y-2">
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider">Título Principal del Comunicado</label>
                <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-800 focus:outline-none focus:border-indigo-500 transition-all shadow-inner placeholder:font-medium placeholder:text-slate-400 text-sm" placeholder="Ej. Comunicado N° 024-2026-DRTPE/PUNO">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="space-y-2">
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider">Fecha de Publicación (Lanzamiento)</label>
                    <input type="date" name="published_at" value="{{ old('published_at', date('Y-m-d')) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-700 focus:outline-none focus:border-indigo-500 transition-all shadow-inner text-sm">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider">Fecha de Retiro (Vencimiento)</label>
                    <input type="date" name="expired_at" value="{{ old('expired_at', date('Y-m-d', strtotime('+7 days'))) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-700 focus:outline-none focus:border-indigo-500 transition-all shadow-inner text-sm">
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider">Sumilla / Descripción Informativa Corta <span class="text-slate-400 font-medium">(Opcional)</span></label>
                <textarea name="description" rows="3" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-700 focus:outline-none focus:border-indigo-500 transition-all shadow-inner placeholder:text-slate-400 placeholder:text-xs text-sm" placeholder="Escriba un breve resumen del contenido del comunicado..."></textarea>
            </div>

            {{-- SECCIÓN MULTIMEDIA MATRIZ --}}
            <div class="space-y-2">
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider">Documento Base Principal <span class="text-red-500">*</span></label>
               
                <input type="file" x-ref="mainFileInput" name="file" accept="application/pdf, image/*" 
                       :required="!mainPreviewUrl" class="hidden" @change="handleMainFile($event)">

                <div x-show="!mainPreviewUrl" @click="$refs.mainFileInput.click()"
                     x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                     class="border-2 border-dashed border-slate-200 hover:border-indigo-500 rounded-xl p-6 text-center bg-slate-50 hover:bg-slate-100/30 transition-colors relative cursor-pointer group min-h-[320px] flex items-center justify-center">
                    <div class="space-y-2 relative z-10">
                        <div class="w-10 h-10 bg-white border border-slate-200 rounded-lg flex items-center justify-center mx-auto text-slate-400 group-hover:text-indigo-500 transition-colors shadow-sm"><i class="fa-solid fa-file-invoice text-base"></i></div>
                        <p class="text-xs font-black text-slate-600">Suelte el afiche o el PDF matriz aquí o explore</p>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Formatos válidos: PDF, JPG, PNG, WEBP (Máx. 10MB)</p>
                    </div>
                </div>

                <div x-show="mainPreviewUrl" x-cloak
                     x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-[0.98]" x-transition:enter-end="opacity-100 scale-100"
                     class="border border-slate-200 bg-slate-50 rounded-2xl p-4 flex flex-col md:flex-row gap-4 items-stretch h-[320px]">
                    <div class="w-full md:w-[55%] bg-slate-950 flex items-center justify-center rounded-xl overflow-hidden border border-slate-200 relative">
                        <template x-if="mainFileType === 'image'">
                            <img :src="mainPreviewUrl" class="w-full h-full object-contain">
                        </template>
                        <template x-if="mainFileType === 'pdf'">
                            <iframe :src="mainPreviewUrl + '#toolbar=0&navpanes=0'" class="w-full h-full border-none bg-white"></iframe>
                        </template>
                    </div>
                    <div class="flex-1 flex flex-col justify-between p-2">
                        <div class="space-y-3">
                            <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 text-[9px] font-mono font-black uppercase px-2 py-0.5 rounded">Carga Principal Lista</span>
                            <div class="space-y-0.5">
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Nombre:</p>
                                <p class="text-slate-800 font-black text-xs truncate" :title="mainFileName" x-text="mainFileName"></p>
                            </div>
                            <div class="space-y-0.5">
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Peso:</p>
                                <p class="text-slate-700 font-bold text-xs font-mono" x-text="mainFileSize"></p>
                            </div>
                        </div>
                        <button type="button" @click="$refs.mainFileInput.click()" 
                                class="w-full bg-white border border-slate-200 text-slate-700 text-center font-black text-xs uppercase tracking-wider py-3 px-4 rounded-xl shadow-sm hover:bg-slate-50 transition cursor-pointer">
                            <i class="fa-solid fa-arrow-rotate-left mr-1 text-indigo-500"></i> Reemplazar Archivo
                        </button>
                    </div>
                </div>
            </div>

            <div class="h-px bg-slate-100 my-2"></div>

            {{-- SECCIÓN DE ANEXOS ADJUNTOS --}}
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider">Documentos Complementarios / Anexos <span class="text-slate-400 font-medium">(Opcional)</span></label>
                    <span class="text-[10px] font-mono font-black px-2 py-0.5 rounded border transition-colors duration-200"
                          :class="attachedFiles.length >= 6 ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-slate-50 text-slate-500 border-slate-200'">
                        <span x-text="attachedFiles.length"></span> / 6 Archivos Máx.
                    </span>
                </div>
               
                <div :class="attachedFiles.length >= 6 ? 'opacity-50 pointer-events-none' : ''"
                     class="border-2 border-dashed border-slate-200 hover:border-indigo-500/40 rounded-xl p-6 text-center bg-slate-50/50 hover:bg-slate-50 transition-colors relative cursor-pointer group">
                    <input type="file" name="attachments[]" accept="application/pdf, image/*" multiple
                           x-ref="attachmentsInputRaw"
                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20"
                           @change="addAttachments($event)">
                    <div class="space-y-2 relative z-10">
                        <div class="w-10 h-10 bg-white border border-slate-200 rounded-lg flex items-center justify-center mx-auto text-slate-400 group-hover:text-indigo-500 transition-colors shadow-sm"><i class="fa-solid fa-folder-plus text-base"></i></div>
                        <p class="text-xs font-black text-slate-600">Presione o arrastre para añadir anexos uno a uno</p>
                        <p class="text-[10px] text-slate-400 font-medium">Los archivos se irán acumulando en la parte inferior de la lista.</p>
                    </div>
                </div>

                <template x-if="attachedFiles.length > 0">
                    <div class="bg-slate-50 border border-slate-200/70 rounded-xl p-3 space-y-1.5 shadow-inner">
                        <template x-for="(file, index) in attachedFiles" :key="file.name + '-' + file.size">
                            <div class="flex items-center justify-between bg-white border border-slate-100 rounded-xl p-2.5 shadow-sm group"
                                 x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">

                                <div class="flex items-center gap-2.5 min-w-0 flex-1 pr-4">
                                    <div class="w-7 h-7 rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0">
                                        <i class="fa-solid text-xs" :class="file.name.toLowerCase().endsWith('.pdf') ? 'fa-file-pdf text-red-500' : 'fa-image text-blue-500'"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="truncate text-xs font-black text-slate-800 leading-none" x-text="file.name"></p>
                                        <p class="text-[9px] font-mono font-medium text-slate-400 mt-1" x-text="(file.size / (1024*1024)).toFixed(2) + ' MB'"></p>
                                    </div>
                                </div>
                                <button type="button" @click="removeAttachment(index)"
                                        class="w-8 h-8 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 flex items-center justify-center transition-all shrink-0 border border-transparent hover:border-red-100 bg-transparent cursor-pointer">
                                    <i class="fa-solid fa-trash-can text-xs"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                </template>
            </div>

            {{-- CONTROL EXTRA: ALERTA INTERNA DE URGENCIA --}}
            <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl border border-slate-200/60 shadow-inner">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-triangle-exclamation text-red-500 text-xs"></i>
                    <label for="is_urgent" class="text-xs font-black uppercase text-slate-700 cursor-pointer select-none">¿Marcar como Comunicado de Alerta Urgente?</label>
                </div>
                <input type="checkbox" id="is_urgent" name="is_urgent" value="1" class="w-4 h-4 accent-red-600 cursor-pointer">
            </div>

            <div class="flex justify-end pt-5 border-t border-slate-100 gap-4">
                <a href="{{ $backUrl ?? route('branch-activities.index') }}" class="px-5 py-3 rounded-xl text-slate-400 hover:text-slate-700 font-bold text-sm transition-colors uppercase tracking-wider decoration-none flex items-center">Cancelar</a>
                <button type="submit" :disabled="attachedFiles.length > 6" class="bg-slate-900 hover:bg-indigo-600 disabled:bg-slate-300 disabled:cursor-not-allowed text-white font-black text-xs uppercase tracking-wider py-3.5 px-8 rounded-xl transition-all shadow-md flex items-center gap-2 border-none cursor-pointer">
                    <i class="fa-solid fa-paper-plane"></i> Lanzar Comunicado Oficial
                </button>
            </div>
        </form>
    </div>
</x-dynamic-component>