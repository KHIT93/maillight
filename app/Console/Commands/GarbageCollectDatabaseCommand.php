<?php

namespace MailLight\Console\Commands;

use Illuminate\Console\Command;

class GarbageCollectDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:gc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run garbage collection on the database in order to keep the size acceptable and not have unecessary old data in the database';

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
        //
    }
}
