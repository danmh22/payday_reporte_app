<?php

namespace Database\Factories;

use App\Models\User;
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
        $users = User::pluck('id')->toArray();
        return [
            'codigo_aliado' => fake()->lexify('cod-') . fake()->unique()->numberBetween('0', '10'),
            'nombre_aliado' => fake()->company(),
            'status' => '1',
            'users_id' => fake()->unique()->randomElement($users),
        ];
    }
}
