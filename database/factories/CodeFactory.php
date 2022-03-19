<?php

use Faker\Generator as Faker;

$factory->define(App\Code::class, function (Faker $faker) {
    return [
        'code' => $faker->unique()->regexify('[A-Za-z0-9]{20}'),
        'active' => 1,
    ];
});
