<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 10.05.16
 * Time: 11:18
 */

namespace App\Advanced\Transformers;



class OptionTransformer extends Transformer
{
    public function transform($lesson) {
        return [
            'key' => $lesson['key'],
            'value' => $lesson['value'],
        ];
    }

}