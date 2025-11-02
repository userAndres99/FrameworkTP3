<?php

namespace Database\Factories;

use App\Models\Organizacion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizacionFactory extends Factory
{
    protected $model = Organizacion::class;

    public function definition()
    {
        return [
            'usuario_creador_id' => User::factory(),
            'nombre' => $this->faker->company(),
            'telefono' => $this->faker->phoneNumber(),
            'email' => $this->faker->companyEmail(),
            'descripcion' => $this->faker->paragraph(),
            'latitud' => $this->faker->latitude(),
            'longitud' => $this->faker->longitude(),
            'documentacion' => null,
            'verificado_en' => null,
        ];
    }
}
