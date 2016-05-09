<?php

namespace App\Models;

use App\MainModel;

class FullItemsBase extends MainModel
{
    protected $table = "full_items_base";
    public $timestamps = true;
    protected $rules = [
        'appid' => 'integer|required',
        'classid' => 'integer|required',
        'instanceid' => 'integer|required',
        'icon_url' => 'string|required',
        'icon_url_large' => 'string',
        'icon_drag_url' => 'string',
        'market_price' => 'string|required',
        'name' => 'string|required',
        'market_hash_name' => 'string|required',
        'market_name' => 'string|required',
        'name_color' => 'string|required',
        'background_color' => 'string',
        'type' => 'string',
        'craft_class' => 'string',
        'market_tradable_restriction' => 'string',
        'tradable' => 'boolean|required',
        'marketable' => 'boolean|required',
        'commodity' => 'boolean|required',
        'descriptions' => '',
        'actions' => '',
        'market_actions' => '',
        'tags' => '',
    ];


    protected $fillable = [
        'appid',
        'classid',
        'instanceid',
        'icon_url',
        'icon_url_large',
        'icon_drag_url',
        'market_price',
        'name',
        'market_hash_name',
        'market_name',
        'name_color',
        'background_color',
        'type',
        'craft_class',
        'market_tradable_restriction',
        'tradable',
        'marketable',
        'commodity',
        'descriptions',
        'actions',
        'market_actions',
        'tags',
    ];

    public function items() {

        return $this->hasMany(Item::class);
    }

    public function finishedBillings() {

        return $this->hasMany(FinishedBillings::class);
    }
}