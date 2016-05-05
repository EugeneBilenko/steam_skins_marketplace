<?php

namespace App\Models;

use App\MainModel;

class Item extends MainModel
{
    protected $table = "items";
    public $timestamps = true;
    protected $rules = [
        'name' => 'string|required',
        'user_id' => 'integer|required',
        'bot_id' => 'integer',
        'full_items_base_id' => 'integer|required',
        'unique_steam_key' => 'string|required',
        'unique_item_attr' => 'string',
        'status' => 'string',
        'price' => 'integer',
    ];
    protected $fillable = [
        'name',
        'user_id',
        'bot_id',
        'full_items_base_id',
        'unique_steam_key',
        'unique_item_attr',
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

    public function billing() {

        return $this->hasMany(Billing::class);
    }
}
