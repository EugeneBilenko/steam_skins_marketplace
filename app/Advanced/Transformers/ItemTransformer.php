<?php

namespace App\Advanced\Transformers;

class ItemTransformer extends Transformer {

    /**
     * Hide created_at and updated_at
     * @param $item
     * @return array
     */

    public function transform($item) {
        return [
            'id' => $item['id'],
            'name'  => $item['name'],
            'user_id'  => $item['user_id'],
            'bot_id'  => $item['bot_id'],
            'full_items_base_id'  => $item['full_items_base_id'],
            'unique_steam_key'  => $item['unique_steam_key'],
            'unique_item_attr'  => $item['unique_item_attr'],
            'status'  => $item['status'],
            'price'  => $item['price'],
        ];
    }
}