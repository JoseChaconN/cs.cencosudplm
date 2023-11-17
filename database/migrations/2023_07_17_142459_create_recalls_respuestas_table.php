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
        Schema::create('recalls_respuestas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('id_recall')->nullable();
            $table->longText('productos')->nullable();
            $table->longText('cantidad_unidad')->nullable();
            $table->longText('fecha_vencimiento')->nullable();
            $table->longText('fecha_elaboracion')->nullable();
            $table->longText('tipo_unidad')->nullable();
            $table->longText('retiro_formato')->nullable();
            $table->longText('lote')->nullable();
            $table->bigInteger('id_responsable')->nullable();
            $table->string('responsable')->nullable();
            $table->string('responsable_email')->nullable();
            $table->bigInteger('id_local')->nullable();
            $table->string('nombre_local')->nullable();
            $table->string('codigo_local')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recalls_respuestas');
    }
};
