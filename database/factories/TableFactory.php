<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Table;
use App\Models\Tenant;
use Faker\Generator as Faker;

$factory->define(Table::class, function (Faker $faker) {
    return [
        'tenant_id' => factory(Tenant::class),
        'name' => 'Mesa ' . $faker->unique()->name, 
        'description' => $faker->sentence,
    ];
});
