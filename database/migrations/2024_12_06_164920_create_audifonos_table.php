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
        Schema::create('audifonos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('ci')->nullable();
            $table->string('cargo')->nullable();
            $table->string('celular')->nullable();
            $table->string('cod_gamea')->nullable();
            $table->string('tecnico')->nullable();
            $table->string('cod_registro')->nullable();
            $table->date('fecha');
            $table->date('fecha_inicio');
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->text('falla')->nullable();
            $table->text('otro')->nullable();
            $table->text('observaciones')->nullable();
            $table->unsignedBigInteger('dependencia_id')->nullable();
            $table->unsignedBigInteger('estado_id')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Agrega el campo deleted_at


            $table->foreign('dependencia_id')->references('id')->on('dependencias')->onDelete('cascade');
            $table->foreign('estado_id')->references('id')->on('estados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audifonos', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Elimina el campo deleted_at
        });
        Schema::dropIfExists('audifonos');
    }
};
