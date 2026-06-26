<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Sede a la que pertenece el usuario ('puno' para la central, o las desconcentradas)
            $table->enum('sede', ['puno', 'juliaca', 'taraco'])->default('puno')->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('sede');
        });
    }
};