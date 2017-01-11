<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domaintable', function (Blueprint $table) {
            $table->string('domainname', 45)->primary();
            $table->string('domainadmin', 45);
            $table->string('reseller', 45);
            $table->timestamp('createdts');
            $table->integer('accountno');
            $table->string('relaytype', 45);
            $table->string('relaymap', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domaintable');
    }
}
