<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
<title>Portal de Transparencia | DRTPE Puno</title>

{{-- CDNs y Recursos Globales --}}
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
        background-color: var(--navy);
        color: #e2e8f0;
        overflow-x: hidden;
        margin: 0;
    }
    h1, h2, h3, h4, h5 { font-family: 'Sora', sans-serif; }

    /* ── BG SCENE ──────────────────────────────────────────── */
    .bg-scene {
        background-image: url('/images/fondodash2.png');
        background-size: cover;
        background-position: center top;
        background-attachment: fixed;
        background-repeat: no-repeat;
    }

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
        background: rgba(5, 9, 20, .38);
        backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px);
        border-bottom: 1px solid rgba(255, 255, 255, .06);
    }
    .section-dark {
        background: rgba(5, 9, 20, .40);
        backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px);
        border-top: 1px solid rgba(255, 255, 255, .06);
        border-bottom: 1px solid rgba(255, 255, 255, .06);
    }
    .section-deep {
        background: rgba(3, 6, 16, .55);
        backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px);
        border-top: 1px solid rgba(255, 255, 255, .06);
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
        background: rgba(255, 255, 255, .04); border: 1px solid rgba(255, 255, 255, .09);
        border-radius: 18px; overflow: hidden;
        transition: background .2s, border-color .2s, transform .2s, box-shadow .2s;
        cursor: pointer; display: block;
    }
    .record-card:hover { background: rgba(255, 255, 255, .08); border-color: rgba(255, 255, 255, .2); transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0, 0, 0, .4); }

    .noticia-card {
        background: rgba(255, 255, 255, .04); border: 1px solid rgba(255, 255, 255, .09);
        border-radius: 18px; overflow: hidden;
        transition: background .2s, border-color .2s, transform .2s, box-shadow .2s;
    }
    .noticia-card:hover { background: rgba(255, 255, 255, .08); border-color: rgba(255, 255, 255, .2); transform: translateY(-3px); box-shadow: 0 16px 36px rgba(0, 0, 0, .4); }
    .noticia-img-wrap.portrait  { height: 280px; }
    .noticia-img-wrap.landscape { height: 180px; }

    /* ── VIDEO YOUTUBE ─────────────────────────────────────── */
    .video-preview-container { position: relative; overflow: hidden; cursor: pointer; transition: all .3s ease; }
    .video-preview-container:hover { transform: translateY(-4px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, .2); }
    .play-button {
        position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
        background: rgba(220, 38, 38, .9); width: 64px; height: 64px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center; transition: all .4s ease;
        animation: pulseRed 2s infinite; z-index: 10;
    }
    @keyframes pulseRed { 0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, .7); } 70% { box-shadow: 0 0 0 15px rgba(239, 68, 68, 0); } 100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); } }

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
</style>