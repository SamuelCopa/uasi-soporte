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
        Schema::table('servicios', function (Blueprint $table) {
            $table->string('token_evaluacion', 64)
                ->nullable()
                ->unique()
                ->after('id');

            $table->timestamp('evaluado_at')
                ->nullable()
                ->after('token_evaluacion');
        });
    }

    public function down(): void
    {
        Schema::table('servicios', function (Blueprint $table) {
            $table->dropColumn([
                'token_evaluacion',
                'evaluado_at'
            ]);
        });
    }
};
