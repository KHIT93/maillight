<?php

namespace MailLight\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Password;
use Illuminate\Database\Schema\Blueprint;

class MigrateMailwatchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:mailwatch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Modify existing mailwatch database table structure for use with MailLight';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->error('WARNING! This will convert the schema of your specified mailwatch database into a structure matching MailLight. This process cannot be reverted unless you have a backup of your data');
        if ($this->confirm('Do you wish to continue?')) {
            $this->line(\Carbon\Carbon::now()->__toString());
            //Rename existing users table before creating the new users structure
            if(Schema::hasTable('users') && !Schema::hasTable('mailwatch_users'))
            {
                $this->line('Relocating existing users to a temporary location');
                Schema::rename('users', 'mailwatch_users');
            }
            $this->line('Initiate schema and data migration');
            //$this->call('migrate:install');
            //$this->line('Create new schema for users');
            //Create new table for users
            //Schema::create('users', function (Blueprint $table) {
            //    $table->uuid('uuid')->primary();
            //    $table->string('name');
            //    $table->string('email')->unique();
            //    $table->string('password');
            //    $table->rememberToken();
            //    $table->string('api_token', 60)->unique();
            //    $table->tinyInteger('quarantine_report')->nullable();
            //    $table->tinyInteger('spamscore')->nullable();
            //    $table->tinyInteger('highspamscore')->nullable();
            //    $table->tinyInteger('noscan')->nullable();
            //    $table->string('quarantine_rcpt', 60)->nullable();
            //    $table->timestamps();
            //});
            ////Create table for password resets
            //Schema::create('password_resets', function (Blueprint $table) {
            //    $table->string('email')->index();
            //    $table->string('token')->index();
            //    $table->timestamp('created_at')->nullable();
            //});
            $this->line('Schema and data migration is now running');
            $this->line('This might take a while to complete and the process may seem stuck');
            $this->line('Please wait...');
            $this->call('migrate', [
                '--path' => 'resources/database/mailwatch/',
                '-vvv' => true,
                '--step' => true
            ]);
            $this->call('migrate');
            $this->info('Schema and data migration completed');
            $this->line('Creating a new administrator account');
            //Create the new administrator account
            \MailLight\Models\User::forceCreate([
                'name' => 'Administrator',
                'email' => 'admin@localhost',
                'password' => 'admin',
                'api_token' => str_random(60)
            ]);
            $this->line(\Carbon\Carbon::now()->__toString());
            $this->line('Migrating user accounts');
            //Copy users to the new users table
            \DB::statement('INSERT INTO `users` (`uuid`, `name`, `email`, `password`, `quarantine_report`, `spamscore`, `highspamscore`, `noscan`, `quarantine_rcpt`, `api_token`) SELECT uuid(), `fullname`, `username`, `password`, `quarantine_report`, `spamscore`, `highspamscore`, `noscan`, `quarantine_rcpt`, RAND(60) FROM `mailwatch_users`');
            $this->info('Users have been migrated');
            if ($this->confirm('Would you like to remove the old users table?')) { Schema::drop('mailwatch_users'); }
            $this->info('Migration is now completed. All users will need reset their passwords due to the usage of stronger encryption');
            if($this->confirm('Would you like to automatically send reset notifications for all users now?'))
            {
                foreach (\MailLight\Models\User::all() as $user)
                {
                    $response = $this->passbroker()->sendResetLink($user->email);
                    if ($response === Password::RESET_LINK_SENT)
                    {
                        $this->info('Password reset notification has been sent to '.$user->email);
                    }
                }
            }
            $this->line(\Carbon\Carbon::now()->__toString());
        }
    }
    protected function passbroker()
    {
        return Password::broker();
    }

}
