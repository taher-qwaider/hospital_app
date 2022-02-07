<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Setting::create([
            'key' => 'phone',
            'value' => ''
        ]);
        Setting::create([
            'key' => 'facebook',
            'value' => ''
        ]);
        Setting::create([
            'key' => 'email',
            'value' => ''
        ]);
        Setting::create([
            'key' => 'about_us',
            'value' => ''
        ]);


        Setting::create([
            'key' => 'board_directors',
            'value' => ''
        ]);
    }
}
