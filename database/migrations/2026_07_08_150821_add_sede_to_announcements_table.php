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
        Schema::table('announcements', function (Blueprint $table) {
            // Sede destino del comunicado. NULL = alcance General / Institucional
            // (Sede Principal, visible en todos los portales). Un valor como
            // 'juliaca' / 'taraco' lo restringe a esa sede desconcentrada.
            $table->string('sede')->nullable()->after('user_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropIndex(['sede']);
            $table->dropColumn('sede');
        });
    }
};
