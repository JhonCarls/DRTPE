@props([
    /**
     * Expresión Alpine que apunta al arreglo de videos ya resueltos por
     * App\Support\VideoEmbed (por ejemplo "ev.videos" o "act.videos").
     */
    'items' => 'videos',
    'heading' => 'Difusión en redes sociales',
])

{{--
    Versión Alpine de la galería, para las listas que el portal arma en el
    cliente (modal de talleres ejecutados, tarjetas de sede desconcentrada).

    A diferencia de x-video-gallery, aquí la reproducción se gobierna con
    estado Alpine (`played`) en vez de manipular el DOM a mano: así Alpine
    conserva el control de los nodos que él mismo creó.
--}}
<x-video-player-assets />

<template x-if="(({{ $items }}) || []).length">
    <div class="mt-5">
        <div class="flex items-center gap-2 mb-3">
            <i class="fa-solid fa-clapperboard text-red-500 text-xs"></i>
            <span class="text-[10px] font-black uppercase tracking-widest text-slate-500">{{ $heading }}</span>
            <span class="text-[10px] font-bold text-slate-400" x-text="'(' + ((({{ $items }}) || []).length) + ')'"></span>
        </div>

        <div class="grid grid-cols-1 gap-4">
            <template x-for="(vid, vidIdx) in (({{ $items }}) || [])" :key="vidIdx">
                <div class="vp-frame" :class="vid.orientation === 'portrait' ? 'is-portrait' : ''"
                     :data-provider="vid.provider" x-data="{ played: false }">

                    <span class="vp-tag">
                        <i :class="'fa-brands fa-' + vid.provider"></i>
                        <span x-text="vid.provider_label"></span>
                    </span>

                    {{-- Portada: solo se solicita el iframe de la red al pulsar. --}}
                    <template x-if="!played && vid.can_embed">
                        <button type="button" class="vp-poster" :class="'vp-poster--' + vid.provider"
                                @click="played = true"
                                :aria-label="'Reproducir video de ' + vid.provider_label">
                            <template x-if="vid.thumbnail_url">
                                <img :src="vid.thumbnail_url" loading="lazy" decoding="async" alt="">
                            </template>
                            <template x-if="!vid.thumbnail_url">
                                <span class="vp-brand">
                                    <i :class="'fa-brands fa-' + vid.provider"></i>
                                    <span x-text="'Ver video en ' + vid.provider_label"></span>
                                </span>
                            </template>
                            <span class="vp-play">
                                <svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                            </span>
                        </button>
                    </template>

                    <template x-if="played">
                        <iframe :src="vid.embed_url" loading="lazy" allowfullscreen
                                referrerpolicy="strict-origin-when-cross-origin"
                                allow="autoplay; encrypted-media; picture-in-picture; clipboard-write; web-share"
                                :title="'Video en ' + vid.provider_label"></iframe>
                    </template>

                    {{-- Enlace corto sin id resoluble: se abre en su red de origen. --}}
                    <template x-if="!vid.can_embed">
                        <a :href="vid.url" target="_blank" rel="noopener"
                           class="vp-external" :class="'vp-poster--' + vid.provider">
                            <i :class="'fa-brands fa-' + vid.provider" class="text-3xl"></i>
                            <strong x-text="'Ver en ' + vid.provider_label"></strong>
                            <small>Se abrirá en una pestaña nueva</small>
                        </a>
                    </template>
                </div>
            </template>
        </div>
    </div>
</template>
