<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSMTPAccessEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('smtpaccess'))
        {
            Schema::table('smtpaccess', function (Blueprint $table) {
                //if($table->engine == 'MyISAM')
                //{
                    DB::statement('ALTER TABLE `smtpaccess` ENGINE = InnoDB');
                //}
                $table->index('id');
                $table->uuid('uuid')->nullable();
            });
            DB::statement('UPDATE `smtpaccess` SET `uuid` = uuid()');
            Schema::table('smtpaccess', function (Blueprint $table) {
                $table->dropPrimary('id');
                $table->renameColumn('smtpvalue', 'smtp_value');
                $table->renameColumn('id', 'mailwatch_id');
                DB::statement('ALTER TABLE `smtpaccess` MODIFY `uuid` CHAR(36) NOT NULL');
                $table->primary('uuid');
            });
        }
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
