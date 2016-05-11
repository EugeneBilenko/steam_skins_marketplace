<?php

namespace App\Advanced\Transformers;

class BotTransformer extends Transformer {

    /**
     * Hide created_at and updated_at
     * @param $bot
     * @return array
     */

    public function transform($bot) {
        return [
            'id' => $bot['id'],
            'type' => $bot['type'],
            'steam_account_id' => $bot['steam_account_id'],
            'code_2fa' => $bot['code_2fa'],
        ];
    }
}