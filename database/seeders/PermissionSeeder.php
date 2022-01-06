<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Permission::updateOrCreate(['name'=>'create-users'],['name'=>'create-users', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'read-users'],['name'=>'read-users', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'edit-users'],['name'=>'edit-users', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'delete-users'],['name'=>'delete-users', 'guard_name' => 'admin']);

        Permission::updateOrCreate(['name'=>'create-admins'],['name'=>'create-admins', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'read-admins'],['name'=>'read-admins', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'edit-admins'],['name'=>'edit-admins', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'delete-admins'],['name'=>'delete-admins', 'guard_name' => 'admin']);

        Permission::updateOrCreate(['name'=>'create-teachers'],['name'=>'create-teachers', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'read-teachers'],['name'=>'read-teachers', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'edit-teachers'],['name'=>'edit-teachers', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'delete-teachers'],['name'=>'delete-teachers', 'guard_name' => 'admin']);

        Permission::updateOrCreate(['name'=>'create-settings'],['name'=>'create-settings', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'read-settings'],['name'=>'read-settings', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'edit-settings'],['name'=>'edit-settings', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'delete-settings'],['name'=>'delete-settings', 'guard_name' => 'admin']);

        Permission::updateOrCreate(['name'=>'create-permissions'],['name'=>'create-permissions', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'read-permissions'],['name'=>'read-permissions', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'edit-permissions'],['name'=>'edit-permissions', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'delete-permissions'],['name'=>'delete-permissions', 'guard_name' => 'admin']);

        Permission::updateOrCreate(['name'=>'create-roles'],['name'=>'create-roles', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'read-roles'],['name'=>'read-roles', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'edit-roles'],['name'=>'edit-roles', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'delete-roles'],['name'=>'delete-roles', 'guard_name' => 'admin']);

        Permission::updateOrCreate(['name'=>'create-home-work'],['name'=>'create-home-work', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'read-home-work'],['name'=>'read-home-work', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'edit-home-work'],['name'=>'edit-home-work', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'delete-home-work'],['name'=>'delete-home-work', 'guard_name' => 'admin']);

        Permission::updateOrCreate(['name'=>'create-posts'],['name'=>'create-posts', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'read-posts'],['name'=>'read-posts', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'edit-posts'],['name'=>'edit-posts', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'delete-posts'],['name'=>'delete-posts', 'guard_name' => 'admin']);

        Permission::updateOrCreate(['name'=>'read-messages'],['name'=>'read-messages', 'guard_name' => 'admin']);

        Permission::updateOrCreate(['name'=>'read-settings'],['name'=>'read-settings', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name'=>'edit-settings'],['name'=>'edit-settings', 'guard_name' => 'admin']);

    }
}
