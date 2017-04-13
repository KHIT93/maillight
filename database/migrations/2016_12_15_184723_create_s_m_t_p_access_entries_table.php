<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSMTPAccessEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smtpaccess', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->integer('id');
            $table->string('prefix', 10);
            $table->string('smtp_value', 100);
            $table->text('comment');
            $table->string('action', 50)->default('RELAY');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('smtpaccess');
    }
}
