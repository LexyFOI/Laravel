<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Group;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Group::class, function (Faker $faker) {
    return [
        'group_name'=> $faker->colorName,
        'location_id'=> factory(\App\Location::class),
        'startTime'=> '08:00',
        //'startTime'=>$faker->time('H:i:s'),
        'endTime'=> '09:00',
        //'endTime'=> Carbon::createFromFormat('H:i:s', 'startTime')->addHour(),
        'group_points'=> $faker->numberBetween(0, 3),
        'organizer' => $faker->name,
    ];
});
