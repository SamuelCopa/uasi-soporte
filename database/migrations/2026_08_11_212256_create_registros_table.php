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
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->date('fecha_asignacion')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_entrega')->nullable();
            $table->string('cod_registro')->nullable();             
            $table->string('tecnico')->nullable();               
            $table->text('falla')->nullable();            
            $table->string('respaldo')->nullable();            
            $table->text('observaciones')->nullable(); 
            $table->text('otro')->nullable(); 

            $table->timestamps();
            $table->softDeletes(); // Agrega el campo deleted_at   

            $table->unsignedBigInteger('cpu_id')->nullable(); 
            $table->unsignedBigInteger('impresora_id')->nullable(); 
            $table->unsignedBigInteger('raton_id')->nullable(); 
            $table->unsignedBigInteger('parlante_id')->nullable(); 
            $table->unsignedBigInteger('teclado_id')->nullable(); 
            $table->unsignedBigInteger('laptop_id')->nullable(); 
            $table->unsignedBigInteger('monitor_id')->nullable(); 
            $table->unsignedBigInteger('audifono_id')->nullable(); 
            $table->unsignedBigInteger('estabilizador_id')->nullable(); 
            $table->unsignedBigInteger('ups_id')->nullable(); 
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->unsignedBigInteger('resultado_id')->nullable(); 

            $table->foreign('cpu_id')->references('id')->on('registro_cpus')->onDelete('cascade');
            $table->foreign('impresora_id')->references('id')->on('impresoras')->onDelete('cascade');
            $table->foreign('raton_id')->references('id')->on('ratons')->onDelete('cascade');
            $table->foreign('teclado_id')->references('id')->on('teclados')->onDelete('cascade');
            $table->foreign('parlante_id')->references('id')->on('parlantes')->onDelete('cascade');
            $table->foreign('laptop_id')->references('id')->on('laptops')->onDelete('cascade');
            $table->foreign('monitor_id')->references('id')->on('monitors')->onDelete('cascade');
            $table->foreign('audifono_id')->references('id')->on('audifonos')->onDelete('cascade');
            $table->foreign('estabilizador_id')->references('id')->on('estabilizadors')->onDelete('cascade');
            $table->foreign('ups_id')->references('id')->on('upeses')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('resultado_id')->references('id')->on('resultados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};
