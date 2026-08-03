<?php

namespace App\Models;

use App\Models\Concerns\HasVideos;
use Illuminate\Database\Eloquent\Attributes\Fillable; // 👈 Mismo estilo de atributos nativos
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'sede', 'title', 'type', 'description', 'photos', 'videos', 'attendees_count'])]
class BranchActivity extends Model
{
    use HasVideos;

    /**
     * Nombre de la tabla explícita en la base de datos
     */
    protected $table = 'branch_activities';

    /**
     * Configuración moderna de casteos de tipos de datos (Laravel 11)
     */
    protected function casts(): array
    {
        return [
            // Convierte automáticamente el JSON de la BD en un array de PHP y viceversa
            'photos' => 'array',
            'videos' => 'array',
        ];
    }

    /**
     * Relación: La actividad pertenece de forma obligatoria a un usuario/creador
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
