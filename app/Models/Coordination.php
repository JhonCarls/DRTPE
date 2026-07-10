<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Coordinación institucional realizada (módulo independiente).
 *
 * @property int $id
 * @property string $title
 * @property Carbon $coordination_date
 * @property string $description
 * @property array|null $photos
 */
class Coordination extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'coordination_date',
        'description',
        'photos',
    ];

    protected $casts = [
        'coordination_date' => 'date',
        'photos' => 'array',
    ];

    /** Estructura plana para el portal público / Alpine.js. */
    public function toPublicArray(): array
    {
        $photos = collect($this->photos ?? [])
            ->map(fn ($p) => asset('storage/'.$p))
            ->values()->all();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => preg_replace('/\s+/', ' ', (string) $this->description),
            'date' => optional($this->coordination_date)->format('d/m/Y'),
            'photos' => $photos,
            'cover' => $photos[0] ?? null,
            'photos_count' => count($photos),
        ];
    }
}
