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
    public function up()
    {
        Schema::create('full_items_base', function(Blueprint $table) {
            $table->increments('id');
            $table->string('market_price');
            $table->string('name');
            $table->integer('defindex');
            $table->string('item_class');
            $table->string('item_type_name');
            $table->string('item_name');
            $table->string('item_description');
            $table->string('proper_name');
            $table->integer('item_quality');
            $table->string('image_inventory');
            $table->integer('min_ilevel');
            $table->integer('max_ilevel');
            $table->string('image_url');
            $table->string('image_url_large');
            $table->string('craft_class');
            $table->string('craft_material_type');
            $table->boolean('capabilities_paintable');          //capabilities->paintable
            $table->boolean('capabilities_nameable');           //capabilities->nameable
            $table->boolean('capabilities_can_sticker');        //capabilities->can_sticker
            $table->boolean('capabilities_can_stattrack_swap'); //capabilities->can_stattrack_swap
            $table->text('attributes');
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
        Schema::dropIfExists('full_items_base');
    }
}
