<?php

namespace App\Models;

use App\MainModel;

class Product
{

    protected $name = "";
    protected $cost = "";

    public function __construct($array){
        $this->name = $array[0];
        $this->cost = $array[1];
    }

    public function name() {
        return $this->name;
    }

    public function cost() {
        return $this->cost;
    }
}
