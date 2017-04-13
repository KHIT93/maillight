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
            $table->string('domain_name', 50);
            $table->string('domain_user', 45);
            $table->integer('spam_level')->default(5);
            $table->integer('spam_action')->default(0);
            $table->integer('highspam_action')->default(1);
            $table->primary(['domain_name', 'domain_user']);
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
