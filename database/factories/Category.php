<?php

use Faker\Generator as Faker;

$factory->define(\Ntupla\Category::class, function (Faker $faker) {
    $name = $faker->colorName;
    return [
        'name' => $name,
        'slug' => str_slug($name),
        'description' =>  $faker->text,
    ];
});
