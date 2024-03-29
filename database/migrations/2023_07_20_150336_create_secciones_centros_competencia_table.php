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
        Schema::create('secciones_centros_competencia', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('id_cc')->nullable();
            $table->integer('codigo_seccion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secciones_centros_competencia');
    }
};
