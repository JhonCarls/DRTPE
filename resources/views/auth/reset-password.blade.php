<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight m-0">Nueva Contraseña</h1>
        <p class="text-slate-500 text-xs font-medium mt-2 leading-relaxed px-2">
            Cree una contraseña segura para su cuenta institucional cumpliendo todos los requisitos.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5"
          x-data="{
              pw: '',
              show: false,
              showConfirm: false,
              get req() {
                  return {
                      len:   this.pw.length >= 8,
                      upper: /[A-Z]/.test(this.pw),
                      lower: /[a-z]/.test(this.pw),
                      num:   /[0-9]/.test(this.pw),
                      sym:   /[^A-Za-z0-9]/.test(this.pw),
                  };
              }
          }">
        @csrf

        {{-- Token de restablecimiento --}}
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        {{-- Correo Electrónico --}}
        <div class="space-y-2">
            <label for="email" class="block text-sm font-bold text-slate-700 ml-1">Correo Electrónico Institucional</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fa-solid fa-envelope text-slate-400 group-focus-within:text-red-600 transition-colors"></i>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                       class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 font-medium placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent transition-all shadow-inner">
            </div>
            @error('email')
                <p class="text-red-500 text-xs font-bold ml-1 flex items-center gap-1 mt-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
            @enderror
        </div>

        {{-- Nueva Contraseña --}}
        <div class="space-y-2">
            <label for="password" class="block text-sm font-bold text-slate-700 ml-1">Nueva Contraseña</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fa-solid fa-lock text-slate-400 group-focus-within:text-red-600 transition-colors"></i>
                </div>
                <input id="password" x-model="pw" :type="show ? 'text' : 'password'" name="password" required autocomplete="new-password"
                       class="w-full pl-11 pr-12 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 font-medium placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent transition-all shadow-inner"
                       placeholder="••••••••">
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 bg-transparent border-none cursor-pointer">
                    <i class="fa-regular" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                </button>
            </div>
            @error('password')
                <p class="text-red-500 text-xs font-bold ml-1 flex items-center gap-1 mt-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
            @enderror
        </div>

        {{-- Verificador de requisitos en tiempo real --}}
        <div class="bg-slate-50 border border-slate-200 rounded-xl p-3.5" x-show="pw.length > 0" x-cloak x-transition>
            <p class="text-[10px] font-black uppercase tracking-wider text-slate-400 mb-2 m-0">Requisitos de seguridad</p>
            <ul class="space-y-1.5 text-xs font-bold m-0 p-0 list-none">
                <li class="flex items-center gap-2 transition-colors" :class="req.len ? 'text-emerald-600' : 'text-slate-400'">
                    <i class="fa-solid text-[11px]" :class="req.len ? 'fa-circle-check' : 'fa-circle-xmark'"></i> Mínimo 8 caracteres
                </li>
                <li class="flex items-center gap-2 transition-colors" :class="req.upper ? 'text-emerald-600' : 'text-slate-400'">
                    <i class="fa-solid text-[11px]" :class="req.upper ? 'fa-circle-check' : 'fa-circle-xmark'"></i> Al menos una letra mayúscula (A-Z)
                </li>
                <li class="flex items-center gap-2 transition-colors" :class="req.lower ? 'text-emerald-600' : 'text-slate-400'">
                    <i class="fa-solid text-[11px]" :class="req.lower ? 'fa-circle-check' : 'fa-circle-xmark'"></i> Al menos una letra minúscula (a-z)
                </li>
                <li class="flex items-center gap-2 transition-colors" :class="req.num ? 'text-emerald-600' : 'text-slate-400'">
                    <i class="fa-solid text-[11px]" :class="req.num ? 'fa-circle-check' : 'fa-circle-xmark'"></i> Al menos un número (0-9)
                </li>
                <li class="flex items-center gap-2 transition-colors" :class="req.sym ? 'text-emerald-600' : 'text-slate-400'">
                    <i class="fa-solid text-[11px]" :class="req.sym ? 'fa-circle-check' : 'fa-circle-xmark'"></i> Al menos un símbolo (!&#64;#$%...)
                </li>
            </ul>
        </div>

        {{-- Confirmar Contraseña --}}
        <div class="space-y-2">
            <label for="password_confirmation" class="block text-sm font-bold text-slate-700 ml-1">Confirmar Contraseña</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fa-solid fa-lock-open text-slate-400 group-focus-within:text-red-600 transition-colors"></i>
                </div>
                <input id="password_confirmation" :type="showConfirm ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password"
                       class="w-full pl-11 pr-12 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 font-medium placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent transition-all shadow-inner"
                       placeholder="••••••••">
                <button type="button" @click="showConfirm = !showConfirm" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 bg-transparent border-none cursor-pointer">
                    <i class="fa-regular" :class="showConfirm ? 'fa-eye-slash' : 'fa-eye'"></i>
                </button>
            </div>
            @error('password_confirmation')
                <p class="text-red-500 text-xs font-bold ml-1 flex items-center gap-1 mt-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-slate-900 hover:bg-red-700 text-white font-bold text-sm uppercase tracking-wider py-4 rounded-xl transition-all duration-300 shadow-[0_8px_20px_-6px_rgba(0,0,0,0.3)] hover:-translate-y-0.5 flex justify-center items-center gap-3 border-none cursor-pointer">
            <i class="fa-solid fa-key"></i> Restablecer Contraseña
        </button>
    </form>
</x-guest-layout>
