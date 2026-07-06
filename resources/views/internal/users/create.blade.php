<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-black text-2xl text-slate-800 leading-none">Registrar Nuevo Usuario</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Control de Accesos y Sedes Regionales</p>
            </div>
            <a href="{{ route('dashboard') }}" class="bg-white hover:bg-gray-100 text-gray-700 font-bold text-xs py-2.5 px-4 rounded-xl border border-gray-250 shadow-sm transition decoration-none">
                <i class="fa-solid fa-arrow-left mr-1"></i> Volver al Panel
            </a>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-6">
        <div class="bg-white rounded-2xl border border-gray-200 p-6 sm:p-8 shadow-sm text-slate-700">
            <form action="{{ route('users.store') }}" method="POST" class="space-y-5">
                @csrf

                <div class="space-y-1.5">
                    <label for="name" class="text-xs font-black uppercase text-gray-500 tracking-wider">Nombre Completo de la Persona</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400"><i class="fa-solid fa-user text-sm"></i></span>
                        <input type="text" id="name" name="name" required value="{{ old('name') }}" placeholder="Ej. Juan Pérez Quispe"
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 pl-10 pr-4 text-sm font-semibold text-gray-800 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                    </div>
                    @error('name') <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1.5">
                    <label for="username" class="text-xs font-black uppercase text-gray-500 tracking-wider">Nombre de Usuario (Identificador)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400"><i class="fa-solid fa-id-card-clip text-sm"></i></span>
                        <input type="text" id="username" name="username" required value="{{ old('username') }}" placeholder="Ej. jperez_juliaca"
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 pl-10 pr-4 text-sm font-semibold text-gray-800 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                    </div>
                    @error('username') <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="role" class="text-xs font-black uppercase text-gray-500 tracking-wider">Rol de Sistema</label>
                        <select id="role" name="role" required class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm font-semibold text-gray-800 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                            <option value="user" selected>Operador de Sede (User)</option>
                            <option value="director">Director Regional</option>
                            <option value="admin">Administrador General</option>
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label for="sede" class="text-xs font-black uppercase text-gray-500 tracking-wider">Asignación Territorial (Sede)</label>
                        <select id="sede" name="sede" required class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm font-semibold text-gray-800 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                            <option value="juliaca">Sede Juliaca</option>
                            <option value="taraco">Sede Taraco</option>
                            <option value="puno">Sede Central Puno</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label for="password" class="text-xs font-black uppercase text-gray-500 tracking-wider">Contraseña de Acceso</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400"><i class="fa-solid fa-lock text-sm"></i></span>
                        <input type="password" id="password" name="password" required placeholder="••••••••"
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 pl-10 pr-4 text-sm font-semibold text-gray-800 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                    </div>
                    @error('password') <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black text-xs uppercase tracking-wider py-3.5 px-4 rounded-xl shadow-md transition-all border-none cursor-pointer">
                        <i class="fa-solid fa-user-plus mr-1.5"></i> Crear Usuario e Indexar Sede
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>