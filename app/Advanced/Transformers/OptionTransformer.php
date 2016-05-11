<?php

namespace App\Advanced\Transformers;

class OptionTransformer extends Transformer {

    /**
     * Hide created_at and updated_at
     * @param $option
     * @return array
     */

    public function transform($option) {
        return [
            'id' => $option['id'],
            'key' => $option['key'],
            'value' => $option['value'],
        ];
    }
}