/**
 * Reproductor de las galerías de video del portal (YouTube, Facebook, TikTok).
 *
 * Funciona por delegación: un único listener en el documento atiende todas las
 * galerías de la página, incluidas las que Alpine monta después de la carga.
 *
 * Al pulsar la portada se sustituye por el iframe de la red. Como la carga
 * depende de un tercero que puede rechazarla (video privado, borrado, límite
 * de peticiones), el marco muestra su estado y, si no llega a cargar, ofrece
 * abrir el video en su red de origen en lugar de quedarse en blanco.
 */
(function () {
    'use strict';

    // El componente de assets puede emitirse dos veces en una misma página
    // (partials/head lo fuerza para garantizar que quede fuera de cualquier
    // <template>, y una galería puede haberlo emitido antes). Sin este
    // guardián se registrarían dos listeners y cada clic abriría el video
    // por duplicado.
    if (window.__vpReproductorCargado) return;
    window.__vpReproductorCargado = true;

    /** Margen antes de dar por fallida la carga del iframe. */
    var TIEMPO_ESPERA_MS = 8000;

    function estado(frame, texto, detalle) {
        var caja = document.createElement('div');
        caja.className = 'vp-status';
        caja.innerHTML =
            '<span class="vp-status__spin"></span>' +
            '<strong>' + texto + '</strong>' +
            (detalle ? '<small>' + detalle + '</small>' : '');
        frame.appendChild(caja);
        return caja;
    }

    function respaldo(frame, url, etiqueta) {
        frame.innerHTML =
            '<a class="vp-external" href="' + url + '" target="_blank" rel="noopener">' +
            '<strong>No se pudo incrustar el video</strong>' +
            '<small>Abrir en ' + etiqueta + '</small>' +
            '</a>';
    }

    document.addEventListener('click', function (e) {
        var poster = e.target.closest('.vp-poster');
        if (!poster) return;

        var frame = poster.closest('.vp-frame');
        if (!frame || frame.dataset.vpLoading === '1') return;

        var src = frame.dataset.embed;
        var url = frame.dataset.url || '';
        var etiqueta = frame.dataset.label || 'su red social';

        // Sin data-embed el marco lo gobierna Alpine (x-video-gallery-live),
        // que monta su propio iframe: aquí no hay nada que hacer.
        if (!src) return;

        frame.dataset.vpLoading = '1';
        frame.innerHTML = '';

        var aviso = estado(frame, 'Cargando video…', etiqueta);

        var iframe = document.createElement('iframe');
        iframe.src = src;
        iframe.setAttribute('allowfullscreen', '');
        iframe.setAttribute('referrerpolicy', 'strict-origin-when-cross-origin');
        iframe.setAttribute('allow', 'autoplay; encrypted-media; picture-in-picture; clipboard-write; web-share');
        iframe.setAttribute('title', frame.dataset.title || 'Video institucional');

        var temporizador = setTimeout(function () {
            console.warn('[video-player] Sin respuesta de', etiqueta, 'tras', TIEMPO_ESPERA_MS, 'ms →', src);
            if (url) respaldo(frame, url, etiqueta);
        }, TIEMPO_ESPERA_MS);

        iframe.addEventListener('load', function () {
            clearTimeout(temporizador);
            aviso.remove();
            console.info('[video-player] Iframe cargado:', src);
        });

        iframe.addEventListener('error', function () {
            clearTimeout(temporizador);
            console.error('[video-player] El iframe falló:', src);
            if (url) respaldo(frame, url, etiqueta);
        });

        frame.appendChild(iframe);
        console.info('[video-player] Iframe insertado →', src);
    });

    console.info('[video-player] Listo. Marcos en la página:', document.querySelectorAll('.vp-frame').length);
})();
