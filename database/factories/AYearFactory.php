<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AYear;
use App\Course;
use Faker\Generator as Faker;

$factory->define(AYear::class, function (Faker $faker) {
    return [
        'ayear'=>'2020/2021',
        'course_id'=>factory(Course::class)->create(),
        'semestar1_start'=>$faker->dateTimeBetween('15.09.2020.', '30.09.2020.'),
        'semestar1_end'=>$faker->dateTimeBetween('15.01.2021.','30.01.2021.'),
        'semestar2_start'=>$faker->dateTimeBetween('15.02.2021.','28.02.2021.'),
        'semestar2_end'=>$faker->dateTimeBetween('01.03.2021.','15.06.2021.'),
    ];
});
