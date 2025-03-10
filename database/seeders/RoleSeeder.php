<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Admin', 'Project Manager', 'Team Member'];

        foreach ($roles as $role) {
            if (!Role::where('name', $role)->exists()) {
                Role::create(['name' => $role, 'guard_name' => 'web']);
            }
        }
        // Role::insert([
        //     ['name' => 'Admin', 'guard_name' => 'web'],
        //     ['name' => 'Project Manager', 'guard_name' => 'web'],
        //     ['name' => 'Team Member', 'guard_name' => 'web']
        // ]);

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => hash::make('12345678'),
        ]);

        $admin->assignRole('admin');

        $manager = User::create([
            'name' => 'Manager User',
            'email' => 'ab1c@gmail.com',
            'password' => hash::make('12345678'),
        ]);

        $manager->assignRole('Project Manager');


        $member = User::create([
            'name' => 'Member User',
            'email' => 'abc@gmail.com',
            'password' => hash::make('12345678'),
        ]);

        $member->assignRole('Team Member');
    }
}
