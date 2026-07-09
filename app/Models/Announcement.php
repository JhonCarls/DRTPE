<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    /**
     * Sedes desconcentradas reconocidas por el sistema. Cualquier autor cuya sede
     * NO esté en esta lista (ej. 'puno', null) se considera Sede Principal → global.
     */
    public const SEDES_DESCONCENTRADAS = ['juliaca', 'taraco'];

    protected $fillable = ['user_id', 'sede', 'title', 'description', 'file_path', 'file_type', 'published_at', 'expired_at', 'attachments'];

    protected $casts = [
        'attachments' => 'array',
        'published_at' => 'date',
        'expired_at' => 'date',
    ];

    /**
     * Se agrega la etiqueta legible de la sede a la serialización JSON para que las
     * vistas (pop-up y tablón del inicio) puedan mostrar de qué sede es el comunicado.
     */
    protected $appends = ['sede_label'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Etiqueta legible de la sede destino: los institucionales (sede = NULL) se rotulan
     * como "Sede Central"; los demás con el nombre de su sede desconcentrada.
     */
    public function getSedeLabelAttribute(): string
    {
        return match (mb_strtolower((string) $this->sede)) {
            'juliaca' => 'Sede Juliaca',
            'taraco' => 'Sede Taraco',
            default => 'Sede Central',
        };
    }

    /**
     * Filtro ESTRICTO por la sede destino del comunicado (columna propia 'sede').
     * Insensible a mayúsculas/minúsculas para evitar fallos con la colación
     * binaria (utf8mb4_bin) de TiDB Cloud.
     */
    public function scopeBySede(Builder $query, ?string $sede): Builder
    {
        return $query->whereRaw('LOWER(sede) = ?', [mb_strtolower((string) $sede)]);
    }

    /**
     * Comunicados de alcance General / Institucional (Sede Principal): sin sede destino.
     */
    public function scopeGlobalPrincipal(Builder $query): Builder
    {
        return $query->whereNull('sede');
    }

    /**
     * Colección visible en el portal de UNA sede desconcentrada:
     * sus propios comunicados (estricto) + los generales de la Sede Principal.
     * NUNCA los de otra sede desconcentrada (aislamiento estricto).
     */
    public function scopeVisibleForSede(Builder $query, ?string $sede): Builder
    {
        $sedeLower = mb_strtolower((string) $sede);

        return $query->where(function (Builder $q) use ($sedeLower) {
            $q->whereRaw('LOWER(sede) = ?', [$sedeLower])
                ->orWhereNull('sede');
        });
    }

    /**
     * Estructura plana y segura para Alpine.js: documento matriz + anexos, ya con
     * sus URLs públicas de storage resueltas. Reutilizable en el panel de gestión,
     * el tablón público y cualquier modal de detalle.
     */
    public function toRepositoryArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'vigencia' => optional($this->published_at)->format('d/m/Y').' — '.optional($this->expired_at)->format('d/m/Y'),
            'main_url' => $this->file_path ? asset('storage/'.$this->file_path) : null,
            'main_is_pdf' => $this->file_type === 'pdf',
            'main_is_image' => $this->file_type === 'image',
            'attachments' => collect($this->attachments ?? [])->map(function ($path, $i) {
                return [
                    'path' => $path, // ruta cruda de storage (para gestionar eliminación en edición)
                    'url' => asset('storage/'.$path),
                    'is_pdf' => str_ends_with(strtolower((string) $path), '.pdf'),
                    'label' => 'Anexo N° '.($i + 1),
                ];
            })->values()->all(),
            'attachments_count' => count($this->attachments ?? []),
        ];
    }
}
