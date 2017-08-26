<?php

use Faker\Generator as Faker;

$factory->define(\Ntupla\Tuple::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(\Ntupla\User::class)->create()->id;
        },
        'category_id' => function () {
            return factory(\Ntupla\Category::class)->create()->id;
        },
        'message' => $faker->text,
    ];
});
