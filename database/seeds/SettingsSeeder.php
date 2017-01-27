<?php

use Illuminate\Database\Seeder;
use MailLight\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create(['name' => 'QUARANTINE_DAYS_TO_KEEP', 'value' => '90']);
        Setting::create(['name' => 'QUARANTINE_DAYS_TO_KEEP', 'value' => '90']);
        Setting::create(['name' => 'BRANDING_NAME', 'value' => 'MailLight']);
        Setting::create(['name' => 'BRANDING_LOGO', 'value' => '/images/ml_logo.png']);
        Setting::create(['name' => 'BRANDING_NAME', 'value' => 'MailLight']);
        
    }
}
