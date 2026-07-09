<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Taller o Capacitación con ciclo de vida de 2 fases:
 *  - status 'programado' (Por Hacer): flyer promocional + bases + fecha/hora.
 *  - status 'ejecutado'  (Hecho): galería de evidencias + asistentes.
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $type taller|capacitacion
 * @property string $status programado|ejecutado
 * @property Carbon|null $scheduled_date
 * @property string|null $start_time
 * @property string|null $end_time
 * @property string|null $location
 * @property string|null $flyer_path
 * @property string|null $flyer_type image|pdf
 * @property array|null $attachments
 * @property Carbon|null $executed_date
 * @property int|null $attendees_count
 * @property array|null $photos
 * @property bool $publish_as_announcement
 * @property int|null $announcement_id
 */
class Workshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'status',
        'scheduled_date',
        'start_time',
        'end_time',
        'location',
        'flyer_path',
        'flyer_type',
        'attachments',
        'executed_date',
        'attendees_count',
        'photos',
        'publish_as_announcement',
        'announcement_id',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'executed_date' => 'date',
        'attachments' => 'array',
        'photos' => 'array',
        'publish_as_announcement' => 'boolean',
    ];

    /** Comunicado generado automáticamente al publicar (si aplica). */
    public function announcement(): BelongsTo
    {
        return $this->belongsTo(Announcement::class);
    }

    public function scopeProgramados(Builder $q): Builder
    {
        return $q->where('status', 'programado');
    }

    public function scopeEjecutados(Builder $q): Builder
    {
        return $q->where('status', 'ejecutado');
    }

    /** Etiqueta legible del tipo. */
    public function getTypeLabelAttribute(): string
    {
        return $this->type === 'taller' ? 'Taller' : 'Capacitación';
    }

    /** URL pública del flyer promocional. */
    public function getFlyerUrlAttribute(): ?string
    {
        return $this->flyer_path ? asset('storage/'.$this->flyer_path) : null;
    }

    /**
     * Estructura plana y segura para el portal público / Alpine.js: normaliza flyer,
     * bases y galería con sus URLs de storage ya resueltas.
     */
    public function toPublicArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => preg_replace('/\s+/', ' ', (string) $this->description),
            'type' => $this->type,
            'type_label' => $this->type_label,
            'status' => $this->status,
            'location' => $this->location,
            'scheduled_date' => optional($this->scheduled_date)->format('d/m/Y'),
            'executed_date' => optional($this->executed_date)->format('d/m/Y'),
            'horario' => $this->horario(),
            'attendees_count' => (int) ($this->attendees_count ?? 0),
            'flyer_url' => $this->flyer_url,
            'flyer_is_pdf' => $this->flyer_type === 'pdf',
            'flyer_is_image' => $this->flyer_type === 'image',
            'attachments' => collect($this->attachments ?? [])->map(function ($path, $i) {
                return [
                    'url' => asset('storage/'.$path),
                    'is_pdf' => str_ends_with(strtolower((string) $path), '.pdf'),
                    'label' => 'Base / Documento N° '.($i + 1),
                ];
            })->values()->all(),
            'photos' => collect($this->photos ?? [])->map(fn ($p) => asset('storage/'.$p))->values()->all(),
            'cover' => isset($this->photos[0]) ? asset('storage/'.$this->photos[0]) : null,
            'photos_count' => count($this->photos ?? []),
        ];
    }

    /** Rango horario legible (ej. "09:00 - 12:00"). */
    public function horario(): ?string
    {
        if (! $this->start_time) {
            return null;
        }

        $fmt = fn ($t) => substr((string) $t, 0, 5);

        return $this->end_time
            ? $fmt($this->start_time).' - '.$fmt($this->end_time)
            : $fmt($this->start_time);
    }
}
