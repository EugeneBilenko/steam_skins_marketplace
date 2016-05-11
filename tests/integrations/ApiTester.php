<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTester extends TestCase
{

    protected $times = 1;
    protected $admin;

//    protected $csrf;

    public function setUp() {

        parent::setUp();
        $this->admin = factory(\App\Models\User::class)->create(['role' => 'admin']);
    }

    protected function getJson($url, $method = 'GET', $data = []) {
        return json_decode($this->signIn($this->admin)->call($method, $url, $data)->getContent());
    }

    protected function times($count = 1) {
        $this->times = $count;
        return $this;
    }

    public function testApi() {
        $this->getJson('api/test');
        $this->assertResponseOk();
    }

}
