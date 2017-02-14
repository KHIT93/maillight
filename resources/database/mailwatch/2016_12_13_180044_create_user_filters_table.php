<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_filters', function (Blueprint $table) {
            $table->dropIndex('user_filters_username_idx');
        });
        Schema::table('user_filters', function (Blueprint $table) {
            DB::statement('ALTER TABLE `user_filters` ENGINE = InnoDB');
            $table->uuid('uuid')->nullable();
        });
        DB::statement('UPDATE `user_filters` SET `uuid` = uuid()');
        Schema::table('user_filters', function (Blueprint $table) {
            DB::statement('ALTER TABLE `user_filters` MODIFY `uuid` CHAR(36) NOT NULL');
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
        Schema::drop('user_filters');
    }
}
