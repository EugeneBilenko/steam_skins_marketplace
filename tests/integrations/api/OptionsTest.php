<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class ApiOptionsTest extends ApiTester
{

    use DatabaseTransactions;

    /** @test  */

    public function it_fetches_options() {

        $this->getJson('api/options');
        $this->assertResponseOk();
    }

    /** @test  */

    public function it_fetches_a_single_option() {

        $option = factory(App\Models\Option::class, $this->times)->create();
        $optionData = $this->getJson('api/options/' . $option->id)->data;

        $this->assertEquals($option->key , $optionData->key);
        $this->assertResponseOk();
    }

    /** @test  */

    public function it_422s_if_a_option_is_not_found() {

        $option = factory(App\Models\Option::class, $this->times)->create();
        $optionData = $this->getJson('api/options/x');

        $this->assertResponseStatus(422);
    }

    /** @test  */

    public function it_creates_a_new_option_given_valid_parameters() {

        $data = [
            'key' => str_random(10),
            'value' => '1',
        ];

        $optionData = $this->getJson('api/options', 'POST', $data);

        $this->assertResponseStatus(200);
    }

    /** @test  */

    public function it_cross_422_creates_a_new_option_given_invalid_parameters() {

        $data = [
            'key' => str_random(10),
        ];
        $optionData = $this->getJson('api/options', 'POST', $data);

        $this->assertResponseStatus(422);
    }

}
