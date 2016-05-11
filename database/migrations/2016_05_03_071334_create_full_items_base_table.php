<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFullItemsBaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('full_items_base', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('appid');
            $table->integer('classid');
            $table->integer('instanceid');
            $table->string('icon_url');
            $table->string('icon_url_large');
            $table->string('icon_drag_url');
            $table->string('market_price');
            $table->string('name');
            $table->string('market_hash_name');
            $table->string('market_name');
            $table->string('name_color');
            $table->string('background_color');
            $table->string('type');
            $table->boolean('tradable');
            $table->boolean('marketable');
            $table->boolean('commodity');
            $table->string('market_tradable_restriction');
            $table->string('descriptions');
            $table->string('actions');
            $table->string('market_actions');
            $table->string('tags');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('full_items_base');
    }
}
