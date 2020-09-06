<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Location;
use Faker\Generator as Faker;

$factory->define(Location::class, function (Faker $faker) {
    return [
        'location_name' => $faker->randomElement(['2.gimnazija','Plesni klub B&D']),
        'address'=> $faker->address,
    ];
});
