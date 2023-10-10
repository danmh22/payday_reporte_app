<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Aliado']);

        // PERMISOS DE USUARIOS
        Permission::create(['name' => 'dashboard-user'])->assignRole($role2);
        Permission::create(['name' => 'facturas-pendientes'])->assignRole($role2);
        Permission::create(['name' => 'reportar-pago'])->assignRole($role2);
        Permission::create(['name' => 'guardar-pago'])->assignRole($role2);
        Permission::create(['name' => 'historial'])->assignRole($role2);

        // PERMISOS DE ADMINISTRADOR - FACTURAS
        Permission::create(['name' => 'dashboard-admin'])->assignRole($role1);
        Permission::create(['name' => 'cargar-facturas'])->assignRole($role1);
        Permission::create(['name' => 'importar-facturas'])->assignRole($role1);
        Permission::create(['name' => 'facturas-emitidas'])->assignRole($role1);
        Permission::create(['name' => 'pagos-conciliar'])->assignRole($role1);
        Permission::create(['name' => 'conciliar-pago'])->assignRole($role1);
        Permission::create(['name' => 'pagos-conciliados'])->assignRole($role1);

        // PERMISOS DE ADMINISTRADOR - USUARIOS
        Permission::create(['name' => 'aliados.index'])->assignRole($role1);
        Permission::create(['name' =>  'aliados.show'])->assignRole($role1);
        Permission::create(['name' => 'aliado-status'])->assignRole($role1);

        // PERMISOS GLOBALES TODOS LOS ROLES
        Permission::create(['name' => 'factura'])->syncRoles([$role1, $role2]);
    }
}
