<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Excuse;
use App\Group;
use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'oib'=>$faker->numberBetween(11111111111,99999999999),
        'student_name'=>$faker->firstName,
        'student_last_name'=> $faker->lastName,
        'email'=> $faker->email,
        'course_id'=>factory(Course::class),
        ];
});
