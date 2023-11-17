<?php

namespace Database\Seeders;

use App\Models\Seccion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeccionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Seccion::insert([
            ['nombre' => 'PANIFICADOS' ,'codigo' => 1 ,'gerencia' => 1],
            ['nombre' => 'GALLETAS Y GOLOSINAS' ,'codigo' => 10 ,'gerencia' => 2],
            ['nombre' => 'MARCAS PROPIAS' ,'codigo' => 100 ,'gerencia' => 0],
            ['nombre' => 'COCKTAIL' ,'codigo' => 11 ,'gerencia' => 2],
            ['nombre' => 'Cama, baño, kids, maletas' ,'codigo' => 12 ,'gerencia' => 3],
            ['nombre' => 'PANIFICADOS SALADOS' ,'codigo' => 12341 ,'gerencia' => 0],
            ['nombre' => 'Marcas Propias' ,'codigo' => 12347 ,'gerencia' => 0],
            ['nombre' => 'FERRETERIA' ,'codigo' => 13 ,'gerencia' => 3],
            ['nombre' => 'PERFUMERÍA' ,'codigo' => 14 ,'gerencia' => 0],
            ['nombre' => 'JUGUETERÍA' ,'codigo' => 15 ,'gerencia' => 3],
            ['nombre' => 'COCINA' ,'codigo' => 16 ,'gerencia' => 3],
            ['nombre' => 'PASTAS' ,'codigo' => 17 ,'gerencia' => 1],
            ['nombre' => 'LIMPIEZA' ,'codigo' => 18 ,'gerencia' => 0],
            ['nombre' => 'LIBRERÍA' ,'codigo' => 19 ,'gerencia' => 3],
            ['nombre' => 'FIAMBRERIA' ,'codigo' => 2 ,'gerencia' => 1],
            ['nombre' => 'CONGELADOS' ,'codigo' => 20 ,'gerencia' => 1],
            ['nombre' => 'FARMACIA' ,'codigo' => 21 ,'gerencia' => 2],
            ['nombre' => 'POLLOS' ,'codigo' => 22 ,'gerencia' => 1],
            ['nombre' => 'DEPORTES /TIEMPO LIBRE' ,'codigo' => 23 ,'gerencia' => 3],
            ['nombre' => 'PILETAS Y PARRILLAS' ,'codigo' => 24 ,'gerencia' => 3],
            ['nombre' => 'QUESERÍA' ,'codigo' => 25 ,'gerencia' => 1],
            ['nombre' => 'BOTILLERÍA/GASEOSAS' ,'codigo' => 26 ,'gerencia' => 2],
            ['nombre' => 'Textil vestuario' ,'codigo' => 27 ,'gerencia' => 3],
            ['nombre' => 'ROTISERÍA / PLATOS PREPARADOS' ,'codigo' => 28 ,'gerencia' => 1],
            ['nombre' => 'LICORES' ,'codigo' => 29 ,'gerencia' => 2],
            ['nombre' => 'LÁCTEOS' ,'codigo' => 3 ,'gerencia' => 1],
            ['nombre' => 'SNACK BAR/ CAFETERÍA' ,'codigo' => 31 ,'gerencia' => 1],
            ['nombre' => 'PASTELERIA' ,'codigo' => 32 ,'gerencia' => 1],
            ['nombre' => 'ELECTRONICA' ,'codigo' => 33 ,'gerencia' => 3],
            ['nombre' => 'PANADERÍA PROPIA' ,'codigo' => 35 ,'gerencia' => 1],
            ['nombre' => 'FAB.FIAMBRES' ,'codigo' => 36 ,'gerencia' => 1],
            ['nombre' => 'RESTAURANT' ,'codigo' => 37 ,'gerencia' => 1],
            ['nombre' => 'MASCOTAS' ,'codigo' => 38 ,'gerencia' => 3],
            ['nombre' => 'ELECTROHOGAR' ,'codigo' => 39 ,'gerencia' => 3],
            ['nombre' => 'PESCADERÍA' ,'codigo' => 4 ,'gerencia' => 1],
            ['nombre' => 'MESA Y TERRAZA' ,'codigo' => 41 ,'gerencia' => 3],
            ['nombre' => 'DECORACIÓN Y ORGANIZACIÓN' ,'codigo' => 42 ,'gerencia' => 3],
            ['nombre' => 'AUTOMOTOR' ,'codigo' => 46 ,'gerencia' => 3],
            ['nombre' => 'MUEBLES' ,'codigo' => 47 ,'gerencia' => 3],
            ['nombre' => 'CARNICERIA' ,'codigo' => 5 ,'gerencia' => 1],
            ['nombre' => 'JARDÍN' ,'codigo' => 52 ,'gerencia' => 3],
            ['nombre' => 'ACCESORIOS DE JARDÍN' ,'codigo' => 53 ,'gerencia' => 3],
            ['nombre' => 'ELECTRODOMÉSTICOS' ,'codigo' => 54 ,'gerencia' => 3],
            ['nombre' => 'NUEVAS TECNOLOGIAS' ,'codigo' => 55 ,'gerencia' => 3],
            ['nombre' => 'FRUTAS Y VERDURAS' ,'codigo' => 6 ,'gerencia' => 1],
            ['nombre' => 'CERDO Y CORDERO' ,'codigo' => 66 ,'gerencia' => 1],
            ['nombre' => 'PDTOS EXCENTOS' ,'codigo' => 69 ,'gerencia' => 0],
            ['nombre' => 'ALMACÉN' ,'codigo' => 7 ,'gerencia' => 2],
            ['nombre' => 'VINOS' ,'codigo' => 8 ,'gerencia' => 2],
            ['nombre' => 'SERVICIOS' ,'codigo' => 85 ,'gerencia' => 3],
            ['nombre' => 'ENVASES' ,'codigo' => 9 ,'gerencia' => 0],
            ['nombre' => 'Plantas Productivas' ,'codigo' => 92 ,'gerencia' => 0],
            ['nombre' => 'Elaboracion Propia' ,'codigo' => 93 ,'gerencia' => 0],
            ['nombre' => 'SAC' ,'codigo' => 9999 ,'gerencia' => 0],
        ]);
    }
}
