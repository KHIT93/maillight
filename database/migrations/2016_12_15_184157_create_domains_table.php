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
            $table->string('domain_name', 45)->primary();
            $table->string('domain_admin', 45);
            $table->string('reseller', 45);
            $table->timestamp('created_ts');
            $table->integer('accountno');
            $table->string('relay_type', 45);
            $table->string('relay_map', 100);
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
