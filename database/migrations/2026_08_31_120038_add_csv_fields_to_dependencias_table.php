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
    Schema::table('dependencias', function (Blueprint $table) {

        $table->unsignedBigInteger('management_id')
            ->nullable();

        $table->string('name')
            ->nullable();

        $table->string('correlative')
            ->nullable();

        $table->string('dependence')
            ->nullable();

        $table->string('status')
            ->nullable();

        $table->integer('sort_order')
            ->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dependencias', function (Blueprint $table) {
            //
        });
    }
};
