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
        Schema::create('recalls', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('reclamo_padre')->nullable();            
            $table->string('archivo')->nullable();
            $table->bigInteger('id_proveedor')->nullable();
            $table->string('nombre_proveedor')->nullable();
            $table->string('rut_proveedor')->nullable();
            $table->string('cadena')->nullable();
            $table->longText('productos')->nullable();
            $table->longText('lote')->nullable();
            $table->longText('locales_lotes')->nullable();
            $table->longText('fecha')->nullable();
            $table->longText('fecha_vencimiento')->nullable();
            $table->string('recall')->nullable();
            $table->longText('problema')->nullable();
            $table->string('motivo')->nullable();
            $table->bigInteger('id_seccion')->nullable(); 
            $table->string('seccion')->nullable();
            $table->longText('accion')->nullable();
            $table->string('enviar_email')->nullable();
            $table->integer('pais')->nullable();
            $table->integer('id_responsable')->nullable();
            $table->integer('id_local')->nullable();
            $table->dateTime('momento_ingreso')->nullable();
            $table->dateTime('momento_final')->nullable();
            $table->string('status')->nullable();
            $table->dateTime('fecha_cierre')->nullable();
            $table->integer('responsable_cierre')->unsigned()->nullable();
            $table->longText('imagen_recall')->nullable();
            $table->longText('img_1')->nullable();
            $table->longText('img_2')->nullable();
            $table->longText('img_3')->nullable();
            $table->longText('img_4')->nullable();
            $table->longText('img_5')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recalls');
    }
};
