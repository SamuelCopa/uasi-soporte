<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laptops', function (Blueprint $table) {
            $table->id();

            $table->foreignId('funcionario_id')
                ->nullable()
                ->constrained('funcionarios')
                ->nullOnDelete();

            $table->foreignId('dependencia_id')
                ->nullable()
                ->constrained('dependencias')
                ->nullOnDelete();

            $table->foreignId('estado_id')
                ->nullable()
                ->constrained('estados')
                ->nullOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('cargo')->nullable();
            $table->string('cod_gamea')->nullable();
            $table->string('cod_registro')->nullable();
            $table->dateTime('fecha')->nullable();
            $table->dateTime('fecha_asignacion')->nullable();

            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->text('falla')->nullable();
            $table->text('observaciones')->nullable();

            $table->dateTime('fecha_inicio')->nullable();
            $table->dateTime('fecha_entrega')->nullable();

            $table->foreignId('reguser_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->boolean('funcionario_activo')->default(true);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laptops');
    }
};