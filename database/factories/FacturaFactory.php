<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Factura>
 */
class FacturaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $monto = fake()->numberBetween('200', '400');
        return [
            'concepto' => fake()->sentence(4),
            'monto_deudor' => $monto,
            'status' => '1',
            'categoria' => fake()->randomElement(['Mensualidad', 'Gastos Generales', 'Otros']),
        ];
    }
}
