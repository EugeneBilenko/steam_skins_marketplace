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

$factory->define(App\Models\User\Credit::class, function (Faker\Generator $faker) {
    file
    return [
        'market_price' => 'string|required',
        'name' => 'string',
        'defindex' => 'integer',
        'item_class' => 'string|required',
        'item_type_name' => 'string|required',
        'item_name' => 'string|required',
        'item_description' => 'string|required',
        'proper_name' => 'string|required',
        'item_quality' => 'integer|required',
        'image_inventory' => 'string|required',
        'min_ilevel' => 'integer|required',
        'max_ilevel' => 'integer|required',
        'image_url' => 'string|required',
        'image_url_large' => 'string|required',
        'craft_class' => 'string|required',
        'craft_material_type' => 'string|required',
        'capabilities_paintable' => 'boolean|required',
        'capabilities_nameable' => 'boolean|required',
        'capabilities_can_sticker' => 'boolean|required',
        'capabilities_can_stattrack_swap' => 'boolean|required',
        'attributes' => 'string|required',
    ];
});