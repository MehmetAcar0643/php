<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Blog;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    $title=$faker->sentence(3);
    return [
        'title' =>$title,
        'slug' =>Str::slug($title),
        'description' =>$faker->paragraph,
        'file' => "https://images.unsplash.com/photo-1593642531955-b62e17bdaa9c?ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80",
        'status' =>$faker->randomElement(['0','1']),
        'must' => 999,
    ];
});
