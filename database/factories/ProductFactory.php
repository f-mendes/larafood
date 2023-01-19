<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tenant;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'tenant_id' => factory(Tenant::class),
        'name' => $faker->unique()->name, 
        'description' => $faker->sentence,
        'image' => 'cerveja.png',
        'price' => 4.99
    ];
});
