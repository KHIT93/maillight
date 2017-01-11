<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domainsettings', function (Blueprint $table) {
            $table->string('domainname', 50);
            $table->string('domainuser', 45);
            $table->integer('spamlevel')->default(5);
            $table->integer('spamaction')->default(0);
            $table->integer('highspamaction')->default(1);
            $table->primary(['domainname', 'domainuser']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domainsettings');
    }
}
