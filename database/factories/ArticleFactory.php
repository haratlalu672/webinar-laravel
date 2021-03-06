<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'user_id'         => '1',
        'slug'         => $faker->text,
        'title'        => $faker->text,
        'content'      => $faker->paragraph,
        'thumbnail'      => 'img/default.jpg',
        'is_published' => true,
    ];
});
