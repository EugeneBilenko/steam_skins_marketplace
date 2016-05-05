<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinishedBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finished_billings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_steam_key');//allowed: bank, trade
            $table->integer('first_owner_users_id')->unsigned();
            $table->foreign('first_owner_users_id')->references('id')->on('users');
            $table->integer('second_owner_users_id')->unsigned();
            $table->foreign('second_owner_users_id')->references('id')->on('users');
            $table->integer('bot_id')->unsigned();
            $table->foreign('bot_id')->references('id')->on('bots');
            $table->integer('full_items_base_id')->unsigned();
            $table->foreign('full_items_base_id')->references('id')->on('full_items_base');
            $table->string('action');
            $table->string('status');
            $table->integer('price')->nullable();
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
        Schema::table('finished_billings', function($table)
        {
            $table->dropForeign(['first_owner_users_id']);
            $table->dropForeign(['second_owner_users_id']);
            $table->dropForeign(['bot_id']);
            $table->dropForeign(['full_items_base_id']);
        });
        Schema::drop('finished_billings');
    }
}
