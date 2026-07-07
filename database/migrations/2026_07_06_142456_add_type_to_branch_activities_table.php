<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('branch_activities', function (Blueprint $table) {
            // Agrega el campo tipo string con un fallback por defecto
            $table->string('type')->default('asesoria')->after('title');
        });
    }

    public function down(): void
    {
        Schema::table('branch_activities', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};