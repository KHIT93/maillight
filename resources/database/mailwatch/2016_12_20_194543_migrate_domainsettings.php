<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateDomainsettings extends Migration
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
            $table->uuid('uuid');
        });
        DB::statement('UPDATE `domainsettings` SET `uuid` = uuid()');
        Schema::table('domainsettings', function (Blueprint $table) {
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
