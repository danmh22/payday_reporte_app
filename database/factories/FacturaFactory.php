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
        $monto_dolar       = fake()->numberBetween('200', '400');
        $monto_original_bs = $monto_dolar * 35.23;
        $monto_actual_bs   = $monto_dolar * 36.30;
        $dif_cambiario     = $monto_actual_bs - $monto_original_bs;
        return [
            'concepto'          => fake()->sentence(4),
            'monto_dolar'      => $monto_dolar,
            'monto_original_bs' => $monto_original_bs,
            'monto_actual_bs'   => $monto_actual_bs,
            'dif_cambiario'     => $dif_cambiario,
            'status'            => '1',
            'categoria'         => fake()->randomElement(['Alquiler','Parking','Gastos Comunes','Gastos No Comunes','Reembolsables','Condominios']),
            'con_retraso'       => 0,
        ];
    }
}
