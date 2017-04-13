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
        if(Schema::hasTable('domaintable'))
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
                $table->renameColumn('domainname', 'domain_name');
                $table->renameColumn('domainadmin', 'domain_admin');
                $table->renameColumn('createdts', 'created_ts');
                $table->renameColumn('relaytype', 'relay_type');
                $table->renameColumn('relaymap', 'relay_map');

                DB::statement('ALTER TABLE `domaintable` MODIFY `uuid` CHAR(36) NOT NULL');
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
        Schema::drop('domaintable');
    }
}
