<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bots', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');//allowed: bank, trade
            $table->integer('steam_account_id')->unsigned()->nullable();
            $table->foreign('steam_account_id')->references('id')->on('steam_accounts');
//            $table->string('steam_trade_url');
            $table->string('code_2fa')->nullable();//todo: check is it can bee null
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
        Schema::table('bots', function($table)
        {
            $table->dropForeign(['steam_account_id']);
        });
        Schema::drop('bots');
    }
}
