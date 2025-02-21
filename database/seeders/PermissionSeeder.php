<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::updateOrCreate(
            ['name' => 'admin',],
            ['name' => 'admin',]
        );  

        $teacherRole = Role::updateOrCreate(
            ['name' => 'teacher',],
            ['name' => 'teacher',]
        );

        $permission1 = Permission::updateOrCreate(
            ['name' => 'main-admin',],
            ['name' => 'main-admin']
        );

        $permission2 = Permission::updateOrCreate(
            ['name' => 'main-teacher',],
            ['name' => 'main-teacher']
        );

        $adminRole->givePermissionTo($permission1);
        $teacherRole->givePermissionTo($permission2);
    }
}
