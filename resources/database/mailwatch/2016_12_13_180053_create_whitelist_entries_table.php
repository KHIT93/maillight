<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhitelistEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('whitelist', function (Blueprint $table) {
            $table->dropIndex('whitelist_uniq');
        });
        Schema::table('whitelist', function (Blueprint $table) {
            DB::statement('ALTER TABLE `whitelist` ENGINE = InnoDB');
            $table->index('id');
            $table->uuid('uuid')->nullable();
        });
        DB::statement('UPDATE `whitelist` SET `uuid` = uuid()');
        Schema::table('whitelist', function (Blueprint $table) {
            $table->dropPrimary('id');
            $table->renameColumn('id', 'mailwatch_id');
            DB::statement('ALTER TABLE `whitelist` MODIFY `uuid` CHAR(36) NOT NULL');
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
        Schema::drop('whitelist');
    }
}
