<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // 🎯 Cambiamos el tipo a TEXT para soportar descripciones de hasta 65,000 caracteres
            $table->text('description')->change(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Si haces rollback, regresa a la limitación estándar
            $table->string('description', 255)->change();
        });
    }
};