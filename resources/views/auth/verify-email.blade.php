<x-guest-layout>
    <div class="text-center mb-6">
        <div class="w-12 h-12 mx-auto bg-amber-50 border border-amber-100 rounded-xl flex items-center justify-center text-amber-600 mb-3">
            <i class="fa-solid fa-envelope-circle-check text-lg"></i>
        </div>
        <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight m-0">Verifique su Correo</h1>
        <p class="text-slate-500 text-xs font-medium mt-2 leading-relaxed px-2">
            Gracias por su registro. Antes de comenzar, verifique su correo electrónico haciendo clic en el enlace que le acabamos de enviar. Si no lo recibió, con gusto le enviaremos otro.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-5 p-3 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-xs font-bold flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i> Se ha enviado un nuevo enlace de verificación a su correo electrónico.
        </div>
    @endif

    <div class="space-y-3">
        <form method="POST" action="{{ route('verification.send') }}" class="m-0">
            @csrf
            <button type="submit" class="w-full bg-slate-900 hover:bg-red-700 text-white font-bold text-sm uppercase tracking-wider py-3.5 rounded-xl transition-all duration-300 shadow-[0_8px_20px_-6px_rgba(0,0,0,0.3)] hover:-translate-y-0.5 flex justify-center items-center gap-3 border-none cursor-pointer">
                <i class="fa-solid fa-rotate-right"></i> Reenviar Correo de Verificación
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit" class="w-full bg-slate-50 hover:bg-slate-100 text-slate-600 font-bold text-xs uppercase tracking-wider py-3 rounded-xl border border-slate-200 transition-colors flex justify-center items-center gap-2 cursor-pointer">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar Sesión
            </button>
        </form>
    </div>
</x-guest-layout>
