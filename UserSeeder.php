<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'nombre' => 'Frank',
            'paterno' => 'Juarez',
            'materno' => 'Osorio',
            'login' => 'admin',
            'password' => Hash::make('123456'),
            'grupo_id' => 1,
        ]);
        User::create([
            'nombre' => 'Frank',
            'paterno' => 'Juarez',
            'materno' => 'Osorio',
            'login' => 'asesor',
            'password' => Hash::make('123456'),
            'grupo_id' => 2,
        ]);
        User::create([
            'nombre' => 'David',
            'paterno' => 'Juarez',
            'materno' => 'Osorio',
            'login' => 'asesor2',
            'password' => Hash::make('123456'),
            'grupo_id' => 2,
        ]);
    }
}
