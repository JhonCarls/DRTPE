@if(isset($comunicadosActivos) && $comunicadosActivos->count() > 0)
<script>
    window.comunicadosPlataforma = @json($comunicadosActivos);
</script>

<div x-data="{
        showPopup: true,
        active: 0,
        items: window.comunicadosPlataforma || [],
        get current() { return this.items[this.active] || null; },
        init() {
            if (this.items.length > 1) {
                setInterval(() => {
                    this.active = (this.active + 1) % this.items.length;
                }, 6500);
            }
        }
    }"
    x-show="showPopup"
    class="fixed inset-0 z-[200] flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-md"
    x-cloak>

    <div class="relative bg-white rounded-2xl w-full max-w-5xl shadow-2xl flex flex-col md:flex-row overflow-hidden border border-slate-100"
         style="height: 75vh;"
         @click.away="showPopup = false"
         x-transition>

        <template x-if="current">
            <div class="w-full h-full flex flex-col md:flex-row items-stretch">

                {{-- COLUMNA IZQUIERDA: VISUALIZADOR MULTIMEDIA --}}
                <div class="w-full md:w-[62%] bg-slate-950 flex items-center justify-center relative overflow-hidden h-1/2 md:h-full border-b md:border-b-0 md:border-r border-slate-100">

                    {{-- Renderizar si es una imagen --}}
                    <template x-if="current.file_type === 'image'">
                        <div class="w-full h-full p-4 flex items-center justify-center">
                            <img :src="'/storage/' + current.file_path"
                                 class="w-full h-full object-contain shadow-2xl transition-all duration-300">
                        </div>
                    </template>

                    {{-- Renderizar si es un PDF u otro tipo de documento --}}
                    <template x-if="current.file_type !== 'image'">
                        <div class="w-full h-full bg-slate-900">
                            <iframe :key="current.id"
                                    :src="'/storage/' + current.file_path + '#toolbar=0&navpanes=0&statusbar=0&view=Fit'"
                                    class="w-full h-full border-none"
                                    allow="autoplay"></iframe>
                        </div>
                    </template>

                    {{-- Indicadores de paginación (Dots) si hay más de un comunicado activo --}}
                    <template x-if="items.length > 1">
                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-slate-950/60 backdrop-blur-sm px-3 py-1.5 flex gap-1.5 z-10 border border-white/10 rounded-full">
                            <template x-for="(c, i) in items" :key="'dot-'+i">
                                <button @click="active = i"
                                        class="h-1.5 transition-all duration-300 border-none p-0 rounded-full"
                                        :class="active === i ? 'bg-amber-500 w-4 shadow-[0_0_6px_#f59e0b]' : 'bg-white/35 w-1.5'"></button>
                            </template>
                        </div>
                    </template>
                </div>

                {{-- COLUMNA DERECHA: DATOS INSTITUCIONALES --}}
                <div class="w-full md:w-[38%] bg-white flex flex-col justify-between p-5 sm:p-6 overflow-y-auto h-1/2 md:h-full text-slate-800">

                    <div class="space-y-4">
                        {{-- Encabezado del panel de datos --}}
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <span class="text-[9px] font-mono font-black text-red-600 uppercase tracking-widest flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-600 animate-pulse"></span>
                                Difusión Oficial
                            </span>
                            <button @click="showPopup = false; document.body.style.overflow='';"
                                    class="text-slate-400 hover:text-slate-700 transition text-[10px] font-black uppercase tracking-wider flex items-center gap-1 bg-transparent border-none cursor-pointer">
                                Cerrar <i class="fa-solid fa-xmark text-xs text-red-500"></i>
                            </button>
                        </div>

                        {{-- Detalles del Comunicado --}}
                        <div class="space-y-2">
                            <div class="flex flex-wrap items-center gap-1.5">
                                <span class="bg-slate-100 text-slate-600 border border-slate-200/60 font-mono text-[9px] font-black uppercase px-2 py-0.5 rounded">Comunicado Activo</span>
                                {{-- Etiqueta de la sede de origen del comunicado --}}
                                <span class="font-mono text-[9px] font-black uppercase px-2 py-0.5 rounded border inline-flex items-center gap-1"
                                      :class="!current.sede ? 'bg-red-50 text-red-700 border-red-200' : 'bg-indigo-50 text-indigo-700 border-indigo-200'">
                                    <i class="fa-solid fa-location-dot text-[8px]"></i><span x-text="current.sede_label"></span>
                                </span>
                            </div>
                            <h3 class="text-slate-900 font-black text-base sm:text-lg tracking-tight uppercase leading-snug break-words" x-text="current.title"></h3>
                            
                            <div class="text-[10px] font-bold text-slate-400 flex items-center gap-1">
                                <i class="fa-regular fa-calendar-check text-slate-400"></i> Publicado:
                                <span class="text-slate-600" x-text="current.published_at ? new Date(current.published_at).toLocaleDateString('es-PE') : ''"></span>
                            </div>

                            <hr class="border-slate-100 my-2">

                            <p class="text-slate-600 text-xs font-medium leading-relaxed bg-slate-50 p-3 border border-slate-100 rounded-xl max-h-40 overflow-y-auto scrollbar-thin"
                               x-text="current.description || 'Sin descripción adicional adjunta.'"></p>
                        </div>
                    </div>

                    {{-- Enlaces de descarga y archivos adjuntos --}}
                    <div class="space-y-4 pt-4 border-t border-slate-100 mt-4 md:mt-0">

                        {{-- Lista de anexos/archivos vinculados --}}
                        <div x-show="current.attachments && current.attachments.length > 0" class="space-y-2">
                            <p class="text-slate-400 text-[9px] font-mono font-black uppercase tracking-wider flex items-center gap-1">
                                <i class="fa-solid fa-paperclip text-amber-500"></i> Archivos y Bases Vinculadas:
                            </p>
                            <div class="space-y-1.5 max-h-36 overflow-y-auto pr-1 scrollbar-thin">
                                <template x-for="(adjuntoPath, idx) in current.attachments" :key="idx">
                                    <a :href="'/storage/' + adjuntoPath" target="_blank"
                                       class="flex items-center gap-2 bg-slate-50 hover:bg-slate-100 border border-slate-200/70 p-2 text-[11px] font-bold text-slate-700 hover:text-slate-900 transition rounded-xl truncate group decoration-none">
                                        <div class="w-5 h-5 rounded-md bg-white border border-slate-200 flex items-center justify-center shrink-0 shadow-sm">
                                            <i class="fa-solid text-[10px]"
                                               :class="adjuntoPath.toLowerCase().endsWith('.pdf') ? 'fa-file-pdf text-red-500' : 'fa-image text-blue-500'"></i>
                                        </div>
                                        <span class="truncate flex-1" x-text="'Anexo Opcional N° ' + (idx + 1)"></span>
                                        <i class="fa-solid fa-arrow-down text-[9px] text-slate-400 group-hover:text-slate-600 transition-colors mr-1"></i>
                                    </a>
                                </template>
                            </div>
                        </div>

                        {{-- Botón de descarga principal --}}
                        <a :href="'/storage/' + current.file_path" target="_blank"
                           class="w-full bg-red-600 hover:bg-red-500 text-white text-xs font-black uppercase tracking-wider py-3 rounded-xl flex items-center justify-center gap-2 transition shadow-md hover:shadow-lg hover:-translate-y-0.5 transform shrink-0 decoration-none">
                            <i class="fa-solid fa-file-arrow-down text-sm"></i> Descargar Documento Principal
                        </a>
                    </div>

                </div>

            </div>
        </template>

    </div>
</div>
@endif