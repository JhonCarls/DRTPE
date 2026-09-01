{{--
    Estilos y reproductor compartidos por las galerías de video del portal.

    Se emiten una sola vez por respuesta (@once) porque tanto la versión
    renderizada en servidor (x-video-gallery) como la versión Alpine
    (x-video-gallery-live) los necesitan y pueden coexistir en la misma página.

    El CSS es autónomo a propósito: el portal público carga Tailwind por CDN y
    la intranet lo compila con Vite, así que aquí no se depende de utilidades
    que puedan no existir en uno de los dos pipelines.

    ── Por qué no basta con @once ─────────────────────────────────────────
    En una página con @extends, Blade renderiza @section('content') ANTES que
    el layout, de modo que una galería del contenido consume el @once antes de
    que partials/head llegue a emitirlo. Si esa galería está dentro de un
    <template> de Alpine —contenido inerte para el navegador— el CSS no se
    aplica y el script no se ejecuta: el reproductor muere en toda la página.

    Por eso partials/head lo invoca con :force="true": emite siempre, pase lo
    que pase, y queda garantizado fuera de cualquier <template>. Las demás
    llamadas siguen siendo idempotentes. Si acaban emitiéndose dos veces,
    video-player.js ignora la segunda carga.
--}}
@props(['force' => false])

@if ($force || ! $__env->hasRenderedOnce('vp-player-assets'))
    @php $__env->markAsRenderedOnce('vp-player-assets'); @endphp
    <style>
        /* ── MARCO RESPONSIVO ────────────────────────────────────────── */
        .vp-frame {
            position: relative;
            width: 100%;
            overflow: hidden;
            border-radius: 16px;
            background: #0f172a;
            box-shadow: 0 10px 24px rgba(15, 23, 42, .16);
        }
        /* Relación de aspecto por truco de padding: compatible con cualquier build. */
        .vp-frame::before { content: ''; display: block; padding-bottom: 56.25%; }      /* 16:9 */
        .vp-frame.is-portrait::before { padding-bottom: 168%; }                          /* 9:16 aprox. */
        .vp-frame.is-portrait { max-width: 340px; }

        .vp-frame > iframe,
        .vp-frame > .vp-poster {
            position: absolute; inset: 0; width: 100%; height: 100%; border: 0;
        }

        /* ── PORTADA ─────────────────────────────────────────────────── */
        .vp-poster {
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; padding: 0; margin: 0;
            transition: filter .3s ease;
        }
        .vp-poster:hover { filter: brightness(1.06); }
        .vp-poster img { width: 100%; height: 100%; object-fit: cover; opacity: .92; }

        /* Portadas de marca para las redes que no exponen miniatura pública. */
        .vp-poster--facebook { background: linear-gradient(135deg, #1877f2 0%, #0b3d91 100%); }
        .vp-poster--tiktok   { background: linear-gradient(135deg, #010101 0%, #25f4ee 180%, #fe2c55 100%); }
        .vp-poster--youtube  { background: linear-gradient(135deg, #7f1d1d 0%, #0f172a 100%); }

        .vp-brand {
            position: absolute; inset: 0;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            gap: 10px; color: #fff; pointer-events: none; text-align: center; padding: 16px;
        }
        .vp-brand i { font-size: 34px; opacity: .95; }
        .vp-brand span {
            font-size: 10px; font-weight: 900; letter-spacing: .12em; text-transform: uppercase; opacity: .82;
        }

        /* ── BOTÓN PLAY ──────────────────────────────────────────────── */
        .vp-play {
            position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
            width: 62px; height: 62px; border-radius: 50%; border: 0;
            display: flex; align-items: center; justify-content: center;
            background: rgba(220, 38, 38, .92); color: #fff; z-index: 5;
            animation: vpPulse 2.4s infinite; pointer-events: none;
        }
        .vp-frame[data-provider="facebook"] .vp-play { background: rgba(24, 119, 242, .95); }
        .vp-frame[data-provider="tiktok"]   .vp-play { background: rgba(254, 44, 85, .95); }
        @keyframes vpPulse {
            0%   { box-shadow: 0 0 0 0 rgba(255, 255, 255, .45); }
            70%  { box-shadow: 0 0 0 16px rgba(255, 255, 255, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0); }
        }

        /* ── ETIQUETA DE RED ─────────────────────────────────────────── */
        .vp-tag {
            position: absolute; top: 10px; left: 10px; z-index: 6;
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 9px; border-radius: 7px;
            font-size: 9px; font-weight: 900; letter-spacing: .1em; text-transform: uppercase;
            color: #fff; background: rgba(15, 23, 42, .72); backdrop-filter: blur(4px);
        }

        /* ── TARJETA DE ENLACE (video no incrustable) ────────────────── */
        .vp-external {
            position: absolute; inset: 0; display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 10px;
            color: #fff; text-decoration: none; padding: 18px; text-align: center;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        }
        .vp-external strong { font-size: 12px; font-weight: 900; }
        .vp-external small  { font-size: 10px; opacity: .75; font-weight: 700; }

        /* ── ESTADO DE CARGA ─────────────────────────────────────────── */
        /* Se muestra mientras el iframe de la red responde y desaparece al
           cargar, para que el marco nunca quede en blanco sin explicación. */
        .vp-status {
            position: absolute; inset: 0; z-index: 4;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            gap: 10px; color: #e2e8f0; background: #0f172a; text-align: center; padding: 16px;
        }
        .vp-status strong { font-size: 12px; font-weight: 900; }
        .vp-status small  { font-size: 10px; opacity: .7; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; }
        .vp-status__spin {
            width: 26px; height: 26px; border-radius: 50%;
            border: 3px solid rgba(226, 232, 240, .22); border-top-color: #e2e8f0;
            animation: vpSpin .8s linear infinite;
        }
        @keyframes vpSpin { to { transform: rotate(360deg); } }
    </style>

    {{-- Reproductor por delegación: un único listener atiende todas las galerías
         de la página, incluidas las que Alpine monta después. Vive en un archivo
         servido desde public/ para que funcione igual en el portal (CDN) y en la
         intranet (Vite), sin depender de scripts en línea. --}}
    @php
        // La versión sigue a la fecha del archivo: al editarlo el navegador
        // descarta su copia en caché sin necesidad de recargar sin caché.
        $vpArchivo = public_path('js/video-player.js');
        $vpVersion = is_file($vpArchivo) ? filemtime($vpArchivo) : 1;
    @endphp
    <script src="{{ asset('js/video-player.js') }}?v={{ $vpVersion }}" defer></script>
@endif
