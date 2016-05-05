<?php

use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    protected $testUser;
    protected $testWallet;

    public function setUp() {
        parent::setUp();

        $this->user = factory(\App\Models\User::class, 1)->create();
        $this->testWallet = factory(\App\Models\User\Credit::class)->create(['user_id'=>$this->user->id, 'credits' => 500]);
    }

    /** @test */

    public function it_has_wallet_with_credits() {

        $this->seeInDatabase('user_credits', [
            'id' =>  $this->testWallet->id,
            'user_id' => $this->user->id,
        ]);
    }

    /** @test */

    public function it_can_has_only_one_credits_wallet() {

        $creditsWallet = factory(\App\Models\User\Credit::class)->create(['user_id'=>$this->user->id]);

        $user = factory(\App\Models\User::class)->create();
        $creditsWallet2 = factory(\App\Models\User\Credit::class)->create(['user_id'=>$user->id]);
        $creditsWallet3 = factory(\App\Models\User\Credit::class)->create(['user_id'=>$user->id]);

        $credit = new \App\Models\User\Credit();
        $assignedWallets = $credit->where('user_id', '=', $this->user->id)->get();

        $this->assertCount(1,$creditsWallet->errors());
        $this->assertCount(1,$creditsWallet2->errors());
        $this->assertCount(1,$creditsWallet3->errors());
        $this->assertCount(1, $assignedWallets);

        $this->seeInDatabase('user_credits', [
            'id' =>  $this->testWallet->id,
            'user_id' => $this->user->id,
        ]);
    }

    /** @test */

    public function it_knows_how_mach_credits_it_has(){

        $balance = $this->user->getCreditsBalance();

        $this->assertEquals(500, $balance);

    }
    /** @test */

    public function it_can_add_some_credits() {

        $this->user->addCredits(100);

        $balance = $this->user->getCreditsBalance();

        $this->assertEquals(600, $balance);
        $this->seeInDatabase('user_credits', [
            'id' =>  $this->testWallet->id,
            'user_id' => $this->user->id,
            'credits' => 600
        ]);
    }

    /** @test */

    public function it_can_lost_some_credits() {

        $this->user->takeCredits(100);

        $balance = $this->user->getCreditsBalance();

        $this->assertEquals(400, $balance);
        $this->seeInDatabase('user_credits', [
            'id' =>  $this->testWallet->id,
            'user_id' => $this->user->id,
            'credits' => 400
        ]);
    }

    /** @test */

    public function it_can_make_a_transaction() {

        $transAction = factory(\App\Models\User\Transaction::class)->create(['user_id'=> $this->user->id, 'action' => 'buy', 'credits' => 0]);
//        fwrite(STDERR, var_dump($transAction->action));
        $this->user->makeTransaction($transAction);

        $this->seeInDatabase('user_transactions', [
            'id' => $transAction->id,
            'user_id' => $this->user->id,
        ]);
    }

    /** @test */

    public function each_transaction_change_total_user_credits() {

        $transAction = factory(\App\Models\User\Transaction::class)->create([
            'user_id'=>$this->user->id,
            'action'=>'buy',
            'credits'=>300
        ]);

        $this->user->makeTransaction($transAction);

        $this->seeInDatabase('user_transactions', [
            'id' => $transAction->id,
            'user_id' => $this->user->id,
            'action'=>'buy',
            'credits'=>300
        ]);

        $balance = $this->user->getCreditsBalance();

        $this->assertEquals(800, $balance);

        $transAction = factory(\App\Models\User\Transaction::class)->create([
            'user_id'=>$this->user->id,
            'action'=>'cashout',
            'credits'=>200
        ]);

        $this->user->makeTransaction($transAction);

        $this->seeInDatabase('user_transactions', [
            'id' => $transAction->id,
            'user_id' => $this->user->id,
            'action'=>'cashout',
            'credits'=>200
        ]);

        $balance = $this->user->getCreditsBalance();

        $this->assertEquals(600, $balance);
    }

    /** @test */

    public function making_log_on_each_user_login() {

        $user1 = factory(\App\Models\User::class)->create();
        $testAccount1 = factory(\App\Models\SteamAccount::class, 1)->create();
        $testAccount1->assignUser($user1);

        $user2 = factory(\App\Models\User::class)->create();

        event(new Login($user1, false));
        event(new Login($user2, false));
        $this->seeInDatabase('user_logins_log', [
            'user_id' => $user1->id,
            'steam_id'=>$testAccount1->id,
        ]);
        $this->seeInDatabase('user_logins_log', [
            'user_id' => $user2->id,
            'steam_id'=>null,
        ]);
    }



}
