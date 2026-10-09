<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario Admin por defecto si no existe
        User::firstOrCreate(
            ['username' => 'BodaMayenTrejo'],
            [
                'nombre_familia' => 'Mayén Trejo',
                'password' => Hash::make('BodaMayenTrejo1527'),
                'cantidad_boletos' => 2,
                'opcion_cabana' => true,
                'rol' => 'Admin',
            ]
        );
    }
}
