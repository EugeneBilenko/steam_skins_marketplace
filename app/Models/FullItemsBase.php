<?php

namespace App\Models;

use App\MainModel;

class FullItemsBase extends MainModel
{
    protected $table = "full_items_base";
    public $timestamps = true;
    protected $rules = [
        'market_price' => 'string|required',
        'name' => 'string',
        'defindex' => 'integer',
        'item_class' => 'string|required',
        'item_type_name' => 'string|required',
        'item_name' => 'string|required',
        'item_description' => 'string|required',
        'proper_name' => 'string|required',
        'item_quality' => 'integer|required',
        'image_inventory' => 'string|required',
        'min_ilevel' => 'integer|required',
        'max_ilevel' => 'integer|required',
        'image_url' => 'string|required',
        'image_url_large' => 'string|required',
        'craft_class' => 'string|required',
        'craft_material_type' => 'string|required',
        'capabilities_paintable' => 'boolean|required',
        'capabilities_nameable' => 'boolean|required',
        'capabilities_can_sticker' => 'boolean|required',
        'capabilities_can_stattrack_swap' => 'boolean|required',
        'attributes' => 'string|required',
    ];
    protected $fillable = [
        'unique_steam_key',
        'first_owner_users_id',
        'second_owner_users_id',
        'bot_id',
        'full_items_base_id',
        'action',
        'status',
        'price',
    ];


    public function user() {

        return $this->belongsTo(User::class);
    }

    public function bot() {

        return $this->belongsTo(Bot::class);
    }

    public function fullItem() {

        return $this->belongsTo(FullItemsBase::class);
    }
}
