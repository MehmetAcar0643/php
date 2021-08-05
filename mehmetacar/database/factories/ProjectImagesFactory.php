<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProjectImage;
use Faker\Generator as Faker;

$factory->define(ProjectImage::class, function (Faker $faker) {
    return [
        'project_id' => $faker->numberBetween(1, 20),
        'file' => "https://images.unsplash.com/photo-1625062294644-654200e31edb?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1947&q=80",
        'status' => $faker->randomElement(['0', '1']),
        'must' => 999,
    ];
});
