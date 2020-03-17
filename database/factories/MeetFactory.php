<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\League;
use App\Meet;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Meet::class, function (Faker $faker) {
    return [
        'league_id' => function() {
        return factory(League::class)->create()->id;
        },
        'meet_date' => $faker->dateTimeBetween('-1 month', '1 month')->format('Y-m-d'),
        'meet_time' => str_pad($faker->numberBetween(8, 22),2, '0', STR_PAD_LEFT) . ':00:00'
    ];
});
