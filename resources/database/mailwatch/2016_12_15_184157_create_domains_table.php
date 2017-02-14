<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('domaintable', function (Blueprint $table) {
            //if($table->engine == 'MyISAM')
            //{
                DB::statement('ALTER TABLE `domaintable` ENGINE = InnoDB');
            //}
            $table->uuid('uuid')->nullable();
        });
        DB::statement('UPDATE `domaintable` SET `uuid` = uuid()');
        Schema::table('domaintable', function (Blueprint $table) {
            $table->dropPrimary('domainname');
            DB::statement('ALTER TABLE `domaintable` MODIFY `uuid` CHAR(36) NOT NULL');
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
        Schema::drop('domaintable');
    }
}
