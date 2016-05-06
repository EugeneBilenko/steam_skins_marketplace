<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ItemTest extends TestCase
{

    use DatabaseTransactions;

    protected $item;
    protected $itemTemplate;

    public function setUp() {

        parent::setUp();

        $this->user = factory(\App\Models\User::class, 1)->create();
        $this->itemTemplate = factory(\App\Models\FullItemsBase::class, 1)->create();
        $this->item = new \App\Models\Item();
    }

    /** @test */

    public function user_has_inventory_with_items () {

        $this->item->uniqueKey = str_random(16);
        $this->item->template($this->itemTemplate);
        $this->item->setOwner($this->user);
        $this->item->save();
    }

    /** @test */

    public function user_can_move_his_item_from_steam_to_inventory () {

        $this->item->setOwner($this->user);
    }

    /** @test */

    public function max_inventory_size_regarding_site_settings () {

    }

    /** @test */

    public function the_item_can_be_assigned_to_bot () {

    }


    /** @test */

    public function it_price_can_be_changed () {

    }

    /** @test */

    public function it_can_be_assigned_to_another_user () {

    }

}
