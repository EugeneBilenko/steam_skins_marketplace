<?php
class OrderTest extends PHPUnit_Framework_TestCase {

    function test_an_order_consists_of_products(){
        $order = new \App\Models\Order;

        $product = new \App\Models\Product(['Fallout 4', 59]);
        $product2 = new \App\Models\Product(['Pill', 60]);
        $order->add($product);
        $order->add($product2);
//        fwrite(STDERR, print_r($order, TRUE));
        $this->assertEquals(2, count($order->products()));
        $this->assertCount(2, $order->products());

    }

    /** @test */

    function an_order_can_determine_the_total_cost_of_all_its_products(){

        $order = new \App\Models\Order;

        $product = new \App\Models\Product(['Fallout 4', 59]);
        $product2 = new \App\Models\Product(['Pill', 60]);
        $order->add($product);
        $order->add($product2);
//        fwrite(STDERR, var_dump($order->total()));
//        fwrite(STDERR, var_dump($product->cost()));
//        fwrite(STDERR, print('___111111111'));
        $this->assertEquals(119, $order->total());
    }


    /** @1testTest */

    public function  a_user_can_like_a_post(){

        $this->signIn();

        $this->post->like();

        $this->seeInDatabase('likes', [
            'user_id' => $this->user->id,
            'likeable_id' => $this->post->id,
            'likeable_type' => get_class($this->post)

        ]);

        $this->assertTrue($this->post->isLiked());
    }

}