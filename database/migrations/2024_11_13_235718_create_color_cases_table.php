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
        Schema::create('color_cases', function (Blueprint $table) {
            $table->id();
            $table->string('color');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('color_cases', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Elimina el campo deleted_at
        });
        Schema::dropIfExists('color_cases');

    }
};
