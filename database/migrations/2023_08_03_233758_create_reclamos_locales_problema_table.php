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
        Schema::create('reclamos_locales_problema', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('id_reclamo')->nullable();
            $table->integer('id_usuario')->nullable();
            $table->integer('id_tienda')->nullable();
            $table->string('resultado')->nullable();
            $table->string('lote')->nullable();
            $table->string('fecha_elab')->nullable();
            $table->string('fecha_venc')->nullable();
            $table->decimal('cantidad',5,2)->nullable();
            $table->string('unidad_cantidad')->nullable();
            $table->string('retiro')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reclamos_locales_problema');
    }
};

