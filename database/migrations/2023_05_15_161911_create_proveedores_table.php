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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('nombre')->nullable();
            $table->string('rut')->unique();
            $table->string('ciclo3')->nullable();
            $table->integer('status')->default(1);
            #FALTA
                #contacto_comercial
                #contacto_calidad
                #plantas
                #antecedentes
                #antecedentes estado 
                #resolucion 
                #resolucion estado
                #importado


        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};

