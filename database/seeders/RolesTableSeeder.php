<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->where('id','>',0)->delete();
        $role = Role::create([
            'id'=>1,
            'name' => 'Super Amdin',
            'guard_name' => 'admin',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('admins')->where('id','>',0)->delete();
        DB::table('admins')->insert([
            'id'=>1,
            'full_name' =>'Super Admin',
            'email' => 'info@admin.com',
            'phone' => '2547896',
            'password' => Hash::make('12345678'),
        ]);



        DB::table('permissions')->where('id','>',0)->delete();
        DB::table('model_has_permissions')->where('permission_id','>',0)->delete();
        DB::table('model_has_roles')->where('role_id','>',0)->delete();
        DB::table('role_has_permissions')->where('role_id','>',0)->delete();
        $permission[]=[];
        $tables_in_db = DB::select('SHOW TABLES');
        $db = "Tables_in_".env('DB_DATABASE');
//        $tables = ['album_images','orders','post_tags','migrations','model_has_permissions','model_has_roles','password_resets','permissions','role_has_permissions','images','social_media','service_features','service_technics','visitor_message_replays','visitor_messages','front_social_media','order_replays','project_images',''];
        $tables = [];
        foreach($tables_in_db as $table){
            if(!in_array($table->{$db},$tables)) {
                $show_permission = Permission::create([
                        'name' => 'show_' . $table->{$db},
                        'guard_name' => 'admin',
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    ]);

                $edit_permission = Permission::create([
                    'name' => 'edit_' . $table->{$db},
                    'guard_name' => 'admin',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);

                $role->givePermissionTo([$edit_permission->id , $show_permission->id]);
            }
        }
//        $show_trans =Permission::create([
//            'name'=>'show_trans',
//            'guard_name' => 'web',
//            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
//            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
//        ]);
//        $edit_trans =Permission::create([
//            'name'=>'edit_trans',
//            'guard_name' => 'web',
//            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
//            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
//        ]);
//        $role->givePermissionTo([$show_trans->id , $edit_trans->id]);

        DB::table('model_has_roles')->insert([
            'model_id'=>1,
            'role_id' =>1,
            'model_type' => 'App\Models\Admin',
        ]);

    }
}
