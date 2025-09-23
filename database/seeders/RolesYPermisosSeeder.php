<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesYPermisosSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $tienda = Role::firstOrCreate(['name' => 'tienda']);
        $vendedor = Role::firstOrCreate(['name' => 'vendedor']);

        // Permisos
        $permisos = [
            // Productos
            'ver productos',
            'crear productos',
            'editar productos',
            'eliminar productos',

            // Ventas
            'registrar ventas',

            // Tiendas y usuarios
            'crear tiendas',
            'crear vendedores', // para dueños de tienda
            'ver vendedores',

            // Inventario
            'ver inventario',
            'mover inventario',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Asignar permisos
        $admin->givePermissionTo($permisos);

        $tienda->givePermissionTo([
            'ver productos',
            'registrar ventas',
            'crear vendedores',
            'ver vendedores',
            'ver inventario',
        ]);

        $vendedor->givePermissionTo([
            'ver productos',
            'registrar ventas',
            'ver inventario',
        ]);
    }

}