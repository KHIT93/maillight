<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailLogEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maillog', function (Blueprint $table) {
            $table->dropIndex('maillog_datetime_idx');
            $table->dropIndex('maillog_id_idx');
            $table->dropIndex('maillog_clientip_idx');
            $table->dropIndex('maillog_from_idx');
            $table->dropIndex('maillog_to_idx');
            $table->dropIndex('maillog_host');
            $table->dropIndex('from_domain_idx');
            $table->dropIndex('to_domain_idx');
            $table->dropIndex('maillog_quarantined');
            $table->dropIndex('timestamp');

        });
        Schema::table('maillog', function (Blueprint $table) {
            DB::statement('ALTER TABLE `maillog` ENGINE = InnoDB');
            $table->uuid('uuid')->nullable();
        });
        DB::statement('UPDATE `maillog` SET `uuid` = uuid()');
        Schema::table('maillog', function (Blueprint $table) {
            $table->renameColumn('id', 'mailwatch_id');
            DB::statement('ALTER TABLE `maillog` MODIFY `uuid` CHAR(36) NOT NULL');
            $table->primary('uuid');
            $table->index('timestamp');
            $table->index('date');
            $table->index('time');
            $table->index('quarantined');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('maillog');
    }
}
