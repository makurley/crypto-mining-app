<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Setting::firstOrCreate([], [
            'title' => 'Your Site Title',
            'description' => 'A brief description of your site.',
            'phone' => '+2348000000000',
            'address' => 'Lagos, Nigeria',
            'email' => 'admin@example.com',
            'touch_icon' => null,
            'favicon' => null,
            'logo' => null,
            'facebook' => 'https://facebook.com/yourpage',
            'twitter' => 'https://twitter.com/yourhandle',
            'instagram' => 'https://instagram.com/yourhandle',
            'telegram' => 'https://t.me/yourchannel',
            'whatsapp' => '+2348000000000',
            'currency' => 'Naira',
            'currency_code' => 'NGN',
            'primary_color' => '#000000',
            'custom_css' => '',
            'custom_js' => '',
            'is_announcement' => false,
            'announcement' => null,
            'is_adsense' => false,
            'google_adsense' => null,
            'is_analytics' => false,
            'google_analytics_id' => null,
            'is_youtube_link' => false,
            'youtube_link' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
