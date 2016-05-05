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