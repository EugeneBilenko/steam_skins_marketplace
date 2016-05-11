<?php

namespace App\Advanced\Transformers;

class BillingTransformer extends Transformer {

    /**
     * Hide id, created_at and updated_at
     * @param $billing
     * @return array
     */

    public function transform($billing) {
        return [
            'id' => $billing['id'],
            'user_id' => $billing['key'],
            'status' => $billing['key'],
            'item_id' => $billing['key'],
        ];
    }
}