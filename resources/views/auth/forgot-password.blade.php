<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight m-0">Recuperar Acceso</h1>
        <p class="text-slate-500 text-xs font-medium mt-2 leading-relaxed px-2">
            Indíquenos su correo electrónico institucional y le enviaremos un enlace para restablecer su contraseña de acceso.
        </p>
    </div>

    {{-- Mensaje de estado (ej. enlace de recuperación enviado) --}}
    @if (session('status'))
        <div class="mb-5 p-3 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-xs font-bold flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i> {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div class="space-y-2">
            <label for="email" class="block text-sm font-bold text-slate-700 ml-1">Correo Electrónico Institucional</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fa-solid fa-envelope text-slate-400 group-focus-within:text-red-600 transition-colors"></i>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                       class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 font-medium placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent transition-all shadow-inner"
                       placeholder="usuario@drtpe.gob.pe">
            </div>
            @error('email')
                <p class="text-red-500 text-xs font-bold ml-1 flex items-center gap-1 mt-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-slate-900 hover:bg-red-700 text-white font-bold text-sm uppercase tracking-wider py-4 rounded-xl transition-all duration-300 shadow-[0_8px_20px_-6px_rgba(0,0,0,0.3)] hover:-translate-y-0.5 flex justify-center items-center gap-3 border-none cursor-pointer">
            <i class="fa-solid fa-paper-plane"></i> Enviar Enlace de Recuperación
        </button>

        <p class="text-center text-xs text-slate-500 font-medium m-0">
            ¿Recordó su contraseña?
            <a href="{{ route('login') }}" class="font-bold text-red-600 hover:text-red-700 decoration-none">Volver al acceso</a>
        </p>
    </form>
</x-guest-layout>
