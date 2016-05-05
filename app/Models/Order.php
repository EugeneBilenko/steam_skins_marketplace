<?php

namespace App\Models;
class Order {

    public $products = [];
    public function add(Product $product){
        $this->products[] = $product;
    }

    public function products(){
        return $this->products;
    }

    public function total(){

        $total =0;
        foreach($this->products as $product){
            $total = $total + $product->cost();
        }

        return $total;
    }
}