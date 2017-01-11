<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateMaillog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maillog', function (Blueprint $table) {
            //if($table->engine == 'MyISAM')
            //{
                DB::statement('ALTER TABLE `maillog` ENGINE = InnoDB');    
                $table->uuid('uuid');
            //}
        });
        DB::statement('UPDATE `maillog` SET `uuid` = uuid()');
        Schema::table('maillog', function (Blueprint $table) {
            $table->renameColumn('id', 'mailwatch_id');
            $table->primary('uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('maillog');
    }
}
