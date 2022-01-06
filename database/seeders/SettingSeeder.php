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
            'subject' => 'socials',
            'key' => 'googlePlay',
            'value' => ''
        ]);
        Setting::create([
            'subject' => 'socials',
            'key' => 'appStore',
            'value' => ''
        ]);
        Setting::create([
            'subject' => 'socials',
            'key' => 'facebook',
            'value' => ''
        ]);
        Setting::create([
            'subject' => 'socials',
            'key' => 'youtube',
            'value' => ''
        ]);
    }
}
