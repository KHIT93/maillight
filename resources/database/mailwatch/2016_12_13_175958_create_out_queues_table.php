<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outq', function (Blueprint $table) {
            $table->dropIndex('outq_hostname');
        });
        Schema::table('outq', function (Blueprint $table) {
            DB::statement('ALTER TABLE `outq` ENGINE = InnoDB');
            $table->uuid('uuid')->nullable();
        });
        DB::statement('UPDATE `outq` SET `uuid` = uuid()');
        Schema::table('outq', function (Blueprint $table) {
            DB::statement('ALTER TABLE `outq` MODIFY `uuid` CHAR(36) NOT NULL');
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
        Schema::drop('outq');
    }
}
