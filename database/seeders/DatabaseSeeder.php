<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Factura;
use Database\Factories\NuevaFacturaFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'testing@mail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'codigo_aliado' => 'cod-999',
            'nombre_aliado' => 'System Admin',
            'role' => '1',
            'status' => '1',
        ])->assignRole('Admin');
        User::factory(10)->create();
        Factura::factory(15)->create();
        Factura::factory(10)->create([
            'status' => '1',
            'nombre_titular' => null,
            'tipo_documento' => null,
            'num_documento' => null,
            'referencia_pago' => null,
            'divisa' => null,
            'metodo_pago' => null,
            'plataforma_pago' => null,
            'monto_pago' => null,
            'fecha_pago' => null,
        ]);
        Factura::factory(10)->create([
            'status' => '3',
        ]);

    }
}
