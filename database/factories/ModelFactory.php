<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'role' => 'user',
    ];
});

$factory->define(App\Models\Option::class, function (Faker\Generator $faker) {
    return [
        'key' =>  str_random(10),
        'value' => $faker->text,
    ];
});

$factory->define(App\Models\SteamAccount::class, function (Faker\Generator $faker) {
    return [
        'steam_id' =>  str_random(10),
        'name' =>  'test_account',
        'profile_url' =>  str_random(10),
    ];
});

$factory->define(App\Models\Bot::class, function (Faker\Generator $faker) {
    return [
        'type' =>  'trader',
    ];
});

$factory->define(App\Models\User\Transaction::class, function (Faker\Generator $faker) {
    return [

    ];
});

$factory->define(App\Models\User\Credit::class, function (Faker\Generator $faker) {
    return [

    ];
});

$factory->define(\App\Models\FullItemsBase::class, function (Faker\Generator $faker) {
    return [
        "market_price" => "999",
        "appid"=> 730,
        "classid"=> random_int(1111111111, 9999999999), //classid
        "instanceid"=> random_int(111111111, 999999999),
        "icon_url"=> "-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf3qr3czxb49KzgL-KmsjuNrnDl1Rd4cJ5nqeUpoqs3gDlqUE-ZW-hIoOddVA5ZlGF_we8w-y81p-07ZnBzXpq6yF3-z-DyLqRPiTH",
        "icon_url_large"=> "-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf3qr3czxb49KzgL-KmsjuNrnDl1Rd4cJ5ntbN9J7yjRrh-BVlZW3ydoTHdABsZ13Y_Qe5xue6gMC-vp-amntr6yQq4XfUzhTin1gSOZHog2Kf",
        "icon_drag_url"=> "",
        "name"=> "2605 M9 Bayonet | Slaughter",
        "market_hash_name"=> "2605 M9 Bayonet | Slaughter (Factory New)",
        "market_name"=> "2605 M9 Bayonet | Slaughter (Factory New)",
        "name_color"=> "8650AC",
        "background_color"=> "",
        "type"=> "2605 Covert Knife",
        "tradable"=> 1,
        "marketable"=> 1,
        "commodity"=> 0,
        "market_tradable_restriction"=> "7",
        "descriptions"=> '',
        "actions"=> '',
        "market_actions"=> '',

    ];
});

$factory->define(\App\Models\Item::class, function (Faker\Generator $faker) {
    $template = factory(App\Models\FullItemsBase::class)->create();

    return [
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'full_items_base_id' =>$template->id,
        'unique_steam_key' => random_int(111111111, 999999999) . '_' . $template->classid . '_' . $template->instanceid,
    ];
});