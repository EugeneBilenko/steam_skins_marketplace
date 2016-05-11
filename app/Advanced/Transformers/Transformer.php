<?php
/**
 * We can hide or rename fields in transform()
 */

namespace  App\Advanced\Transformers;

abstract class Transformer {

    public function transformCollection(array $items){
        return array_map([$this, 'transform'], $items);
    }

    public abstract function transform($item);

}