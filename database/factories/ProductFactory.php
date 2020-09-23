<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'titel' => $faker-> word,
        'omschrijving' => $faker->text(5000),
        'leerlingen' => $faker -> name,
        'link' => $faker -> domainName,
        'categorie_id' => $faker -> numberBetween(1,5),
        'module_id' => $faker -> numberBetween(1,5)    ];
});
