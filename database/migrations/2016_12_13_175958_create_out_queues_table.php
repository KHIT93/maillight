<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outq', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->text('id')->nullable();
            $table->date('cdate')->nullable();
            $table->time('ctime')->nullable();
            $table->text('from_address')->nullable();
            $table->text('to_address')->nullable();
            $table->text('subject')->nullable();
            $table->text('message')->nullable();
            $table->text('size')->nullable();
            $table->text('priority')->nullable();
            $table->text('attempts')->nullable();
            $table->text('lastattempt')->nullable();
            $table->text('hostname')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outq');
    }
}
