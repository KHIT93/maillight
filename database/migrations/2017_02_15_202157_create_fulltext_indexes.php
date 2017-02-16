<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFulltextIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `blacklist` ADD FULLTEXT `to_address` (`to_address`)');
        DB::statement('ALTER TABLE `blacklist` ADD FULLTEXT `from_address` (`from_address`)');
        DB::statement('ALTER TABLE `inq` ADD FULLTEXT `hostname` (`hostname`)');
        DB::statement('ALTER TABLE `maillog` ADD FULLTEXT `from_address` (`from_address`)');
        DB::statement('ALTER TABLE `maillog` ADD FULLTEXT `from_domain` (`from_domain`)');
        DB::statement('ALTER TABLE `maillog` ADD FULLTEXT `to_address` (`to_address`)');
        DB::statement('ALTER TABLE `maillog` ADD FULLTEXT `to_domain` (`to_domain`)');
        DB::statement('ALTER TABLE `maillog` ADD FULLTEXT `clientip` (`clientip`)');
        DB::statement('ALTER TABLE `maillog` ADD FULLTEXT `hostname` (`hostname`)');
        DB::statement('ALTER TABLE `mtalog` ADD FULLTEXT `host` (`host`)');
        DB::statement('ALTER TABLE `mtalog` ADD FULLTEXT `type` (`type`)');
        DB::statement('ALTER TABLE `mtalog` ADD FULLTEXT `msg_id` (`msg_id`)');
        DB::statement('ALTER TABLE `mtalog` ADD FULLTEXT `relay` (`relay`)');
        DB::statement('ALTER TABLE `outq` ADD FULLTEXT `hostname` (`hostname`)');
        DB::statement('ALTER TABLE `releaselog` ADD FULLTEXT `mailid` (`mailid`)');
        DB::statement('ALTER TABLE `saved_filters` ADD FULLTEXT `name` (`name`)');
        DB::statement('ALTER TABLE `saved_filters` ADD FULLTEXT `col` (`col`)');
        DB::statement('ALTER TABLE `saved_filters` ADD FULLTEXT `operator` (`operator`)');
        DB::statement('ALTER TABLE `saved_filters` ADD FULLTEXT `value` (`value`)');
        DB::statement('ALTER TABLE `saved_filters` ADD FULLTEXT `username` (`username`)');
        DB::statement('ALTER TABLE `user_filters` ADD FULLTEXT `username` (`username`)');
        DB::statement('ALTER TABLE `whitelist` ADD FULLTEXT `to_address` (`to_address`)');
        DB::statement('ALTER TABLE `whitelist` ADD FULLTEXT `from_address` (`from_address`)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
