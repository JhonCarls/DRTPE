@props([
    /** Enlaces ya guardados (array de URLs). En alta se pasa []. */
    'videos' => [],
    /** Nombre del campo; se envía como arreglo (videos[]). */
    'name' => 'videos',
    'label' => 'Difusión en redes sociales',
    'help' => 'Pega el enlace público del video. Puedes agregarlos ahora o volver más tarde para publicar la cobertura del evento.',
    'max' => \App\Support\VideoEmbed::MAX_PER_RECORD,
])

@php
    // old() gana sobre el valor persistido para conservar lo escrito cuando la
    // validación rebota el formulario.
    $initial = array_values(array_filter(
        (array) old($name, $videos),
        fn ($u) => is_string($u) && trim($u) !== ''
    ));
@endphp

<div class="space-y-2" x-data="videoRepeater({{ \Illuminate\Support\Js::from($initial) }}, {{ (int) $max }})">
    <label class="block text-sm font-black text-slate-700 tracking-tight">
        {{ $label }}
        <span class="ml-1 inline-flex items-center gap-1.5 align-middle text-slate-400">
            <i class="fa-brands fa-youtube hover:text-red-500 transition-colors"></i>
            <i class="fa-brands fa-facebook hover:text-blue-600 transition-colors"></i>
            <i class="fa-brands fa-tiktok hover:text-slate-900 transition-colors"></i>
        </span>
    </label>

    <template x-for="(row, i) in rows" :key="row.uid">
        <div class="flex items-center gap-2">
            {{-- Indicador de red detectada en vivo --}}
            <div class="w-10 h-10 rounded-xl border flex items-center justify-center flex-shrink-0 transition-colors"
                 :class="{
                     'bg-red-50 border-red-200 text-red-600': row.provider === 'youtube',
                     'bg-blue-50 border-blue-200 text-blue-600': row.provider === 'facebook',
                     'bg-slate-900 border-slate-900 text-white': row.provider === 'tiktok',
                     'bg-slate-50 border-slate-200 text-slate-300': !row.provider
                 }">
                <i :class="row.provider ? 'fa-brands fa-' + row.provider : 'fa-solid fa-link'"></i>
            </div>

            <input type="url" :name="'{{ $name }}[]'" x-model="row.url" @input="detect(row)"
                   placeholder="https://www.tiktok.com/@drtpepuno/video/..."
                   class="flex-1 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 focus:outline-none transition-all">

            <button type="button" @click="remove(i)"
                    class="w-10 h-10 rounded-xl bg-slate-50 hover:bg-red-50 border border-slate-200 hover:border-red-200 text-slate-400 hover:text-red-500 flex items-center justify-center flex-shrink-0 transition-colors cursor-pointer">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </template>

    {{-- Aviso de enlace no soportado, resuelto en el cliente antes de enviar --}}
    <template x-if="rows.some(r => r.url.trim() !== '' && !r.provider)">
        <p class="text-[11px] font-bold text-amber-600 m-0">
            <i class="fa-solid fa-triangle-exclamation mr-1"></i>
            Hay un enlace que no es de YouTube, Facebook ni TikTok: se descartará al guardar.
        </p>
    </template>

    <div class="flex items-center justify-between gap-3 pt-1">
        <p class="text-[11px] text-slate-400 font-medium m-0">{{ $help }}</p>
        <button type="button" @click="add()" x-show="rows.length < max"
                class="inline-flex items-center gap-1.5 bg-slate-900 hover:bg-indigo-600 text-white text-[11px] font-black uppercase tracking-wider px-3 py-2 rounded-lg transition-colors border-none cursor-pointer flex-shrink-0">
            <i class="fa-solid fa-plus"></i> Agregar video
        </button>
    </div>

    {{-- $errors solo lo comparte el middleware web; se comprueba para que el
         componente también sea renderizable fuera de ese contexto. --}}
    @if (isset($errors))
        @error($name.'.*')
            <p class="text-[11px] font-bold text-red-600 m-0">{{ $message }}</p>
        @enderror
    @endif
</div>

@once
    <script>
        /**
         * Repetidor de enlaces de video para la intranet.
         *
         * La detección de red es solo un apoyo visual: la validación real y el
         * descarte de enlaces no soportados ocurren en el servidor
         * (App\Rules\SupportedVideoUrl + App\Support\VideoEmbed::sanitize).
         */
        document.addEventListener('alpine:init', () => {
            Alpine.data('videoRepeater', (initial, max) => ({
                max,
                uid: 0,
                rows: [],

                init() {
                    (initial || []).forEach((url) => this.push(url));
                    // Siempre se ofrece una fila vacía lista para pegar.
                    if (this.rows.length === 0) this.push('');
                },

                push(url) {
                    const row = { uid: this.uid++, url: url || '', provider: null };
                    this.detect(row);
                    this.rows.push(row);
                },

                add() { if (this.rows.length < this.max) this.push(''); },

                remove(i) {
                    this.rows.splice(i, 1);
                    if (this.rows.length === 0) this.push('');
                },

                detect(row) {
                    const host = (row.url.match(/^https?:\/\/([^/?#]+)/i) || [])[1] || '';
                    const h = host.toLowerCase().replace(/^www\./, '');

                    if (h.includes('youtube.com') || h === 'youtu.be') row.provider = 'youtube';
                    else if (h.includes('facebook.com') || h === 'fb.watch' || h === 'fb.me') row.provider = 'facebook';
                    else if (h.includes('tiktok.com')) row.provider = 'tiktok';
                    else row.provider = null;
                },
            }));
        });
    </script>
@endonce
