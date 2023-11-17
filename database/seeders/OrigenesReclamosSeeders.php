<?php

namespace Database\Seeders;

use App\Models\OrigenesReclamos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrigenesReclamosSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        OrigenesReclamos::insert([
            ['nombre' => 'Call Center','grupo' => 1,'created_at' => now(),'updated_at' => now()],
            ['nombre' => 'Servicio al cliente Jumbo 6004003000','grupo' => 1,'created_at' => now(),'updated_at' => now()],
            ['nombre' => 'Servicio al cliente SISA 6004002000','grupo' => 1,'created_at' => now(),'updated_at' => now()],
            ['nombre' => 'E-mail (sitios web jumbo.cl y santaisabel.cl)','grupo' => 1,'created_at' => now(),'updated_at' => now()],
            ['nombre' => 'Libro de Sugerencias Jumbo (Servicio al cliente, centro de cajas, informaciones, Rincón Jumbo, locales Jumbo)','grupo' => 1,'created_at' => now(),'updated_at' => now()],
            ['nombre' => 'Libro de Sugerencias SISA','grupo' => 1,'created_at' => now(),'updated_at' => now()],
            ['nombre' => 'Línea 800 Marcas Propia','grupo' => 1,'created_at' => now(),'updated_at' => now()],
            ['nombre' => 'Logística (por parte de locales)','grupo' => 1,'created_at' => now(),'updated_at' => now()],
            ['nombre' => 'Redes Sociales','grupo' => 1,'created_at' => now(),'updated_at' => now()],
            ['nombre' => 'Forma Verbal (Información, centro de cajas, etc)','grupo' => 1,'created_at' => now(),'updated_at' => now()],
            ['nombre' => 'Línea 600 Marcas Propia','grupo' => 1,'created_at' => now(),'updated_at' => now()],
            ['nombre' => 'Sernac','grupo' => 1,'created_at' => now(),'updated_at' => now()],
            ['nombre' => 'Libro de sugerencias Rincón Jumbo','grupo' => 1,'created_at' => now(),'updated_at' => now()],
            ['nombre' => 'Libro de sugerencias Servicio al cliente','grupo' => 1,'created_at' => now(),'updated_at' => now()],
            ['nombre' => 'Detección en el local','grupo' => 1,'created_at' => now(),'updated_at' => now()],
            ['nombre' => 'Sag','grupo' => 1,'created_at' => now(),'updated_at' => now()],
            ['nombre' => 'Seremi','grupo' => 1,'created_at' => now(),'updated_at' => now()],
            ['nombre' => 'Sernap','grupo' => 1,'created_at' => now(),'updated_at' => now()],
            ['nombre' => 'SAC local presencial','grupo' => 1,'created_at' => now(),'updated_at' => now()],
            ['nombre' => 'SAC call center','grupo' => 1,'created_at' => now(),'updated_at' => now()],
            ['nombre' => 'Redes sociales','grupo' => 1,'created_at' => now(),'updated_at' => now()],
        ]
    );
    }
}
