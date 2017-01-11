<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateAuditLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('audit_log', function (Blueprint $table) {
            //if($table->engine == 'MyISAM')
            //{
                //$table->engine = 'InnoDB';
                DB::statement('ALTER TABLE `audit_log` ENGINE = InnoDB');
            //}
            $table->uuid('uuid');
        });
        DB::statement('UPDATE `audit_log` SET `uuid` = uuid()');
        Schema::table('audit_log', function (Blueprint $table) {
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
        Schema::drop('audit_log');
    }
}
