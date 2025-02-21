<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::updateOrCreate(
            ['name' => 'admin',],
            ['name' => 'admin',]
        );

        Role::updateOrCreate(
            ['name' => 'teacher',],
            ['name' => 'teacher',]
        );

      
        $adminRole = Role::updateOrCreate(['name' => 'admin']);
        $teacherRole = Role::updateOrCreate(['name' => 'teacher']);

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123admin'),
            'google_id' => 'google_id',
            'google_token' => 'google_token',
            'google_refresh_token' => 'google_refresh_token',
        ]);
        $admin->assignRole($adminRole);

        $teacher = User::create([
            'name' => 'Teacher User',
            'email' => 'teacher@gmail.com',
            'password' => bcrypt('teacher123teacher'),
            'google_id' => 'teacher_google_id',
            'google_token' => 'teacher_google_token',
            'google_refresh_token' => 'teacher_google_refresh_token',
        ]);
        $teacher->assignRole($teacherRole);
    }
}
