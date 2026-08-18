<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('servicios', function (Blueprint $table) {
            $table->foreignId('dependencia_id')
                  ->nullable()
                  ->after('id')
                  ->constrained('dependencias')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('servicios', function (Blueprint $table) {
            $table->dropForeign(['dependencia_id']);
            $table->dropColumn('dependencia_id');
        });
    }
};
