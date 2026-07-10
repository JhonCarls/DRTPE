import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    // Se fija el host del dev-server y del canal HMR a 'localhost' (IPv4) para que
    // coincida con la URL de navegación. Sin esto, Vite escribía el marcador en
    // http://[::1]:5173 (IPv6) y el cliente HMR, al no reconectar, forzaba recargas
    // automáticas de la página tras cargar el dashboard (que sí usa @vite).
    server: {
        host: 'localhost',
        hmr: {
            host: 'localhost',
        },
    },
});
