<?php

use Illuminate\Database\Seeder;
use MailLight\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' =>'administrator', 'label' => 'System Administrator']);
        Role::create(['name' =>'domain_administrator', 'label' => 'Domain Administrator']);
        Role::create(['name' =>'user', 'label' => 'Standard User']);
    }
}
