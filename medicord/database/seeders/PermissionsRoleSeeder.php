<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class PermissionsRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'superAdmin']);
        $doctor = Role::create(['name' => 'doctor', ]);
        $patient = Role::create(['name' => 'patient', ]);

        $permissions = [
            'create-role',
            'edit-role',
            'delete-role',
            'create-user',
            'edit-user',
            'delete-user',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $doctor->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
        ]);

        $patient->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
        ]);
    }
}
