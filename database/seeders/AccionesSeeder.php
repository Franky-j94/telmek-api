<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Acciones;

class AccionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Acciones::create([
            'descripcion' => 'Agregar',
            'activo' => 1,
        ]);
        Acciones::create([
            'descripcion' => 'Actualizar',
            'activo' => 1,
        ]);
        Acciones::create([
            'descripcion' => 'Eliminar',
            'activo' => 1,
        ]);
        Acciones::create([
            'descripcion' => 'Consultar',
            'activo' => 1,
        ]);
        Acciones::create([
            'descripcion' => 'Exportar',
            'activo' => 1,
        ]);
        Acciones::create([
            'descripcion' => 'Cancelar',
            'activo' => 1,
        ]);
    }
}
