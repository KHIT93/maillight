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
            $table->string('from_address', 511)->nullable();
            $table->string('from_domain', 255)->nullable();
            $table->string('to_address', 511)->nullable();
            $table->string('to_domain', 255)->nullable();
            $table->string('subject', 1023)->nullable();
            $table->ipAddress('clientip')->nullable();
            $table->text('archive')->nullable();
            $table->tinyInteger('isspam')->nullable();
            $table->tinyInteger('ishighspam')->nullable();
            $table->tinyInteger('issaspam')->nullable();
            $table->tinyInteger('isrblspam')->nullable();
            $table->tinyInteger('isfp')->nullable();
            $table->tinyInteger('isfn')->nullable();
            $table->tinyInteger('spamwhitelisted')->nullable();
            $table->tinyInteger('spamblacklisted')->nullable();
            $table->decimal('sascore', 7, 2)->nullable();
            $table->text('spamreport')->nullable();
            $table->tinyInteger('virusinfected')->nullable();
            $table->tinyInteger('nameinfected')->nullable();
            $table->tinyInteger('otherinfected')->nullable();
            $table->text('report')->nullable();
            $table->tinyInteger('ismcp')->nullable();
            $table->tinyInteger('ishighmcp')->nullable();
            $table->tinyInteger('issamcp')->nullable();
            $table->tinyInteger('mcpwhitelisted')->nullable();
            $table->tinyInteger('mcpblacklisted')->nullable();
            $table->decimal('mcpsascore', 7, 2)->nullable();
            $table->text('mcpreport')->nullable();
            $table->string('hostname', 255)->nullable();
            $table->date('date')->nullable()->index();
            $table->time('time')->nullable()->index();
            $table->text('headers')->nullable();
            $table->tinyInteger('quarantined')->nullable()->index();
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
