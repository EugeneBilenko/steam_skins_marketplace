<?php

namespace App\Advanced\Transformers;

class SteamAccountTransformer extends Transformer {

    /**
     * Hide created_at and updated_at
     * @param $account
     * @return array
     */

    public function transform($account) {
        return [
            'id' => $account['id'],
            'trade_url' => $account['trade_url'],
            'steam_id' => $account['steam_id'],
            'name' => $account['name'],
            'profile_url' => $account['profile_url'],
            'avatar' => $account['avatar'],
            'status' => $account['status'],
            'visibility' => $account['visibility'],
            'profile_state' => $account['profile_state'],
            'last_logoff' => $account['last_logoff'],
            'comment_permission' => $account['comment_permission'],
            //private data
            'real_name' => $account['real_name'],
            'primary_group_id' => $account['primary_group_id'],
            'time_created' => $account['time_created'],
            'game_id' => $account['game_id'],
            'gameserver_ip' => $account['gameserver_ip'],
            'loc_country_code' => $account['loc_country_code'],
            'loc_state_code' => $account['loc_state_code'],
            'loc_city_id' => $account['loc_city_id'],

        ];
    }
}