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
        Setting::create(['name' => 'app.log_days_to_keep', 'value' => '90']);

        Setting::create(['name' => 'branding.name', 'value' => 'MailLight']);
        Setting::create(['name' => 'branding.logo', 'value' => '/images/ml_logo.png']);
        Setting::create(['name' => 'branding.support.email', 'value' => '']);
        Setting::create(['name' => 'branding.support.email', 'value' => '']);
        Setting::create(['name' => 'branding.support.show', 'value' => '0']);

        Setting::create(['name' => 'mail.mailscanner.config_dir', 'value' => '']);
        Setting::create(['name' => 'mail.mailscanner.lib_dir', 'value' => '']);
        Setting::create(['name' => 'mail.mailscanner.executable', 'value' => '']);

        Setting::create(['name' => 'mail.spamassassin.executable', 'value' => '']);
        Setting::create(['name' => 'mail.spamassassin.rules_dir', 'value' => '']);
        Setting::create(['name' => 'mail.spamassassin.preferences', 'value' => '']);

        Setting::create(['name' => 'mail.log', 'value' => '']);

        Setting::create(['name' => 'quarantine.days_to_keep', 'value' => config('app.log_days_to_keep')]);
        Setting::create(['name' => 'quarantine.from_address', 'value' => 'postmaster@'.gethostname()]);
        Setting::create(['name' => 'quarantine.from_name', 'value' => config('branding.name')]);
        Setting::create(['name' => 'quarantine.report_subject', 'value' => 'Message Quarantine Report']);
        Setting::create(['name' => 'quarantine.report_days', 'value' => '7']);

    }
}
