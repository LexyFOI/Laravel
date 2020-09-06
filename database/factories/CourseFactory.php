<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'course_shortName'=> $faker->randomElement(['IS','PS','EP']),
        'course_longName'=> $faker->sentence,
    ];
});
