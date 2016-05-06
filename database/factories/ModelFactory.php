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
        'market_price' => '100000.99 - 200000.99',
        'name' => 'test_item_' . str_random(5),
        'defindex' => 1,
        'item_class' => 'test_item_class_1',
        'item_type_name' => 'test_item_type_1',
        'item_name' => 'test_item_name',
        'item_description' =>  'test_item_description',
        'proper_name' => 'test_item_proper',
        'item_quality' => 1,
        'image_inventory' => 'http://',
        'min_ilevel' => 1,
        'max_ilevel' => 100,
        'image_url' => 'http://',
        'image_url_large' => 'http://',
        'craft_class' => 'test_craft_class',
        'craft_material_type' => 'test_material',
        'capabilities_paintable' => false,
        'capabilities_nameable' => false,
        'capabilities_can_sticker' => false,
        'capabilities_can_stattrack_swap' => false,
        'attributes' => 'test_attrs',
    ];
});