<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GruposSistema;

class GruposSistemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        GruposSistema::create([
            'descripcion_grupo' => 'Administrador',
            'activo' => true,
        ]);
        GruposSistema::create([
            'descripcion_grupo' => 'Asesor de ventas',
            'activo' => true,
        ]);
    }
}
