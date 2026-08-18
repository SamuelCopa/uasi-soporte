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
        Schema::create('marca_discos', function (Blueprint $table) {
            $table->id();
            $table->string('marca');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marca_discos', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Elimina el campo deleted_at
        });
        Schema::dropIfExists('marca_discos');
    }
};
