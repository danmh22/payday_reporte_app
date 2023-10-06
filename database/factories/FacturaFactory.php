<?php

namespace Database\Factories;

use App\Models\Aliado;
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
        $aliados = Aliado::pluck('id')->toArray();
        return [
            'aliados_id' => fake()->randomElement($aliados),
            'concepto' => fake()->sentence(4),
            'monto_deudor' => $monto,
            'status' => '1',
            'categoria' => fake()->randomElement(['Mensualidad', 'Gastos Generales', 'Otros']),
        ];
    }
}
