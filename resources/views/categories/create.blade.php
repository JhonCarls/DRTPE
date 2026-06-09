<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2.5 bg-gradient-to-br from-indigo-600 to-indigo-800 rounded-xl text-white shadow-md shadow-indigo-200">
                <i class="fa-solid fa-layer-group text-lg"></i>
            </div>
            <div>
                <h2 class="font-black text-2xl text-slate-800 leading-tight tracking-tight">
                    {{ __('Registrar Actividad General (PP)') }}
                </h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Definición de Programas Presupuestales</p>
            </div>
            <a href="{{ route('categories.index') }}" class="ml-auto text-slate-400 hover:text-indigo-600 transition-colors">
                <i class="fa-solid fa-arrow-left-long text-xl"></i>
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            {{-- MODIFICADO: x-data inicializado con el estado del departamento reteniendo selecciones previas con old() --}}
            <form action="{{ route('categories.store') }}" method="POST" 
                  class="bg-white rounded-2xl border border-slate-100 shadow-xl overflow-hidden"
                  x-data="{ department: '{{ old('department', 'prevencion') }}' }">
                @csrf
                
                <div class="p-6 sm:p-8 bg-slate-50/50 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-2 text-slate-500">
                        <i class="fa-solid fa-barcode text-sm"></i>
                        <span class="text-xs font-bold uppercase tracking-wider">Identificación Presupuestal</span>
                    </div>
                    <span class="text-[10px] font-black text-indigo-600 bg-indigo-50 border border-indigo-100 px-2 py-0.5 rounded-md uppercase tracking-wider">Estructura Programática</span>
                </div>

                @if ($errors->any())
                    <div class="mx-6 sm:mx-10 mt-6 p-4 bg-red-50 border border-red-200 text-red-700 text-xs font-bold rounded-xl space-y-1 shadow-sm">
                        <p class="font-black uppercase tracking-wider flex items-center gap-1.5">
                            <i class="fa-solid fa-triangle-exclamation animate-pulse"></i> No se pudo procesar la actividad general
                        </p>
                        <ul class="list-disc pl-4 space-y-0.5 font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="p-6 sm:p-10 space-y-6">

                    {{-- 🎯 NUEVO: MÓDULO INTERACTIVO DE DEPARTAMENTOS RESPONSABLES (3 COLUMNAS) --}}
                    <div class="space-y-3">
                        <label class="block text-slate-700 text-xs font-black uppercase tracking-wider">Departamento / Área Responsable <span class="text-red-500">*</span></label>
                        
                        <input type="hidden" name="department" :value="department">
                       
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            
                            {{-- Tarjeta A: Prevención --}}
                            <div @click="department = 'prevencion'"
                                 :class="department === 'prevencion' ? 'border-blue-600 bg-blue-50/20 ring-2 ring-blue-500/10' : 'border-slate-200 bg-slate-50/50 hover:bg-slate-50'"
                                 class="border-2 p-4 flex flex-col justify-between cursor-pointer transition-all duration-200 rounded-2xl relative shadow-sm h-32 group">
                                <div class="flex items-center gap-3">
                                    <div :class="department === 'prevencion' ? 'bg-blue-600 text-white shadow-md' : 'bg-white text-slate-400 border border-slate-200'"
                                         class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                                        <i class="fa-solid fa-shield-halved text-xs"></i>
                                    </div>
                                    <h4 class="font-black text-slate-900 text-xs uppercase tracking-tight">Prevención</h4>
                                </div>
                                <p class="text-slate-400 text-[10px] font-medium leading-tight">Control de riesgos laborales e inspección preventiva regional.</p>
                                <div class="absolute top-4 right-4 text-blue-600" x-show="department === 'prevencion'"><i class="fa-solid fa-circle-check text-sm"></i></div>
                            </div>

                            {{-- Tarjeta B: Formaliza --}}
                            <div @click="department = 'formaliza'"
                                 :class="department === 'formaliza' ? 'border-amber-500 bg-amber-50/20 ring-2 ring-amber-500/10' : 'border-slate-200 bg-slate-50/50 hover:bg-slate-50'"
                                 class="border-2 p-4 flex flex-col justify-between cursor-pointer transition-all duration-200 rounded-2xl relative shadow-sm h-32 group">
                                <div class="flex items-center gap-3">
                                    <div :class="department === 'formaliza' ? 'bg-amber-500 text-white shadow-md' : 'bg-white text-slate-400 border border-slate-200'"
                                         class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                                        <i class="fa-solid fa-gavel text-xs"></i>
                                    </div>
                                    <h4 class="font-black text-slate-900 text-xs uppercase tracking-tight">Formaliza</h4>
                                </div>
                                <p class="text-slate-400 text-[10px] font-medium leading-tight">Mesas de diálogo, acuerdos y formalización del empleo puneño.</p>
                                <div class="absolute top-4 right-4 text-amber-500" x-show="department === 'formaliza'"><i class="fa-solid fa-circle-check text-sm"></i></div>
                            </div>

                            {{-- Tarjeta C: Empleo --}}
                            <div @click="department = 'empleo'"
                                 :class="department === 'empleo' ? 'border-emerald-600 bg-emerald-50/20 ring-2 ring-emerald-500/10' : 'border-slate-200 bg-slate-50/50 hover:bg-slate-50'"
                                 class="border-2 p-4 flex flex-col justify-between cursor-pointer transition-all duration-200 rounded-2xl relative shadow-sm h-32 group">
                                <div class="flex items-center gap-3">
                                    <div :class="department === 'empleo' ? 'bg-emerald-600 text-white shadow-md' : 'bg-white text-slate-400 border border-slate-200'"
                                         class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                                        <i class="fa-solid fa-briefcase text-xs"></i>
                                    </div>
                                    <h4 class="font-black text-slate-900 text-xs uppercase tracking-tight">Empleo</h4>
                                </div>
                                <p class="text-slate-400 text-[10px] font-medium leading-tight">Inserción laboral, ferias informativas y capacitaciones externas.</p>
                                <div class="absolute top-4 right-4 text-emerald-600" x-show="department === 'empleo'"><i class="fa-solid fa-circle-check text-sm"></i></div>
                            </div>

                        </div>
                        @error('department') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="h-px bg-slate-100 my-2"></div>

                    {{-- Inputs Básicos --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <div class="sm:col-span-1 space-y-2">
                            <label class="block text-slate-700 text-sm font-black tracking-tight">Código PP</label>
                            <input type="text" name="pp_code" value="{{ old('pp_code') }}" required 
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 focus:outline-none transition-all shadow-inner placeholder:font-normal text-sm" 
                                   placeholder="Ej. PP 0103">
                            <p class="text-[9px] text-slate-400 font-medium italic">* Se permite repetir códigos de programa.</p>
                        </div>
                        
                        <div class="sm:col-span-2 space-y-2">
                            <label class="block text-slate-700 text-sm font-black tracking-tight">Denominación de la Actividad</label>
                            <input type="text" name="name" value="{{ old('name') }}" required 
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-800 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 focus:outline-none transition-all shadow-inner text-sm" 
                                   placeholder="Nombre de la actividad presupuestal">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-slate-700 text-sm font-black tracking-tight">Descripción del Objetivo</label>
                        <textarea name="description" rows="4" 
                                  class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-700 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 focus:outline-none transition-all shadow-inner placeholder:text-sm text-sm" 
                                  placeholder="Detalle el alcance de este programa presupuestal...">{{ old('description') }}</textarea>
                    </div>

                </div>

                <div class="p-6 sm:p-8 bg-slate-50/50 border-t border-slate-100 flex items-center justify-end gap-4">
                    <a href="{{ route('categories.index') }}" class="px-5 py-3 rounded-xl text-slate-500 hover:text-slate-800 font-bold text-sm transition-colors uppercase tracking-wider">
                        Cancelar
                    </a>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-black text-xs uppercase tracking-wider py-3.5 px-8 rounded-xl transition-all shadow-md flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk text-xs"></i> Guardar Actividad General
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>