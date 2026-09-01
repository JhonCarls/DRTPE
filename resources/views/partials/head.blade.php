<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
<title>Portal de Transparencia | DRTPE Puno</title>

{{-- CDNs y Recursos Globales --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800;900&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --red:       #dc2626;
        --navy:      #060c1a;
        --sidebar-w: 300px;
        --header-h:  68px;
        --navbar-h:  72px;
        --diag:      4.5vw;
    }

    *, *::before, *::after { box-sizing: border-box; }
    html { scroll-behavior: smooth; }

    body {
        font-family: 'DM Sans', sans-serif;
        background-color: #eceff4;
        background-image: linear-gradient(180deg, #f6f8fb 0%, #e9edf3 100%);
        background-attachment: fixed;
        color: #334155;
        overflow-x: hidden;
        margin: 0;
    }
    h1, h2, h3, h4, h5 { font-family: 'Sora', sans-serif; }

    /* ── BG SCENE ──────────────────────────────────────────── */
    /* Fondo institucional limpio: degradado profundo con sutiles halos
       rojo/azul para dar profundidad sin ruido visual, mejorando la
       legibilidad del texto sobre las tarjetas. */
    .bg-scene {
        background-color: #070d1e;
        background-image:
            radial-gradient(1100px 620px at 6% -8%, rgba(220, 38, 38, .20), transparent 58%),
            radial-gradient(1000px 720px at 102% 2%, rgba(37, 99, 235, .16), transparent 56%),
            radial-gradient(1200px 900px at 50% 120%, rgba(30, 58, 138, .22), transparent 60%),
            linear-gradient(180deg, #0b1327 0%, #080f21 48%, #05091a 100%);
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-size: cover;
    }

    /* Fondo CLARO institucional para las subsecciones (Estructura Orgánica,
       Servicios, Administración). Limpio, con tintes muy sutiles. */
    .bg-scene-light {
        background-color: #eef2f7;
        background-image:
            radial-gradient(1000px 560px at 100% -6%, rgba(37, 99, 235, .08), transparent 60%),
            radial-gradient(900px 520px at -4% 2%, rgba(220, 38, 38, .06), transparent 58%),
            linear-gradient(180deg, #f8fafc 0%, #eff3f8 55%, #e9eef5 100%);
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-size: cover;
    }

    /* ── ANIMACIONES DE ENTRADA (scroll reveal) ────────────── */
    [data-reveal] {
        opacity: 0;
        transform: translateY(26px);
        transition: opacity .65s cubic-bezier(.16, .84, .44, 1),
                    transform .65s cubic-bezier(.16, .84, .44, 1);
        will-change: opacity, transform;
    }
    [data-reveal].revealed { opacity: 1; transform: none; }
    @media (prefers-reduced-motion: reduce) {
        [data-reveal] { opacity: 1 !important; transform: none !important; transition: none !important; }
    }

    /* Realce de tarjetas institucionales (hover) */
    .card-hover {
        transition: transform .3s cubic-bezier(.16, .84, .44, 1),
                    box-shadow .3s ease, border-color .3s ease;
    }
    .card-hover:hover { transform: translateY(-6px); }

    /* Ícono en pastilla con brillo al pasar el cursor */
    .icon-tile { transition: transform .3s ease, box-shadow .3s ease; }
    .card-hover:hover .icon-tile { transform: scale(1.08) rotate(-3deg); }

    @keyframes floatSoft { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-6px); } }
    .float-soft { animation: floatSoft 4s ease-in-out infinite; }

    /* ── BANDAS DE SECCIÓN (ritmo visual institucional) ─────── */
    /* Alternan fondo blanco / tintado con un borde superior de color
       para dividir claramente cada sección y darle vida a la página. */
    .band-white { background: #ffffff; border-bottom: 1px solid #e5e9f0; }
    .band-tint  { background: linear-gradient(180deg, #eef3fb 0%, #e6edf7 100%); border-bottom: 1px solid #dce3ee; }
    .band-slate { background: linear-gradient(180deg, #f1f5f9 0%, #e8eef6 100%); border-bottom: 1px solid #dce3ee; }
    .band-amber { background: linear-gradient(180deg, #fffdf5 0%, #fef7e6 100%); border-bottom: 1px solid #f5e6c8; }
    .band-top-red     { border-top: 3px solid #dc2626; }
    .band-top-indigo  { border-top: 3px solid #6366f1; }
    .band-top-amber   { border-top: 3px solid #f59e0b; }
    .band-top-emerald { border-top: 3px solid #10b981; }
    .band-top-blue    { border-top: 3px solid #3b82f6; }

    /* Etiqueta "eyebrow" de sección */
    .eyebrow { font-family: 'Sora', sans-serif; font-weight: 800; font-size: 11px; letter-spacing: .22em; text-transform: uppercase; }

    /* ── SIDEBAR ───────────────────────────────────────────── */
    #sidebar {
        position: fixed; 
        left: 0;
        top: calc(var(--header-h));
        width: var(--sidebar-w);
        height: calc(100vh - var(--header-h));
        background: rgba(4, 8, 20, .97);
        border-right: 1px solid rgba(255, 255, 255, .07);
        backdrop-filter: blur(28px); 
        -webkit-backdrop-filter: blur(28px);
        overflow-y: auto; 
        overflow-x: hidden;
        z-index: 45;
        transition: transform .3s cubic-bezier(.4, 0, .2, 1);
    }
    #sidebar::-webkit-scrollbar { width: 3px; }
    #sidebar::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, .1); border-radius: 99px; }

    /* Barra de desplazamiento discreta para paneles con contenido desbordado.
       Antes se declaraba dentro de la vista de sede, así que en el resto del
       portal la clase no tenía efecto pese a usarse. */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(148, 163, 184, .55); border-radius: 10px; }

    #sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, .65); z-index: 44; }

    @media (max-width: 1023px) {
        #sidebar      { transform: translateX(-100%); }
        #main-content { margin-left: 0 !important; }
    }
    #sidebar.open         { transform: translateX(0); }
    #sidebar-overlay.open { display: block; }

    /* ── SIDEBAR ITEMS ─────────────────────────────────────── */
    .sb-label {
        font-family: 'Sora', sans-serif; font-size: 9.5px; font-weight: 700;
        letter-spacing: .22em; text-transform: uppercase; color: rgba(255, 255, 255, .24);
        padding: 18px 16px 7px;
        border-top: 1px solid rgba(255, 255, 255, .05); margin-top: 4px;
    }
    .sb-label:first-of-type { border-top: none; margin-top: 0; }

    .sb-item {
        display: flex; align-items: flex-start; gap: 9px;
        padding: 7px 11px; border-radius: 11px; margin: 0 8px 2px;
        cursor: pointer; border-left: 2px solid transparent;
        transition: background .15s, border-color .15s;
    }
    .sb-item:hover  { background: rgba(255, 255, 255, .06); }
    .sb-item.active { background: rgba(220, 38, 38, .12); border-color: #dc2626; }

    .sb-thumb {
        width: 32px; height: 32px; border-radius: 8px; overflow: hidden; flex-shrink: 0;
        background: rgba(255, 255, 255, .05); border: 1px solid rgba(255, 255, 255, .08);
        display: flex; align-items: center; justify-content: center;
    }
    .sb-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .sb-dot { width: 7px; height: 7px; border-radius: 3px; flex-shrink: 0; margin-top: 5px; }

    .sb-sep { display: flex; align-items: center; gap: 7px; padding: 5px 14px 3px; }
    .sb-sep span { font-size: 8.5px; font-weight: 800; letter-spacing: .18em; text-transform: uppercase; white-space: nowrap; }
    .sb-sep::after { content: ''; flex: 1; height: 1px; background: rgba(255, 255, 255, .07); }

    /* ── MAIN LAYOUT ───────────────────────────────────────── */
    #main-content {
        margin-left: var(--sidebar-w);
        min-height: 100vh;
        padding-top: var(--header-h);
        transition: margin-left .3s;
    }

    #top-navbar { padding-left: 0; }
    @media (min-width: 1024px) { #top-navbar { padding-left: var(--sidebar-w); } }

    /* ── SLIDERS ───────────────────────────────────────────── */
    .clip-top    { clip-path: polygon(0 0, 100% 0, 100% calc(100% - var(--diag)), 0 100%); }
    .clip-bottom { clip-path: polygon(0 0, 100% 0, 100% 100%, 0 calc(100% - var(--diag))); }

    .ken-burns { animation: kenBurns 16s ease-out infinite alternate; }
    @keyframes kenBurns { from { transform: scale(1); } to { transform: scale(1.13); } }

    .slider-progress-wrap {
        position: absolute; bottom: var(--diag); left: 0; right: 0;
        height: 3px; background: rgba(255, 255, 255, .12); z-index: 30;
    }
    .slider-progress-fill { height: 100%; transition: width 50ms linear; }

    .slider-dot { width: 8px; height: 8px; border-radius: 99px; background: rgba(255, 255, 255, .3); transition: width .3s, background .3s; cursor: pointer; border: none; padding: 0; }
    .slider-dot.is-active { width: 22px; background: #fff; }

    /* ── SECTION STYLES ────────────────────────────────────── */
    .section-after-sliders {
        position: relative;
        margin-top: calc(-1 * var(--diag));
        padding-top: calc(var(--diag) + 2.5rem);
        background: transparent;
    }
    .section-dark {
        background: rgba(255, 255, 255, .55);
        border-top: 1px solid rgba(15, 23, 42, .07);
        border-bottom: 1px solid rgba(15, 23, 42, .07);
    }
    .section-deep {
        background: transparent;
    }

    /* ── GALLERY ───────────────────────────────────────────── */
    .foto-extra { display: none; opacity: 0; transform: scale(.95); transition: all .45s; }
    .mostrar-todas .foto-extra { display: block; opacity: 1; transform: scale(1); animation: fadeInGrid .45s ease forwards; }
    @keyframes fadeInGrid { from { opacity: 0; transform: translateY(12px) scale(.95); } to { opacity: 1; transform: translateY(0) scale(1); } }
    .foto-galeria { transition: transform .55s; cursor: zoom-in; display: block; }
    .foto-item:hover .foto-galeria { transform: scale(1.05); }

    /* ── TIMELINE ──────────────────────────────────────────── */
    .timeline-rail { border-left: 2px solid rgba(96, 165, 250, .22); }
    .timeline-node {
        position: absolute; left: calc(-1rem - 9px); top: 1.75rem;
        width: 17px; height: 17px; background: #3b82f6;
        border: 3px solid rgba(15, 30, 70, .85); border-radius: 5px;
        box-shadow: 0 0 10px rgba(96, 165, 250, .45);
        transition: all .25s; z-index: 2; transform: rotate(45deg);
    }
    .reporte-wrapper:hover .timeline-node { background: #dc2626; transform: rotate(135deg); box-shadow: 0 0 14px rgba(220, 38, 38, .5); }
    .subevent-card { background: rgba(255, 255, 255, .96); border-radius: 18px; overflow: hidden; box-shadow: 0 4px 24px rgba(0, 0, 0, .18); transition: box-shadow .25s; }
    .subevent-card:hover { box-shadow: 0 8px 36px rgba(0, 0, 0, .28); }

    .activity-header {
        background: linear-gradient(130deg, #0c1a50 0%, #1e3a8a 60%, #1d4ed8 100%);
        border-left: 5px solid #f59e0b; border-radius: 18px; overflow: hidden; position: relative;
    }
    .activity-header::before { content: ''; position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: rgba(245, 158, 11, .07); border-radius: 50%; }

    /* ── CARDS ─────────────────────────────────────────────── */
    .record-card {
        background: #ffffff; border: 1px solid #e2e8f0;
        border-radius: 18px; overflow: hidden;
        transition: border-color .2s, transform .2s, box-shadow .2s;
        cursor: pointer; display: block; box-shadow: 0 1px 3px rgba(15, 23, 42, .06);
    }
    .record-card:hover { border-color: #cbd5e1; transform: translateY(-4px); box-shadow: 0 18px 36px rgba(15, 23, 42, .14); }

    .noticia-card {
        background: #ffffff; border: 1px solid #e2e8f0;
        border-radius: 18px; overflow: hidden;
        transition: border-color .2s, transform .2s, box-shadow .2s;
        box-shadow: 0 1px 3px rgba(15, 23, 42, .06);
    }
    .noticia-card:hover { border-color: #cbd5e1; transform: translateY(-3px); box-shadow: 0 16px 32px rgba(15, 23, 42, .14); }
    .noticia-img-wrap.portrait  { height: 280px; }
    .noticia-img-wrap.landscape { height: 180px; }

    /* ── VIDEO ─────────────────────────────────────────────── */
    /* Los estilos del reproductor viven en x-video-player-assets, que se
       invoca al final de este mismo archivo (fuera de este bloque <style>)
       y se comparte con la intranet: YouTube, Facebook y TikTok. */

    /* ── COMUNICADOS ───────────────────────────────────────── */
    .comunicado-pdf-icon {
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        height: 100%; gap: 12px; padding: 24px;
        background: linear-gradient(135deg, rgba(15, 20, 40, .9), rgba(30, 40, 70, .9));
    }

    /* ── SOCIAL ────────────────────────────────────────────── */
    .social-badge { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 9px; font-size: 11px; font-weight: 700; transition: all .18s; text-decoration: none; white-space: nowrap; }
    .social-badge:hover { transform: translateY(-2px); filter: brightness(1.1); }
    .badge-fb { background: #1877f2; color: #fff; }
    .badge-tt { background: #111; color: #fff; border: 1px solid rgba(255, 255, 255, .15); }

    /* ── FOOTER LIGHT ──────────────────────────────────────── */
    .footer-light { background: rgba(240, 244, 248, .97); backdrop-filter: blur(10px); color: #1e293b; }

    /* ── LIGHTBOX ──────────────────────────────────────────── */
    #lightbox { opacity: 0; visibility: hidden; transition: opacity .35s, visibility .35s; }
    #lightbox.active { opacity: 1; visibility: visible; }

    /* ── HIGHLIGHT SCROLL ──────────────────────────────────── */
    @keyframes highlightPulse { 0% { box-shadow: 0 0 0 0 rgba(220, 38, 38, .6); } 60% { box-shadow: 0 0 0 22px rgba(220, 38, 38, 0); } 100% { box-shadow: none; } }
    .highlight-target { animation: highlightPulse 2s ease; }

    /* ── TOP NAVBAR DROPDOWN ───────────────────────────────── */
    [x-cloak] { display: none !important; }

    /* ═══════════════════════════════════════════════════════════
       ORNAMENTOS PASTEL — capa decorativa suave (acabado artesanal)
       Mantiene el look claro; aporta calidez sin restar formalidad.
       ═══════════════════════════════════════════════════════════ */
    :root {
        --pastel-rose:   #f8d3e0;
        --pastel-mint:   #c8ecdc;
        --pastel-lav:    #e1dbfb;
        --pastel-peach:  #ffe0c9;
        --pastel-sky:    #d3e8ff;
        --pastel-butter: #fceec6;
    }

    /* Halo pastel ambiental detrás de todo el contenido (aparece en los
       espacios entre secciones). No intercepta clics. */
    body::before {
        content: ''; position: fixed; inset: 0; z-index: -1; pointer-events: none;
        background:
            radial-gradient(360px 360px at 7% 15%,  rgba(248, 211, 224, .5), transparent 70%),
            radial-gradient(320px 320px at 93% 22%, rgba(211, 232, 255, .48), transparent 70%),
            radial-gradient(380px 380px at 86% 68%, rgba(200, 236, 220, .44), transparent 72%),
            radial-gradient(320px 320px at 10% 84%, rgba(252, 238, 198, .46), transparent 72%);
    }

    /* Orbe pastel difuminado para decorar secciones concretas */
    .orn-layer { position: absolute; inset: 0; overflow: hidden; pointer-events: none; z-index: 0; border-radius: inherit; }
    .orn-blob  { position: absolute; width: 15rem; height: 15rem; border-radius: 50%; filter: blur(54px); opacity: .55; }
    .orn-blob.rose   { background: var(--pastel-rose); }
    .orn-blob.mint   { background: var(--pastel-mint); }
    .orn-blob.lav    { background: var(--pastel-lav); }
    .orn-blob.peach  { background: var(--pastel-peach); }
    .orn-blob.sky    { background: var(--pastel-sky); }
    .orn-blob.butter { background: var(--pastel-butter); }
    .orn-drift { animation: ornDrift 15s ease-in-out infinite; }
    @keyframes ornDrift { 0%,100% { transform: translate(0,0); } 50% { transform: translate(0,-18px); } }
    @media (prefers-reduced-motion: reduce) { .orn-drift { animation: none; } }

    /* Textura de puntos tenue (grano artesanal) */
    .orn-dots { background-image: radial-gradient(#cdd7e8 1.3px, transparent 1.4px); background-size: 18px 18px; }

    /* Subrayado dibujado a mano bajo títulos (SVG inline, sin recursos externos) */
    .sketch-underline { position: relative; display: inline-block; }
    .sketch-underline::after {
        content: ''; position: absolute; left: -3px; right: -3px; bottom: -.4em; height: .5em; z-index: -1;
        background: no-repeat center / 100% 100%;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 120 12'%3E%3Cpath d='M2,8 C22,2 42,10 62,6 C82,2 102,10 118,5' fill='none' stroke='%23f9a8d4' stroke-width='4' stroke-linecap='round'/%3E%3C/svg%3E");
    }
    .sketch-underline.su-mint::after  { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 120 12'%3E%3Cpath d='M2,8 C22,2 42,10 62,6 C82,2 102,10 118,5' fill='none' stroke='%2334d399' stroke-width='4' stroke-linecap='round'/%3E%3C/svg%3E"); }
    .sketch-underline.su-sky::after   { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 120 12'%3E%3Cpath d='M2,8 C22,2 42,10 62,6 C82,2 102,10 118,5' fill='none' stroke='%2360a5fa' stroke-width='4' stroke-linecap='round'/%3E%3C/svg%3E"); }
    .sketch-underline.su-amber::after { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 120 12'%3E%3Cpath d='M2,8 C22,2 42,10 62,6 C82,2 102,10 118,5' fill='none' stroke='%23fbbf24' stroke-width='4' stroke-linecap='round'/%3E%3C/svg%3E"); }

    /* Pastilla de ícono en tono pastel con anillo suave */
    .tile-pastel {
        border: 1px solid rgba(255, 255, 255, .8);
        box-shadow: 0 8px 20px rgba(148, 163, 184, .22), inset 0 1px 0 rgba(255, 255, 255, .85);
    }
    .tile-rose  { background: linear-gradient(150deg, #fff0f5, var(--pastel-rose));  color: #d76494; }
    .tile-mint  { background: linear-gradient(150deg, #eefbf5, var(--pastel-mint));  color: #2f9e78; }
    .tile-lav   { background: linear-gradient(150deg, #f4f1ff, var(--pastel-lav));   color: #7c6bd4; }
    .tile-peach { background: linear-gradient(150deg, #fff5ec, var(--pastel-peach)); color: #e0864a; }
    .tile-sky   { background: linear-gradient(150deg, #eef7ff, var(--pastel-sky));   color: #4b8fd6; }

    /* Chispa/asterisco decorativo posicionado */
    .orn-spark { position: absolute; pointer-events: none; }
</style>

<script>
    // Scroll reveal institucional: activa elementos con [data-reveal] al entrar al viewport.
    document.addEventListener('DOMContentLoaded', function () {
        var els = document.querySelectorAll('[data-reveal]');
        if (!els.length) return;
        if (!('IntersectionObserver' in window)) {
            els.forEach(function (el) { el.classList.add('revealed'); });
            return;
        }
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });
        els.forEach(function (el) { io.observe(el); });
    });
</script>

{{--
    Estilos y reproductor de las galerías de video.

    Se emiten aquí, en el <head>, y no donde se usa la galería: varias de esas
    posiciones quedan dentro de un <template> de Alpine, cuyo contenido el
    navegador trata como inerte (ni aplica el CSS ni ejecuta el JS).

    force="true" es imprescindible, no decorativo: en las páginas con @extends
    Blade renderiza la sección de contenido ANTES que este layout, así que una
    galería del contenido ya consumió el @once cuando llegamos aquí. Sin forzar,
    la única emisión sería la de dentro del <template> y el reproductor quedaría
    muerto en toda la página (así estaban /talleres-capacitaciones y
    /coordinaciones-institucionales). Emitir dos veces es inocuo: el script se
    autoprotege contra la segunda carga.
--}}
<x-video-player-assets :force="true" />