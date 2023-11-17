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
        Schema::create('tienda_mes_sin_rechazos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('id_responsable')->nullable();
            $table->integer('id_tienda')->nullable();
            $table->integer('respuesta')->default(0);
            $table->date('fecha_respuesta')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tienda_mes_sin_rechazos');
    }
};
