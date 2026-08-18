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
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();

            $table->string('cite')->nullable();
            $table->string('dirigido_a')->nullable();
            $table->string('cargo')->nullable();
            $table->date('fecha_actual')->nullable();
            $table->string('cite_antecedentes')->nullable();
            $table->text('referencia')->nullable();
            $table->text('instruccion')->nullable();
            $table->text('caract_sicaf')->nullable();
            $table->text('descripcion_trabajo')->nullable();

            $table->unsignedBigInteger('cod_gamea')->nullable();
            $table->unsignedBigInteger('tecnico')->nullable();
            $table->unsignedBigInteger('fecha_recepcion')->nullable();
            $table->unsignedBigInteger('via1')->nullable();
            $table->unsignedBigInteger('via2')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('cod_gamea')->references('id')->on('impresoras')->onDelete('cascade');
            $table->foreign('fecha_recepcion')->references('id')->on('impresoras')->onDelete('cascade');
            $table->foreign('via1')->references('id')->on('responsables')->onDelete('cascade');
            $table->foreign('via2')->references('id')->on('responsables')->onDelete('cascade');
            $table->foreign('tecnico')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
