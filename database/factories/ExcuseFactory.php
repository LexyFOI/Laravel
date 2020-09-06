<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Excuse;
use Faker\Generator as Faker;

$factory->define(Excuse::class, function (Faker $faker) {
    return [
        'excuse_id'=>$faker->randomDigit,
        'description'=>$faker->sentence,
    ];
});
