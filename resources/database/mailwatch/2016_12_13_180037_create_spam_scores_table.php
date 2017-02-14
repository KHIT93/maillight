<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpamScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spamscores', function (Blueprint $table) {
            $table->dropPrimary('user');
            $table->index('user');
        });
        Schema::table('spamscores', function (Blueprint $table) {
            $table->increments('id');
        });
        Schema::table('spamscores', function (Blueprint $table) {
            $table->dropIndex(['user']);
            $table->index('id');
            $table->uuid('uuid')->nullable();
        });
        DB::statement('UPDATE `spamscores` SET `uuid` = uuid()');
        Schema::table('spamscores', function (Blueprint $table) {
            $table->dropPrimary('id');
            DB::statement('ALTER TABLE `spamscores` MODIFY `uuid` CHAR(36) NOT NULL');
            $table->primary('uuid');
        });
        Schema::table('spamscores', function (Blueprint $table) {
            $table->dropColumn('id');
        });
        DB::statement('ALTER TABLE `spamscores` ENGINE = InnoDB');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('spamscores');
    }
}
