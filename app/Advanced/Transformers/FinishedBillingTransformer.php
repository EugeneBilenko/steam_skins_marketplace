<?php

namespace App\Advanced\Transformers;

class FinishedBillingTransformer extends Transformer {

    /**
     * Hide  created_at and updated_at
     * @param $fBilling
     * @return array
     */

    public function transform($fBilling) {
        return [
            'id' => $fBilling['id'],
            'unique_steam_key' => $fBilling['unique_steam_key'],
            'first_owner_users_id' => $fBilling['first_owner_users_id'],
            'second_owner_users_id' => $fBilling['second_owner_users_id'],
            'bot_id' => $fBilling['bot_id'],
            'full_items_base_id' => $fBilling['full_items_base_id'],
            'action' => $fBilling['action'],
            'status' => $fBilling['status'],
            'price' => $fBilling['price'],
        ];
    }
}