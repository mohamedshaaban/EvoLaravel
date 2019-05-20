<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'logo' => 'images/Rizit_logo.png',
            'facebook' => 'https://www.facebook.com/',
            'twitter' => 'https://www.twitter.com/',
            'instgram' => 'https://www.Instgram.com/',
            'linkedin' => 'https://www.Linkedin.com/',
            'whatsapp' => '9999999',
            'google_store_link' => 'https://play.google.com/store/apps/details?id=com.whatsapp',
            'app_store_link' => 'https://play.google.com/store/apps/details?id=com.whatsapp',
            'copy_right_ar' => 'جميع الحقوق محفوظة',
            'copy_right_en' => 'Copyright © 2018 Rizit. All rights reserved.',
            'address_ar' => 'kuwait tunis street',
            'address_en' => 'kuwait tunis street',
            'phone' => '98989898989',
            'mobile' => '98989898989',
            'fax' => '98989898989',
            'email_support' => 'support@rizit.com',
            'email_info' => 'info@rizit.com',
            'default_currency' => 'KWD',
            'working_hours' => '8 AM - 4 PM',
            'location' => '39.12552454,41.521454444',
            'created_at' => '2018-10-09 07:54:55',
            'updated_at' => '2018-10-09 12:29:07',
        ]);
    }
}
