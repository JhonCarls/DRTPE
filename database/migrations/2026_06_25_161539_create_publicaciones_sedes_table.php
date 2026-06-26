<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branch_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('sede', ['juliaca', 'taraco']); // Indexación directa para consultas veloces
            $table->string('title');
            $table->text('description');
            $table->json('photos'); // Guardará el array de rutas de imágenes
            $table->integer('attendees_count')->nullable(); // Cantidad de personas (opcional)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('branch_activities');
    }
};