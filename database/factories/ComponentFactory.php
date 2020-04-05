<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Component;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Component::class, function (Faker $faker) {
    $summary = $faker->sentence;
    return [
        'user_id' => $faker->boolean ? 1 : factory(User::class)->create(),
        'summary' => $summary,
        'description' => $faker->paragraph(5),
        'code' => '<h1>Hello World</h1>',
        'category' => $faker->randomElement(['Navigation', 'Input', 'UI']),
        'slug' => Str::slug($summary)
    ];
});
