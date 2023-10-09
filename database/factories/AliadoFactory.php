<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aliado>
 */
class AliadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo_aliado' => fake()->lexify('cod-') . fake()->unique()->numberBetween('0', '10'),
            'nombre_aliado' => fake()->company(),
            'status' => '1',
        ];
    }
}
