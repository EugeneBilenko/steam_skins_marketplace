<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {

//    $user = factory(App\Models\User::class)->create();
//    Event::fire(new \App\Events\SomeEvent($user));
//    event(new \App\Events\SomeEvent($user));
//    $example = file_get_contents('http://steamcommunity.com/id/samalexcs/inventory/json/730/2');
//    $fp = fopen(__DIR__ . '/data.json', 'w');
//    fwrite($fp, $example);
//    fclose($fp);
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/blockchain-test-api', 'Blockchain\BlockchainController@testBlockchaineCurl');

Route::get('/blockchain-test', 'Blockchain\BlockchainController@testBlockchaineCurlLocal');

Route::group(['middleware' => 'auth'], function() {

    Route::get('/billing', 'BillingController@index');

    Route::get('/billing/{ID}', 'BillingController@show');

    Route::post('/billing/store', 'BillingController@store');

    Route::get('/test-user', function () {
        session()->flash('msg','You have access user');
        session()->flash('msg-type', 'info');
        return view('welcome');
    });

});

Route::group(['middleware' =>['auth','role:support']], function() {

    Route::get('/test-support', function () {
        session()->flash('msg','You have access support');
        session()->flash('msg-type', 'info');
        return view('welcome');
    });

});

Route::group(['middleware' =>['auth','role:admin']], function() {

    Route::get('/test-admin', function () {
        session()->flash('msg','You have access admin');
        session()->flash('msg-type', 'info');
        return view('welcome');
    });

});
