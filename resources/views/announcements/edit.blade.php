@php $repo = $announcement->toRepositoryArray(); @endphp
<x-dynamic-component :component="$layout ?? 'app-layout'">
    <div class="max-w-3xl mx-auto space-y-6 py-2">

        {{-- ENCABEZADO --}}
        <div class="flex items-center gap-3 bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
            <div class="p-2.5 bg-gradient-to-br from-amber-500 to-amber-700 rounded-xl text-white shadow-md">
                <i class="fa-solid fa-pen-to-square text-lg"></i>
            </div>
            <div class="min-w-0">
                <h2 class="font-black text-xl text-slate-800 tracking-tight leading-none truncate">Editar Comunicado</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1.5 truncate">{{ $announcement->title }}</p>
            </div>
            <a href="{{ $backUrl ?? route('announcements.index') }}" class="ml-auto w-9 h-9 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-400 hover:text-slate-700 flex items-center justify-center transition-colors decoration-none shrink-0">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
        </div>

        <form action="{{ route('announcements.update', $announcement) }}" method="POST" enctype="multipart/form-data"
              class="bg-white border border-slate-200 shadow-xs rounded-2xl p-6 sm:p-10 space-y-6"
              x-data="{
                  // Reemplazo opcional del documento matriz
                  newMainUrl: null, newMainType: null, newMainName: '', newMainSize: '',
                  handleMainFile(e) {
                      const file = e.target.files[0];
                      if (!file) return;
                      this.newMainName = file.name;
                      this.newMainSize = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                      this.newMainType = file.type.includes('image') ? 'image' : 'pdf';
                      if (this.newMainUrl) URL.revokeObjectURL(this.newMainUrl);
                      this.newMainUrl = URL.createObjectURL(file);
                  },

                  // Anexos existentes (del servidor) y su marcado para eliminación
                  existing: @js($repo['attachments']),
                  removed: [],
                  toggleRemove(path) {
                      this.removed.includes(path)
                          ? this.removed = this.removed.filter(p => p !== path)
                          : this.removed.push(path);
                  },
                  isRemoved(path) { return this.removed.includes(path); },

                  // Anexos NUEVOS a agregar
                  attachedFiles: [],
                  addAttachments(e) {
                      Array.from(e.target.files).forEach(file => {
                          const dup = this.attachedFiles.some(f => f.name === file.name && f.size === file.size);
                          if (!dup && this.totalKept < 6) this.attachedFiles.push(file);
                      });
                      this.syncInputFiles();
                  },
                  removeAttachment(i) { this.attachedFiles.splice(i, 1); this.syncInputFiles(); },
                  syncInputFiles() {
                      const dt = new DataTransfer();
                      this.attachedFiles.forEach(f => dt.items.add(f));
                      this.$refs.attachmentsInputRaw.files = dt.files;
                  },
                  get keptExisting() { return this.existing.filter(a => !this.removed.includes(a.path)).length; },
                  get totalKept() { return this.keptExisting + this.attachedFiles.length; }
              }">
            @csrf
            @method('PUT')

            {{-- Inputs ocultos para los anexos marcados como eliminados --}}
            <template x-for="p in removed" :key="p">
                <input type="hidden" name="removed_attachments[]" :value="p">
            </template>

            {{-- Errores de validación --}}
            @if ($errors->any())
                <div class="p-4 bg-red-50 border border-red-200 text-red-700 text-xs font-bold rounded-xl space-y-1">
                    <p class="font-black uppercase tracking-wider"><i class="fa-solid fa-triangle-exclamation"></i> Atención: Revisa los campos</p>
                    <ul class="list-disc pl-4 space-y-0.5 font-medium m-0">
                        @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            {{-- Alcance (informativo) --}}
            @if($isCentral ?? false)
                <div class="flex items-center gap-3 p-3.5 bg-red-50 border border-red-200 rounded-xl">
                    <i class="fa-solid fa-landmark text-red-600"></i>
                    <p class="text-xs font-black text-red-700 uppercase tracking-wider m-0">
                        {{ is_null($announcement->sede) ? 'Difusión Oficial Institucional' : 'Comunicado de Sede: '.ucfirst($announcement->sede) }}
                    </p>
                </div>
            @endif

            {{-- Título --}}
            <div class="space-y-2">
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider">Título Principal del Comunicado</label>
                <input type="text" name="title" value="{{ old('title', $announcement->title) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-800 focus:outline-none focus:border-indigo-500 transition-all shadow-inner text-sm">
            </div>

            {{-- Fechas --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="space-y-2">
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider">Fecha de Publicación</label>
                    <input type="date" name="published_at" value="{{ old('published_at', optional($announcement->published_at)->format('Y-m-d')) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-700 focus:outline-none focus:border-indigo-500 transition-all shadow-inner text-sm">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider">Fecha de Retiro (Vencimiento)</label>
                    <input type="date" name="expired_at" value="{{ old('expired_at', optional($announcement->expired_at)->format('Y-m-d')) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-700 focus:outline-none focus:border-indigo-500 transition-all shadow-inner text-sm">
                </div>
            </div>

            {{-- Descripción --}}
            <div class="space-y-2">
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider">Sumilla / Descripción <span class="text-slate-400 font-medium">(Opcional)</span></label>
                <textarea name="description" rows="3" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-700 focus:outline-none focus:border-indigo-500 transition-all shadow-inner text-sm">{{ old('description', $announcement->description) }}</textarea>
            </div>

            {{-- DOCUMENTO MATRIZ ACTUAL + REEMPLAZO --}}
            <div class="space-y-2">
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider">Documento Base Principal (Matriz)</label>

                <input type="file" x-ref="mainFileInput" name="file" accept="application/pdf, image/*" class="hidden" @change="handleMainFile($event)">

                {{-- Preview actual (si no se ha elegido reemplazo) --}}
                <div x-show="!newMainUrl" class="border border-slate-200 bg-slate-50 rounded-2xl p-4 flex flex-col md:flex-row gap-4 items-stretch min-h-[300px]">
                    <div class="w-full md:w-[55%] bg-slate-950 flex items-center justify-center rounded-xl overflow-hidden border border-slate-200 h-64 md:h-auto">
                        @if($repo['main_is_image'])
                            <img src="{{ $repo['main_url'] }}" class="w-full h-full object-contain">
                        @else
                            <iframe src="{{ $repo['main_url'] }}#toolbar=0&navpanes=0" class="w-full h-full border-none bg-white"></iframe>
                        @endif
                    </div>
                    <div class="flex-1 flex flex-col justify-between p-2">
                        <div class="space-y-2">
                            <span class="bg-blue-50 text-blue-700 border border-blue-200 text-[9px] font-mono font-black uppercase px-2 py-0.5 rounded">Documento Actual</span>
                            <p class="text-xs text-slate-500 font-medium">Tipo: <span class="font-black text-slate-700 uppercase">{{ $announcement->file_type }}</span></p>
                            <a href="{{ $repo['main_url'] }}" target="_blank" class="inline-flex items-center gap-2 text-xs font-black text-indigo-600 hover:text-indigo-800 decoration-none"><i class="fa-solid fa-arrow-up-right-from-square"></i> Ver actual</a>
                        </div>
                        <button type="button" @click="$refs.mainFileInput.click()" class="w-full bg-white border border-slate-200 text-slate-700 font-black text-xs uppercase tracking-wider py-3 px-4 rounded-xl shadow-sm hover:bg-slate-50 transition cursor-pointer">
                            <i class="fa-solid fa-arrow-rotate-left mr-1 text-indigo-500"></i> Reemplazar Documento
                        </button>
                    </div>
                </div>

                {{-- Preview del NUEVO archivo elegido --}}
                <div x-show="newMainUrl" x-cloak class="border border-emerald-200 bg-emerald-50/40 rounded-2xl p-4 flex flex-col md:flex-row gap-4 items-stretch min-h-[300px]">
                    <div class="w-full md:w-[55%] bg-slate-950 flex items-center justify-center rounded-xl overflow-hidden border border-slate-200 h-64 md:h-auto">
                        <template x-if="newMainType === 'image'"><img :src="newMainUrl" class="w-full h-full object-contain"></template>
                        <template x-if="newMainType === 'pdf'"><iframe :src="newMainUrl + '#toolbar=0&navpanes=0'" class="w-full h-full border-none bg-white"></iframe></template>
                    </div>
                    <div class="flex-1 flex flex-col justify-between p-2">
                        <div class="space-y-2">
                            <span class="bg-emerald-100 text-emerald-700 border border-emerald-200 text-[9px] font-mono font-black uppercase px-2 py-0.5 rounded">Nuevo — reemplazará al actual</span>
                            <p class="text-slate-800 font-black text-xs truncate" x-text="newMainName"></p>
                            <p class="text-slate-600 font-bold text-xs font-mono" x-text="newMainSize"></p>
                        </div>
                        <button type="button" @click="newMainUrl = null; $refs.mainFileInput.value = ''" class="w-full bg-white border border-slate-200 text-slate-700 font-black text-xs uppercase tracking-wider py-3 px-4 rounded-xl shadow-sm hover:bg-slate-50 transition cursor-pointer">
                            <i class="fa-solid fa-xmark mr-1 text-red-500"></i> Cancelar reemplazo
                        </button>
                    </div>
                </div>
            </div>

            <div class="h-px bg-slate-100"></div>

            {{-- ANEXOS EXISTENTES --}}
            <div class="space-y-3" x-show="existing.length > 0">
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider"><i class="fa-solid fa-paperclip mr-1"></i> Anexos Actuales</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <template x-for="a in existing" :key="a.path">
                        <div class="flex items-center gap-2.5 rounded-xl px-3 py-2.5 border transition"
                             :class="isRemoved(a.path) ? 'bg-red-50 border-red-200 opacity-60' : 'bg-slate-50 border-slate-200'">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0" :class="a.is_pdf ? 'bg-red-100 text-red-500' : 'bg-blue-100 text-blue-500'">
                                <i class="fa-solid" :class="a.is_pdf ? 'fa-file-pdf' : 'fa-image'"></i>
                            </div>
                            <a :href="a.url" target="_blank" class="flex-1 text-xs font-bold text-slate-700 truncate decoration-none hover:text-indigo-600" x-text="a.label" :class="isRemoved(a.path) ? 'line-through' : ''"></a>
                            <button type="button" @click="toggleRemove(a.path)" class="w-8 h-8 rounded-lg flex items-center justify-center transition shrink-0 border-none cursor-pointer"
                                    :class="isRemoved(a.path) ? 'bg-emerald-100 text-emerald-600' : 'bg-transparent text-slate-400 hover:text-red-600 hover:bg-red-50'">
                                <i class="fa-solid" :class="isRemoved(a.path) ? 'fa-rotate-left' : 'fa-trash-can'"></i>
                            </button>
                        </div>
                    </template>
                </div>
                <p class="text-[11px] text-slate-400 font-medium" x-show="removed.length > 0"><i class="fa-solid fa-circle-info mr-1"></i> Los anexos tachados se eliminarán al guardar.</p>
            </div>

            {{-- AGREGAR NUEVOS ANEXOS --}}
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider">Agregar Nuevos Anexos <span class="text-slate-400 font-medium">(Opcional)</span></label>
                    <span class="text-[10px] font-mono font-black px-2 py-0.5 rounded border" :class="totalKept >= 6 ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-slate-50 text-slate-500 border-slate-200'">
                        <span x-text="totalKept"></span> / 6 en total
                    </span>
                </div>
                <div :class="totalKept >= 6 ? 'opacity-50 pointer-events-none' : ''" class="border-2 border-dashed border-slate-200 hover:border-indigo-500/40 rounded-xl p-6 text-center bg-slate-50/50 transition-colors relative cursor-pointer group">
                    <input type="file" name="attachments[]" accept="application/pdf, image/*" multiple x-ref="attachmentsInputRaw" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" @change="addAttachments($event)">
                    <div class="space-y-2 relative z-10">
                        <div class="w-10 h-10 bg-white border border-slate-200 rounded-lg flex items-center justify-center mx-auto text-slate-400 group-hover:text-indigo-500 transition-colors shadow-sm"><i class="fa-solid fa-folder-plus text-base"></i></div>
                        <p class="text-xs font-black text-slate-600">Presione o arrastre para añadir anexos</p>
                    </div>
                </div>
                <template x-if="attachedFiles.length > 0">
                    <div class="bg-slate-50 border border-slate-200/70 rounded-xl p-3 space-y-1.5 shadow-inner">
                        <template x-for="(file, index) in attachedFiles" :key="file.name + '-' + file.size">
                            <div class="flex items-center justify-between bg-white border border-slate-100 rounded-xl p-2.5 shadow-sm"
                                 x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
                                <div class="flex items-center gap-2.5 min-w-0 flex-1 pr-4">
                                    <div class="w-7 h-7 rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0">
                                        <i class="fa-solid text-xs" :class="file.name.toLowerCase().endsWith('.pdf') ? 'fa-file-pdf text-red-500' : 'fa-image text-blue-500'"></i>
                                    </div>
                                    <p class="truncate text-xs font-black text-slate-800" x-text="file.name"></p>
                                </div>
                                <button type="button" @click="removeAttachment(index)" class="w-8 h-8 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 flex items-center justify-center transition-all shrink-0 border-none bg-transparent cursor-pointer">
                                    <i class="fa-solid fa-trash-can text-xs"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                </template>
            </div>

            {{-- ACCIONES --}}
            <div class="flex justify-end pt-5 border-t border-slate-100 gap-4">
                <a href="{{ $backUrl ?? route('announcements.index') }}" class="px-5 py-3 rounded-xl text-slate-400 hover:text-slate-700 font-bold text-sm transition-colors uppercase tracking-wider decoration-none flex items-center">Cancelar</a>
                <button type="submit" :disabled="totalKept > 6" class="bg-slate-900 hover:bg-amber-600 disabled:bg-slate-300 disabled:cursor-not-allowed text-white font-black text-xs uppercase tracking-wider py-3.5 px-8 rounded-xl transition-all shadow-md flex items-center gap-2 border-none cursor-pointer">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</x-dynamic-component>
