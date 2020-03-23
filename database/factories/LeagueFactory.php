<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\League;
use App\User;
use Faker\Generator as Faker;

$factory->define(League::class, function (Faker $faker) {
    return [
        'name'       => $faker->bs,
        'creator_id' => factory(User::class)
    ];
});
