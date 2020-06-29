<?php

use Faker\Generator as Faker;

$factory->define(App\Router::class, function (Faker $faker) {
    return [
        'sap_id'          => $faker->uuid,
        'hostname'        => $faker->url,
        'type'            => $faker->randomElement(['AGI', 'CSS']),
        'loopback'        => $faker->ipv4,
        'mac_address'     => $faker->macAddress 
    ];
});