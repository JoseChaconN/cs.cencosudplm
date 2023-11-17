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
        #Schema::create('activity_logs', function (Blueprint $table) {
        #    $table->id();
        #    $table->timestamps();
        #    $table->integer('id_usuario')->nullable();
        #    $table->integer('id_registro')->nullable();
        #    $table->string('area')->nullable();
        #    $table->string('tabla')->nullable();
        #    $table->string('accion')->nullable();
        #    $table->json('data')->nullable();
        #});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
