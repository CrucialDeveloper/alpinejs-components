<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Component;
use Faker\Generator as Faker;

$factory->define(Component::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'summary' => $faker->sentence,
        'description' => $faker->paragraph(5),
        'code' => '<h1>Hello World</h1>',
    ];
});
