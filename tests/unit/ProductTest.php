<?php

class ProductTest extends PHPUnit_Framework_TestCase {

    public $product;

    public function setUp(){

        $this->product = new \App\Models\Product(['Fallout 4', 59]);
    }

    function testAProductHasName(){

        $this->assertEquals('Fallout 4', $this->product->name());

    }

    function testAProductHasCost(){

        $this->assertEquals(59, $this->product->cost());

    }

    /** @test */

    function a_product_has_a_name(){

        $this->assertEquals('Fallout 4', $this->product->name());

    }

    /** @test */
    function a_product_has_a_cost(){

        $this->assertEquals(59, $this->product->cost());

    }

}