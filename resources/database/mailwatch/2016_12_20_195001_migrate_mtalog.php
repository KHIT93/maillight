<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateMtalog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mtalog', function (Blueprint $table) {
            //if($table->engine == 'MyISAM')
            //{
                DB::statement('ALTER TABLE `mtalog` ENGINE = InnoDB');
            //}
            $table->uuid('uuid');
        });
        DB::statement('UPDATE `mtalog` SET `uuid` = uuid()');
        Schema::table('mtalog', function (Blueprint $table) {
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
        Schema::drop('mtalog');
    }
}
