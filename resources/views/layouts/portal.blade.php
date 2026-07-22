<!DOCTYPE html>
<html lang="es">
<head>
    @include('partials.head')
</head>
<body class="antialiased selection:bg-red-700 selection:text-white">

    {{-- Componentes globales fijos --}}
    @include('partials.popup')
    @include('partials.header')
    @include('partials.sidebar')

    {{-- Aquí se inyectará el contenido de cada página --}}
    <div id="main-content">
        @yield('content')
    </div>

    @include('partials.modals')

    {{-- Scripts compartidos por todo el portal --}}
    <script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    document.getElementById('sidebar-toggle')?.addEventListener('click', () => {
        sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
    });
    function openSidebar()  { sidebar.classList.add('open');    overlay.classList.add('open');    }
    function closeSidebar() { sidebar.classList.remove('open'); overlay.classList.remove('open'); }

    function scrollToSection(id) {
        document.getElementById(id)?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
    function playVideo(playButton, youtubeId, containerId) {
        const c = document.getElementById(containerId);
        c.querySelector('.video-thumbnail').style.display = 'none';
        playButton.style.display = 'none';
        const iframe = c.querySelector('.video-iframe');
        iframe.src = `https://www.youtube.com/embed/${youtubeId}?autoplay=1&rel=0`;
        iframe.style.display = 'block';
    }
    document.addEventListener('alpine:init', () => {
        Alpine.data('autoSlider', (items, totalMs) => ({
            items, active: 0, progress: 0, tick: 50,
            init() { if(this.items.length > 1) this.startTimer(); },
            startTimer() {
                const step = 100 / (totalMs / this.tick);
                setInterval(() => {
                    this.progress += step;
                    if(this.progress >= 100) {
                        this.progress = 0;
                        this.active = (this.active + 1) % this.items.length;
                    }
                }, this.tick);
            }
        }));
    });
    </script>
    @stack('scripts')
</body>
</html>