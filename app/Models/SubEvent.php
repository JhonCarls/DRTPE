<?php

namespace App\Models;

use App\Models\Concerns\HasVideos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubEvent extends Model
{
    use HasFactory, HasVideos, SoftDeletes;

    protected $fillable = ['event_id', 'report_title', 'event_date', 'attendees_count', 'comment', 'youtube_url', 'videos', 'photos', 'photo_priority'];

    // Para manejar las fotos como array automáticamente
    protected $casts = [
        'photos' => 'array',
        'photo_priority' => 'array',
        'videos' => 'array',
        'event_date' => 'date',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Enlaces de difusión del reporte.
     *
     * 'youtube_url' es la columna heredada de cuando solo se admitía YouTube:
     * se usa como respaldo si el registro todavía no tiene el arreglo 'videos'
     * (por ejemplo, si aún no se ejecutó el backfill de la migración).
     */
    public function videoLinks(): array
    {
        $links = array_values(array_filter((array) ($this->videos ?? []), 'is_string'));

        if ($links === [] && ! empty($this->youtube_url)) {
            $links[] = trim((string) $this->youtube_url);
        }

        return $links;
    }
}
