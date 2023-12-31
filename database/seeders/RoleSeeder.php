<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'admin',
            // 'guard_name' => 'web',
        ]);
        Role::create([
            'name' => 'Marketing',
            // 'guard_name' => 'web',
        ]);
        Role::create([
            'name' => 'Development',
            // 'guard_name' => 'web',
        ]);
        Role::create([
            'name' => 'Finance',
            // 'guard_name' => 'web',
        ]);
        Role::create([
            'name' => 'Sales',
            // 'guard_name' => 'web',
        ]);
        Role::create([
            'name' => 'All',
            // 'guard_name' => 'web',
        ]);
        
        
    }
}
