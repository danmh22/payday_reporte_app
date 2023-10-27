<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Aliado;
use App\Models\User;
use App\Models\Factura;
use App\Models\Pago;
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
        $admin = User::factory()->create([
                    'name' => 'Test Admin',
                    'email' => 'testing@mail.com',
                    'email_verified_at' => now(),
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'remember_token' => Str::random(10),
                ])->assignRole('Admin');
                Aliado::factory()
                    ->count(1)
                    ->for($admin)
                    ->create([
                    'codigo_aliado' => 'cod-999',
                    'nombre_aliado' => 'System Admin',
                    'status' => '1',
                ]);

        
        for ($i=0; $i < 5; $i++) { 
            $currentUser = User::factory()->create()->assignRole('Aliado');
            // Se asigna un aliado al usuario
            $aliado = Aliado::factory()->count(1)->for($currentUser)->create();
            // Se crean facturas con diferentes estatus
            $facturas_creadas = Factura::factory()->count(4)->for($aliado[0])->create();
            $facturas_abonadas = Factura::factory()->count(6)->for($aliado[0])
                ->create(['status' => '2']);
            foreach ($facturas_abonadas as $factura) {
                Pago::factory()->count(2)->for($factura)->create();
                Pago::factory()->count(2)->for($factura)
                ->create(['status' => '1']);
            }
            
        }
 

    }
}
