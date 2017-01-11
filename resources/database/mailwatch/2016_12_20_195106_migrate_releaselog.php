<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateReleaselog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('releaselog', function (Blueprint $table) {
            //if($table->engine == 'MyISAM')
            //{
                DB::statement('ALTER TABLE `releaselog` ENGINE = InnoDB');
            //}
            $table->uuid('uuid');
        });
        DB::statement('UPDATE `releaselog` SET `uuid` = uuid()');
        Schema::table('releaselog', function (Blueprint $table) {
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
        Schema::drop('releaselog');
    }
}
