@props([
    /** Videos ya resueltos por App\Support\VideoEmbed (array de arrays). */
    'videos' => [],
    /** Encabezado opcional sobre la galería. */
    'heading' => 'Difusión en redes sociales',
    /** Oculta el encabezado cuando la galería va dentro de otra tarjeta. */
    'bare' => false,
])

@php
    $videos = array_values(array_filter((array) $videos));
@endphp

@if (! empty($videos))
    <x-video-player-assets />

    <div {{ $attributes->merge(['class' => 'mt-6']) }}>
        @unless ($bare)
            <div class="flex items-center gap-2 mb-3">
                <i class="fa-solid fa-clapperboard text-red-500 text-xs"></i>
                <span class="text-[10px] font-black uppercase tracking-widest text-slate-500">{{ $heading }}</span>
                <span class="text-[10px] font-bold text-slate-400">({{ count($videos) }})</span>
            </div>
        @endunless

        <div class="grid grid-cols-1 {{ count($videos) > 1 ? 'sm:grid-cols-2' : '' }} gap-4">
            @foreach ($videos as $video)
                <div class="vp-frame {{ $video['orientation'] === 'portrait' ? 'is-portrait' : '' }}"
                     data-provider="{{ $video['provider'] }}"
                     data-embed="{{ $video['embed_url'] }}"
                     data-url="{{ $video['url'] }}"
                     data-label="{{ $video['provider_label'] }}"
                     data-title="Video en {{ $video['provider_label'] }}">

                    <span class="vp-tag">
                        <i class="fa-brands fa-{{ $video['provider'] }}"></i> {{ $video['provider_label'] }}
                    </span>

                    @if ($video['can_embed'])
                        <button type="button" class="vp-poster vp-poster--{{ $video['provider'] }}"
                                aria-label="Reproducir video de {{ $video['provider_label'] }}">
                            @if ($video['thumbnail_url'])
                                <img src="{{ $video['thumbnail_url'] }}" loading="lazy" decoding="async"
                                     alt="Miniatura del video en {{ $video['provider_label'] }}">
                            @else
                                {{-- Facebook y TikTok no exponen miniatura pública sin credenciales. --}}
                                <span class="vp-brand">
                                    <i class="fa-brands fa-{{ $video['provider'] }}"></i>
                                    <span>Ver video en {{ $video['provider_label'] }}</span>
                                </span>
                            @endif
                            <span class="vp-play">
                                <svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                            </span>
                        </button>
                    @else
                        {{-- Enlace corto que no se pudo expandir: se ofrece abrirlo en su red. --}}
                        <a href="{{ $video['url'] }}" target="_blank" rel="noopener"
                           class="vp-external vp-poster--{{ $video['provider'] }}">
                            <i class="fa-brands fa-{{ $video['provider'] }} text-3xl"></i>
                            <strong>Ver en {{ $video['provider_label'] }}</strong>
                            <small>Se abrirá en una pestaña nueva</small>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endif
