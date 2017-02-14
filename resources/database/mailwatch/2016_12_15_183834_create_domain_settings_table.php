<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('domainsettings', function (Blueprint $table) {
            //if($table->engine == 'MyISAM')
            //{
                DB::statement('ALTER TABLE `domainsettings` ENGINE = InnoDB');
            //}
            $table->dropPrimary(['domainname', 'domainuser']);
            $table->uuid('uuid')->nullable();
        });
        DB::statement('UPDATE `domainsettings` SET `uuid` = uuid()');
        Schema::table('domainsettings', function (Blueprint $table) {
            DB::statement('ALTER TABLE `domainsettings` MODIFY `uuid` CHAR(36) NOT NULL');
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
        Schema::drop('domainsettings');
    }
}
