<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditLogEntriesTable extends Migration
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
            $table->uuid('uuid')->nullable();
        });
        DB::statement('UPDATE `audit_log` SET `uuid` = uuid()');
        Schema::table('audit_log', function (Blueprint $table) {
            DB::statement('ALTER TABLE `audit_log` MODIFY `uuid` CHAR(36) NOT NULL');
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
