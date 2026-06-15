{{-- ════════════════════════════════════════════════════════════ --}}
{{-- PHOTO REPORT MODAL (Para las fotos de los Sliders)          --}}
{{-- ════════════════════════════════════════════════════════════ --}}
<div x-data="{ open: false, report: null, photoIndex: 0 }"
     @open-modal.window="report = $event.detail.report; photoIndex = 0; open = true; document.body.style.overflow = 'hidden';"
     x-show="open"
     class="fixed inset-0 z-[100] flex items-center justify-center p-4"
     style="display: none;" 
     x-transition>
     
    {{-- Fondo oscuro del modal --}}
    <div class="absolute inset-0 bg-slate-950/95 backdrop-blur-lg cursor-pointer" @click="open = false; document.body.style.overflow = '';"></div>
    
    {{-- Contenedor del Modal --}}
    <div class="relative w-full max-w-5xl bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row z-10" style="height: min(85vh, 640px);">
        
        {{-- Área de la Imagen (Izquierda) --}}
        <div class="w-full md:w-3/5 h-56 md:h-full bg-slate-900 relative flex items-center justify-center flex-shrink-0">
            <template x-if="report && report.photos && report.photos.length > 0">
                <img :src="'{{ asset('storage') }}/' + report.photos[photoIndex]" class="max-w-full max-h-full object-contain">
            </template>
            
            {{-- Controles de navegación de fotos en el modal --}}
            <button @click="photoIndex = photoIndex === 0 ? report.photos.length - 1 : photoIndex - 1" class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/10 hover:bg-red-600 text-white rounded-full flex items-center justify-center border border-white/20 transition shadow-lg border-none cursor-pointer">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button @click="photoIndex = photoIndex === report.photos.length - 1 ? 0 : photoIndex + 1" class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/10 hover:bg-red-600 text-white rounded-full flex items-center justify-center border border-white/20 transition shadow-lg border-none cursor-pointer">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
        
        {{-- Área de Datos de la Actividad (Derecha) --}}
        <div class="w-full md:w-2/5 p-6 flex flex-col overflow-y-auto bg-slate-50 relative text-slate-800">
            <button @click="open = false; document.body.style.overflow = '';" class="absolute top-4 right-4 w-9 h-9 bg-slate-400 text-white rounded-full hover:bg-red-600 flex items-center justify-center transition border-none cursor-pointer">
                <i class="fa-solid fa-xmark"></i>
            </button>
            
            <div x-show="report" class="mt-4">
                <span class="px-3 py-1.5 rounded-lg text-[10px] font-black uppercase text-white tracking-widest" 
                      :class="report?.type === 'evento' ? 'bg-red-600' : 'bg-blue-600'" 
                      x-text="report?.type === 'evento' ? 'Evento Institucional' : 'Actividad de Difusión'"></span>
                
                <h3 class="text-2xl font-black text-slate-900 mt-4 mb-4 leading-tight" x-text="report?.title"></h3>
                <div class="h-1 w-10 bg-red-600 rounded-full mb-4"></div>
                <p class="text-slate-600 text-sm font-medium leading-relaxed" x-text="report?.description"></p>
                
                {{-- Contador de imágenes inferior --}}
                <div class="mt-6 pt-5 border-t border-slate-200 flex items-center gap-2">
                    <i class="fa-solid fa-camera text-slate-400 text-sm"></i>
                    <p class="text-xs font-bold text-slate-500">
                        Foto <span x-text="photoIndex + 1" class="text-slate-900"></span> de <span x-text="report?.photos?.length" class="text-slate-900"></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ════════════════════════════════════════════════════════════ --}}
{{-- LIGHTBOX (Visor de imágenes a pantalla completa de las galerías) --}}
{{-- ════════════════════════════════════════════════════════════ --}}
<div id="lightbox" class="fixed inset-0 z-[110] bg-slate-950/97 backdrop-blur-xl flex flex-col items-center justify-center">
    
    {{-- Barra superior del Lightbox --}}
    <div class="absolute top-0 left-0 w-full p-5 flex justify-between items-center z-50">
        <span id="lb-counter" class="text-white font-bold text-[10px] tracking-widest bg-white/10 px-4 py-2 rounded-full border border-white/15"></span>
        <button id="lb-close" class="w-11 h-11 bg-white/10 hover:bg-red-600 text-white rounded-full flex items-center justify-center border border-white/15 transition border-none cursor-pointer">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>
    </div>
    
    {{-- Botón Anterior --}}
    <button id="lb-prev" class="absolute left-3 sm:left-8 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/06 hover:bg-red-600 text-white rounded-full flex items-center justify-center border border-white/10 z-50 transition border-none cursor-pointer">
        <i class="fa-solid fa-chevron-left text-xl"></i>
    </button>
    
    {{-- Contenedor de la Imagen principal --}}
    <div class="relative max-w-6xl max-h-[82vh] w-full px-4 sm:px-24 flex items-center justify-center">
        <img id="lb-img" src="" class="max-w-full max-h-[80vh] object-contain rounded-xl shadow-2xl" style="transition: opacity .2s, transform .2s;">
    </div>
    
    {{-- Botón Siguiente --}}
    <button id="lb-next" class="absolute right-3 sm:right-8 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/06 hover:bg-red-600 text-white rounded-full flex items-center justify-center border border-white/10 z-50 transition border-none cursor-pointer">
        <i class="fa-solid fa-chevron-right text-xl"></i>
    </button>
</div>