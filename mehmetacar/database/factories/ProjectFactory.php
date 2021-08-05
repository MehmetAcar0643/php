<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Project::class, function (Faker $faker) {
    $title = $faker->sentence(3);
    return [
        'study_id' => $faker->numberBetween(1, 5),
        'title' => $title,
        'slug' => Str::slug($title),
        'description' => $faker->paragraph,
        'file' => "https://images.unsplash.com/photo-1593642531955-b62e17bdaa9c?ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80",
        'status' => $faker->randomElement(['0', '1']),
        'must' => 999,
        'baslangic' => $faker -> dateTimeThisDecade($max = '+10 years'),
        'bitis' =>$faker -> dateTimeThisDecade($max = '+10 years')
    ];
});
