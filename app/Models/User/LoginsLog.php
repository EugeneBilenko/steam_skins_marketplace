<?php

namespace App\Models\User;

use App\MainModel;
use App\Models\User;

class LoginsLog extends MainModel
{
    protected $table = 'user_referrals';
    public $timestamps = true;
    protected $rules = [
        'user_id' => 'integer|required',
        'steam_id' => 'integer'
    ];

    protected $fillable = ['user_id','steam_id'];


    public function user() {
        return $this->belongsTo(User::class);
    }

    //todo: get steam id from steam accounts by user id
}
