<?php

use Faker\Generator as Faker;

$factory->define(Boaz\User::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone' => $faker->phoneNumber,
        'avatar' => null,
        'address' => $faker->address,
        'country_id' => function () use ($faker) {
            return $faker->randomElement(Boaz\Country::pluck('id')->toArray());
        },
        'role_id' => function () {
            return factory(\Boaz\Role::class)->create()->id;
        },
        'status' => Boaz\Support\Enum\UserStatus::ACTIVE,
        'birthday' => $faker->date()
    ];
});
