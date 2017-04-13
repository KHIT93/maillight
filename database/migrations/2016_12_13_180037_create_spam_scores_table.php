<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpamScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spamscores', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->integer('user')->unsigned();
            $table->decimal('low_spamscore', 10, 0);
            $table->decimal('high_spamcore', 10, 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spamscores');
    }
}
