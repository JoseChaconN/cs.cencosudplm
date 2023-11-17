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
        Schema::create('rechazos_productos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('id_rechazo')->nullable();
            $table->integer('id_producto')->nullable();
            $table->integer('id_seccion')->nullable();
            $table->decimal('cant_cajas',10,2)->nullable();
            $table->string('un_cant_cajas')->nullable();
            $table->decimal('cant_cajas_rechz',10,2)->nullable();
            $table->string('un_cant_cajas_rechz')->nullable();
            $table->decimal('cant_cajas_solicitadas',10,2)->nullable();
            $table->decimal('cant_cajas_entregadas',10,2)->nullable();
            $table->string('num_fact')->nullable();
            $table->date('fecha_elaboracion')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->integer('causa_rechazo')->nullable();
            $table->string('folio_rechazo')->nullable();
            $table->string('especificaciones')->nullable();
            $table->longText('orden_compra_entrega')->nullable();
            $table->longText('fotos_prod_rechz')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rechazos_productos');
    }
};
