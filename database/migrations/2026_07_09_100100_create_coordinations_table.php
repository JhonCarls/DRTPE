<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Módulo independiente de "Coordinaciones Institucionales Realizadas".
 * No tiene relación con Talleres/Capacitaciones: solo título, fecha (SIN hora),
 * descripción/acuerdos y galería fotográfica.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coordinations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('coordination_date');           // fecha estricta, sin hora
            $table->text('description');
            $table->json('photos')->nullable();           // galería de evidencias
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coordinations');
    }
};
