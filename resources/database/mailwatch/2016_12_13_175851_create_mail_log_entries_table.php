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
            $table->renameColumn('isspam', 'is_spam');
            $table->renameColumn('ishighspam', 'is_highspam');
            $table->renameColumn('issaspam', 'is_sa_spam');
            $table->renameColumn('isrblspam', 'is_rbl_spam');
            $table->renameColumn('isfp', 'is_fp');
            $table->renameColumn('isfn', 'is_fn');
            $table->renameColumn('spamwhitelisted', 'spam_whitelisted');
            $table->renameColumn('spamblacklisted', 'spam_blacklisted');
            $table->renameColumn('sascore', 'sa_score');
            $table->renameColumn('spamreport', 'spam_report');
            $table->renameColumn('virusinfected', 'virus_infected');
            $table->renameColumn('nameinfected', 'name_infected');
            $table->renameColumn('otherinfected', 'other_infected');
            $table->renameColumn('ismcp', 'is_mcp');
            $table->renameColumn('ishighmcp', 'is_highmcp');
            $table->renameColumn('issamcp', 'is_sa_mcp');
            $table->renameColumn('mcpwhitelisted', 'mcp_whitelisted');
            $table->renameColumn('mcpblacklisted', 'mcp_blacklisted');
            $table->renameColumn('mcpsascore', 'mcp_sa_score');
            $table->renameColumn('mcpreport', 'mcp_report');
            $table->tinyInteger('released')->nullable()->index();
            $table->tinyInteger('deleted')->nullable()->index();
            DB::statement('ALTER TABLE `maillog` MODIFY `uuid` CHAR(36) NOT NULL');
            $table->primary('uuid');
            $table->index('timestamp');
            $table->index(['date', 'time']);
            $table->index('quarantined');
            $table->index('from_address');
            $table->index('from_domain');
            $table->index('to_domain');
            $table->index('to_address');
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
