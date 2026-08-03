<?php

namespace App\Rules;

use App\Support\VideoEmbed;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Valida que el enlace pegado por el operador pertenezca a una de las redes
 * que el portal sabe reproducir de forma incrustada.
 *
 * Los campos vacíos se dan por válidos: el repetidor de videos siempre envía
 * una fila en blanco y quien decide descartarla es VideoEmbed::sanitize().
 */
class SupportedVideoUrl implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || trim($value) === '') {
            return;
        }

        if (! VideoEmbed::isSupported($value)) {
            $fail('El enlace de video debe ser de YouTube, Facebook o TikTok.');
        }
    }
}
