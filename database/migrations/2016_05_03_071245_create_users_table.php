<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('user');//allowed : user, support, admin
            $table->integer('rankXP')->nullable();//user XP on site
            $table->string('referral_code')->nullable();//allowed : user, support, admin
            $table->string('api_key')->nullable();//allowed : user, support, admin
            $table->integer('steam_account_id')->unsigned()->nullable();
            $table->foreign('steam_account_id')->references('id')->on('steam_accounts');
            $table->string('api_token', 60);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table)
        {
            $table->dropForeign(['steam_account_id']);
        });
        Schema::drop('users');
    }
}
