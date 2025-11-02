<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Organizacion;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //usuario de prueba (si ya existe, usarlo)
        $user = User::first();
        if (! $user) {
            $user = User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // Crear 10 organizaciones 
        Organizacion::factory()
            ->count(10)
            ->for($user, 'creador')
            ->create();

        // Añadir organizaciones con coordenadas 
        $cipolletti = [
            ['lat' => -38.9450, 'long' => -67.9800],
            ['lat' => -38.9485, 'long' => -67.9900],
            ['lat' => -38.9530, 'long' => -67.9855],
        ];

        foreach ($cipolletti as $i => $pt) {
            Organizacion::create([
                'usuario_creador_id' => $user->id,
                'nombre' => 'Organización Cipolletti ' . ($i + 1),
                'telefono' => '299-400' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'email' => 'cipolletti' . ($i + 1) . '@example.com',
                'descripcion' => 'Organización de prueba en Cipolletti para visualización en mapa.',
                'latitud' => $pt['lat'],
                'longitud' => $pt['long'],
            ]);
        }

        // Añadir organizaciones con coordenadas 
        $neuquen = [
            ['lat' => -38.9510, 'long' => -68.0590],
            ['lat' => -38.9560, 'long' => -68.0500],
            ['lat' => -38.9490, 'long' => -68.0650],
        ];

        foreach ($neuquen as $i => $pt) {
            Organizacion::create([
                'usuario_creador_id' => $user->id,
                'nombre' => 'Organización Neuquén ' . ($i + 1),
                'telefono' => '299-500' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'email' => 'neuquen' . ($i + 1) . '@example.com',
                'descripcion' => 'Organización de prueba en Neuquén para visualización en mapa.',
                'latitud' => $pt['lat'],
                'longitud' => $pt['long'],
            ]);
        }
    }
}
