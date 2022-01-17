<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::factory(500)->create();
        $this->call(RolesTableSeeder::class);

//        $admin = Admin::where('email', 'info@admin.com');
//        $admin->assignRole('admin');
    }
}
