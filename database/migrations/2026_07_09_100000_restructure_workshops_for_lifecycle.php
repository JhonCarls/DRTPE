<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Reestructura por completo la tabla `workshops` para soportar el ciclo de vida de
 * Talleres y Capacitaciones (programado ⇄ ejecutado). La tabla estaba vacía, por lo
 * que se recrea desde cero sin pérdida de datos. Las coordinaciones se separan a su
 * propia tabla independiente (ver create_coordinations_table).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('workshops');

        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');

            // Clasificación y fase del ciclo de vida
            $table->enum('type', ['taller', 'capacitacion'])->default('capacitacion');
            $table->enum('status', ['programado', 'ejecutado'])->default('programado');

            // ── FASE A: Programación (Por Hacer) ──────────────────────────
            $table->date('scheduled_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('location')->nullable();

            // Insumos de convocatoria
            $table->string('flyer_path')->nullable();          // afiche promocional (imagen o PDF)
            $table->string('flyer_type')->nullable();          // 'image' | 'pdf'
            $table->json('attachments')->nullable();           // bases / TDR (múltiples)

            // ── FASE B: Ejecución (Hecho) ─────────────────────────────────
            $table->date('executed_date')->nullable();
            $table->unsignedInteger('attendees_count')->nullable();
            $table->json('photos')->nullable();                // galería de evidencias

            // Sincronización automática con el módulo de Comunicados
            $table->boolean('publish_as_announcement')->default(false);
            $table->unsignedBigInteger('announcement_id')->nullable()->index();

            $table->timestamps();

            $table->index(['status', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workshops');
    }
};
