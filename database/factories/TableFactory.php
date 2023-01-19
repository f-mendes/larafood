<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Table;
use Faker\Generator as Faker;

$factory->define(Table::class, function (Faker $faker) {
    return [
        'tenant_id' => function (array $attributes) {
            return $attributes['tenant_id'];
        },
        'name' => 'Mesa ' . $faker->unique()->name, 
        'description' => $faker->sentence,
    ];
});
