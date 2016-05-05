<?php

namespace App\Models;

use App\MainModel;

class FinishedBillings extends MainModel
{
    protected $table = "finished_billings";
    public $timestamps = true;
    protected $rules = [
        'unique_steam_key' => 'string|required',
        'first_owner_users_id' => 'integer|required',
        'second_owner_users_id' => 'integer|required',
        'bot_id' => 'integer|required',
        'full_items_base_id' => 'integer|required',
        'action' => 'string|required',
        'status' => 'string|required',
        'price' => 'integer|required',
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

    public function firstOwner() {
        return $this->belongsTo(User::class);
    }

    public function secondOwner() {
        return $this->belongsTo(User::class);
    }

    public function bot() {
        return $this->belongsTo(Bot::class);
    }

    public function fullItemBase() {
        return $this->belongsTo(FullItemsBase::class);
    }

}
