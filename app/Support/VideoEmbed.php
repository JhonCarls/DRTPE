<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;

/**
 * Normalizador de enlaces de video de las redes donde la DRTPE difunde sus
 * actividades: YouTube, Facebook y TikTok.
 *
 * Convierte la URL pública que el operador copia y pega (desde la app móvil o
 * el navegador) en la estructura plana que consume el reproductor del portal:
 * proveedor, URL de incrustación, miniatura y orientación del marco.
 *
 * Regla de diseño: en la base de datos solo se guarda la URL original (un
 * arreglo JSON de cadenas, igual que 'photos'). Todo lo derivado se resuelve
 * en tiempo de lectura para que un cambio de reglas de incrustación no obligue
 * a migrar datos.
 */
final class VideoEmbed
{
    /** Redes soportadas por el reproductor incrustado del portal. */
    public const PROVIDERS = ['youtube', 'facebook', 'tiktok'];

    /** Etiquetas legibles para la intranet y el portal. */
    public const LABELS = [
        'youtube' => 'YouTube',
        'facebook' => 'Facebook',
        'tiktok' => 'TikTok',
    ];

    /** Máximo de videos que se aceptan por registro. */
    public const MAX_PER_RECORD = 6;

    /**
     * Resuelve una URL a su estructura de reproducción.
     *
     * Devuelve null si la URL está vacía o no pertenece a una red soportada,
     * de modo que las vistas puedan filtrar sin validaciones adicionales.
     */
    public static function resolve(?string $url): ?array
    {
        $url = trim((string) $url);

        if ($url === '') {
            return null;
        }

        $provider = self::detectProvider($url);

        if ($provider === null) {
            return null;
        }

        return match ($provider) {
            'youtube' => self::resolveYoutube($url),
            'facebook' => self::resolveFacebook($url),
            'tiktok' => self::resolveTiktok($url),
        };
    }

    /**
     * Resuelve una colección de URLs descartando las no soportadas.
     *
     * @param  iterable<string>|null  $urls
     * @return array<int, array<string, mixed>>
     */
    public static function resolveMany($urls): array
    {
        $resolved = [];

        foreach ((array) $urls as $url) {
            $video = self::resolve(is_string($url) ? $url : null);

            if ($video !== null) {
                $resolved[] = $video;
            }
        }

        return $resolved;
    }

    /**
     * Limpia el arreglo que llega del formulario antes de persistirlo:
     * recorta, descarta vacíos y no soportados, expande enlaces cortos de
     * TikTok y elimina duplicados respetando el orden de carga.
     *
     * @param  iterable<string>|null  $urls
     * @return array<int, string>
     */
    public static function sanitize($urls, bool $expandShortLinks = true): array
    {
        $clean = [];

        foreach ((array) $urls as $url) {
            if (! is_string($url)) {
                continue;
            }

            $url = trim($url);

            if ($url === '' || self::detectProvider($url) === null) {
                continue;
            }

            if ($expandShortLinks && self::isShortLink($url)) {
                $url = self::expand($url);
            }

            if (! in_array($url, $clean, true)) {
                $clean[] = $url;
            }

            if (count($clean) >= self::MAX_PER_RECORD) {
                break;
            }
        }

        return $clean;
    }

    /** Indica si la URL pertenece a alguna de las redes soportadas. */
    public static function isSupported(?string $url): bool
    {
        return self::detectProvider(trim((string) $url)) !== null;
    }

    /**
     * Identifica la red social de la URL a partir de su dominio.
     *
     * Se compara sobre el host y no sobre la cadena completa para que un
     * parámetro como "?ref=facebook" no clasifique mal el enlace.
     */
    public static function detectProvider(string $url): ?string
    {
        $host = strtolower((string) parse_url($url, PHP_URL_HOST));

        if ($host === '') {
            return null;
        }

        $host = preg_replace('/^www\./', '', $host);

        return match (true) {
            str_contains($host, 'youtube.com'), $host === 'youtu.be' => 'youtube',
            str_contains($host, 'facebook.com'), $host === 'fb.watch', $host === 'fb.me' => 'facebook',
            str_contains($host, 'tiktok.com') => 'tiktok',
            default => null,
        };
    }

    // ─────────────────────────────────────────────────────────────────────
    // RESOLUCIÓN POR RED
    // ─────────────────────────────────────────────────────────────────────

    /**
     * YouTube: se extrae el identificador de 11 caracteres de cualquiera de sus
     * formatos (watch, youtu.be, embed, shorts, live). Es la única red que
     * expone miniatura pública sin credenciales.
     */
    private static function resolveYoutube(string $url): array
    {
        preg_match(
            '~(?:youtube\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/|live/|v/)|youtu\.be/)([A-Za-z0-9_-]{11})~',
            $url,
            $m
        );

        $id = $m[1] ?? null;

        // Los Shorts son verticales: el marco debe respetar esa proporción.
        $isShort = str_contains(strtolower($url), '/shorts/');

        return self::payload(
            url: $url,
            provider: 'youtube',
            videoId: $id,
            embedUrl: $id ? 'https://www.youtube.com/embed/'.$id.'?autoplay=1&rel=0&modestbranding=1' : null,
            thumbnailUrl: $id ? 'https://img.youtube.com/vi/'.$id.'/hqdefault.jpg' : null,
            orientation: $isShort ? 'portrait' : 'landscape',
        );
    }

