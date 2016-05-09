<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ItemTest extends TestCase
{

    use DatabaseTransactions;

    protected $item;
    protected $itemTemplate;

    /** @test */

    public function it_can_be_assignet_to_user () {

        $user = factory(\App\Models\User::class)->create();
        $item = factory(\App\Models\Item::class)->create();

        $item->setOwner($user);

        $this->seeInDatabase('items', [
            'id' =>  $item->id,
            'user_id' => $user->id,
        ]);
    }


    /** @1test */

    public function max_inventory_size_regarding_site_settings () {

        $user = factory(\App\Models\User::class)->create();
        $items = factory(\App\Models\Item::class, 50)->create();

        foreach($items as $item) {
            $item->setOwner($user);
        }
        $oItem = new \App\Models\Item();
        $assigntedItems = $oItem->where('user_id', $user->id)->count();

        $this->assertEquals(\App\Models\Option::getOption('inventory_size'), $assigntedItems);
    }

    /** @test */

    public function the_item_can_be_assigned_to_bot () {

        $bot = factory(\App\Models\Bot::class)->create();
        $item = factory(\App\Models\Item::class)->create();
        $item->setBot($bot);
        $this->seeInDatabase('items', [
            'id' =>  $item->id,
            'bot_id' => $bot->id,
        ]);
    }


    /** @test */

    public function it_price_can_be_changed () {
        $item = factory(\App\Models\Item::class)->create();
        $item->setPrice(1000);
        $this->seeInDatabase('items', [
            'id' =>  $item->id,
            'price' => 1000,
        ]);
    }

    /** @test */

    public function it_can_be_assigned_to_another_user () {

        $user = factory(\App\Models\User::class)->create();
        $item = factory(\App\Models\Item::class)->create();
        $item->setOwner($user);
        $this->seeInDatabase('items', [
            'id' =>  $item->id,
            'user_id' => $user->id,
        ]);
        $user2 = factory(\App\Models\User::class)->create();
        $item->setOwner($user2);
        $this->seeInDatabase('items', [
            'id' =>  $item->id,
            'user_id' => $user2->id,
        ]);
    }

}
