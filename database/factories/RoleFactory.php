<?php

use Faker\Generator as Faker;

$factory->define(Boaz\Role::class, function (Faker $faker) {
    return [
        'name' => str_random(5),
        'display_name' => implode(" ", $faker->words(2)),
        'description' => substr($faker->paragraph, 0, 191),
        'removable' => true,
    ];
});
