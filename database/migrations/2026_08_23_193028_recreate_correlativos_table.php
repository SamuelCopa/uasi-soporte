<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('correlativos');

        Schema::create('correlativos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anio')->unique();
            $table->unsignedBigInteger('ultimo_numero')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('correlativos');
    }
};
