<?php

namespace App\Models;

use App\MainModel;


class Bot extends MainModel
{
    protected $table = "bots";
    public $timestamps = true;
    protected $rules = [
        'type' => 'string',
        'steam_account_id' => 'integer|unique:bots',
        'code_2fa' => 'string',
    ];
    protected $fillable = [
        'type',
        'steam_account_id',
        'code_2fa',
    ];

    public function steamAccount() {

        return $this->belongsTo(SteamAccount::class);
    }

    public function items() {

        return $this->hasMany(Item::class);
    }

}