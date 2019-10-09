<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Competition;
use Faker\Generator as Faker;

$factory->define(Competition::class, function (Faker $faker) {
  return [
    'name' => $faker->name,
    'station' => rand(1, 2),
    // 'type'   => rand(1, 3),
    'type'   => 1,
    'description' => $faker->text,
    'status' => rand(0, 1),
    'startDate' => $faker->date,  
    'endDate' => $faker->date,
    'created_at' => now(),  
    'updated_at' => now()
  ];
});
