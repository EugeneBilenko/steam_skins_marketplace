<?php

namespace App\Advanced\Transformers;

class FullItemsBaseTransformer extends Transformer {

    /**
     * Hide id, created_at and updated_at
     * @param $item
     * @return array
     */

    public function transform($item) {
        return $item;
        return [
            'key' => $item['key'],
            'value' => $item['value'],
        ];
    }
}