<?php

namespace MailLight\Console\Commands;

use Illuminate\Console\Command;

class ConvertToUtf8Command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:utf8';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Converts the database to utf8mb4';

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
        \DB::statement("ALTER DATABASE `".env('DB_DATABASE', 'mailscanner')."` DEFAULT CHARACTER SET `utf8mb4` DEFAULT COLLATE `utf8mb4_unicode_ci`");
        \DB::statement("ALTER TABLE `audit_log` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        \DB::statement("ALTER TABLE `blacklist` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        \DB::statement("ALTER TABLE `inq` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        \DB::statement("ALTER TABLE `maillog` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        \DB::statement("ALTER TABLE `mcp_rules` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        \DB::statement("ALTER TABLE `mtalog` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        \DB::statement("ALTER TABLE `outq` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        \DB::statement("ALTER TABLE `sa_rules` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        \DB::statement("ALTER TABLE `saved_filters` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        \DB::statement("ALTER TABLE `spamscores` CHANGE `user` `user` VARCHAR(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL");
        \DB::statement("ALTER TABLE `spamscores` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        \DB::statement("ALTER TABLE `user_filters` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        \DB::statement("ALTER TABLE `users` CHANGE `username` `username` VARCHAR(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL");
        \DB::statement("ALTER TABLE `users` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        \DB::statement("ALTER TABLE `whitelist` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        \DB::statement("ALTER TABLE `domaintable` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        \DB::statement("ALTER TABLE `domainsettings` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        \DB::statement("ALTER TABLE `releaselog` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        \DB::statement("ALTER TABLE `smtpaccess` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    }
}
