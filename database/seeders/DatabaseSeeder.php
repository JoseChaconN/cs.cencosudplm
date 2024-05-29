<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(RoleSeeder::class);
        $this->call(PaisSeeder::class);
        $this->call(TiendasSeeder::class);
        $this->call(ProductosSeeder::class);
        $this->call(ProveedoresSeeder::class);
        $this->call(CentrosCompetenciaSeeder::class);
        $this->call(SeccionesSeeder::class);
        $this->call(OrigenesReclamosSeeders::class);
        $this->call(MotivosRechazosSeeders::class);
    }
}
