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
        Schema::create('rechazos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('id_responsable')->nullable();
            $table->integer('id_usuario')->nullable()->comment('USUARIO QUE INGRESO EL RECHAZO');
            $table->integer('id_proveedor')->nullable();
            $table->string('categoria')->nullable();
            $table->string('tipo_tienda')->nullable();
            $table->string('tipo_proveedor')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->string('tipo_rechazo')->nullable();
            $table->string('estado_carga')->nullable();
            $table->longText('obs_rechazo')->nullable();
            $table->string('status')->nullable();
            $table->date('fecha_cerrado')->nullable();
            $table->integer('id_responsable_cierre')->nullable();
            $table->longText('seccion')->nullable();
            $table->string('auto_especial')->nullable();
            $table->string('auto_responsable')->nullable();
            $table->longText('auto_motivo')->nullable();
            $table->longText('obs')->nullable();
            $table->string('motivo_total')->nullable();
            $table->string('bd')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rechazos');
    }
};
