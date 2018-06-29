<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Qualification::class, function (Faker $faker) {
    return [
    	'crebo' => $faker->randomNumber(5),
    	'owner' => $faker->word(),
        'title' => strtoupper($faker->word()),
        'sub_title' => $faker->text(20),
        'duration' => $faker->numberBetween(1, 3),
        'terms_per_year' => $faker->numberBetween(2, 4)
    ];
});
