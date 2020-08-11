<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
$factory->define(Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company(),
        'quantity' => $faker->randomNumber(),
        'barcode' => ''.$faker->randomNumber(6,true).$faker->randomNumber(6,true),
    ];
});
