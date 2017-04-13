<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inq', function (Blueprint $table) {
            $table->dropIndex('inq_hostname');
        });
        Schema::table('inq', function (Blueprint $table) {
            DB::statement('ALTER TABLE `inq` ENGINE = InnoDB');
            $table->uuid('uuid')->nullable();
            $table->renameColumn('lastattempt', 'last_attempt')
        });
        DB::statement('UPDATE `inq` SET `uuid` = uuid()');
        Schema::table('inq', function (Blueprint $table) {
            DB::statement('ALTER TABLE `inq` MODIFY `uuid` CHAR(36) NOT NULL');
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
        Schema::drop('inq');
    }
}
