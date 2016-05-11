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

//    $class = new \App\Http\Controllers\ItemsController();
//    $class->createItemsExamples();

//
//    $user = factory(App\Models\User::class)->create();
//    Event::fire(new \App\Events\SomeEvent($user));
//    event(new \App\Events\SomeEvent($user));
//    $example = file_get_contents('http://steamcommunity.com/id/samalexcs/inventory/json/730/2');
//    $fp = fopen(__DIR__ . '/data.json', 'w');
//    fwrite($fp, $example);
//    fclose($fp);
    return view('welcome');
});

//Headers: X-CSRF-TOKEN : thisTokenString
Route::get('get_csrf', function() {
    return [
        'csrf' => csrf_token()
    ];
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/blockchain-test-api', 'Blockchain\BlockchainController@testBlockchaineCurl');

Route::get('/blockchain-test', 'Blockchain\BlockchainController@testBlockchaineCurlLocal');

Route::group(['middleware' => 'auth'], function() {

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

Route::group(['prefix' => 'api'], function() {

    Route::get('test',function() {
        return Response::json(['data' => 'api'], 200, []);

    });

    Route::get('option/{key}', 'Api\OptionsController@getValue');
    Route::get('options', 'Api\OptionsController@index');
//    Route::get('items', 'Api\ItemsController@index');

    Route::group(['middleware' =>['auth','role:user']], function() {

    });

    Route::group(['middleware' =>['auth','role:support']], function() {

    });

    Route::group(['middleware' =>['auth','role:admin']], function() {
        Route::resource('billings', 'Api\BillingsController');
        Route::resource('bots', 'Api\BotsController');
        Route::resource('finished-billings', 'Api\FinishedBillingsController');
        Route::resource('items-base', 'Api\FullItemsBaseController');
//        Route::resource('items', 'Api\ItemsController', ['except' => 'index']);
        Route::resource('items', 'Api\ItemsController');
        Route::resource('options', 'Api\OptionsController');
        Route::resource('steam-accounts', 'Api\SteamAccountsController');
        Route::resource('users', 'Api\UsersController');
    });

});