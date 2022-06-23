<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = ['USER', 'INSTRUCTOR', 'ADMIN', 'SUPER_ADMIN'];
        foreach ($roles as $key => $role) {
            Role::create(['name' => $role ]);
        } 
        // $permission = Permission::create(['name' => 'edit articles']);
    }
}
