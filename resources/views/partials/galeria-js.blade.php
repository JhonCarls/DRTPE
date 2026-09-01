{{-- ════════════════════════════════════════════════════════════════════
     GALERÍAS FOTOGRÁFICAS DEL PORTAL — comportamiento compartido

     Antes vivía dentro de welcome.blade.php, por lo que solo la portada
     tenía visor de imágenes. Al extraerlo aquí lo comparten la portada y
     todas las páginas que extienden layouts.portal (entre ellas las de
     zonas desconcentradas), sin duplicar el código.

     Depende del marcado de partials/modals.blade.php (#lightbox) y de las
     clases .galeria-fotos / .foto-galeria / .foto-extra / .btn-mostrar-mas
     definidas en partials/head.blade.php. Si el documento no las trae, el
     script no hace nada: cada acceso al DOM está protegido.
     ════════════════════════════════════════════════════════════════════ --}}
<script>
(function () {
    'use strict';

    // ── Botón "Ver N fotografías adicionales" ───────────────────────────
    // Alterna la clase .mostrar-todas de la cuadrícula, que es la que
    // revela los .foto-extra ocultos a partir de la quinta imagen.
    document.querySelectorAll('.btn-mostrar-mas').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var wrap = this.closest('.rounded-2xl') || this.closest('.bg-slate-50');
            var grid = wrap ? wrap.querySelector('.galeria-fotos') : null;
            if (!grid) return;

            var extras = grid.querySelectorAll('.foto-extra').length;
            var span   = this.querySelector('span');
            var icon   = this.querySelector('i');
            var show   = grid.classList.toggle('mostrar-todas');

            if (span) span.textContent = show
                ? 'Ocultar fotografías adicionales'
                : 'Ver ' + extras + (extras === 1 ? ' fotografía adicional' : ' fotografías adicionales');
            if (icon) {
                icon.classList.toggle('fa-images', !show);
                icon.classList.toggle('fa-chevron-up', show);
            }
        });
    });

    // ── Visor a pantalla completa ───────────────────────────────────────
    var lb     = document.getElementById('lightbox');
    var lbImg  = document.getElementById('lb-img');
    var lbCtr  = document.getElementById('lb-counter');
    var lbNext = document.getElementById('lb-next');
    var lbPrev = document.getElementById('lb-prev');
    var lbX    = document.getElementById('lb-close');

    if (!lb || !lbImg) return;

    var gallery = [], lbIdx = 0;

    function updateLB() {
        if (!gallery.length) return;
        lbImg.style.opacity = '.4';
        setTimeout(function () {
            lbImg.src = gallery[lbIdx].src;
            if (lbCtr) lbCtr.textContent = 'IMAGEN ' + (lbIdx + 1) + ' DE ' + gallery.length;
            lbImg.style.opacity = '1';
        }, 160);
    }

    function openLB()  { updateLB(); lb.classList.add('active'); document.body.style.overflow = 'hidden'; }
    function closeLB() { lb.classList.remove('active'); document.body.style.overflow = ''; }

    // Delegado: cubre también las galerías que Alpine muestre después.
    document.addEventListener('click', function (e) {
        var img = e.target.closest ? e.target.closest('.foto-galeria') : null;
        if (!img) return;
        var grid = img.closest('.galeria-fotos');
        if (!grid) return;
        gallery = Array.prototype.slice.call(grid.querySelectorAll('.foto-galeria'));
        lbIdx = gallery.indexOf(img);
        openLB();
    });

    if (lbX)    lbX.addEventListener('click', closeLB);
    if (lbNext) lbNext.addEventListener('click', function () { lbIdx = (lbIdx + 1) % gallery.length; updateLB(); });
    if (lbPrev) lbPrev.addEventListener('click', function () { lbIdx = (lbIdx - 1 + gallery.length) % gallery.length; updateLB(); });

    lb.addEventListener('click', function (e) { if (e.target === lb) closeLB(); });

    document.addEventListener('keydown', function (e) {
        if (!lb.classList.contains('active')) return;
        if (e.key === 'Escape') closeLB();
        if (e.key === 'ArrowRight' && lbNext) lbNext.click();
        if (e.key === 'ArrowLeft'  && lbPrev) lbPrev.click();
    });
})();
</script>
