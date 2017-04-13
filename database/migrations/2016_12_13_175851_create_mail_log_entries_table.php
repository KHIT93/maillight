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
        Schema::create('maillog', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->timestamp('timestamp')->index();
            $table->string('id', 255)->nullable();
            $table->bigInteger('size')->nullable();
            $table->string('from_address', 511)->nullable()->index();
            $table->string('from_domain', 255)->nullable()->index();
            $table->string('to_address', 511)->nullable()->index();
            $table->string('to_domain', 255)->nullable()->index();
            $table->string('subject', 1023)->nullable();
            $table->ipAddress('clientip')->nullable();
            $table->text('archive')->nullable();
            $table->tinyInteger('is_spam')->nullable();
            $table->tinyInteger('is_highspam')->nullable();
            $table->tinyInteger('is_sa_spam')->nullable();
            $table->tinyInteger('is_rbl_spam')->nullable();
            $table->tinyInteger('is_fp')->nullable();
            $table->tinyInteger('is_fn')->nullable();
            $table->tinyInteger('spam_whitelisted')->nullable();
            $table->tinyInteger('spam_blacklisted')->nullable();
            $table->decimal('sa_score', 7, 2)->nullable();
            $table->text('spam_report')->nullable();
            $table->tinyInteger('virus_infected')->nullable();
            $table->tinyInteger('name_infected')->nullable();
            $table->tinyInteger('other_infected')->nullable();
            $table->text('report')->nullable();
            $table->tinyInteger('is_mcp')->nullable();
            $table->tinyInteger('is_highmcp')->nullable();
            $table->tinyInteger('is_sa_mcp')->nullable();
            $table->tinyInteger('mcp_whitelisted')->nullable();
            $table->tinyInteger('mcp_blacklisted')->nullable();
            $table->decimal('mcp_sa_score', 7, 2)->nullable();
            $table->text('mcp_report')->nullable();
            $table->string('hostname', 255)->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->text('headers')->nullable();
            $table->tinyInteger('quarantined')->nullable()->index();
            $table->tinyInteger('released')->nullable()->index();
            $table->tinyInteger('deleted')->nullable()->index();
            $table->index(['date', 'time']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maillog');
    }
}
