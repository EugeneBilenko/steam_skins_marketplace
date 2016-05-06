<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

//use \Illuminate\Container\Container as Container;
//use \Illuminate\Support\Facades\Facade as Facade;

class SteamAccountTest extends TestCase {

    use DatabaseTransactions;

    /** @test */

    public function add_account() {

        $result = factory(\App\Models\SteamAccount::class, 1)->create();

        $this->assertEquals(1, count($result));
    }

    /** @test */

    public function update_account_trade_url() {

        $account = factory(\App\Models\SteamAccount::class, 1)->create();

//        $this->assertEquals(1, count($account));
        $steamAccount = \App\Models\SteamAccount::find($account->id);
//        clm($steamAccount);
        $trade_url = str_random(10);
        $steamAccount->trade_url = $trade_url;
        $result = $steamAccount->save();

//        clm($result);

        $this->seeInDatabase('steam_accounts', [
            'id' => $account->id,
            'trade_url' => $trade_url
        ]);
    }

    /** @test */

    public function remove_account() {

        $test_account = factory(\App\Models\SteamAccount::class, 1)->create();

        $this->assertEquals(1, count($test_account));

        \App\Models\SteamAccount::destroy($test_account->id);

        $this->setExpectedException('\Exception');
        \App\Models\SteamAccount::where('id', $test_account->id)->firstOrFail();

    }

    /** @test */
    public function assign_user_to_steam() {

        $test_account = factory(\App\Models\SteamAccount::class, 1)->create();

        $user = factory(\App\Models\User::class, 1)->create();

        $test_account->assignUser($user);

        $this->seeInDatabase('users', [
            'id' => $user->id,
            'steam_account_id' => $test_account->id
        ]);

    }

    /** @test */
    public function it_can_has_only_one_assigned_user() {

        $test_account = factory(\App\Models\SteamAccount::class, 1)->create();

        $user = factory(\App\Models\User::class, 1)->create();
        $user2 = factory(\App\Models\User::class, 1)->create();
        $user3 = factory(\App\Models\User::class, 1)->create();

        $test_account->assignUser($user);
        $test_account->assignUser($user2);
        $test_account->assignUser($user3);

        $this->notSeeInDatabase('users', [
            'id' => $user->id,
            'steam_account_id' => $test_account->id
        ]);
        $this->notSeeInDatabase('users', [
            'id' => $user2->id,
            'steam_account_id' => $test_account->id
        ]);
        $this->seeInDatabase('users', [
            'id' => $user3->id,
            'steam_account_id' => $test_account->id
        ]);

    }

    /** @test */
    public function assign_bot_to_steam() {

        $test_account = factory(\App\Models\SteamAccount::class, 1)->create();
        $bot = factory(\App\Models\Bot::class, 1)->create();

        $test_account->assignBot($bot);

        $this->seeInDatabase('bots', [
            'id' => $bot->id,
            'steam_account_id' => $test_account->id
        ]);
    }

    /** @test */
    public function it_can_has_only_one_assigned_bot() {

        $test_account = factory(\App\Models\SteamAccount::class, 1)->create();

        $bot = factory(\App\Models\Bot::class, 1)->create();
        $bot2 = factory(\App\Models\Bot::class, 1)->create();
        $bot3 = factory(\App\Models\Bot::class, 1)->create();

        $test_account->assignBot($bot);
        $test_account->assignBot($bot2);
        $test_account->assignBot($bot3);

        $this->notSeeInDatabase('bots', [
            'id' => $bot->id,
            'steam_account_id' => $test_account->id
        ]);
        $this->notSeeInDatabase('bots', [
            'id' => $bot2->id,
            'steam_account_id' => $test_account->id
        ]);
        $this->seeInDatabase('bots', [
            'id' => $bot3->id,
            'steam_account_id' => $test_account->id
        ]);

    }
}