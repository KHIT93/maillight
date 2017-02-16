<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMTALogEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mtalog', function (Blueprint $table) {
            $table->dropIndex('mtalog_uniq');
            $table->dropIndex('mtalog_timestamp');
            $table->dropIndex('mtalog_type');
        });
        Schema::table('mtalog', function (Blueprint $table) {
            DB::statement('ALTER TABLE `mtalog` ENGINE = InnoDB');
            $table->uuid('uuid')->nullable();
        });
        DB::statement('UPDATE `mtalog` SET `uuid` = uuid()');
        Schema::table('mtalog', function (Blueprint $table) {
            DB::statement('ALTER TABLE `mtalog` MODIFY `uuid` CHAR(36) NOT NULL');
            $table->primary('uuid');
            $table->index('timestamp');
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
