<?php

use Faker\Generator as Faker;

$factory->define(\Ntupla\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->colorName,
        'description' =>  $faker->text,
    ];
});
