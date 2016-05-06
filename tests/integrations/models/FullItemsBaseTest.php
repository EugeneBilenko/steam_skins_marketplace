<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FullItemsBaseTest extends TestCase
{
    /** @test */

    public function add_items()
    {
        factory(\App\Models\FullItemsBase::class, 10)->create();

        $items = \App\Models\FullItemsBase::all();

        $this->assertEquals(10, count($items));
    }
}
