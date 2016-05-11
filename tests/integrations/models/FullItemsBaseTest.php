<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FullItemsBaseTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */

    public function add_items() {
        $items = \App\Models\FullItemsBase::all()->count();
//        clm($items);
        factory(\App\Models\FullItemsBase::class, 10)->create();

        $items2 = \App\Models\FullItemsBase::all()->count();

        $this->assertEquals(10, ($items2 - $items));
    }
}
