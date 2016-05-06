<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name')->nullable();//allowed: bank, trade
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('bot_id')->unsigned()->nullable();
            $table->foreign('bot_id')->references('id')->on('bots');
            $table->integer('full_items_base_id')->unsigned();
            $table->foreign('full_items_base_id')->references('id')->on('full_items_base');
            $table->string('unique_steam_key');
            $table->integer('inventory_position');
            $table->string('unique_item_attr')->nullable();
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
        Schema::table('items', function($table)
        {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['bot_id']);
            $table->dropForeign(['full_items_base_id']);
        });
        Schema::drop('items');
    }
}