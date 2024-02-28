<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Clinic;
use Faker\Generator as Faker;

$factory->define(Clinic::class, function (Faker $faker) {
    return [
        'regular_id'=>$faker->unique()->numberBetween($min = 1, $max = 15),
        'name'=>$faker->text($maxNbChars = 30) // 255
    ];
});
