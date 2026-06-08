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
            
            <form action="{{ route('categories.store') }}" method="POST" class="bg-white rounded-2xl border border-slate-100 shadow-xl overflow-hidden">
                @csrf
                
                <div class="p-6 sm:p-8 bg-slate-50/50 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-2 text-slate-500">
                        <i class="fa-solid fa-barcode text-sm"></i>
                        <span class="text-xs font-bold uppercase tracking-wider">Identificación Presupuestal</span>
                    </div>
                    <span class="text-[10px] font-black text-indigo-600 bg-indigo-50 border border-indigo-100 px-2 py-0.5 rounded-md uppercase tracking-wider">Estructura Programática</span>
                </div>

                <div class="p-6 sm:p-10 space-y-6">

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <div class="sm:col-span-1 space-y-2">
                            <label class="block text-slate-700 text-sm font-black tracking-tight">Código PP</label>
                            <input type="text" name="pp_code" value="{{ old('pp_code') }}" required 
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 focus:outline-none transition-all shadow-inner placeholder:font-normal" 
                                   placeholder="Ej. PP 0103">
                            <p class="text-[9px] text-slate-400 font-medium italic">* Se permite repetir códigos de programa.</p>
                        </div>
                        
                        <div class="sm:col-span-2 space-y-2">
                            <label class="block text-slate-700 text-sm font-black tracking-tight">Denominación de la Actividad</label>
                            <input type="text" name="name" value="{{ old('name') }}" required 
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-800 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 focus:outline-none transition-all shadow-inner" 
                                   placeholder="Nombre de la actividad presupuestal">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-slate-700 text-sm font-black tracking-tight">Descripción del Objetivo</label>
                        <textarea name="description" rows="4" 
                                  class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-700 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 focus:outline-none transition-all shadow-inner placeholder:text-sm" 
                                  placeholder="Detalle el alcance de este programa presupuestal...">{{ old('description') }}</textarea>
                    </div>

                </div>

                <div class="p-6 sm:p-8 bg-slate-50/50 border-t border-slate-100 flex items-center justify-end gap-4">
                    <a href="{{ route('categories.index') }}" class="px-5 py-3 rounded-xl text-slate-500 hover:text-slate-800 font-bold text-sm transition-colors uppercase tracking-wider">
                        Cancelar
                    </a>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-black text-sm uppercase tracking-wider py-3.5 px-8 rounded-xl transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5 flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i> Guardar Actividad General
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>