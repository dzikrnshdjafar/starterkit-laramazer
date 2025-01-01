<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Buat roles
        $adminRole = Role::create(['name' => 'Admin']);
        $kabidRole = Role::create(['name' => 'Kepala Bidang']);
        $pengelolaRole = Role::create(['name' => 'Pengelola']);

        // Sinkronisasi User & Role
        $user1 = User::find(1);
        $user2 = User::find(2);
        $user3 = User::find(3);

        $user1->assignRole('Admin');
        $user2->assignRole('Kepala Bidang');
        $user3->assignRole('Pengelola');


        // Deklarasi permissions to roles
        $crudPermission = Permission::where('name', 'CRUD')->first();
        $exportPermission = Permission::where('name', 'EXPORT')->first();
        $semiCrudPermission = Permission::where('name', 'SEMI CRUD')->first();

        if ($crudPermission) {
            $adminRole->givePermissionTo($crudPermission);
        }

        if ($exportPermission) {
            $kabidRole->givePermissionTo($exportPermission);
        }

        if ($semiCrudPermission) {
            $pengelolaRole->givePermissionTo($semiCrudPermission);
        }
    }
}
