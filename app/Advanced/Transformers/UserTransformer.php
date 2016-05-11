<?php

namespace App\Advanced\Transformers;

class UserTransformer extends Transformer {

    /**
     * Hide created_at and updated_at
     * @param $user
     * @return array
     */

    public function transform($user) {
        return [
            'name'=> $user['name'],
            'email'=> $user['email'],
            'role'=> $user['role'],
            'rankXP'=> $user['rankXP'],
            'referral_code'=> $user['referral_code'],
            'api_key'=> $user['api_key'],
            'steam_account_id'=> $user['steam_account_id'],

        ];
    }
}