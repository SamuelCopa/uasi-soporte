<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('otros_equipos', function (Blueprint $table) {

            $table->id();

            // Tipo de equipo
            $table->foreignId('tipo_equipo_id')
                ->constrained('tipos_equipos')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            // Datos generales
            $table->string('cargo')->nullable();
            $table->string('cod_gamea')->nullable();
            $table->string('cod_registro')->nullable();

            $table->timestamp('fecha')->nullable();
            $table->timestamp('fecha_asignacion')->nullable();

            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();

            // Mantenimiento
            $table->text('falla')->nullable();
            $table->text('otro')->nullable();
            $table->text('observaciones')->nullable();

            $table->timestamp('fecha_inicio')->nullable();
            $table->timestamp('fecha_entrega')->nullable();

            // Relaciones
            $table->foreignId('dependencia_id')
                ->nullable()
                ->constrained('dependencias')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('estado_id')
                ->nullable()
                ->constrained('estados')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('responsable_id')
                ->nullable()
                ->constrained('responsables')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('funcionario_id')
                ->nullable()
                ->constrained('funcionarios')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('resultado_id')
                ->nullable()
                ->constrained('resultados')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            // Usuarios
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('reguser_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            // Otros campos de tu tabla audifonos
            $table->boolean('boton_oculto')->default(false);

            $table->boolean('funcionario_activo')->default(true);

            // Fechas Laravel
            $table->timestamps();

            // Eliminación lógica
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('otros_equipos');
    }
};
