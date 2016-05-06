<?php

namespace App\Models;

use App\MainModel;

class SteamAccount extends MainModel {

    protected $table = "steam_accounts";
    public $timestamps = true;
    protected $rules = [
        //public data
        'trade_url' => 'string',
        'steam_id' => 'string|required|unique:steam_accounts,id',
        'name' => 'string',
        'profile_url' => 'string|required',
        'avatar' => 'string',
        'status' => 'integer',
        'visibility' => 'integer',
        'profile_state' => 'integer',
        'last_logoff' => 'date',
        'comment_permission' => 'integer',
        //private data
        'real_name' => 'string',
        'primary_group_id' => 'string',
        'time_created' => 'date',
        'game_id' => 'string',
        'gameserver_ip' => 'string',
        'loc_country_code' => 'string',
        'loc_state_code' => 'string',
        'loc_city_id' => 'string',
    ];

    protected $fillable = [
        //public data
        'trade_url',
        'steam_id',
        'name',
        'profile_url',
        'avatar',
        'status',
        'visibility',
        'profile_state',
        'last_logoff',
        'comment_permission',
        //private data
        'real_name',
        'primary_group_id',
        'time_created',
        'game_id',
        'gameserver_ip',
        'loc_country_code',
        'loc_state_code',
        'loc_city_id',
    ];

    public function user() {

        return $this->hasOne(User::class);
    }

    public function assignUser(User $user) {

        $oldUser = $this->user();
        if ($oldUser) {
            $oldUser->update(['steam_account_id' => null]);
        }
        $this->user()->save($user);
    }

    public function bot() {

        return $this->hasOne(Bot::class);
    }

    public function assignBot(Bot $bot) {
        $oldBot = $this->bot();
        if ($oldBot) {
            $oldBot->update(['steam_account_id' => null]);
        }
        $this->bot()->save($bot);
    }
}
