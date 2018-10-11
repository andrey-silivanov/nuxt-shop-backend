<?php

use Faker\Generator as Faker;
use App\Models\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->text(50),
        'price' => $faker->numberBetween(100, 9000),
        'count' => $faker->randomDigit,
        'published' => true
    ];
});
