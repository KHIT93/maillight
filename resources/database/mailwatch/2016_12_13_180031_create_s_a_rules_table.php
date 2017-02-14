<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSARulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sa_rules', function (Blueprint $table) {
            //if($table->engine == 'MyISAM')
            //{
                DB::statement('ALTER TABLE `sa_rules` ENGINE = InnoDB');
            //}
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sa_rules');
    }
}
