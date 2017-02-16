<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReleaseLogEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('releaselog', function (Blueprint $table) {
            $table->dropIndex('date');
        });
        Schema::table('releaselog', function (Blueprint $table) {
            DB::statement('ALTER TABLE `releaselog` ENGINE = InnoDB');
            $table->uuid('uuid')->nullable();
        });
        DB::statement('UPDATE `releaselog` SET `uuid` = uuid()');
        Schema::table('releaselog', function (Blueprint $table) {
            DB::statement('ALTER TABLE `releaselog` MODIFY `uuid` CHAR(36) NOT NULL');
            $table->primary('uuid');
            $table->index('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('releaselog');
    }
}
