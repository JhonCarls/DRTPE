<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="p-2.5 bg-gradient-to-br from-slate-800 to-slate-950 rounded-xl text-white shadow-md">
                    <i class="fa-solid fa-file-circle-plus text-lg"></i>
                </div>
                <div>
                    <h2 class="font-black text-2xl text-slate-800 leading-tight tracking-tight">
                        {{ __('Registrar Nuevo Reporte') }}
                    </h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Sustento de Metas Físicas Ejecutadas</p>
                </div>
            </div>
            <a href="{{ route('subevents.index') }}" 
               class="inline-flex items-center px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-slate-700 hover:bg-gray-50 transition-all duration-200 shadow-sm hover:shadow text-xs font-bold uppercase tracking-wider">
                <i class="fa-solid fa-arrow-left-long mr-2 text-slate-400"></i> Volver
            </a>
        </div>
    </x-slot>

    <div class="py-12" x-data="reportForm()">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Contenedor Principal Dashboard --}}
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-sky-100">
                <div class="h-2 w-full bg-gradient-to-r from-sky-400 via-blue-500 to-indigo-600"></div>

                {{-- Panel de Alertas de Validaciones del Servidor --}}
                @if ($errors->any())
                    <div class="mx-8 mt-6 p-4 bg-red-50 border border-red-200 text-red-700 text-xs font-bold rounded-xl space-y-1 shadow-sm">
                        <p class="font-black uppercase tracking-wider flex items-center gap-1.5">
                            <i class="fa-solid fa-triangle-exclamation animate-pulse"></i> No se pudo procesar el reporte
                        </p>
                        <ul class="list-disc pl-4 space-y-0.5 font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="p-8">
                    <form x-ref="mainForm" action="{{ route('subevents.store') }}" method="POST" enctype="multipart/form-data" @submit.prevent="openConfirmationModal()">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            {{-- Actividad Operativa Vinculada --}}
                            <div>
                                <label for="event_id" class="block text-sm font-black text-slate-700 tracking-tight mb-2">
                                    Actividad Operativa <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="event_id" id="event_id" x-model="form.event_id" required
                                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-700 focus:ring-2 focus:ring-sky-400/20 focus:border-sky-500 focus:outline-none transition-all shadow-inner appearance-none cursor-pointer text-sm">
                                        <option value="" disabled selected>Selecciona una actividad...</option>
                                        @foreach($events as $event)
                                            <option value="{{ $event->id }}" data-code="{{ $event->event_code }}" data-name="{{ $event->description }}">
                                                [{{ $event->category->pp_code ?? 'PP' }}] · {{ $event->event_code }} - {{ Str::limit($event->description, 50) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400"><i class="fa-solid fa-chevron-down text-xs"></i></div>
                                </div>
                            </div>

                            {{-- Fecha del Evento --}}
                            <div>
                                <label for="event_date" class="block text-sm font-black text-slate-700 tracking-tight mb-2">
                                    Fecha del Evento <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="event_date" id="event_date" x-model="form.event_date" required
                                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-700 focus:ring-2 focus:ring-sky-400/20 focus:border-sky-500 focus:outline-none transition-all shadow-inner text-sm">
                            </div>

                            {{-- Título del Reporte --}}
                            <div class="md:col-span-2">
                                <label for="report_title" class="block text-sm font-black text-slate-700 tracking-tight mb-2">
                                    Título Temático del Reporte / Evidencia <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="report_title" id="report_title" x-model="form.report_title" required
                                       placeholder="Ej: Ejecución de Mesa Técnica de Trabajo con Colectivos Regionales"
                                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-800 focus:ring-2 focus:ring-sky-400/20 focus:border-sky-500 focus:outline-none transition-all shadow-inner placeholder:font-normal text-sm">
                            </div>

                            {{-- Cantidad de Personas Alcanzadas --}}
                            <div>
                                <label for="attendees_count" class="block text-sm font-black text-slate-700 tracking-tight mb-2">
                                    Personas Alcanzadas <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="attendees_count" id="attendees_count" x-model="form.attendees_count" required min="1"
                                       placeholder="Cantidad física lograda"
                                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-black text-slate-800 focus:ring-2 focus:ring-sky-400/20 focus:border-sky-500 focus:outline-none transition-all shadow-inner text-sm">
                            </div>

                            {{-- Difusión multiplataforma: se reproduce incrustada en el portal --}}
                            <div class="md:col-span-2">
                                <x-video-input label="Enlaces de Video Evidencia (Opcional)"
                                               help="YouTube, Facebook o TikTok. Puedes dejarlo vacío y agregar la cobertura más adelante desde la edición." />
                            </div>

                            {{-- Observaciones Cortas --}}
                            <div class="md:col-span-2">
                                <label for="comment" class="block text-sm font-black text-slate-700 tracking-tight mb-2">
                                    Comentario / Observaciones de Auditoría <span class="text-slate-400 font-medium">(Opcional)</span>
                                </label>
                                <textarea name="comment" id="comment" x-model="form.comment" rows="3"
                                          placeholder="Escriba precisiones o incidentes detectados durante la actividad..."
                                          class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-700 focus:ring-2 focus:ring-sky-400/20 focus:border-sky-500 focus:outline-none transition-all shadow-inner resize-none text-sm leading-relaxed"></textarea>
                            </div>

                            {{-- GESTOR DE IMÁGENES ACUMULATIVO CON PREVIEW --}}
                            <div class="md:col-span-2 space-y-3">
                                <div class="flex items-center justify-between">
                                    <label class="block text-sm font-black text-slate-700 tracking-tight">Fotos de Evidencia Concluida</label>
                                    <span class="text-[10px] font-mono font-black px-2 py-0.5 rounded border bg-slate-50 border-slate-200 text-slate-600 shadow-sm"
                                          x-show="attachedPhotos.length > 0" x-text="attachedPhotos.length + ' fotos listas'"></span>
                                </div>

                                <input type="file" name="photos[]" id="photosInputRaw" x-ref="photosInputRaw" multiple accept="image/*"
                                       class="hidden" @change="addPhotos($event)">

                                <div @click="$refs.photosInputRaw.click()"
                                     class="border-2 border-dashed border-slate-200 hover:border-sky-500 rounded-xl p-6 text-center bg-slate-50/50 hover:bg-slate-100/30 transition-all duration-200 relative group cursor-pointer">
                                    <div class="space-y-2">
                                        <div class="w-10 h-10 bg-white border border-slate-200 rounded-lg flex items-center justify-center mx-auto text-slate-400 group-hover:text-sky-500 transition-colors shadow-sm"><i class="fa-solid fa-images text-base"></i></div>
                                        <p class="text-xs font-black text-slate-600">Haga clic o arrastre fotografías de evidencia para acumularlas</p>
                                        <p class="text-[10px] text-slate-400 font-medium">Formatos soportados: PNG, JPG, JPEG, WEBP (Soporta carga individual o en lotes)</p>
                                    </div>
                                </div>

                                <template x-if="attachedPhotos.length > 0">
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 p-4 bg-slate-50 border border-slate-200/70 rounded-2xl shadow-inner">
                                        <template x-for="(pic, index) in attachedPhotos" :key="index">
                                            <div class="relative aspect-video rounded-xl overflow-hidden border border-white shadow bg-slate-900 group">
                                                <img :src="pic.url" class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition-opacity">
                                                
                                                <button type="button" @click="removePhoto(index)"
                                                        class="absolute top-1.5 right-1.5 w-6 h-6 rounded-lg bg-red-600/90 hover:bg-red-700 text-white flex items-center justify-center border-none transition shadow-md z-30 cursor-pointer"
                                                        title="Eliminar esta imagen de la lista">
                                                    <i class="fa-solid fa-xmark text-[11px]"></i>
                                                </button>

                                                <div class="absolute bottom-0 left-0 right-0 bg-slate-950/60 p-1 text-[8px] text-slate-200 font-mono truncate" x-text="pic.name"></div>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                            </div>

                        </div>

                        {{-- Botones de pie del formulario --}}
                        <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-end gap-4">
                            <a href="{{ route('subevents.index') }}" 
                               class="px-5 py-3 rounded-xl text-slate-400 hover:text-slate-700 font-bold text-sm transition-colors uppercase tracking-wider">
                                Cancelar
                            </a>
                            <button type="submit" 
                                    class="bg-slate-900 hover:bg-sky-600 text-white font-black text-xs uppercase tracking-wider py-3.5 px-8 rounded-xl transition-all shadow-md flex items-center gap-2">
                                <i class="fa-solid fa-paper-plane"></i> Validar e Insertar Reporte
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ════════ MODAL DE CONFIRMACIÓN FLOTANTE HERMÉTICO ════════ --}}
        <div x-show="showModal" x-cloak class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm" role="dialog" aria-modal="true">
            <div class="bg-white rounded-3xl overflow-hidden shadow-2xl border border-slate-100 max-w-lg w-full" 
                 @click.away="showModal = false" x-transition>
                
                <div class="bg-gradient-to-r from-sky-500 to-blue-600 px-6 py-4.5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-white/10 border border-white/20 rounded-xl p-2 text-white shadow-inner">
                            <i class="fa-solid fa-shield-cat text-lg"></i>
                        </div>
                        <h3 class="ml-3 text-lg font-black text-white uppercase tracking-tight" id="modal-title">
                            Confirmar Envío de Evidencias
                        </h3>
                    </div>
                </div>

                <div class="p-6 sm:p-8 space-y-4">
                    <p class="text-slate-700 text-sm font-medium leading-relaxed">
                        Se registrará un nuevo reporte de avance vinculante para <br>
                        <span class="font-black text-sky-700 uppercase" x-text="selectedEventName"></span> 
                        con un total de 
                        <span class="font-black text-emerald-600 text-lg" x-text="form.attendees_count || '0'"></span> 
                        personas registradas.
                    </p>
                    
                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                        <dl class="grid grid-cols-3 gap-y-2 text-xs font-semibold">
                            <dt class="text-slate-400 uppercase tracking-wider">Fecha Ejecución:</dt>
                            <dd class="text-slate-800 font-mono col-span-2" x-text="formatDate(form.event_date)"></dd>
                            
                            <dt class="text-slate-400 uppercase tracking-wider">Título Reporte:</dt>
                            <dd class="text-slate-800 font-bold truncate col-span-2" x-text="form.report_title || '—'"></dd>

                            <dt class="text-slate-400 uppercase tracking-wider">Difusión en Redes:</dt>
                            <dd class="text-slate-800 font-bold truncate col-span-2" x-text="videoCount > 0 ? videoCount + ' enlace(s) de video' : 'Sin videos'"></dd>

                            <dt class="text-slate-400 uppercase tracking-wider font-black">Total Fotos:</dt>
                            <dd class="text-emerald-600 font-black col-span-2 uppercase" x-text="attachedPhotos.length + ' evidencias fotográficas'"></dd>
                        </dl>
                    </div>

                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider flex items-center gap-1">
                        <i class="fa-solid fa-circle-info text-sky-500 text-sm"></i> ¿Toda la información física de auditoría es fidedigna?
                    </p>
                </div>

                <div class="bg-slate-50 px-6 py-4 flex justify-end space-x-3 border-t border-slate-100">
                    <button type="button" @click="showModal = false"
                            class="px-4 py-2.5 rounded-xl text-slate-400 hover:text-slate-700 font-bold text-xs uppercase tracking-wider transition-colors">
                        Revisar Campos
                    </button>
                    <button type="button" @click="submitForm()"
                            class="px-5 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-black text-xs uppercase tracking-wider rounded-xl transition-all shadow-md">
                        <i class="fa-solid fa-cloud-arrow-up mr-1"></i> Confirmar y Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Script Engine de Control Centralizado --}}
    <script>
        function reportForm() {
            return {
                showModal: false,
                form: {
                    event_id: '{{ old('event_id', '') }}',
                    event_date: '{{ old('event_date', '') }}',
                    report_title: '{{ old('report_title', '') }}',
                    attendees_count: '{{ old('attendees_count', '') }}', // 🎯 CORREGIDO: Mapeado correctamente para sincronización estricta
                    comment: '{{ old('comment', '') }}'
                },
                attachedPhotos: [],
                selectedEventName: '',
                // Los enlaces de video los administra el componente x-video-input
                // (ámbito Alpine propio): aquí solo se resume su cantidad.
                videoCount: 0,
                init() {
                    this.updateSelectedEventName();
                    this.$watch('form.event_id', () => this.updateSelectedEventName());
                },
                updateSelectedEventName() {
                    const select = document.getElementById('event_id');
                    if (select && select.selectedIndex > 0) {
                        const option = select.options[select.selectedIndex];
                        this.selectedEventName = '«' + (option.dataset.code || 'AO') + '»';
                    } else {
                        this.selectedEventName = 'la actividad seleccionada';
                    }
                },
                addPhotos(e) {
                    const files = Array.from(e.target.files);
                    files.forEach(file => {
                        const isDuplicate = this.attachedPhotos.some(p => p.name === file.name && p.file.size === file.size);
                        if (!isDuplicate) {
                            this.attachedPhotos.push({
                                file: file,
                                url: URL.createObjectURL(file), 
                                name: file.name,
                                size: (file.size / (1024 * 1024)).toFixed(2) + ' MB'
                            });
                        }
                    });
                    this.syncInput();
                },
                removePhoto(index) {
                    URL.revokeObjectURL(this.attachedPhotos[index].url);
                    this.attachedPhotos.splice(index, 1);
                    this.syncInput();
                },
                syncInput() {
                    const dt = new DataTransfer();
                    this.attachedPhotos.forEach(p => dt.items.add(p.file));
                    this.$refs.photosInputRaw.files = dt.files;
                },
                formatDate(dateString) {
                    if (!dateString) return '—';
                    const date = new Date(dateString + 'T00:00:00');
                    return date.toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' });
                },
                openConfirmationModal() {
                    if (!this.form.event_id || !this.form.event_date || !this.form.report_title || !this.form.attendees_count) {
                        alert('Por favor completa todos los campos obligatorios.');
                        return;
                    }
                    this.updateSelectedEventName();
                    this.videoCount = Array.from(document.querySelectorAll('input[name="videos[]"]'))
                        .filter(i => i.value.trim() !== '').length;
                    this.showModal = true;
                },
                submitForm() {
                    this.$refs.mainForm.submit();
                }
            }
        }
    </script>
</x-app-layout>