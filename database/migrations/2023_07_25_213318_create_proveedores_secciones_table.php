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
        Schema::create('proveedores_secciones', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('id_proveedor')->nullable();
            $table->integer('codigo_seccion')->nullable();
        });
        $productosAgrupados = DB::table('productos')->select('id_seccion', 'id_proveedor')
            ->where('id_seccion' , '>' , 0)
            ->where('id_proveedor' , '>' , 0)
            ->groupBy('id_seccion', 'id_proveedor')
            ->get();

        // Insertar en la tabla proveedores_secciones
        foreach ($productosAgrupados as $producto) {
            DB::table('proveedores_secciones')->insert([
                'codigo_seccion' => $producto->id_seccion,
                'id_proveedor' => $producto->id_proveedor,
            ]);
        }
        /*DB::table('proveedores_secciones')->insert([
                ['id_proveedor' => 1 , 'codigo_seccion' =>1, 'created_at' => now(),'updated_at' => now()],
                ['id_proveedor' => 1 , 'codigo_seccion' =>2, 'created_at' => now(),'updated_at' => now()],
                ['id_proveedor' => 2 , 'codigo_seccion' =>6, 'created_at' => now(),'updated_at' => now()]
            ]
        );*/
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores_secciones');
    }
};
