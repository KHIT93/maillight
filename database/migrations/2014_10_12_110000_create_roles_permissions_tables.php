<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolesPermissionsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('uuid');
            $table->string('name')->unique();
            $table->string('label')->nullable();
            $table->timestamps();
        });

        // Create table for associating roles to users (Many-to-Many)
        /*Schema::create('role_user', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('user_id');
            $table->uuid('role_id');
            $table->primary(['user_id', 'role_id']);
        });
        Schema::table('role_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('uuid')->on('users')
                ->onDelete('cascade');
            $table->foreign('role_id')->references('uuid')->on('roles')
                ->onDelete('cascade');
        });*/

        // Create table for storing permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('uuid');
            $table->string('name')->unique();
            $table->string('label')->nullable();
            $table->timestamps();
        });

        // Create table for associating permissions to roles (Many-to-Many)
        /*Schema::create('permission_role', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('permission_id');
            $table->uuid('role_id');
            $table->primary(['permission_id', 'role_id']);
        });
        Schema::table('permission_role', function (Blueprint $table) {
            $table->foreign('permission_id')->references('uuid')->on('permissions')
                ->onDelete('cascade');
            $table->foreign('role_id')->references('uuid')->on('roles')
                ->onDelete('cascade');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('permission_role');
        Schema::drop('permissions');
        Schema::drop('role_user');
        Schema::drop('roles');
    }
}
