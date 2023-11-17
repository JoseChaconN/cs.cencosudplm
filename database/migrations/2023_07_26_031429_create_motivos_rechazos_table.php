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
        Schema::create('motivos_rechazos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('area')->nullable();
            $table->string('causa_rechazo')->nullable();
            $table->integer('codigo_seccion')->nullable();
            $table->integer('vida_util')->nullable();
            $table->integer('status')->default(1);
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motivos_rechazos');
    }
};
