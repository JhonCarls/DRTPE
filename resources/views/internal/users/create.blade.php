<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-black text-2xl text-slate-800 leading-none flex items-center gap-2.5">
                    <span class="w-9 h-9 rounded-xl bg-red-600 text-white flex items-center justify-center text-sm"><i class="fa-solid fa-users-gear"></i></span>
                    Alta de Operadores de Sedes Desconcentradas
                </h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1.5 ml-11">Control de Accesos y Jurisdicciones Regionales</p>
            </div>
            <a href="{{ route('dashboard') }}" class="bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs py-2.5 px-4 rounded-xl border border-slate-200 shadow-sm transition decoration-none shrink-0">
                <i class="fa-solid fa-arrow-left mr-1"></i> Volver al Panel
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto space-y-6">

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl flex items-center gap-2 font-bold text-sm"><i class="fa-solid fa-circle-check text-emerald-500"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-xl flex items-center gap-2 font-bold text-sm"><i class="fa-solid fa-triangle-exclamation text-red-500"></i> {{ session('error') }}</div>
        @endif

        {{-- ══ FORMULARIO DE ALTA ══ --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden"
             x-data="{ sede: '{{ old('sede', 'juliaca') }}', role: '{{ old('role', 'user') }}', showPass: false }">
            <div class="bg-gradient-to-r from-slate-900 to-slate-950 px-6 py-4">
                <h3 class="text-white font-black text-sm uppercase tracking-widest m-0"><i class="fa-solid fa-user-plus text-red-500 mr-2"></i> Registrar Nuevo Operador</h3>
            </div>

            <form action="{{ route('users.store') }}" method="POST" class="p-6 sm:p-8 space-y-7">
                @csrf

                @if ($errors->any())
                    <div class="p-4 bg-red-50 border border-red-200 text-red-700 text-xs font-bold rounded-xl space-y-1">
                        <p class="font-black uppercase tracking-wider m-0"><i class="fa-solid fa-triangle-exclamation"></i> Revisa los campos</p>
                        <ul class="list-disc pl-4 space-y-0.5 font-medium m-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                {{-- Datos personales --}}
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3"><i class="fa-solid fa-id-card mr-1"></i> Datos Personales</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5 sm:col-span-2">
                            <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Nombre Completo</label>
                            <input type="text" name="name" required value="{{ old('name') }}" placeholder="Ej. Juan Pérez Quispe"
                                   class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-black uppercase text-slate-500 tracking-wider">DNI <span class="text-slate-400 font-medium normal-case">(8 dígitos)</span></label>
                            <input type="text" name="dni" value="{{ old('dni') }}" maxlength="8" inputmode="numeric" placeholder="Ej. 40123456"
                                   class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Correo Institucional</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="operador@drtpe.gob.pe"
                                   class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                        </div>
                    </div>
                </div>

                {{-- Jurisdicción (sede) --}}
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3"><i class="fa-solid fa-map-location-dot mr-1"></i> Asignación de Jurisdicción</p>
                    <input type="hidden" name="sede" :value="sede">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        @foreach($sedes as $key => $s)
                            <button type="button" @click="sede = '{{ $key }}'"
                                    :class="sede === '{{ $key }}' ? 'border-red-500 bg-red-50 ring-2 ring-red-500/20' : 'border-slate-200 bg-white hover:border-slate-300'"
                                    class="text-left p-4 rounded-xl border-2 transition-all cursor-pointer flex items-center gap-3">
                                <span class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 transition-colors"
                                      :class="sede === '{{ $key }}' ? 'bg-red-600 text-white' : 'bg-slate-100 text-slate-500'">
                                    <i class="fa-solid {{ $s['icon'] }}"></i>
                                </span>
                                <div>
                                    <p class="text-sm font-black text-slate-800 m-0">{{ $s['label'] }}</p>
                                    <p class="text-[11px] text-slate-400 font-bold m-0">{{ $s['desc'] }}</p>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Rol y permisos --}}
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3"><i class="fa-solid fa-shield-halved mr-1"></i> Rol y Permisos</p>
                    <input type="hidden" name="role" :value="role">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <button type="button" @click="role = 'user'"
                                :class="role === 'user' ? 'border-indigo-500 bg-indigo-50 ring-2 ring-indigo-500/20' : 'border-slate-200 hover:border-slate-300'"
                                class="text-left p-4 rounded-xl border-2 transition-all cursor-pointer">
                            <div class="flex items-center gap-2 mb-1"><i class="fa-solid fa-user-gear text-indigo-600"></i><span class="text-sm font-black text-slate-800">Operador de Sede</span></div>
                            <p class="text-[11px] text-slate-500 font-medium m-0">Registra actividades de su jurisdicción y emite comunicados de su sede.</p>
                        </button>
                        <button type="button" @click="role = 'director'"
                                :class="role === 'director' ? 'border-indigo-500 bg-indigo-50 ring-2 ring-indigo-500/20' : 'border-slate-200 hover:border-slate-300'"
                                class="text-left p-4 rounded-xl border-2 transition-all cursor-pointer">
                            <div class="flex items-center gap-2 mb-1"><i class="fa-solid fa-user-tie text-indigo-600"></i><span class="text-sm font-black text-slate-800">Director de Sede</span></div>
                            <p class="text-[11px] text-slate-500 font-medium m-0">Supervisa la gestión operativa de la sede además de las funciones de operador.</p>
                        </button>
                    </div>
                </div>

                {{-- Credenciales --}}
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3"><i class="fa-solid fa-key mr-1"></i> Credenciales de Acceso</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Usuario (login)</label>
                            <input type="text" name="username" required value="{{ old('username') }}" placeholder="Ej. jperez_juliaca"
                                   class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 text-sm font-semibold text-slate-800 focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-black uppercase text-slate-500 tracking-wider">Contraseña</label>
                            <div class="relative">
                                <input :type="showPass ? 'text' : 'password'" name="password" required placeholder="Mínimo 6 caracteres"
                                       class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 pr-11 text-sm font-semibold text-slate-800 focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                                <button type="button" @click="showPass = !showPass" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 bg-transparent border-none cursor-pointer">
                                    <i class="fa-solid" :class="showPass ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-black text-xs uppercase tracking-wider py-3.5 px-8 rounded-xl shadow-md transition-all border-none cursor-pointer">
                        <i class="fa-solid fa-user-plus mr-1.5"></i> Crear Operador de Sede
                    </button>
                </div>
            </form>
        </div>

        {{-- ══ TABLA DE OPERADORES POR SEDE ══ --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-sm font-black uppercase tracking-widest text-slate-600 m-0"><i class="fa-solid fa-people-roof text-red-500 mr-2"></i> Operadores Registrados por Sede</h3>
                <span class="text-[11px] font-black text-slate-400">{{ $operators->flatten()->count() }} cuenta(s)</span>
            </div>

            @forelse($operators as $sedeKey => $group)
                <div class="border-b border-slate-100 last:border-b-0">
                    <div class="px-6 py-2.5 bg-slate-50 flex items-center gap-2">
                        <i class="fa-solid {{ $sedes[$sedeKey]['icon'] ?? 'fa-building' }} text-slate-400 text-xs"></i>
                        <span class="text-[11px] font-black uppercase tracking-widest text-slate-500">{{ $sedes[$sedeKey]['label'] ?? ('Sede '.ucfirst($sedeKey ?: 'Sin asignar')) }}</span>
                        <span class="text-[10px] font-black text-slate-400 bg-white border border-slate-200 rounded-full px-2 py-0.5">{{ $group->count() }}</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left">
                            <tbody class="divide-y divide-slate-100">
                                @foreach($group as $op)
                                    <tr class="hover:bg-slate-50/60 transition-colors">
                                        <td class="px-6 py-3">
                                            <div class="flex items-center gap-3">
                                                <div class="w-9 h-9 rounded-full bg-slate-900 text-white flex items-center justify-center font-black text-sm shrink-0">{{ strtoupper(substr($op->name, 0, 1)) }}</div>
                                                <div class="min-w-0">
                                                    <p class="text-xs font-black text-slate-800 m-0 truncate">{{ $op->name }}</p>
                                                    <p class="text-[11px] text-slate-400 m-0 truncate">
                                                        <i class="fa-solid fa-at text-[9px]"></i> {{ $op->username }}
                                                        @if($op->dni) · DNI {{ $op->dni }} @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap">
                                            <span class="text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-lg border
                                                {{ $op->role === 'admin' ? 'bg-red-50 text-red-600 border-red-200' : ($op->role === 'director' ? 'bg-amber-50 text-amber-600 border-amber-200' : 'bg-indigo-50 text-indigo-600 border-indigo-200') }}">
                                                {{ $op->role === 'admin' ? 'Admin' : ($op->role === 'director' ? 'Director' : 'Operador') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap">
                                            <span class="inline-flex items-center gap-1.5 text-[11px] font-black uppercase tracking-wider {{ $op->is_active ? 'text-emerald-600' : 'text-slate-400' }}">
                                                <span class="w-1.5 h-1.5 rounded-full {{ $op->is_active ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                                                {{ $op->is_active ? 'Activo' : 'Inactivo' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-[11px] font-bold text-slate-400">
                                            <i class="fa-regular fa-calendar mr-1"></i> {{ $op->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-right">
                                            @if($op->id !== auth()->id())
                                                <form action="{{ route('users.toggle', $op) }}" method="POST" class="m-0 inline">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" onclick="return confirm('¿Cambiar el estado de acceso de este operador?')"
                                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-wider border transition-colors cursor-pointer
                                                            {{ $op->is_active ? 'bg-white text-red-600 border-red-200 hover:bg-red-50' : 'bg-white text-emerald-600 border-emerald-200 hover:bg-emerald-50' }}">
                                                        <i class="fa-solid {{ $op->is_active ? 'fa-user-slash' : 'fa-user-check' }}"></i>
                                                        {{ $op->is_active ? 'Desactivar' : 'Activar' }}
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-[10px] font-bold text-slate-300 uppercase">Tú</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center text-slate-400"><span class="text-xs font-bold uppercase tracking-wider">No hay operadores registrados aún.</span></div>
            @endforelse
        </div>
    </div>
</x-app-layout>
