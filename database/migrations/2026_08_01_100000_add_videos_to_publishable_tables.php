<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Difusión audiovisual multiplataforma (YouTube / Facebook / TikTok).
 *
 * Agrega la columna JSON 'videos' a los módulos que se publican en el portal.
 * La migración es aditiva: no elimina 'sub_events.youtube_url' para no perder
 * los enlaces históricos; esa columna queda como respaldo de solo lectura y el
 * modelo la fusiona si 'videos' viniera vacío.
 */
return new class extends Migration
{
    /** Módulos que difunden actividades en el portal público. */
    private const TABLES = ['sub_events', 'workshops', 'coordinations', 'branch_activities'];

    public function up(): void
    {
        foreach (self::TABLES as $table) {
            if (Schema::hasTable($table) && ! Schema::hasColumn($table, 'videos')) {
                Schema::table($table, function (Blueprint $t) {
                    $t->json('videos')->nullable()->after('photos');
                });
            }
        }

        $this->backfillLegacyYoutubeLinks();
    }

    public function down(): void
    {
        foreach (self::TABLES as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'videos')) {
                Schema::table($table, function (Blueprint $t) {
                    $t->dropColumn('videos');
                });
            }
        }
    }

    /**
     * Traslada los enlaces de YouTube ya registrados en sub_events al nuevo
     * arreglo, para que el historial siga viéndose en el portal sin recarga
     * manual. Se codifica en PHP (no con funciones JSON del motor) para que
     * corra igual en TiDB/MySQL y en el SQLite de las pruebas.
     */
    private function backfillLegacyYoutubeLinks(): void
    {
        if (! Schema::hasTable('sub_events') || ! Schema::hasColumn('sub_events', 'youtube_url')) {
            return;
        }

        DB::table('sub_events')
            ->select('id', 'youtube_url')
            ->whereNotNull('youtube_url')
            ->where('youtube_url', '<>', '')
            ->whereNull('videos')
            ->orderBy('id')
            ->chunkById(200, function ($rows) {
                foreach ($rows as $row) {
                    DB::table('sub_events')
                        ->where('id', $row->id)
                        ->update(['videos' => json_encode([trim($row->youtube_url)], JSON_UNESCAPED_SLASHES)]);
                }
            });
    }
};
