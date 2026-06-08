<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="p-2.5 bg-gradient-to-br from-slate-800 to-slate-950 rounded-xl text-white shadow-md">
                    <i class="fa-solid fa-pen-to-square text-lg"></i>
                </div>
                <div>
                    <h2 class="font-black text-2xl text-slate-800 leading-tight tracking-tight">
                        {{ __('Editar Actividad Operativa') }}
                    </h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Modificación del Plan Operativo Institucional</p>
                </div>
            </div>
            <a href="{{ route('events.index') }}" class="inline-flex items-center px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-slate-700 hover:bg-slate-50 transition-all duration-200 shadow-sm hover:shadow text-xs font-bold uppercase tracking-wider">
                <i class="fa-solid fa-arrow-left-long mr-2 text-slate-400"></i> Volver
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            {{-- MODIFICADO: x-data inicializa la fuente de financiamiento actual del registro desde el backend --}}
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-slate-100"
                 x-data="{ source: '{{ old('funding_source', $event->funding_source ?? 'gobierno_regional') }}' }">
                
                {{-- Barra decorativa institucional --}}
                <div class="h-1.5 w-full bg-gradient-to-r from-blue-500 via-indigo-600 to-indigo-800"></div>

                <div class="p-6 sm:p-8 bg-slate-50/50 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-2 text-slate-500">
                        <i class="fa-solid fa-file-invoice text-sm"></i>
                        <span class="text-xs font-black uppercase tracking-wider">Actualización de Datos (A01)</span>
                    </div>
                    <span class="text-[10px] font-black text-indigo-600 bg-indigo-50 border border-indigo-100 px-2.5 py-0.5 rounded-md uppercase tracking-wider">Año Fiscal 2026</span>
                </div>

                {{-- Panel de Control de Errores Críticos del Servidor --}}
                @if ($errors->any())
                    <div class="mx-6 sm:mx-10 mt-6 p-4 bg-red-50 border border-red-200 text-red-700 text-xs font-bold rounded-xl space-y-1 shadow-sm">
                        <p class="font-black uppercase tracking-wider flex items-center gap-1.5">
                            <i class="fa-solid fa-triangle-exclamation animate-pulse"></i> No se pudo actualizar el registro
                        </p>
                        <ul class="list-disc pl-4 space-y-0.5 font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="p-6 sm:p-10">
                    <form action="{{ route('events.update', $event) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            
                            {{-- Selector de Categoría PP General --}}
                            <div class="md:col-span-2 space-y-2">
                                <label for="category_id" class="block text-sm font-black text-slate-700 tracking-tight">
                                    Vincular a Actividad General (PP) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="category_id" id="category_id" required 
                                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-700 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 focus:outline-none transition-all shadow-inner appearance-none cursor-pointer text-sm">
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('category_id', $event->category_id) == $cat->id ? 'selected' : '' }}>
                                                [{{ $cat->pp_code ?? '—' }}] · {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400"><i class="fa-solid fa-chevron-down text-xs"></i></div>
                                </div>
                                @error('category_id') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Código de Actividad Operativa --}}
                            <div class="space-y-2">
                                <label for="event_code" class="block text-sm font-black text-slate-700 tracking-tight">
                                    Código Actividad <span class="text-slate-400 font-medium">(Ej. A01)</span> <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="event_code" id="event_code" 
                                       value="{{ old('event_code', $event->event_code) }}" required
                                       placeholder="A01"
                                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-black text-slate-800 uppercase focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 focus:outline-none transition-all shadow-inner placeholder:font-normal text-sm">
                                @error('event_code') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Código POI --}}
                            <div class="space-y-2">
                                <label for="poi_code" class="block text-sm font-black text-slate-700 tracking-tight">
                                    Código POI <span class="text-slate-400 font-medium">(Opcional)</span>
                                </label>
                                <input type="text" name="poi_code" id="poi_code" 
                                       value="{{ old('poi_code', $event->poi_code) }}"
                                       placeholder="Cód. Referencial"
                                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-700 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 focus:outline-none transition-all shadow-inner text-sm">
                                @error('poi_code') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Unidad de Medida --}}
                            <div class="space-y-2">
                                <label for="unit_measure" class="block text-sm font-black text-slate-700 tracking-tight">
                                    Unidad de Medida <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="unit_measure" id="unit_measure" required 
                                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-700 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 focus:outline-none transition-all shadow-inner appearance-none cursor-pointer text-sm">
                                        <option value="PERSONAS" {{ old('unit_measure', $event->unit_measure) == 'PERSONAS' ? 'selected' : '' }}>PERSONAS ALCANZADAS</option>
                                        <option value="ACTAS" {{ old('unit_measure', $event->unit_measure) == 'ACTAS' ? 'selected' : '' }}>ACTAS FIRMADAS</option>
                                        <option value="EVENTOS" {{ old('unit_measure', $event->unit_measure) == 'EVENTOS' ? 'selected' : '' }}>EVENTOS EJECUTADOS</option>
                                    </select>
                                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400"><i class="fa-solid fa-chevron-down text-xs"></i></div>
                                </div>
                                @error('unit_measure') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Meta Física Anual --}}
                            <div class="space-y-2">
                                <label for="goal_people" class="block text-sm font-black text-slate-700 tracking-tight">
                                    Meta Física <span class="text-slate-400 font-medium">(Cantidad Anual)</span> <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="goal_people" id="goal_people" min="1" 
                                       value="{{ old('goal_people', $event->goal_people) }}" required
                                       placeholder="0"
                                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-black text-slate-800 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 focus:outline-none transition-all shadow-inner text-sm">
                                @error('goal_people') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- 🎯 NUEVO: SECCIÓN PREMIUM EDITABLE PARA FUENTE DE FINANCIAMIENTO (Sincronizado con Alpine) --}}
                            <div class="md:col-span-2 space-y-3">
                                <label class="block text-slate-700 text-sm font-black tracking-tight">Fuente de Financiamiento Operativo <span class="text-red-500">*</span></label>
                                <input type="hidden" name="funding_source" :value="source">
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    
                                    {{-- Opción Gobierno Regional --}}
                                    <div @click="source = 'gobierno_regional'" 
                                         :class="source === 'gobierno_regional' ? 'border-indigo-600 bg-indigo-50/40 ring-2 ring-indigo-500/10' : 'border-slate-200 bg-slate-50/50 hover:bg-slate-50'"
                                         class="border-2 rounded-2xl p-5 flex items-start gap-4 cursor-pointer transition-all duration-200 relative group shadow-sm">
                                        <div :class="source === 'gobierno_regional' ? 'bg-indigo-600 text-white shadow-md' : 'bg-white text-slate-400 border border-slate-200'"
                                             class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                                            <i class="fa-solid fa-building-government text-sm"></i>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <h4 class="font-black text-slate-900 text-sm leading-tight">Gobierno Regional</h4>
                                            <p class="text-slate-500 text-[11px] mt-1 font-medium leading-relaxed">Presupuesto ordinario asignado por la Sede Central del GORE Puno.</p>
                                        </div>
                                        <div class="absolute top-4 right-4 text-indigo-600 text-xs" x-show="source === 'gobierno_regional'"><i class="fa-solid fa-circle-check text-base"></i></div>
                                    </div>

                                    {{-- Opción SUNAFIL --}}
                                    <div @click="source = 'gobierno_central'" 
                                         :class="source === 'gobierno_central' ? 'border-amber-500 bg-amber-50/20 ring-2 ring-amber-500/10' : 'border-slate-200 bg-slate-50/50 hover:bg-slate-50'"
                                         class="border-2 rounded-2xl p-5 flex items-start gap-4 cursor-pointer transition-all duration-200 relative group shadow-sm">
                                        <div :class="source === 'gobierno_central' ? 'bg-amber-500 text-white shadow-md' : 'bg-white text-slate-400 border border-slate-200'"
                                             class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                                            <i class="fa-solid fa-building-shield text-sm"></i>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <h4 class="font-black text-slate-900 text-sm leading-tight">SUNAFIL / Gobierno Central</h4>
                                            <p class="text-slate-500 text-[11px] mt-1 font-medium leading-relaxed">Transferencias sectoriales directas de fiscalización laboral y tesoro público.</p>
                                        </div>
                                        <div class="absolute top-4 right-4 text-amber-500 text-xs" x-show="source === 'gobierno_central'"><i class="fa-solid fa-circle-check text-base"></i></div>
                                    </div>

                                </div>
                                @error('funding_source') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Descripción y Objetivos --}}
                            <div class="md:col-span-2 space-y-2">
                                <label for="description" class="block text-sm font-black text-slate-700 tracking-tight">
                                    Descripción de la Actividad Operativa <span class="text-red-500">*</span>
                                </label>
                                <textarea name="description" id="description" rows="4" required
                                          placeholder="Describe detalladamente la actividad operativa..."
                                          class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-700 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 focus:outline-none transition-all shadow-inner placeholder:text-slate-400 text-sm leading-relaxed">{{ old('description', $event->description) }}</textarea>
                                @error('description') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- Botones de acción inferiores estilizados --}}
                        <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-end gap-4">
                            <a href="{{ route('events.index') }}" 
                               class="px-5 py-3 rounded-xl text-slate-400 hover:text-slate-700 font-bold text-sm transition-colors uppercase tracking-wider">
                                Cancelar
                            </a>
                            <button type="submit" 
                                    class="bg-slate-900 hover:bg-indigo-600 text-white font-black text-xs uppercase tracking-wider py-3.5 px-8 rounded-xl transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5 flex items-center gap-2">
                                <i class="fa-solid fa-floppy-disk text-sm"></i> Actualizar Actividad Operativa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>