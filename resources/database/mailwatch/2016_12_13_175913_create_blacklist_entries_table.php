<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlacklistEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blacklist', function (Blueprint $table) {
            $table->dropIndex('blacklist_uniq');
        });
        Schema::table('blacklist', function (Blueprint $table) {
            DB::statement('ALTER TABLE `blacklist` ENGINE = InnoDB');
            $table->index('id');
            $table->uuid('uuid')->nullable();
        });
        DB::statement('UPDATE `blacklist` SET `uuid` = uuid()');
        Schema::table('blacklist', function (Blueprint $table) {
            $table->dropPrimary('id');
            $table->renameColumn('id', 'mailwatch_id');
            DB::statement('ALTER TABLE `blacklist` MODIFY `uuid` CHAR(36) NOT NULL');
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
        Schema::drop('blacklist');
    }
}
