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
        Schema::create('mtalog', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->datetime('timestamp')->nullable()->index();
            $table->string('host', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->string('msg_id', 20)->nullable();
            $table->string('relay', 255)->nullable();
            $table->text('dsn')->nullable();
            $table->text('status')->nullable();
            $table->time('delay')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mtalog');
    }
}
