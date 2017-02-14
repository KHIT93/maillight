<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavedFilersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saved_filters', function (Blueprint $table) {
            $table->dropIndex('unique_filters');
        });
        Schema::table('saved_filters', function (Blueprint $table) {
            DB::statement('ALTER TABLE `saved_filters` ENGINE = InnoDB');
            $table->uuid('uuid')->nullable();
        });
        DB::statement('UPDATE `saved_filters` SET `uuid` = uuid()');
        Schema::table('saved_filters', function (Blueprint $table) {
            DB::statement('ALTER TABLE `saved_filters` MODIFY `uuid` CHAR(36) NOT NULL');
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
        Schema::drop('saved_filters');
    }
}
