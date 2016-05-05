<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserReferrals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_referrals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();                         //the owner of the referral code
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('referral_id')->unsigned();                     //user who used the referral code
            $table->foreign('referral_id')->references('id')->on('users');
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
        Schema::table('user_referrals', function($table)
        {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['referral_id']);
        });
        Schema::drop('user_referrals');
    }
}
