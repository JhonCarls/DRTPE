<?php

namespace App\Models\Concerns;

use App\Support\VideoEmbed;

/**
 * Difusión audiovisual compartida por los módulos que se publican en el portal.
 *
 * La columna 'videos' guarda un arreglo JSON de URLs públicas (misma convención
 * que 'photos'); la resolución a reproductor incrustado ocurre en lectura vía
 * App\Support\VideoEmbed.
 *
 * Los modelos que arrastran una columna heredada de un solo enlace (SubEvent y
 * su 'youtube_url') sobrescriben videoLinks() para fusionarla.
 */
trait HasVideos
{
    /**
     * URLs crudas tal como se guardaron, en su orden de carga.
     *
     * @return array<int, string>
     */
    public function videoLinks(): array
    {
        return array_values(array_filter((array) ($this->videos ?? []), 'is_string'));
    }

    /**
     * Videos ya normalizados para el reproductor del portal.
     *
     * @return array<int, array<string, mixed>>
     */
    public function videoEmbeds(): array
    {
        return VideoEmbed::resolveMany($this->videoLinks());
    }

    /** Atajo para las vistas: ¿este registro tiene difusión audiovisual? */
    public function getHasVideosAttribute(): bool
    {
        return $this->videoEmbeds() !== [];
    }

    /** Cantidad de videos reproducibles (para contadores y reportes). */
    public function getVideosCountAttribute(): int
    {
        return count($this->videoEmbeds());
    }
}
