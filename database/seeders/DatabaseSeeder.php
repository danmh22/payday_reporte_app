<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Aliado;
use App\Models\User;
use App\Models\Factura;
use App\Models\Pago;
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
        ])->assignRole('Admin');
        Aliado::factory()->create([
            'codigo_aliado' => 'cod-999',
            'nombre_aliado' => 'System Admin',
            'role' => '1',
            'status' => '1',
            'users_id' => 1,
        ]);
        User::factory(10)
            ->has(Aliado::factory()
                    ->has(Factura::factory()->count(4))
                    ->count(1))
            ->create();
        Factura::factory(15)
            ->has(Pago::factory()->count(2))
            ->create([
                'status' => '2',
            ]);
        Factura::factory(10)->create([
            'status' => '3',
        ]);

    }
}
