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
        Schema::create('registro_cpus', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->string('nombre')->nullable();
            $table->string('ci')->nullable();
            $table->string('cargo')->nullable();
            $table->string('celular')->nullable();
            $table->string('usuario')->nullable();
            $table->string('contrasena')->nullable();
            $table->string('cod_gamea')->nullable();
            $table->string('cod_registro')->nullable();             
            $table->string('tecnico')->nullable();               
            $table->text('falla')->nullable();            
            $table->string('respaldo')->nullable();            
            $table->text('observaciones')->nullable(); 
            $table->text('otro')->nullable(); 
               

            $table->unsignedBigInteger('modtmadre_id')->nullable(); 
            $table->unsignedBigInteger('dependencia_id')->nullable(); 
            $table->unsignedBigInteger('estado_id')->nullable(); 
            $table->unsignedBigInteger('marcacase_id')->nullable(); 
            $table->unsignedBigInteger('colorcase_id')->nullable(); 
            $table->unsignedBigInteger('marcaprocesador_id')->nullable(); 
            $table->unsignedBigInteger('genprocesador_id')->nullable(); 
            $table->unsignedBigInteger('modeloprocesador_id')->nullable(); 
            $table->unsignedBigInteger('marcatmadre_id')->nullable();             
            $table->unsignedBigInteger('marcadisco_id')->nullable(); 
            $table->unsignedBigInteger('moddisco_id')->nullable(); 
            $table->unsignedBigInteger('capacdisco_id')->nullable(); 
            $table->unsignedBigInteger('tipodisco_id')->nullable(); 
            $table->unsignedBigInteger('marcadisco2_id')->nullable(); 
            $table->unsignedBigInteger('moddisco2_id')->nullable(); 
            $table->unsignedBigInteger('capacdisco2_id')->nullable(); 
            $table->unsignedBigInteger('tipodisco2_id')->nullable();
            $table->unsignedBigInteger('disipador_id')->nullable(); 
            $table->unsignedBigInteger('marcaram_id')->nullable(); 
            $table->unsignedBigInteger('tiporam_id')->nullable(); 
            $table->unsignedBigInteger('capacram_id')->nullable(); 
            $table->unsignedBigInteger('cantidad_id')->nullable(); 
            $table->unsignedBigInteger('disipador2_id')->nullable(); 
            $table->unsignedBigInteger('marcaram2_id')->nullable(); 
            $table->unsignedBigInteger('tiporam2_id')->nullable(); 
            $table->unsignedBigInteger('capacram2_id')->nullable(); 
            $table->unsignedBigInteger('cantidad2_id')->nullable(); 
            $table->unsignedBigInteger('disipador3_id')->nullable(); 
            $table->unsignedBigInteger('marcaram3_id')->nullable(); 
            $table->unsignedBigInteger('tiporam3_id')->nullable(); 
            $table->unsignedBigInteger('capacram3_id')->nullable(); 
            $table->unsignedBigInteger('cantidad3_id')->nullable(); 
            $table->unsignedBigInteger('disipador4_id')->nullable(); 
            $table->unsignedBigInteger('marcaram4_id')->nullable(); 
            $table->unsignedBigInteger('tiporam4_id')->nullable(); 
            $table->unsignedBigInteger('capacram4_id')->nullable(); 
            $table->unsignedBigInteger('cantidad4_id')->nullable(); 
            $table->unsignedBigInteger('marcatvideo_id')->nullable(); 
            $table->unsignedBigInteger('capactvideo_id')->nullable(); 
            $table->unsignedBigInteger('tipotvideo_id')->nullable(); 
            $table->unsignedBigInteger('marcatred_id')->nullable(); 
            $table->unsignedBigInteger('modtred_id')->nullable(); 
            $table->unsignedBigInteger('marcawifi_id')->nullable(); 
            $table->unsignedBigInteger('modcawifi_id')->nullable(); 
            $table->unsignedBigInteger('marcafuente_id')->nullable(); 
            $table->unsignedBigInteger('potfuente_id')->nullable(); 
            $table->unsignedBigInteger('marcacd_id')->nullable(); 
            $table->timestamps();
            $table->softDeletes(); // Agrega el campo deleted_at   

            $table->foreign('modtmadre_id')->references('id')->on('modelo_tmadres')->onDelete('cascade');
            $table->foreign('dependencia_id')->references('id')->on('dependencias')->onDelete('cascade');
            $table->foreign('estado_id')->references('id')->on('estados')->onDelete('cascade');
            $table->foreign('marcacase_id')->references('id')->on('marca_cases')->onDelete('cascade');
            $table->foreign('colorcase_id')->references('id')->on('color_cases')->onDelete('cascade');
            $table->foreign('marcaprocesador_id')->references('id')->on('marca_procesadors')->onDelete('cascade');
            $table->foreign('genprocesador_id')->references('id')->on('gen_procesadors')->onDelete('cascade');
            $table->foreign('modeloprocesador_id')->references('id')->on('modelo_procesadors')->onDelete('cascade');
            $table->foreign('marcatmadre_id')->references('id')->on('marca_tmadres')->onDelete('cascade');
            $table->foreign('marcadisco_id')->references('id')->on('marca_discos')->onDelete('cascade');
            $table->foreign('moddisco_id')->references('id')->on('modelo_discos')->onDelete('cascade');
            $table->foreign('capacdisco_id')->references('id')->on('capacidad_discos')->onDelete('cascade');
            $table->foreign('tipodisco_id')->references('id')->on('tipo_discos')->onDelete('cascade');
            $table->foreign('marcadisco2_id')->references('id')->on('marca_discos')->onDelete('cascade');
            $table->foreign('moddisco2_id')->references('id')->on('modelo_discos')->onDelete('cascade');
            $table->foreign('capacdisco2_id')->references('id')->on('capacidad_discos')->onDelete('cascade');
            $table->foreign('tipodisco2_id')->references('id')->on('tipo_discos')->onDelete('cascade');
            $table->foreign('disipador_id')->references('id')->on('disipador_rams')->onDelete('cascade');
            $table->foreign('marcaram_id')->references('id')->on('marca_rams')->onDelete('cascade');
            $table->foreign('tiporam_id')->references('id')->on('tipo_rams')->onDelete('cascade');
            $table->foreign('capacram_id')->references('id')->on('capacidad_rams')->onDelete('cascade');
            $table->foreign('cantidad_id')->references('id')->on('cantidad_rams')->onDelete('cascade');
            $table->foreign('disipador2_id')->references('id')->on('disipador_rams')->onDelete('cascade');
            $table->foreign('marcaram2_id')->references('id')->on('marca_rams')->onDelete('cascade');
            $table->foreign('tiporam2_id')->references('id')->on('tipo_rams')->onDelete('cascade');
            $table->foreign('capacram2_id')->references('id')->on('capacidad_rams')->onDelete('cascade');
            $table->foreign('cantidad2_id')->references('id')->on('cantidad_rams')->onDelete('cascade');
            $table->foreign('disipador3_id')->references('id')->on('disipador_rams')->onDelete('cascade');
            $table->foreign('marcaram3_id')->references('id')->on('marca_rams')->onDelete('cascade');
            $table->foreign('tiporam3_id')->references('id')->on('tipo_rams')->onDelete('cascade');
            $table->foreign('capacram3_id')->references('id')->on('capacidad_rams')->onDelete('cascade');
            $table->foreign('cantidad3_id')->references('id')->on('cantidad_rams')->onDelete('cascade');
            $table->foreign('disipador4_id')->references('id')->on('disipador_rams')->onDelete('cascade');
            $table->foreign('marcaram4_id')->references('id')->on('marca_rams')->onDelete('cascade');
            $table->foreign('tiporam4_id')->references('id')->on('tipo_rams')->onDelete('cascade');
            $table->foreign('capacram4_id')->references('id')->on('capacidad_rams')->onDelete('cascade');
            $table->foreign('cantidad4_id')->references('id')->on('cantidad_rams')->onDelete('cascade');
            $table->foreign('marcatvideo_id')->references('id')->on('marca_tvideos')->onDelete('cascade');
            $table->foreign('capactvideo_id')->references('id')->on('capacidad_tvideos')->onDelete('cascade');
            $table->foreign('tipotvideo_id')->references('id')->on('tipo_tvideos')->onDelete('cascade');
            $table->foreign('marcatred_id')->references('id')->on('marca_treds')->onDelete('cascade');
            $table->foreign('modtred_id')->references('id')->on('modelo_treds')->onDelete('cascade');
            $table->foreign('marcawifi_id')->references('id')->on('marca_twifis')->onDelete('cascade');
            $table->foreign('modcawifi_id')->references('id')->on('modelo_wifis')->onDelete('cascade');
            $table->foreign('marcafuente_id')->references('id')->on('marca_fuentes')->onDelete('cascade');
            $table->foreign('potfuente_id')->references('id')->on('potencia_fuentes')->onDelete('cascade');
            $table->foreign('marcacd_id')->references('id')->on('marca_lectorcds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registro_cpus', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Elimina el campo deleted_at
        });
    
        Schema::dropIfExists('registro_cpus');
    }
};
