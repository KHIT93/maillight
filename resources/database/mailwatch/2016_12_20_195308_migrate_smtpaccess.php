<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateSmtpaccess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smtpaccess', function (Blueprint $table) {
            //if($table->engine == 'MyISAM')
            //{
                DB::statement('ALTER TABLE `smtpaccess` ENGINE = InnoDB');
            //}
            $table->index('id');
            $table->uuid('uuid');
        });
        DB::statement('UPDATE `smtpaccess` SET `uuid` = uuid()');
        Schema::table('smtpaccess', function (Blueprint $table) {
            $table->dropPrimary('id');
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
        Schema::drop('smtpaccess');
    }
}