    /**
     * Facebook: el plugin oficial acepta la URL pública completa, así que no
     * hace falta extraer el id. No hay miniatura sin token de Graph API, por lo
     * que el reproductor muestra una portada de marca hasta que se pulsa play.
     */
    private static function resolveFacebook(string $url): array
    {
        $isReel = (bool) preg_match('~/reels?/~i', $url);

        $embed = 'https://www.facebook.com/plugins/video.php?href='.rawurlencode($url)
            .'&show_text=false&autoplay=true&width=560';

        preg_match('~(?:videos/|[?&]v=|/reels?/)(\d{6,})~', $url, $m);

        return self::payload(
            url: $url,
            provider: 'facebook',
            videoId: $m[1] ?? null,
            embedUrl: $embed,
            thumbnailUrl: null,
            orientation: $isReel ? 'portrait' : 'landscape',
        );
    }

    /**
     * TikTok: el reproductor oficial necesita el id numérico del video. Los
     * enlaces cortos (vm./vt./t/) no lo contienen; si no se pudo expandir al
     * guardar, el registro se conserva y la tarjeta ofrece abrirlo en TikTok.
     *
     * Se replican los parámetros del script oficial de incrustación: 'lang'
     * deja el reproductor en español y 'embedFrom' identifica el origen del
     * flujo. No son obligatorios, pero alinean la petición con la que TikTok
     * espera.
     *
     * Nota: TikTok limita por IP y a veces devuelve una pantalla negra con
     * "overload-protect triggered" en lugar del video. Es transitorio y no
     * depende de esta URL; se resuelve solo al bajar el ritmo de peticiones.
     */
    private static function resolveTiktok(string $url): array
    {
        preg_match('~/(?:video|v|embed(?:/v2)?)/(\d{6,})~', $url, $m);

        $id = $m[1] ?? null;

        return self::payload(
            url: $url,
            provider: 'tiktok',
            videoId: $id,
            embedUrl: $id ? 'https://www.tiktok.com/embed/v2/'.$id.'?lang=es-ES&embedFrom=oembed' : null,
            thumbnailUrl: null,
            orientation: 'portrait',
        );
    }

    // ─────────────────────────────────────────────────────────────────────
    // ENLACES CORTOS
    // ─────────────────────────────────────────────────────────────────────

    /** Enlaces de "compartir" que ocultan el id real del video. */
    public static function isShortLink(string $url): bool
    {
        $host = strtolower((string) parse_url($url, PHP_URL_HOST));
        $host = preg_replace('/^www\./', '', $host);
        $path = (string) parse_url($url, PHP_URL_PATH);

        return in_array($host, ['vm.tiktok.com', 'vt.tiktok.com', 'fb.watch', 'fb.me', 'youtu.be'], true)
            || ($host === 'tiktok.com' && str_starts_with($path, '/t/'));
    }

    /**
     * Sigue las redirecciones de un enlace corto para obtener la URL canónica.
     *
     * Es una mejora oportunista: si la red no responde o el enlace es inválido
     * se devuelve la URL original sin interrumpir el guardado del formulario.
     */
    public static function expand(string $url): string
    {
        try {
            $response = Http::withHeaders([
                // Sin un User-Agent de navegador TikTok responde con un intersticial.
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0 Safari/537.36',
            ])->timeout(5)->connectTimeout(3)->withOptions([
                'allow_redirects' => ['max' => 5, 'track_redirects' => true],
            ])->get($url);

            $chain = $response->getHeader('X-Guzzle-Redirect-History');
            $final = end($chain);

            if (is_string($final) && $final !== '' && self::detectProvider($final) !== null) {
                // Se descartan los parámetros de rastreo que agregan las apps.
                return strtok($final, '?') ?: $final;
            }
        } catch (\Throwable $e) {
            // Silencioso a propósito: el enlace corto se guarda tal cual.
        }

        return $url;
    }

    // ─────────────────────────────────────────────────────────────────────

    /**
     * Estructura plana común a las tres redes.
     *
     * 'can_embed' distingue el video reproducible dentro del portal del que
     * solo puede abrirse en su red de origen.
     */
    private static function payload(
        string $url,
        string $provider,
        ?string $videoId,
        ?string $embedUrl,
        ?string $thumbnailUrl,
        string $orientation,
    ): array {
        return [
            'url' => $url,
            'provider' => $provider,
            'provider_label' => self::LABELS[$provider],
            'video_id' => $videoId,
            'embed_url' => $embedUrl,
            'thumbnail_url' => $thumbnailUrl,
            'orientation' => $orientation,
            'can_embed' => $embedUrl !== null,
        ];
    }
}
