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
        /* aqui llamamos a todos los seeders para que al momento de ejecutar el 
         * comando php artisan db:seed se ejecuten todos los seeders
         */
        $this->call(class: AccionesSeeder::class);
        $this->call(GruposSistemaSeeder::class);
        $this->call(UserSeeder::class);
    }
}
