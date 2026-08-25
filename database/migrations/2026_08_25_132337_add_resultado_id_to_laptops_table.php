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
        Schema::table('laptops', function (Blueprint $table) {
            $table->foreignId('resultado_id')->constrained('resultados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laptops', function (Blueprint $table) {
            $table->dropForeign('laptopss_resultado_id_foreign');
            $table->dropColumn('resultado_id');
        });
    }
};
