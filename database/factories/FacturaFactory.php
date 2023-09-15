<?php

namespace Database\Factories;

use App\Models\User;
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
        $users = User::pluck('id')->toArray();
        return [
            'users_id' => fake()->randomElement($users),
            'concepto' => fake()->sentence(4),
            'monto_deudor' => $monto,
            'status' => '2',
            'nombre_titular' => fake()->firstName() . ' ' . fake()->lastName(),
            'tipo_documento' => fake()->randomElement(['V', 'J', 'P']),
            'num_documento' => fake()->unique()->numberBetween('3000000', '50000000'),
            'referencia_pago' => fake()->unique()->numerify('1020######'),
            'divisa' => fake()->randomElement(['VES', 'USD']),
            'metodo_pago' => fake()->randomElement(['Transferencia', 'Pago Móvil', 'Efectivo', 'Depósito']),
            'plataforma_pago' => fake()->words(2, true),
            'monto_pago' => $monto,
            'fecha_pago' => fake()->dateTime(),
        ];
    }
}
