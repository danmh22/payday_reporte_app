<?php

namespace Database\Factories;

use App\Models\Factura;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pago>
 */
class PagoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $monto = fake()->numberBetween('200', '400');
        $facturas = Factura::pluck('id')->toArray();
        return [
            'facturas_id' => fake()->randomElement($facturas),
            'nombre_titular' => fake()->firstName() . ' ' . fake()->lastName(),
            'tipo_documento' => fake()->randomElement(['V', 'J', 'P']),
            'num_documento' => fake()->unique()->numberBetween('3000000', '50000000'),
            'referencia_pago' => fake()->unique()->numerify('1020######'),
            'divisa' => fake()->randomElement(['VES', 'USD']),
            'metodo_pago' => fake()->randomElement(['Transferencia', 'Pago Móvil', 'Efectivo', 'Depósito']),
            'plataforma_pago' => fake()->words(2, true),
            'monto_pago' => $monto,
            'monto_equivalente' => $monto,
            'status' => '2',
            'fecha_pago' => fake()->dateTime(),
        ];
    }
}
