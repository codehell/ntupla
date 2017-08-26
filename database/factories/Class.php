<?php

use Faker\Generator as Faker;

$factory->define(\Ntupla\Selectors::class, function (Faker $faker) {
    return [
        'selector' => $faker->colorName,
    ];
});
