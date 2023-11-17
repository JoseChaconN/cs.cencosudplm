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
        Schema::create('usuarios_tiendas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('id_usuario')->nullable();
            $table->integer('id_tienda')->nullable();
            $table->string('tipo')->nullable()->comment('usuario = tienda/tecnologo | supervisor = supervisores sisa');
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios_tiendas');
    }
};
